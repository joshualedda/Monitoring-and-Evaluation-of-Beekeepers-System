<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

	}

	 
	//--> Check if the login form is submitted, and validates the user credential
	//    If not submitted it redirects to the login page
	
	public function login()
	{

		$this->logged_in();

		$this->form_validation->set_rules('username', $this->lang->line('Username'), 'required');
        $this->form_validation->set_rules('password', $this->lang->line('Password'), 'required');
        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
            // true case
           	$username_exists = $this->model_auth->check_username($this->input->post('username'));

           	if($username_exists == TRUE) {
           		$login = $this->model_auth->login($this->input->post('username'), $this->input->post('password'));

           		if($login) {

           			$logged_in_sess = array(
           				'user_id' => $login['id'],
				        'profile'  => $login['profile_id'],
				        'username' => $login['username'],
				        'name'=>$login['name'],
				        'language' => $login['language'],
				        'logged_in' => TRUE
					);

					$this->session->set_userdata($logged_in_sess);
	           			redirect('dashboard', 'refresh');


           		}
           		else {
           			$this->data['errors'] = $this->lang->line('Incorrect username/password combination'); 
           			$this->load->view('templates/header');
           			$this->load->view('login', $this->data);
           		}
           	}
           	else {
           		$this->data['errors'] = $this->lang->line('Username does not exists');
           		$this->load->view('templates/header');
           		$this->load->view('login', $this->data);
           	}	
        }
        else {
            // false case
            $this->load->view('templates/header');
            $this->load->view('login', $this->data ?? []);
        }	
	}

	
	//--> Clears the session and redirects to login page
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

}
