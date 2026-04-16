<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('User');

	}


	public function index()
	{
		if(!in_array('viewUser', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('user/index', $this->data);	
	}

	
	//--> It retrieve the specific user information via a user id
	//    and returns the data in json format

	public function fetchUserDataById($id) 
	{
		if($id) {
			$data = $this->model_user->getUserData($id);
			echo json_encode($data);
		}
	}

	public function fetchProfileData() 
	{
		$data = $this->model_profile->getProfileData();
		echo json_encode($data);

	}


	//--> It retrieves all the user data from the database 
	//    This function is called from the datatable ajax function
	//    The data is return based on the json format.

	public function fetchUserData()
	{
		$result = array('data' => array());

		$data = $this->model_user->getUserData();

		foreach ($data as $key => $value) {

			$profile_data = $this->model_profile->getProfileData($value['profile_id']);

			$buttons = '';

			if(in_array('updateUser', $this->permission)) {
				$buttons = '<button type="button" class="btn-dt btn-dt-edit" title="Edit" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="ph ph-pencil-simple"></i></button>';
							 	$name='  <a data-target="#editModal" onclick="editFunc('.$value['id'].')" data-toggle="modal" href="#editModal">'.$value['username'].'</a>';

			}

			if(in_array('deleteUser', $this->permission)) {
				$buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';
			}

			$language = ($value['language'] == 'en') ? $this->lang->line('English') : $this->lang->line('French');

			$result['data'][$key] = array(			
				$name,
				$value['email'],
				$value['name'],
				$value['phone'],
				$profile_data['name'],
				$language,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


   //--> If the validation is not true (not valid), then it provides the validation error on the json format
   //    If the validation for each input is valid then it inserts the data into the database and 
   //    returns the appropriate message in the json format.

	public function create()
	{
		if(!in_array('createUser', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('username', $this->lang->line('Username'), 'trim|required|min_length[5]|max_length[12]|is_unique[user.username]');
		$this->form_validation->set_rules('email', $this->lang->line('Email'), 'trim|required|is_unique[user.email]');
		$this->form_validation->set_rules('password', $this->lang->line('Password'), 'trim|required|min_length[5]');
		$this->form_validation->set_rules('cpassword', $this->lang->line('Confirm Password'), 'trim|required|matches[password]');
		$this->form_validation->set_rules('name', $this->lang->line('Name'), 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$password = $this->password_hash($this->input->post('password'));
        	$data = array(
        		'username' => $this->input->post('username'),
        		'password' => $password,
        		'profile_id' => $this->input->post('profile'),
        		'email' => $this->input->post('email'),
        		'name' => $this->input->post('name'),
        		'phone' => $this->input->post('phone'),
        		'active' => $this->input->post('active'),
        		'region_id' => $this->input->post('region'),
        		'language' => $this->input->post('language'),	
        	);

        	$create = $this->model_user->create($data);
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


	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}	


   //--> If the validation is not true (not valid), then it provides the validation error on the json format
   //    If the validation for each input is valid then it updates the data into the database and 
   //    returns an appropriate message in the json format.

	public function my_account()
	{
	if(!in_array('viewAccount', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$id = $this->session->user_id;

		if($id) {
			$this->form_validation->set_rules('username', $this->lang->line('username'), 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('email', $this->lang->line('Email'), 'trim|required');
			$this->form_validation->set_rules('name', $this->lang->line('Name'), 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

			if ($this->form_validation->run() == TRUE) {
	            // true case
		        if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
		        	$data = array(
		        		'username' => $this->input->post('username'),
		        		'email' => $this->input->post('email'),
		        		'name' => $this->input->post('name'),
		             	'phone' => $this->input->post('phone'),
		        		'active' => $this->input->post('active'),
		        		'language' => $this->input->post('language'),
		        	);

		        	$update = $this->model_user->edit($data, $id);
		        	if($update == true) {
		        		$msg_error = $this->lang->line('Successfully updated'); 
		        		$this->session->set_flashdata('success', $msg_error);
		        		redirect('user/my_account', 'refresh');
		        	}
		        	else {
		        		$msg_error = $this->lang->line('Error occurred'); 
                        $this->session->set_flashdata('error', $msg_error);
		        		redirect('user/my_account', 'refresh');
		        	}
		        }
		        else {
		        	$this->form_validation->set_rules('password', $this->lang->line('Password'), 'trim|required|min_length[6]');
					$this->form_validation->set_rules('cpassword', $this->lang->line('Confirm Password'), 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
			        		'username' => $this->input->post('username'),
			        		'password' => $password,
			        		'email' => $this->input->post('email'),
			        		'name' => $this->input->post('name'),
			        		'phone' => $this->input->post('phone'),
			        		'active' => $this->input->post('active'),
			        		'language' => $this->input->post('language'),
			        	);

			        	$update = $this->model_user->edit($data, $id);
			        	if($update == true) {
			        		$msg_error = $this->lang->line('Successfully updated'); 
			        		$this->session->set_flashdata('success', $msg_error);
			        		redirect('user/my_account', 'refresh');
			        	}
			        	else {
			        		$msg_error = $this->lang->line('Error occurred'); 
                            $this->session->set_flashdata('error', $msg_error);
			        		redirect('user/my_account', 'refresh');
			        	}
					}
			        else {
			            // false case
			        	$account_data = $this->model_user->getUserData($id);
			        	$profile = $this->model_user->getUserProfile($id);

			        	$this->data['account_data'] = $account_data;
			        	$this->data['account_profile'] = $profile;

			            $profile_data = $this->model_profile->getProfileData();
			        	$this->data['profile_data'] = $profile_data;

						$this->render_template('user/my_account', $this->data);	
			        }	

		        }
	        }
	        else {
	            // false case
	        	$account_data = $this->model_user->getUserData($id);
	        	$profile = $this->model_user->getUserProfile($id);

	        	$this->data['account_data'] = $account_data;
	        	$this->data['account_profile'] = $profile;

	            $profile_data = $this->model_profile->getProfileData();
	        	$this->data['profile_data'] = $profile_data;

				$this->render_template('user/my_account', $this->data);	
	        }		
	}
}


	public function update($id)
	{
		if(!in_array('updateUser', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {

			// We have an update without changing the password
	        if(empty($this->input->post('edit_password'))) 
        		{
        		$this->form_validation->set_rules('edit_username', $this->lang->line('Username'), 'trim|required|min_length[5]|max_length[12]');
				$this->form_validation->set_rules('edit_email', $this->lang->line('Email'), 'trim|required');
				$this->form_validation->set_rules('edit_name', $this->lang->line('Name'), 'trim|required');
				$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        		if ($this->form_validation->run() == TRUE) {
		        	$data = array(
		        		'username' => $this->input->post('edit_username'),
		        		'profile_id' => $this->input->post('edit_profile'),
		        		'email' => $this->input->post('edit_email'),
		        		'name' => $this->input->post('edit_name'),
		        		'phone' => $this->input->post('edit_phone'),
		        		'active' => $this->input->post('edit_active'),
		        		'region_id' => $this->input->post('edit_region'),
		        		'language' => $this->input->post('edit_language'),
		        	);

			        $update = $this->model_user->edit($data, $id);	
		        	
		        	if($update == true) {
		        		$response['success'] = true;
		        		$response['messages'] = $this->lang->line('Successfully updated');
		        		}
		        	else {
		        		$response['success'] = false;
		        		$response['messages'] = $this->lang->line('Error in the database while updating the information');			
		        		}
	        		}  //validation is true
		        else   //validation is false
		        	{
		        	$response['success'] = false;
		        	foreach ($_POST as $key => $value) {
		        		$response['messages'][$key] = form_error($key);}
		        	}
		        }  //end if we have an update without password		

            else  //we have an update with the password included
            	{
		        	$this->form_validation->set_rules('edit_username', $this->lang->line('Username'), 'trim|required|min_length[5]|max_length[12]');
					$this->form_validation->set_rules('edit_email', $this->lang->line('Email'), 'trim|required');
					$this->form_validation->set_rules('edit_name', $this->lang->line('Name'), 'trim|required');					
		        	$this->form_validation->set_rules('edit_password', $this->lang->line('Password'), 'trim|required|min_length[6]');
					$this->form_validation->set_rules('edit_cpassword', $this->lang->line('Confirm Password'), 'trim|required|matches[edit_password]');
					$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('edit_password'));

						$data = array(
			        		'username' => $this->input->post('edit_username'),
			        		'profile_id' => $this->input->post('edit_profile'),
			        		'email' => $this->input->post('edit_email'),
			        		'name' => $this->input->post('edit_name'),
			        		'phone' => $this->input->post('edit_phone'),
			        		'region_id' => $this->input->post('edit_region'),
			        		'active' => $this->input->post('edit_active'),
			        		'language' => $this->input->post('edit_language'),
			        		'password' => $password,			        		
			        	);

			        	$update = $this->model_user->edit($data, $id);

			        	if($update == true) {
			        		$response['success'] = true;
			        		$response['messages'] = $this->lang->line('Successfully updated');
			        		}
			        	else {
			        		$response['success'] = false;
			        		$response['messages'] = $this->lang->line('Error in the database while updating the information');			
			        		}
					} // form validation is true for update with password
				else  //Validation is false and we send messages of errors
					{
					$response['success'] = false;
		        	foreach ($_POST as $key => $value) {
		        		$response['messages'][$key] = form_error($key);}	
					}	
				} // if password to update
			} // if we have an ID

		echo json_encode($response);
	}


	public function remove()
	{
		if(!in_array('deleteUser', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$user_id = $this->input->post('user_id');

		$response = '';
		$response = array();
		
		if($user_id) {			
			$delete = $this->model_user->remove($user_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = $this->lang->line('Successfully deleted');}
			else {
				$response['success'] = false;
				$response['messages'] = $this->lang->line('Error in the database while deleting the information');
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = $this->lang->line('Refresh the page again');
		}

		echo json_encode($response);
	}





	
	
}