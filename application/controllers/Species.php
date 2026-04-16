<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Species extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Species');

	}

	
	//--> Redirects to the manage species page

	public function index()
	{

		if(!in_array('viewSpecies', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('species/index', $this->data);	
	}	

	
	//--> It checks if it gets the species id and retreives
	//    the species information from the species model and 
	//    returns the data into json format. 
	//    This function is invoked from the view page.
	
	public function fetchSpeciesDataById($id) 
	{
		if($id) {
			$data = $this->model_species->getSpeciesData($id);
			echo json_encode($data);
		}

		return false;
	}

	
	//--> Fetches the species value from the species table 
	//    This function is called from the datatable ajax function
	
	public function fetchSpeciesData()
	{
		$result = array('data' => array());

		$data = $this->model_species->getSpeciesData();

		foreach ($data as $key => $value) {

			$buttons = '';

			if(in_array('updateSpecies', $this->permission)) {
				$buttons .= '<button type="button" class="btn-dt btn-dt-edit" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="ph ph-pencil-simple"></i></button>';
							 	$name='  <a data-bs-target="#editModal" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" href="#editModal" class="text-decoration-none fw-medium">'.$value['name'].'</a>';

			}

			if(in_array('deleteSpecies', $this->permission)) {
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

	
	//--> It checks the species form validation 
	//    and if the validation is true (valid) then it inserts the data into the database 
	//    and returns the json format operation messages
	
	public function create()
	{
		if(!in_array('createSpecies', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('species_name', $this->lang->line('Name'), 'trim|required');

		

$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('species_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_species->create($data);
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

	
	//--> It checks the species form validation 
	//    and if the validation is true (valid) then it updates the data into the database 
	//    and returns the json format operation messages
	
	public function update($id)
	{

		if(!in_array('updateSpecies', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = '';
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_species_name', $this->lang->line('Name'), 'trim|required');
			
			

$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_species_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_species->update($data, $id);
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

	
	//--> It removes the species information from the database 
	//    and returns the json format operation messages
	
	public function remove()
	{
		if(!in_array('deleteSpecies', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$species_id = $this->input->post('species_id');

		$response = array();

		if($species_id) {
			//---> Validate if the information is used in beekeeper table
			$total_beekeeper = $this->model_species->checkIntegrity($species_id);
			//---> If no beekeeper have this information, we can delete
            //$total_beekeeper=0;
            if ($total_beekeeper == 0) {        
				$delete = $this->model_species->remove($species_id);
				if($delete == true) {
					$response['success'] = true;
					$response['messages'] = $this->lang->line('Successfully deleted');}
				else {
					$response['success'] = false;
					$response['messages'] = $this->lang->line('Error in the database while deleting the information');}
				}

			else {
				//---> There is at least one beekeeper having this information
				$response['success'] = false;
				$response['messages'] = $this->lang->line('At least one colony uses this information.  You cannot delete.');}

		}
		else {
			$response['success'] = false;
			$response['messages'] = $this->lang->line('Refresh the page again');}

		echo json_encode($response);
	}

}