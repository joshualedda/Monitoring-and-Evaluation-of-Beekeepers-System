<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Admin_Controller 
{	
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->load->model('model_municipality');
		$this->load->model('model_province');
		$this->load->model('model_region');
		$this->load->model('model_barangay');
		$this->load->model('model_beekeeper');
		$this->load->model('model_colony');
		$this->load->model('model_report');
		$this->load->model('model_species');
		$this->load->model('model_nationality');
		$this->load->model('model_phase');
		$this->load->model('model_association');
		$this->load->model('model_inquiry_type');
		$this->load->model('model_support_type');
		$this->load->model('model_source');
		$this->load->model('model_topography');
		$this->load->model('model_category');

		$this->data['page_title'] = $this->lang->line('Reports');
	}

	 

	public function index()
	{

		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        //--> The report uses flashdata session variable.  Flashdata are temporary variables
        //    that will be used only one time.  

	    $this->session->set_flashdata('printdoc', 'no');  

		if($this->input->post('report') == 'REP01') {
			$this->session->set_flashdata('printREP01', 'yes'); 
			$this->session->set_flashdata('printdoc', 'yes');
			$this->session->set_flashdata('province', $this->input->post('province'));  
		    $this->session->set_flashdata('municipality', $this->input->post('municipality'));  
		    $this->session->set_flashdata('category', $this->input->post('category'));  
		}

		else if($this->input->post('report') == 'REP02') {
			$this->session->set_flashdata('printREP02', 'yes'); 
			$this->session->set_flashdata('printdoc', 'yes');  
		    $this->session->set_flashdata('province', $this->input->post('province'));  
		    $this->session->set_flashdata('phase', $this->input->post('phase')); 
		    $this->session->set_flashdata('species', $this->input->post('species'));  
		}

		else if($this->input->post('report') == 'REP03') {
			$this->session->set_flashdata('printREP03', 'yes'); 
			$this->session->set_flashdata('printdoc', 'yes');  
		    $this->session->set_flashdata('municipality', $this->input->post('municipality'));  
		    $this->session->set_flashdata('year', $this->input->post('year')); 
		}
		else if($this->input->post('report') == 'REP04') {
			$this->session->set_flashdata('printREP04', 'yes'); 
			$this->session->set_flashdata('printdoc', 'yes');   
		    $this->session->set_flashdata('date_from', $this->input->post('date_from'));
		    $this->session->set_flashdata('date_to', $this->input->post('date_to'));
		    $this->session->set_flashdata('inquiry_type', $this->input->post('inquiry_type')); 
		    $this->session->set_flashdata('support_type', $this->input->post('support_type')); 
		}
		else if($this->input->post('report') == 'REP05') {
			$this->session->set_flashdata('printREP05', 'yes'); 
			$this->session->set_flashdata('printdoc', 'yes');  
		    $this->session->set_flashdata('phase', $this->input->post('phase')); 		   
		    $this->session->set_flashdata('species', $this->input->post('species'));  
		}

		$this->data['region'] = $this->model_region->getActiveRegion();   				
		$this->data['province'] = $this->model_province->getActiveProvince();  
		$this->data['municipality'] = $this->model_municipality->getActiveMunicipality();  
		$this->data['barangay'] = $this->model_barangay->getActiveBarangay();             
		$this->data['beekeeper'] = $this->model_beekeeper->getActiveBeekeeperData(); 
		$this->data['inquiry_type'] = $this->model_inquiry_type->getActiveInquiryType();
		$this->data['colony'] = $this->model_colony->getActiveColonyData();       
		$this->data['species'] = $this->model_species->getActiveSpecies();        
		$this->data['nationality'] = $this->model_nationality->getActiveNationality();  
		$this->data['phase'] = $this->model_phase->getActivePhase(); 
		$this->data['association'] = $this->model_association->getActiveAssociation();      
		$this->data['report'] = $this->model_report->getReportList(); 
		$this->data['source'] = $this->model_source->getActiveSource();    
		$this->data['topography'] = $this->model_topography->getActiveTopography();
		$this->data['support_type'] = $this->model_support_type->getActiveSupportType();


		$this->render_template('report/index', $this->data);
	}

}