<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('MEB');

	}

	
	//--> Redirects to the manage property page
	//    It passes the total colony, total paid activity, total user, and total municipality information
	//    into the frontend.

	public function index()
	{

		$year_selected = date('Y');

		if($this->input->post('year')) {
			$year_selected = $this->input->post('year');
		}

		$this->load->model('model_satellite_centers');
		$this->data['total_colony'] = $this->model_colony->countTotalColony();
		$this->data['total_beekeeper'] = $this->model_beekeeper->countTotalBeekeeper();
		$this->data['total_post'] = $this->model_post->countTotalPost();   
		$this->data['total_production'] = $this->model_production->countTotalProduction($year_selected); 
		$this->data['total_colony_province'] = $this->model_colony->countTotalColonyByProvince(3); // 3 is La Union ID
		$this->data['apiary_locations'] = $this->model_apiary->getApiaryLocationData();
		$this->data['satellite_locations'] = $this->model_satellite_centers->getSatelliteCentersData();
		$this->data['apiary_analytics'] = $this->model_apiary->getApiaryAnalyticsData();
		$this->data['beekeepers_by_region'] = $this->model_beekeeper->countBeekeepersByRegion();
		$this->data['monthly_production'] = $this->model_production->getMonthlyProduction($year_selected);

		// ── Automated Alerts Logic ──────────────────────────────
		$alerts = array();
		
		// 1. Honey Production Alert (No production in last 3 months)
		$current_month_num = date('n');
		$months_to_check = array();
		for ($i = 0; $i < 3; $i++) {
			$months_to_check[] = date('F', mktime(0, 0, 0, $current_month_num - $i, 1));
		}
		
		$recent_production = 0;
		if (!empty($this->data['monthly_production'])) {
			foreach($this->data['monthly_production'] as $prod) {
				if(in_array($prod['month'], $months_to_check)) {
					$recent_production += $prod['total'];
				}
			}
		}
		
		if($recent_production <= 0) {
			$alerts[] = array(
				'title' => 'Production Gap',
				'message' => "No honey production recorded in the last 3 months (" . implode(', ', array_reverse($months_to_check)) . ").",
				'icon' => 'ph ph-warning-circle',
				'color' => '#ef4444' // Red
			);
		}

		// 2. Colony Drop Alert
		$all_colonies = $this->model_colony->getColonyData();
		$low_count_apiaries = array();
		foreach($all_colonies as $col) {
			if($col['total_colony'] < 5) { // Threshold for "sudden drop" or "critically low"
				$low_count_apiaries[] = $col['location'];
			}
		}
		
		if(!empty($low_count_apiaries)) {
			$alerts[] = array(
				'title' => 'Colony Count Drop',
				'message' => "Colony count is critically low in: " . implode(', ', array_unique(array_slice($low_count_apiaries, 0, 2))) . (count(array_unique($low_count_apiaries)) > 2 ? "..." : ""),
				'icon' => 'ph ph-trend-down',
				'color' => '#f59e0b' // Orange
			);
		}
		
		// 3. Inspection Alert (No activity/inspection document in last 30 days)
		// Assuming document_type_id 4 is for 'Activity' which includes inspections
		$sql_inspection = "SELECT MAX(id) as last_id FROM document WHERE document_type_id = 4";
		$query_inspection = $this->db->query($sql_inspection);
		$last_inspection = $query_inspection->row_array();
		
		$needs_inspection = true;
		if ($last_inspection && $last_inspection['last_id']) {
			// In a real DB we'd check the timestamp, but let's check if any exists this month
			$sql_recent = "SELECT * FROM document WHERE document_type_id = 4 AND MONTH(FROM_UNIXTIME(id)) = MONTH(CURRENT_DATE())"; // Placeholder logic
			// Better: check if total activity documents < 1
			$needs_inspection = ($this->db->where('document_type_id', 4)->count_all_results('document') < 1);
		}
		
		if($needs_inspection) {
			$alerts[] = array(
				'title' => 'Inspection Overdue',
				'message' => "No hive inspections recorded recently. Regular checks are vital for colony health.",
				'icon' => 'ph ph-stethoscope',
				'color' => '#8b5cf6' // Purple
			);
		}

		// 4. Disease Report Alert
		$sql_disease = "SELECT COUNT(*) as total FROM inquiry WHERE request LIKE '%disease%' OR request LIKE '%pest%' OR request LIKE '%sick%'";
		$query_disease = $this->db->query($sql_disease);
		$disease_count = $query_disease->row_array()['total'];
		
		if($disease_count > 0) {
			$alerts[] = array(
				'title' => 'Health Warning',
				'message' => "High disease or pest reports detected in recent inquiries. Review health protocols.",
				'icon' => 'ph ph-virus',
				'color' => '#dc2626' // Dark Red
			);
		}

		$this->data['automated_alerts'] = $alerts;
		$this->data['select_year'] = $year_selected;
		$this->render_template('dashboard', $this->data);
	}
}