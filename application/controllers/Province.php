<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Province extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Province');

	}


    //--> Redirects to the manage province page

	public function index()
	{
		if(!in_array('viewProvince', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->render_template('province/index', $this->data);	
	}


	//--> It retrieve the specific province information via a province id
	//    and returns the data in json format

	public function fetchProvinceDataById($id) 
	{
		if($id) {
			$data = $this->model_province->getProvinceData($id);
			echo json_encode($data);
		}
	}

	public function fetchProvinceDataByRegion() 
	{
			if($this->input->post('region_id'))
			{
				echo $this->model_province->getProvinceDataByRegionId($this->input->post('region_id'));
			}
	}


		public function fetchActiveProvince() 
	{
		$data = $this->model_province->getActiveProvince();
		echo json_encode($data);

	}

	
	//--> It retrieves all the province data from the database 
	//    This function is called from the datatable ajax function
	//    The data is return based on the json format.
	
	public function fetchProvinceData()
	{
		$result = array('data' => array());

		$data = $this->model_province->getProvinceData();

		foreach ($data as $key => $value) {

			$region_data = $this->model_region->getRegionData($value['region_id']);


			$buttons = '';

			if(in_array('updateProvince', $this->permission)) {
				$buttons = '<button type="button" class="btn-dt btn-dt-edit" title="Edit" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="ph ph-pencil-simple"></i></button>';
			 	$name='  <a data-bs-target="#editModal" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" href="#editModal" class="text-decoration-none fw-medium">'.$value['name'].'</a>';
				
			}

			if(in_array('deleteProvince', $this->permission)) {
				$buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="ph ph-trash"></i></button>';}

			$active = ($value['active'] == 1) ? '<span class="dt-badge dt-badge-success">'.$this->lang->line('Active').'</span>' : '<span class="dt-badge dt-badge-danger">'.$this->lang->line('Inactive').'</span>';

			$result['data'][$key] = array(		
				$name,
				$region_data['name'],
				$value['code'],
				$active,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


	//--> If the validation is not true (not valid), then it provides the validation error on the json format
    //    If the validation for each input is valid then it creates the data into the database and 
    //    returns an appropriate message in the json format.

	public function create()
	{
		if(!in_array('createProvince', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
		$this->form_validation->set_rules('region', $this->lang->line('Region'), 'required');
		$this->form_validation->set_rules('province_name', $this->lang->line('Name'), 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'region_id' =>$this->input->post('region'),
        		'code' => $this->input->post('province_code'),
        		'name' => $this->input->post('province_name'),
        		'map_id' => $this->input->post('map_id'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_province->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = $this->lang->line('Successfully created');
        
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = $this->lang->line('Error in the database while creating the information');			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}	

	//--> If the validation is not true (not valid), then it provides the validation error on the json format
    //    If the validation for each input is valid then it updates the data into the database and 
    //    returns an appropriate message in the json format.

	public function update($id)
	{
		if(!in_array('updateProvince', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_province_region', $this->lang->line('Region'), 'trim|required');
			$this->form_validation->set_rules('edit_province_name', $this->lang->line('Name'), 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'region_id'=> $this->input->post('edit_province_region'),
	        		'code' => $this->input->post('edit_province_code'),
	        		'name' => $this->input->post('edit_province_name'),
	        		'map_id' => $this->input->post('edit_map_id'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_province->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = $this->lang->line('Successfully updated');
	        		}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = $this->lang->line('Error in the database while updating the information');			
	        		}
	        	}
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = $this->lang->line('Error please refresh the page again');
		}

		echo json_encode($response);
	}

	
	//--> If checks if the province id is provided on the function, if not then an appropriate message 
	//    is return on the json format
    //    If the validation is true (valid) then it removes the data into the database and returns an appropriate 
    //    message in the json format.
    
	public function remove()
	{
		if(!in_array('deleteProvince', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$province_id = $this->input->post('province_id');

		$response = '';
		$response = array();

		if($province_id) {
			//---> Validate if the information is used in beekeeper/colony table
			$total_rows = $this->model_province->checkIntegrity($province_id);
			//---> If no beekeeper/colony have this information, we can delete
            if ($total_rows == 0) {        
				$delete = $this->model_province->remove($province_id);
				if($delete == true) {
					$response['success'] = true;
					$response['messages'] = $this->lang->line('Successfully deleted');}
				else {
					$response['success'] = false;
					$response['messages'] = $this->lang->line('Error in the database while deleting the information');}
				}

			else {
				//---> There is at least one beekeeper or colony having this information
				$response['success'] = false;
				$response['messages'] = $this->lang->line('At least one lgu uses this information.  You cannot delete.');}

		}
		else {
			$response['success'] = false;
			$response['messages'] = $this->lang->line('Refresh the page again');}

		echo json_encode($response);
	}

}