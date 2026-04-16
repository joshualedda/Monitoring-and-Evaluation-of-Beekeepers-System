<?php 

class MY_Controller extends CI_Controller

{

	public function __construct()
	{parent::__construct();		
		
		//--> If the language is French, we load the language file 
		//    This instruction set_item is working only if it's in construct...
		//    If the language is English, it's the default of CodeIgniter
		//    Because we need translation for each term in the system
		//    we need also to create a language file with these terms for english.
		//    English Translation:   application/language/english/english_lang.php
		//    French Translation:  application/language/french/french_lang.php

		if($this->session->language == 'fr') {
			$this->config->set_item('language', 'french');
			// Load language files French
			$this->lang->load('french_lang', 'french');
			$this->lang->load('calendar_lang', 'french');
			$this->lang->load('date_lang', 'french'); 
			$this->lang->load('email_lang', 'french'); 
			$this->lang->load('form_validation_lang', 'french'); 
			$this->lang->load('ftp_lang', 'french'); 
			$this->lang->load('imglib_lang', 'french');  
			$this->lang->load('migration_lang', 'french'); 
			$this->lang->load('number_lang', 'french'); 
			$this->lang->load('pagination_lang', 'french'); 
			$this->lang->load('profiler_lang', 'french'); 
			$this->lang->load('unit_test_lang', 'french'); 
			$this->lang->load('calendar_lang', 'french'); 
			$this->lang->load('upload_lang', 'french');
			//Create the link session variable for the translation of dataTable (Ajax) in French			
            $link_language = array('link_language' => base_url('assets/bower_components/datatables.net/French.json'));
   		    $this->session->set_userdata($link_language);
			}			
		else {	
		    $this->config->set_item('language', 'english');
			// Load language files English
			$this->lang->load('english_lang', 'english');
			$this->lang->load('calendar_lang', 'english');
			$this->lang->load('date_lang', 'english'); 
			$this->lang->load('email_lang', 'english'); 
			$this->lang->load('form_validation_lang', 'english'); 
			$this->lang->load('ftp_lang', 'english'); 
			$this->lang->load('imglib_lang', 'english');  
			$this->lang->load('migration_lang', 'english'); 
			$this->lang->load('number_lang', 'english'); 
			$this->lang->load('pagination_lang', 'english'); 
			$this->lang->load('profiler_lang', 'english'); 
			$this->lang->load('unit_test_lang', 'english'); 
			$this->lang->load('calendar_lang', 'english'); 
			$this->lang->load('upload_lang', 'english');
			$link_language = array('link_language' => base_url('assets/bower_components/datatables.net/English.json'));
   		    $this->session->set_userdata($link_language);				
			
			}
			
}
}

class Admin_Controller extends MY_Controller 
{
	var $permission = array();
	public function __construct() 
	{
		parent::__construct();

		$profile_data = array();

		if(empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);

		}
		else {
			$user_id = $this->session->userdata('user_id');
			$profile_data = $this->model_profile->getUserProfileByUserId($user_id);
			
			$this->data['user_permission'] = unserialize($profile_data['permission']);
			$this->permission = unserialize($profile_data['permission']);
			if($profile_data['name']=='regional' || $profile_data['profile_id']=='4')
			{
				array_push($this->permission,"regional");
				array_push($this->permission,$profile_data['region_id']);
			}
		}
	}

	public function logged_in()
	{
		$session_data = $this->session->userdata();

		if($session_data['logged_in'] == TRUE) {		
			redirect('dashboard', 'refresh');
		}
	}

	public function not_logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == FALSE) {
			redirect('auth/login', 'refresh');
		}
	}

	public function render_template($page = null, $data = array())
	{

		$this->load->view('templates/header',$data);
		$this->load->view('templates/side_menubar',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view($page, $data);
		$this->load->view('templates/footer',$data);
	}



			
}