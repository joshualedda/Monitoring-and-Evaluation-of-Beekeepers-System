<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fund_Source extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Fund Source');

	}


	//--> Redirects to the manage fund_source page

	public function index()
	{

		if(!in_array('viewFund_Source', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('fund_source/index', $this->data);	
	}	

	
	//--> It checks if it gets the fund_source id and retreives
	//    the fund_source information from the fund_source model and 
	//    returns the data into json format. 
	//    This function is invoked from the view page.

	public function fetchFund_SourceDataById($id) 
	{
		if($id) {
			$data = $this->model_fund_source->getFund_SourceData($id);
			echo json_encode($data);
		}

		return false;
	}

	
	//--> Fetches the fund_source value from the fund_source table 
	//    This function is called from the datatable ajax function
	
	public function fetchFund_SourceData()
	{
		$result = array('data' => array());

		$data = $this->model_fund_source->getFund_SourceData();

		foreach ($data as $key => $value) {

			$buttons = '';

			if(in_array('updateFund_Source', $this->permission)) {
				$buttons .= '<button type="button" class="btn-dt btn-dt-edit" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="ph ph-pencil-simple"></i></button>';
			 	$name='  <a data-bs-target="#editModal" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" href="#editModal" class="text-decoration-none fw-medium">'.$value['name'].'</a>';
		
			}

			if(in_array('deleteFund_Source', $this->permission)) {
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

	
	//--> It checks the fund_source form validation 
	//    and if the validation is true (valid) then it inserts the data into the database 
	//    and returns the json format operation messages
	
	public function create()
	{
		if(!in_array('createFund_Source', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('fund_source_name', $this->lang->line('Name'), 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('fund_source_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_fund_source->create($data);
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

	
	//--> It checks the fund_source form validation 
	//    and if the validation is true (valid) then it updates the data into the database 
	//    and returns the json format operation messages
	
	public function update($id)
	{

		if(!in_array('updateFund_Source', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = '';
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_fund_source_name', $this->lang->line('Name'), 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_fund_source_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_fund_source->update($data, $id);
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

	
	//--> It removes the fund_source information from the database 
	//    and returns the json format operation messages
	
	public function remove()
	{
		if(!in_array('deleteFund_Source', $this->permission)) {
			redirect('dashboard', 'refresh');}
		
		$fund_source_id = $this->input->post('fund_source_id');

        $response = '';
		$response = array();

		if($fund_source_id) {
			//---> Validate if the information is used in colony table
			//$total_beekeeper = $this->model_fund_source->checkIntegrity($fund_source_id);
			//---> If no colony have this information, we can delete
            $total_beekeeper=$this->model_fund_source->checkIntegrity($fund_source_id);
            //$total_beekeeper=0;
            if ($total_beekeeper == 0) {        
				$delete = $this->model_fund_source->remove($fund_source_id);
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
				$response['messages'] = $this->lang->line('At least one beekeeper uses this information.  You cannot delete.');}

		}
		else {
			$response['success'] = false;
			$response['messages'] = $this->lang->line('Refresh the page again');}

		echo json_encode($response);
	}

}