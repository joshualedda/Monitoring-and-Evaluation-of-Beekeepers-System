<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post_category extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Category');

	}


	//--> Redirects to the manage post_category page

	public function index()
	{

		if(!in_array('viewPostCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('post_category/index', $this->data);	
	}	

	
	//--> It checks if it gets the post_category id and retrieves
	//    the post_category information from the post_category model and 
	//    returns the data into json format. 
	//    This function is invoked from the view page.
	
	public function fetchPost_categoryDataById($id) 
	{
		if($id) {
			$data = $this->model_post_category->getPostCategoryData($id);
			echo json_encode($data);
		}

		return false;
	}

	
	//--> Fetches the post_category value from the post_category table 
	//    This function is called from the datatable ajax function
	
	public function fetchPost_categoryData()
	{
		$result = array('data' => array());

		$data = $this->model_post_category->getPostCategoryData(); 

		foreach ($data as $key => $value) {

			$buttons = '';

			if(in_array('updatePostCategory', $this->permission)) {
				$buttons .= '<button type="button" class="btn-dt btn-dt-edit" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#editModal"><i class="ph ph-pencil-simple"></i></button>';
							 	$name='  <a data-bs-target="#editModal" onclick="editFunc('.$value['id'].')" data-bs-toggle="modal" href="#editModal" class="text-decoration-none fw-medium">'.$value['name'].'</a>';

			}

			if(in_array('deletePostCategory', $this->permission)) {
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

	
	//--> It checks the post_category form validation 
	//    and if the validation is true (valid) then it inserts the data into the database 
	//    and returns the json format operation messages
	
	public function create()
	{
		if(!in_array('createPostCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('post_category_name', $this->lang->line('Name'), 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('post_category_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_post_category->create($data);
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

	
	//--> It checks the post_category form validation 
	//    and if the validation is true (valid) then it updates the data into the database 
	//    and returns the json format operation messages
	
	public function update($id)
	{

		if(!in_array('updatePostCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = '';
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_post_category_name', $this->lang->line('Name'), 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_post_category_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_post_category->update($data, $id);
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

	
	//--> It removes the post_category information from the database 
	//    and returns the json format operation messages
	
	public function remove()
	{
		if(!in_array('deletePostCategory', $this->permission)) {
			redirect('dashboard', 'refresh');}
		
		$post_category_id = $this->input->post('post_category_id');

        $response = '';
		$response = array();

		if($post_category_id) {
			//---> Validate if the information is used in post table
			$total_post = $this->model_post_category->checkIntegrity($post_category_id);
			//---> If no post have this information, we can delete
            if ($total_post == 0) {        
				$delete = $this->model_post_category->remove($post_category_id);
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
				$response['messages'] = $this->lang->line('At least one post uses this information.  You cannot delete.');}

		}
		else {
			$response['success'] = false;
			$response['messages'] = $this->lang->line('Refresh the page again');}

		echo json_encode($response);
	}

}