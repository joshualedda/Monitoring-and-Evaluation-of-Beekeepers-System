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

		$this->data['total_colony'] = $this->model_colony->countTotalColony();
		$this->data['total_beekeeper'] = $this->model_beekeeper->countTotalBeekeeper();
		$this->data['total_post'] = $this->model_post->countTotalPost();   
		$this->data['total_production'] = $this->model_production->countTotalProduction($year_selected); 
		$this->data['total_colony_province'] = $this->model_colony->countTotalColonyByProvince(3); // 3 is La Union ID
		$this->data['apiary_locations'] = $this->model_apiary->getApiaryLocationData();
		$this->data['apiary_analytics'] = $this->model_apiary->getApiaryAnalyticsData();

		$this->data['select_year'] = $year_selected;
		$this->render_template('dashboard', $this->data);
	}
}