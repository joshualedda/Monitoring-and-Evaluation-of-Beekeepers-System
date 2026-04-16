<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lgu extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Lgu');

	}

    //--> Redirects to the manage lgu page

	public function index()
	{
		if(!in_array('viewLgu', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->render_template('lgu/index', $this->data);	
	}


	//--> It retrieve the specific lgu information via a lgu id
	//    and returns the data in json format

	public function fetchLguDataById($id) 
	{
		if($id) {
			$data = $this->model_lgu->getLguData($id);
			echo json_encode($data);
		}
	}

	public function fetchLguDataByProvince() 
	{
			if($this->input->post('province_id'))
			{
				echo $this->model_lgu->getLguDataByProvince($this->input->post('province_id'));
			}
	}

	public function fetchActiveLgu() 
	{
		$data = $this->model_lgu->getActiveLgu();
		echo json_encode($data);

	}
	
	//--> It retrieves all the lgu data from the database 
	//    This function is called from the datatable ajax function
	//    The data is return based on the json format.
	
	public function fetchLguData()
	{
		$result = array('data' => array());

		$data = $this->model_lgu->getLguData();

		foreach ($data as $key => $value) {

			$province_data = $this->model_province->getProvinceData($value['province_id']);


			$buttons = '';

			if(in_array('updateLgu', $this->permission)) {
				$buttons = '<button type="button" class="btn-dt btn-dt-edit" title="Edit" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="ph ph-pencil-simple"></i></button>';
			 	$name='  <a data-bs-target="#editModal" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" href="#editModal" class="text-decoration-none fw-medium">'.$value['name'].'</a>';
		
			}

			if(in_array('deleteLgu', $this->permission)) {
				$buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="ph ph-trash"></i></button>';}

			$active = ($value['active'] == 1) ? '<span class="dt-badge dt-badge-success">'.$this->lang->line('Active').'</span>' : '<span class="dt-badge dt-badge-danger">'.$this->lang->line('Inactive').'</span>';

			$result['data'][$key] = array(			
				$name,
				$province_data['name'],
				$value['zip_code'],
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
		if(!in_array('createLgu', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
		$this->form_validation->set_rules('province', $this->lang->line('Province'), 'required');
		$this->form_validation->set_rules('lgu_name', $this->lang->line('Name'), 'trim|required');
		$this->form_validation->set_rules('lgu_zipcode', $this->lang->line('Zip Code'), 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'province_id' =>$this->input->post('province'),
        		'code' => $this->input->post('lgu_code'),
        		'name' => $this->input->post('lgu_name'),
        		'zip_code' => $this->input->post('lgu_zipcode'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_lgu->create($data);
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
		if(!in_array('updateLgu', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_lgu_province', $this->lang->line('Province'), 'trim|required');
			$this->form_validation->set_rules('edit_lgu_name', $this->lang->line('Name'), 'trim|required');
			$this->form_validation->set_rules('edit_lgu_zipcode', $this->lang->line('Zip Code'), 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'province_id'=> $this->input->post('edit_lgu_province'),
	        		'code' => $this->input->post('edit_lgu_code'),
	        		'name' => $this->input->post('edit_lgu_name'),
	        		'zip_code' => $this->input->post('edit_lgu_zipcode'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_lgu->update($data, $id);
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

	
	//--> If checks if the lgu id is provided on the function, if not then an appropriate message 
	//    is return on the json format
    //    If the validation is true (valid) then it removes the data into the database and returns an appropriate 
    //    message in the json format.
    
	public function remove()
	{
		if(!in_array('deleteLgu', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$lgu_id = $this->input->post('lgu_id');

		$response = '';
		$response = array();

		if($lgu_id) {
			//---> Validate if the information is used in beekeeper/colony table
			$total_rows = $this->model_lgu->checkIntegrity($lgu_id);
			//---> If no beekeeper/colony have this information, we can delete
            if ($total_rows == 0) {        
				$delete = $this->model_lgu->remove($lgu_id);
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
				$response['messages'] = $this->lang->line('At least one barangay uses this information.  You cannot delete.');}

		}
		else {
			$response['success'] = false;
			$response['messages'] = $this->lang->line('Refresh the page again');}

		echo json_encode($response);
	}

}