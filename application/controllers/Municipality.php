<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Municipality extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Municipality');
	}

	public function fetchMunicipalityDataByProvince() 
	{
		if($this->input->post('province_id'))
		{
			$this->load->model('model_municipality');
			echo $this->model_municipality->getMunicipalityDataByProvinceId($this->input->post('province_id'));
		}
	}
}
