<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Satellite_centers extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Satellite Centers';

		$this->load->model('model_satellite_centers');
		$this->load->model('model_region');
		$this->load->model('model_province');
		$this->load->model('model_municipality');
		$this->load->model('model_barangay');
	}

	public function index()
	{
        // Permission check (using beekeeper permissions as a proxy or just general admin)
        if(!in_array('viewBeekeeper', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('satelite-centers/index', $this->data);	
	}

	public function fetchSatelliteCentersData()
	{
		$result = array('data' => array());

		$data = $this->model_satellite_centers->getSatelliteCentersData();        

		foreach ($data as $key => $value) {
            $buttons = '';

            if(in_array('updateBeekeeper', $this->permission)) {
                $buttons .= '<a href="'.base_url('satellite_centers/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';
            }

            if(in_array('deleteBeekeeper', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';
            }

			$result['data'][$key] = array(
				$value['satellite_name'],
				$value['region_name'],
                $value['province_name'],
				$value['municipality_name'],
				$value['barangay_name'],
				$buttons
			);
		}

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($result));
	}

	public function create()
	{
		if(!in_array('createBeekeeper', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('satellite_name', 'Satellite Name', 'trim|required');
		$this->form_validation->set_rules('region', 'Region', 'trim|required');
		$this->form_validation->set_rules('province', 'Province', 'trim|required');
		$this->form_validation->set_rules('municipality', 'Municipality', 'trim|required');
		$this->form_validation->set_rules('barangay', 'Barangay', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'satellite_name' => $this->input->post('satellite_name'),
                'region_id' => $this->input->post('region'),
                'province_id' => $this->input->post('province'),
                'municipality_id' => $this->input->post('municipality'),
                'barangay_id' => $this->input->post('barangay'),
                'coordinate' => $this->input->post('coordinate'),
                'map' => $this->input->post('map')
            );

            $create = $this->model_satellite_centers->create($data);

            if($create) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('satellite_centers/', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('satellite_centers/create', 'refresh');
            }
        }

        $this->data['region'] = $this->model_region->getActiveRegion();
		$this->render_template('satelite-centers/create', $this->data);
	}

	public function update($id)
	{      
		if(!in_array('updateBeekeeper', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) { redirect('dashboard', 'refresh'); }

		$this->form_validation->set_rules('satellite_name', 'Satellite Name', 'trim|required');
		$this->form_validation->set_rules('region', 'Region', 'trim|required');
		$this->form_validation->set_rules('province', 'Province', 'trim|required');
		$this->form_validation->set_rules('municipality', 'Municipality', 'trim|required');
		$this->form_validation->set_rules('barangay', 'Barangay', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'satellite_name' => $this->input->post('satellite_name'),
                'region_id' => $this->input->post('region'),
                'province_id' => $this->input->post('province'),
                'municipality_id' => $this->input->post('municipality'),
                'barangay_id' => $this->input->post('barangay'),
                'coordinate' => $this->input->post('coordinate'),
                'map' => $this->input->post('map')
            );

            $update = $this->model_satellite_centers->update($data, $id);

            if($update) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('satellite_centers/', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('satellite_centers/update/'.$id, 'refresh');
            }
        }

        $this->data['satellite_data'] = $this->model_satellite_centers->getSatelliteCentersData($id);
        $this->data['region'] = $this->model_region->getActiveRegion();
        $this->data['province'] = $this->model_province->getProvinceByRegionId($this->data['satellite_data']['region_id']);
        $this->data['municipality'] = $this->model_municipality->getMunicipalityByProvinceId($this->data['satellite_data']['province_id']);
        $this->data['barangay'] = $this->model_barangay->getBarangayByMunicipalityId($this->data['satellite_data']['municipality_id']);
        
        $this->render_template('satelite-centers/edit', $this->data); 
	}

	public function remove()
	{
		if(!in_array('deleteBeekeeper', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$id = $this->input->post('satellite_id');
		$response = array();

		if($id) {
			$delete = $this->model_satellite_centers->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";
			} else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the information";
			}
		} else {
			$response['success'] = false;
			$response['messages'] = "Refesh the page again!!";
		}

		echo json_encode($response);
	}
}
