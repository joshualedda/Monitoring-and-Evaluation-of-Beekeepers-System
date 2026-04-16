<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Region');
	}

 
    //--> Redirects to the manage region page

	public function index()
	{
		if(!in_array('viewRegion', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('region/index', $this->data);	
	}


	//--> It retrieves the specific information from the key
	//    and returns the data in json format

	public function fetchRegionDataById($id) 
	{
		if($id) {
			$data = $this->model_region->getRegionData($id);
			echo json_encode($data);
		}
	}


	
	//--> For creation of drop-down list

	public function fetchActiveRegion() 
	{
		$data = $this->model_region->getActiveRegion();
		echo json_encode($data);

	}

	
	//--> It retrieves all the region data from the database 
	//    This function is called from the datatable ajax function
	//    The data is return based on the json format.

	public function fetchRegionData()
	{
		$result = array('data' => array());

		$data = $this->model_region->getRegionData();

		foreach ($data as $key => $value) {

			$buttons = '';

			if(in_array('updateRegion', $this->permission)) {
				$buttons = '<button type="button" class="btn-dt btn-dt-edit" title="Edit" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="ph ph-pencil-simple"></i></button>';
			 	$name='  <a data-target="#editModal" onclick="editFunc('.$value['id'].')" data-toggle="modal" href="#editModal">'.$value['name'].'</a>';
			}

			if(in_array('deleteRegion', $this->permission)) {
				$buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';
			}

			$active = ($value['active'] == 1) ? '<span class="dt-badge dt-badge-success">'.$this->lang->line('Active').'</span>' : '<span class="dt-badge dt-badge-warning">'.$this->lang->line('Inactive').'</span>';

			$result['data'][$key] = array(	
				
				$name,
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
		if(!in_array('createRegion', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('region_name', $this->lang->line('Name'), 'trim|required');
		$this->form_validation->set_rules('region_code', $this->lang->line('Code'), 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'code' => $this->input->post('region_code'),
        		'name' => $this->input->post('region_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_region->create($data);
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
		if(!in_array('updateRegion', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_region_name', $this->lang->line('Name'), 'trim|required');
			$this->form_validation->set_rules('edit_region_code', $this->lang->line('Code'), 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'code' => $this->input->post('edit_region_code'),
	        		'name' => $this->input->post('edit_region_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_region->update($data, $id);
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

	
	//--> If checks if the region id is provided on the function, if not then an appropriate message 
	//    is return on the json format
    //    If the validation is true (valid) then it removes the data into the database and returns an appropriate 
    //    message in the json format.
 
	public function remove()
	{
		if(!in_array('deleteRegion', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$region_id = $this->input->post('region_id');

		$response = '';
		$response = array();

		if($region_id) {
			//---> Validate if the information is used in beekeeper/colony table
			$total_rows = $this->model_region->checkIntegrity($region_id);
			//---> If no beekeeper/colony have this information, we can delete
            if ($total_rows == 0) {        
				$delete = $this->model_region->remove($region_id);
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
				$response['messages'] = $this->lang->line('At least one province uses this information.  You cannot delete.');}

		}
		else {
			$response['success'] = false;
			$response['messages'] = $this->lang->line('Refresh the page again');}

		echo json_encode($response);
			
	}

}