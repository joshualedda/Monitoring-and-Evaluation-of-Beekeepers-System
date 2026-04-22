<?php 

class Model_report extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	//--> Get active information
	public function getReportList()
	{
		$sql = "SELECT report_code,report_title 
		FROM report 
		WHERE report_selection = ?
		ORDER BY report_code";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
public function getReport07()
	{
			$sql = "SELECT 	association.*,
							association_name AS 'name',
							'no code' AS 'code',
							region.name AS 'region_name',
							lgu.name AS 'lgu_name',
							province.name AS 'province_name',
							barangay.name AS 'barangay_name',
					CASE WHEN association.active = 1 THEN 'Yes' ELSE 'No' END AS 'active'
					FROM association
						LEFT JOIN region ON association.region_id=region.id
						LEFT JOIN province ON association.province_id = province.id
						LEFT JOIN lgu ON association.lgu_id = lgu.id
						LEFT JOIN barangay ON association.barangay_id = barangay.id
						ORDER BY id DESC";
			$query = $this->db->query($sql, array());
			return $query->result();
	}

	public function get_REP1A($apiary_id)
	{
				
		$sql="SELECT apiary.*,colony.*,beekeeper.*,species.name,phase.name as phase_name
		FROM apiary
		     LEFT JOIN colony on colony.apiary_id=apiary.id
		     LEFT JOIN species on species.id=colony.species_id
		     LEFT JOIN phase on phase.id=colony.phase_id
			 LEFT JOIN beekeeper on beekeeper.id=apiary.beekeeper_id
			 LEFT JOIN region on beekeeper.region_id=region.id
			 LEFT JOIN province ON beekeeper.province_id = province.id
			 LEFT JOIN lgu ON beekeeper.lgu_id = lgu.id
			 LEFT JOIN barangay ON beekeeper.barangay_id = barangay.id
			 LEFT JOIN association ON beekeeper.association_id = association.id
			 
		WHERE apiary.id =?"; 

		$query = $this->db->query($sql, array($apiary_id));
		return $query->result();		

	}

		public function getReportInfo ($report_code)
	{

		$sql = "SELECT report_code,report_title
				FROM report
				WHERE report_code = ?
				ORDER BY report_code";
		$query = $this->db->query($sql, array($report_code));
		return $query->row_array();
	}


	//--> print a specific colony
	public function get_REP0C($colony_id)
	{
		
		$sql = "SELECT colony.*, species.name AS 'species_name',
						phase.name AS 'phase_name',
						apiary.location AS 'apiary_location'
				FROM colony
				JOIN species ON colony.species_id = species.id
				JOIN PHASE ON colony.phase_id = phase.id
				JOIN apiary ON colony.apiary_id = apiary.id
				WHERE colony.id = ?";
		$query = $this->db->query($sql, array($colony_id));
		return $query->result();		

	}

	public function get_REP0C_Document($colony_id)
	{
		$sql = "SELECT document.*,document_type.name AS 'document_type_name'
		FROM document 
			JOIN document_type ON document.document_type_id = document_type.id
  	 	 	LEFT JOIN colony ON document.colony_id = colony.id
		WHERE document.colony_id = ?
		ORDER BY document_type.name";
		$query = $this->db->query($sql, array($colony_id));
		return $query->result();

	}
	//Get production data of the colony
	public function get_REP0C_production($colony_id)
	{
		$sql = "SELECT production.*, product.name AS 'product_name'
				FROM production
				JOIN product ON production.product_id = product.id
				WHERE production.colony_id = ?";
		$query = $this->db->query($sql, array($colony_id));
		return $query->result();
	}

	public function get_REP0C_beekeeper($colony_id)
	{
		$sql = "SELECT beekeeper.*,region.name AS 'region_name', barangay.name AS 'barangay_name',lgu.name AS 'lgu_name',
						gender.name AS 'gender_name',province.name AS 'province_name',association.association_name AS 'association_name',
						education.name AS'education_name',category.name AS 'category_name',barangay.name AS 'barangay_name',
					CASE WHEN beekeeper.active = 1 THEN 'Active' ELSE 'Inactive' END AS 'active'
				FROM beekeeper
				LEFT JOIN education ON beekeeper.education_id=education.id
				LEFT JOIN gender ON beekeeper.gender_id=gender.id
				LEFT JOIN region ON beekeeper.region_id=region.id
				LEFT JOIN province ON beekeeper.province_id = province.id
				LEFT JOIN lgu ON beekeeper.lgu_id = lgu.id
				LEFT JOIN barangay ON beekeeper.barangay_id = barangay.id
				LEFT JOIN association ON beekeeper.association_id = association.id
				JOIN category ON beekeeper.category_id = category.id
				JOIN apiary ON beekeeper.id = apiary.beekeeper_id
				JOIN colony ON colony.apiary_id = apiary.id
		WHERE colony.id = ?";
		$query = $this->db->query($sql, array($colony_id));
		return $query->result();
	}



	//--> print of a beekeeper 
	public function get_REP0B($beekeeper_id)
	{
		$sql = "SELECT beekeeper.*,region.name as 'region_name', barangay.name as 'barangay_name',lgu.name AS 'lgu_name',
			gender.name as 'gender_name',province.name AS 'province_name',association.association_name AS 'association_name',
			education.name as'education_name',category.name AS 'category_name',barangay.name AS 'barangay_name',
			CASE WHEN beekeeper.active = 1 THEN 'Active' else 'Inactive' END AS 'active'
		FROM beekeeper 
		     LEFT JOIN education on beekeeper.education_id=education.id
			 LEFT JOIN gender on beekeeper.gender_id=gender.id
			 LEFT JOIN region on beekeeper.region_id=region.id
			 LEFT JOIN province ON beekeeper.province_id = province.id
			 LEFT JOIN lgu ON beekeeper.lgu_id = lgu.id
			 LEFT JOIN barangay ON beekeeper.barangay_id = barangay.id
			 LEFT JOIN association ON beekeeper.association_id = association.id
			 JOIN category ON beekeeper.category_id = category.id
		WHERE beekeeper.id = ?";
		$query = $this->db->query($sql, array($beekeeper_id));
		return $query->result();
	}

	public function get_REP0B_apiary($beekeeper_id)
	{
		$sql = "SELECT apiary.*,region.name as 'region_name', barangay.name as 'barangay_name',lgu.name AS 'lgu_name',
			province.name AS 'province_name',
			barangay.name AS 'barangay_name'
			FROM apiary 
			 LEFT JOIN region on apiary.region_id=region.id
			 LEFT JOIN province ON apiary.province_id = province.id
			 LEFT JOIN lgu ON apiary.lgu_id = lgu.id
			 LEFT JOIN barangay ON apiary.barangay_id = barangay.id
		WHERE beekeeper_id = ?";
		$query = $this->db->query($sql, array($beekeeper_id));
		return $query->result();		
	}

	//--> print colony of beekeeper
	public function get_REP0B_colony($beekeeper_id)
	{
		
		$sql = "SELECT colony.*,species.name AS 'species_name',
			status.name AS 'status_name', phase.name AS 'phase_name',
			lgu.name AS 'lgu_name',
			province.name AS 'province_name'
		FROM colony
			JOIN species ON colony.species_id = species.id
			JOIN status ON colony.status_id = status.id
			JOIN phase ON colony.phase_id = phase.id 
			LEFT JOIN lgu ON colony.lgu_id = lgu.id
			LEFT JOIN province ON colony.province_id = province.id
		WHERE beekeeper_id = ?
		ORDER BY colony_no";
		$query = $this->db->query($sql, array($beekeeper_id));
		return $query->result();		

	}


	public function get_REP0B_production($beekeeper_id)
	{
		$sql = "SELECT * FROM production WHERE beekeeper_id = ?";
		$query = $this->db->query($sql, array($beekeeper_id));
		return $query->result();
	}


	public function get_REP0B_inquiry($beekeeper_id)
	{
		$sql = "SELECT inquiry.*,
			support_type.name AS 'support_type_name', inquiry_type.name AS 'inquiry_type_name' 
		FROM inquiry 
			LEFT JOIN support_type ON support_type.id = inquiry.support_type_id
			LEFT JOIN inquiry_type ON inquiry_type.id = inquiry.inquiry_type_id
		WHERE beekeeper_id = ?";
		$query = $this->db->query($sql, array($beekeeper_id));
		return $query->result();
	}

	public function get_REP0B_Document($beekeeper_id)
	{
		$sql = "SELECT document.*,document_type.name AS 'document_type_name'
		FROM document 
			JOIN document_type ON document.document_type_id = document_type.id
  	 	 	LEFT JOIN colony ON document.colony_id = colony.id
		WHERE document.beekeeper_id = ?
		ORDER BY document_type.name";
		$query = $this->db->query($sql, array($beekeeper_id));
		return $query->result();

	}


	public function get_REP0A($association_id)
	{
		$sql = "SELECT association.*,region.name AS 'region_name', barangay.name AS 'barangay_name', lgu.name AS 'lgu_name',
			province.name AS 'province_name',
			barangay.name AS 'barangay_name',
			CASE WHEN association.active = 1 THEN 'Active' else 'Inactive' END AS 'active'
		FROM association 
			 LEFT JOIN region on association.region_id=region.id
			 LEFT JOIN province ON association.province_id = province.id
			 LEFT JOIN lgu ON association.lgu_id = lgu.id
			 LEFT JOIN barangay ON association.barangay_id = barangay.id
		WHERE association.id = ?";
		$query = $this->db->query($sql, array($association_id));
		return $query->result();
	}
	public function get_REP0A_beekeeper($association_id)
	{
		$sql = "SELECT beekeeper.*,region.name as 'region_name', barangay.name as 'barangay_name',lgu.name AS 'lgu_name',
			province.name AS 'province_name',association.association_name AS 'association_name',
			category.name AS 'category_name',barangay.name AS 'barangay_name',
			CASE WHEN beekeeper.active = 1 THEN 'Active' else 'Inactive' END AS 'active'
		FROM beekeeper 
			 LEFT JOIN region on beekeeper.region_id=region.id
			 LEFT JOIN province ON beekeeper.province_id = province.id
			 LEFT JOIN lgu ON beekeeper.lgu_id = lgu.id
			 LEFT JOIN barangay ON beekeeper.barangay_id = barangay.id
			 LEFT JOIN association ON beekeeper.association_id = association.id
			 JOIN category ON beekeeper.category_id = category.id
		WHERE association.id = ?";
		$query = $this->db->query($sql, array($association_id));
		return $query->result();
	}

	public function get_REP01()
	{
		//--> Criteria Province
		$province = $this->session->province;
        if ($province == 'all') {
        	$province_from = 0;
			$province_to = 999;
        }
        else {
			$province_from = $province;
			$province_to = $province;
		}

		//--> Criteria Municipality
		$municipality = $this->session->municipality;
        if ($municipality == 'all') {
        	$municipality_from = 0;
			$municipality_to = 999999;
        }
        else {
			$municipality_from = $municipality;
			$municipality_to = $municipality;
		}

		//--> Criteria Category
		$category = $this->session->category;
        if ($category == 'all') {
        	$category_from = 1;
			$category_to = 999;
        }
        else {
			$category_from = $category;
			$category_to = $category;		}


		$sql = "SELECT beekeeper.*,municipality.citymunDesc AS 'municipality_name',
			province.provDesc AS 'province_name',association_name,
			category.name AS 'category_name'
		FROM beekeeper 
			 LEFT JOIN municipality ON beekeeper.lgu_id = municipality.municipality_id
			 JOIN province ON beekeeper.province_id = province.province_id
			 JOIN association ON beekeeper.association_id = association.id
			 JOIN category ON beekeeper.category_id = category.id
		WHERE beekeeper.lgu_id BETWEEN $municipality_from AND $municipality_to
		    AND beekeeper.province_id BETWEEN $province_from AND $province_to 
			AND beekeeper.category_id BETWEEN $category_from AND $category_to  
		ORDER BY beekeeper_name";
		
		$query = $this->db->query($sql, array());

		if ($query->num_rows() > 0) {return $query->result();}
		
		return NULL;

	}


	public function get_REP02()
	{		
		//--> Criteria Phase
		$phase = $this->session->phase;
        if ($phase == 'all') {
        	$phase_from = '0';
			$phase_to = '999';
        }
        else {
			$phase_from = $phase;
			$phase_to = $phase;
		}

		//--> Criteria Bee Type
		$species = $this->session->species;
        if ($species == 'all') {
        	$species_from = '0';
			$species_to = '999';
        }
        else {
			$species_from = $species;
			$species_to = $species;
		}

		//--> Criteria Lgu
		$province = $this->session->province;
        if ($province == 'all') {
        	$province_from = 0;
			$province_to = 999;
        }
        else {
			$province_from = $province;
			$province_to = $province;
		}

		//--> Criteria date
		$date_begin_from = $this->session->date_begin_from;
		$date_begin_to = $this->session->date_begin_to;
		$date_end_from = $this->session->date_end_from;
		$date_end_to = $this->session->date_end_to;
		if ($date_begin_from == null) {$date_begin_from = "'1900-01-01'";} else {$date_begin_from = "'".$date_begin_from."'";}
		if ($date_begin_to == null) {$date_begin_to = "'2500-01-01'";} else {$date_begin_to = "'".$date_begin_to."'";}
		if ($date_end_from == null) {$date_end_from = "'1900-01-01'";} else {$date_end_from = "'".$date_end_from."'";}
		if ($date_end_to == null) {$date_end_to = "'2500-01-01'";} else {$date_end_to = "'".$date_end_to."'";}


    	$sql = "SELECT colony.*,province.name AS 'province_name',
			species.code AS 'species_code',beekeeper_name,
			phase.name AS 'phase_name'
		FROM colony 			 
			JOIN beekeeper ON colony.beekeeper_id = beekeeper.id
			JOIN species ON colony.species_id = species.id
			JOIN phase ON colony.phase_id = phase.id
			LEFT JOIN province ON colony.province_id = province.id
		WHERE  phase_id BETWEEN $phase_from AND $phase_to 
			AND species_id BETWEEN $species_from AND $species_to 
			AND colony.province_id BETWEEN $province_from AND $province_to
			AND date_begin BETWEEN $date_begin_from AND $date_begin_to
			AND date_end BETWEEN $date_end_from AND $date_end_to
		ORDER BY beekeeper_name";
		
		$query = $this->db->query($sql, array());

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		
		return NULL;

	}

	public function get_REP03()
	{
		//--> Criteria Municipality
		$municipality = $this->session->municipality;
        if ($municipality == 'all') {
        	$municipality_from = 0;
			$municipality_to = 999999;
        }
        else {
			$municipality_from = $municipality;
			$municipality_to = $municipality;
		}

		$year = $this->session->year;

		$sql = "SELECT production.*,beekeeper_name,beekeeper_register_id
		FROM production 
			 JOIN beekeeper ON production.beekeeper_id = beekeeper.id
		WHERE beekeeper.lgu_id BETWEEN $municipality_from AND $municipality_to
		    AND production.year = $year
		ORDER BY beekeeper_name";
		
		$query = $this->db->query($sql, array());

		if ($query->num_rows() > 0) {return $query->result();}
		
		return NULL;

	}

	public function get_REP04()
	{

		$inquiry_type = $this->session->inquiry_type;
        if ($inquiry_type == 'all') {
        	$inquiry_type_from = 0;
			$inquiry_type_to = 999;
        }
        else {
			$inquiry_type_from = $inquiry_type;
			$inquiry_type_to = $inquiry_type;
		}

		$support_type = $this->session->support_type;
        if ($support_type == 'all') {
        	$support_type_from = 0;
			$support_type_to = 999;
        }
        else {
			$support_type_from = $support_type;
			$support_type_to = $support_type;
		}

		$date_from = $this->session->date_from;
		$date_to = $this->session->date_to;
		if ($date_from == null) {$date_from = "'1900-01-01'";} else {$date_from = "'".$date_from."'";}
		if ($date_to == null) {$date_to = "'2500-01-01'";} else {$date_to = "'".$date_to."'";}


		
        $sql = "SELECT inquiry.*, inquiry_type.name AS 'inquiry_type_name', beekeeper_name, 
        beekeeper_register_id,support_type.name AS 'support_type_name'
		FROM inquiry 
			 JOIN beekeeper ON inquiry.beekeeper_id = beekeeper.id
			 JOIN inquiry_type ON inquiry_type.id = inquiry.inquiry_type_id
			 JOIN support_type ON support_type.id = inquiry.support_type_id
		WHERE  inquiry_date BETWEEN $date_from AND $date_to
				AND inquiry_type_id BETWEEN $inquiry_type_from AND $inquiry_type_to
				AND support_type_id BETWEEN $support_type_from AND $support_type_to
		ORDER BY beekeeper_name";
					
		$query = $this->db->query($sql, array());

		if ($query->num_rows() > 0) {return $query->result();}
		
		return NULL;
	}


	public function get_REP05()
	{   

		//--> Criteria Phase
		$phase = $this->session->phase;
        if ($phase == 'all') {
        	$phase_from = '0';
			$phase_to = '999';
        }
        else {
			$phase_from = $phase;
			$phase_to = $phase;
		}

		//--> Criteria Bee Type
		$species = $this->session->species;
        if ($species == 'all') {
        	$species_from = '0';
			$species_to = '999';
        }
        else {
			$species_from = $species;
			$species_to = $species;
		}

		//--> Criteria date
		$date_begin_from = $this->session->date_begin_from;
		$date_begin_to = $this->session->date_begin_to;
		$date_end_from = $this->session->date_end_from;
		$date_end_to = $this->session->date_end_to;
		if ($date_begin_from == null) {$date_begin_from = "'1900-01-01'";} else {$date_begin_from = "'".$date_begin_from."'";}
		if ($date_begin_to == null) {$date_begin_to = "'2500-01-01'";} else {$date_begin_to = "'".$date_begin_to."'";}
		if ($date_end_from == null) {$date_end_from = "'1900-01-01'";} else {$date_end_from = "'".$date_end_from."'";}
		if ($date_end_to == null) {$date_end_to = "'2500-01-01'";} else {$date_end_to = "'".$date_end_to."'";}


		$sql = "SELECT colony.id,colony_no,beekeeper_name,province.name AS 'province_name',
					     species.name as 'species_name',phase.name as 'phase_name',
					     colony.province_id,area_size,date_end,date_begin,location	   	        
				FROM colony 			 
					JOIN beekeeper ON colony.beekeeper_id = beekeeper.id
					JOIN species ON colony.species_id = species.id
					JOIN phase ON colony.phase_id = phase.id
					JOIN province ON colony.province_id = province.id
				WHERE  phase_id BETWEEN $phase_from AND $phase_to 
					AND species_id BETWEEN $species_from AND $species_to 
					AND date_begin BETWEEN $date_begin_from AND $date_begin_to
					AND date_end BETWEEN $date_end_from AND $date_end_to";

		$query = $this->db->query($sql, array());  

	   	if ($query->num_rows() > 0) {
			return $query->result();
		}
		
		return NULL;

	}


	//-------------------------------------- S E T T I N G S ----------------------------------------------------

	public function getReport06($setting)
	{
		if ($setting == 'gender') {
			$sql = "SELECT id,name, 'no code' as 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM gender ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'fund_source') {
			$sql = "SELECT id,name,'no code' as 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM fund_source ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'education') {
			$sql = "SELECT id,name,'no code' as 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM education ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'topography') {
			$sql = "SELECT id,name,'no code' AS 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM topography ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		if ($setting == 'association') {
			$sql = "SELECT id,association_name as 'name','no code' as 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM association ORDER BY association_name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'nationality') {
			$sql = "SELECT id,name,'no code' AS 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM nationality ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'inquiry_type') {
			$sql = "SELECT id,name,code,
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM inquiry_type ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'support_type') {
			$sql = "SELECT id,name,code,
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM support_type ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'species') {
			$sql = "SELECT id,name,'no code' as 'code',	
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM species ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'status') {
			$sql = "SELECT id,name,'no code' AS 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM status ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'phase') {
			$sql = "SELECT id,name,'no code' AS 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM phase ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}

		elseif ($setting == 'category') {
			$sql = "SELECT id,name,'no code' AS 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM category ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}
		elseif ($setting == 'source') {
			$sql = "SELECT id,name,'no code' AS 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM source ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}
		elseif ($setting == 'product') {
			$sql = "SELECT id,name,'no code' AS 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM product ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}
		elseif ($setting == 'document_type') {
			$sql = "SELECT id,name,'no code' AS 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM document_type ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}
				elseif ($setting == 'post_category') {
			$sql = "SELECT id,name,'no code' AS 'code',
					CASE WHEN active = 1 THEN 'Yes' else 'No' END AS 'active'
					FROM post_category ORDER BY name";
			$query = $this->db->query($sql, array());
			return $query->result();
		}
	}

	
}