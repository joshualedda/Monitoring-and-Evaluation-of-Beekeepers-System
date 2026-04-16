<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Byproduct extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('By-product');

	}


	//--> Redirects to the manage status page

	public function index()
	{

		if(!in_array('viewByproduct', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('byproduct/index', $this->data);	
	}	

	
	//--> It checks if it gets the status id and retrieves
	//    the status information from the status model and 
	//    returns the data into json format. 
	//    This function is invoked from the view page.
	
	public function fetchByproductDataById($id) 
	{
		if($id) {
			$data = $this->model_byproduct->getByproductData($id);
			echo json_encode($data);
		}

		return false;
	}

	
	//--> Fetches the status value from the status table 
	//    This function is called from the datatable ajax function
	
	public function fetchByproductData()
	{
		$result = array('data' => array());

		$data = $this->model_byproduct->getByproductData(); 

		foreach ($data as $key => $value) {

			$buttons = '';

			if(in_array('updateByproduct', $this->permission)) {
				$buttons .= '<button type="button" class="btn-dt btn-dt-edit" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="ph ph-pencil-simple"></i></button>';
							 	$name='  <a data-bs-target="#editModal" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" href="#editModal" class="text-decoration-none fw-medium">'.$value['name'].'</a>';

			}

			if(in_array('deleteByproduct', $this->permission)) {
				$buttons .= ' <button type="button" class="btn-dt btn-dt-delete" onclick="removeFunc('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#removeModal"><i class="ph ph-trash"></i></button>';
			}
				

			$active = ($value['active'] == 1) ? '<span class="dt-badge dt-badge-success">'.$this->lang->line('Active').'</span>' : '<span class="dt-badge dt-badge-danger">'.$this->lang->line('Inactive').'</span>';

			$result['data'][$key] = array(
				$name,
				$active,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	
	//--> It checks the status form validation 
	//    and if the validation is true (valid) then it inserts the data into the database 
	//    and returns the json format operation messages
	
	public function create()
	{
		if(!in_array('createByproduct', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('byproduct_name', $this->lang->line('Name'), 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('byproduct_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_byproduct->create($data);
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

	
	//--> It checks the status form validation 
	//    and if the validation is true (valid) then it updates the data into the database 
	//    and returns the json format operation messages
	
	public function update($id)
	{

		if(!in_array('updateByproduct', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = '';
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_byproduct_name', $this->lang->line('Name'), 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_byproduct_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_byproduct->update($data, $id);
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

	
	//--> It removes the status information from the database 
	//    and returns the json format operation messages
	
	public function remove()
	{
		if(!in_array('deleteByproduct', $this->permission)) {
			redirect('dashboard', 'refresh');}
		
		$byproduct_id = $this->input->post('byproduct_id');

        $response = '';
		$response = array();

		if($byproduct_id) {
			//---> Validate if the information is used in colony table
			$total_colony = $this->model_status->checkIntegrity($byproduct_id);
			//---> If no colony have this information, we can delete
            if ($total_colony == 0) {        
				$delete = $this->model_status->remove($byproduct_id);
				if($delete == true) {
					$response['success'] = true;
					$response['messages'] = $this->lang->line('Successfully deleted');}
				else {
					$response['success'] = false;
					$response['messages'] = $this->lang->line('Error in the database while deleting the information');}
				}

			else {
				//---> There is at least one colony having this information
				$response['success'] = false;
				$response['messages'] = $this->lang->line('At least one colony uses this information.  You cannot delete.');}

		}
		else {
			$response['success'] = false;
			$response['messages'] = $this->lang->line('Refresh the page again');}

		echo json_encode($response);
	}

}