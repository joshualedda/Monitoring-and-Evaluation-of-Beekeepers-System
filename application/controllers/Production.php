<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Production');
        $this->load->model('model_production');
        $this->load->model('model_colony');
        $this->load->model('model_product');
	}

	public function index()
	{
        if(!in_array('viewProduction', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('production/index', $this->data);	
	}

	public function fetchProductionData()
	{
		$result = array('data' => array());

        $data = $this->model_production->getProductionData();

		foreach ($data as $key => $value) {

            $buttons = '';

            if(in_array('updateProduction', $this->permission)) {
                $buttons .= '<a href="'.base_url('production/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';
            }
            if(in_array('deleteProduction', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';
            }
           
			$result['data'][$key] = array(				
				$value['colony_number'],
                $value['product_name'],
                $value['total_production'],
				$value['production_date'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

	public function fetchProductData()
	{
		$data = $this->model_product->getActiveProduct();
		echo json_encode($data);
	}

	public function fetchProductionDataById($id)
	{
		if($id) {
			$data = $this->model_production->getProductionData($id);
			echo json_encode($data);
		}
	}

	public function fetchProductionColony($colony_id)
	{
		$result = array('data' => array());

        $data = $this->model_production->getProductionColony($colony_id);

		foreach ($data as $key => $value) {

            $buttons = '';

            if(in_array('updateProduction', $this->permission)) {
                $buttons .= '<a href="javascript:void(0);" onclick="editProduction('.$value['id'].')" class="btn-dt btn-dt-edit" title="Edit" data-toggle="modal" data-target="#editModalProduction"><i class="ph ph-pencil-simple"></i></a>';
            }
            if(in_array('deleteProduction', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeProduction('.$value['id'].')" data-toggle="modal" data-target="#removeModalProduction"><i class="ph ph-trash"></i></button>';
            }
           
			$result['data'][$key] = array(				
                $value['product_name'],
                $value['total_production'],
                $value['gross_income'],
                $value['cost'],
                $value['net_income'],
				$value['production_date'],
				$buttons
			);
		}

		echo json_encode($result);
	}

	public function create()
	{

		if(!in_array('createProduction', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('colony_id', $this->lang->line('Colony'), 'trim|required');
        $this->form_validation->set_rules('product_id', $this->lang->line('Product'), 'trim|required');
        $this->form_validation->set_rules('year', $this->lang->line('Year'), 'trim|required');
        
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
          	$data = array(
				'colony_id' => $this->input->post('colony_id'),
			    'product_id' => $this->input->post('product_id'),
                'cost' => $this->input->post('cost'),
				'gross_income' => $this->input->post('gross_income'),
				'net_income' => $this->input->post('net_income'),                
                'production_date' => $this->input->post('production_date'),                
                'total_production' => $this->input->post('total_production'),
                'year' => $this->input->post('year')      		
        	);

        	$create = $this->model_production->create($data);

        	if($create == false) {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('production/create', 'refresh');
            } else {
                $msg_success = $this->lang->line('Successfully created'); 
                $this->session->set_flashdata('success', $msg_success);
                redirect('production', 'refresh');
            }
        }

        $this->data['colonies'] = $this->model_colony->getColonyData(); 
		$this->data['products'] = $this->model_product->getActiveProduct();  

        $this->render_template('production/create', $this->data);
	}

	public function update($production_id = null)
	{      
        if(!in_array('updateProduction', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$production_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('colony_id', $this->lang->line('Colony'), 'trim|required');
        $this->form_validation->set_rules('product_id', $this->lang->line('Product'), 'trim|required');
        $this->form_validation->set_rules('year', $this->lang->line('Year'), 'trim|required');
        
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'colony_id' => $this->input->post('colony_id'),
			    'product_id' => $this->input->post('product_id'),
                'cost' => $this->input->post('cost'),
				'gross_income' => $this->input->post('gross_income'),
				'net_income' => $this->input->post('net_income'),                
                'production_date' => $this->input->post('production_date'),                
                'total_production' => $this->input->post('total_production'),
                'year' => $this->input->post('year')
            );
            
            $update = $this->model_production->update($data, $production_id);

            if($update == true) {
                $msg_success = $this->lang->line('Successfully updated'); 
                $this->session->set_flashdata('success', $msg_success);
                redirect('production', 'refresh');
            } else {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('production/update/'.$production_id, 'refresh');
            }
        }

        $this->data['production_data'] = $this->model_production->getProductionData($production_id);
        $this->data['colonies'] = $this->model_colony->getColonyData(); 
		$this->data['products'] = $this->model_product->getActiveProduct();  

        $this->render_template('production/edit', $this->data); 
	}

	public function remove()
	{
        if(!in_array('deleteProduction', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $production_id = $this->input->post('production_id');

        $response = array();

        if($production_id) {
            $delete = $this->model_production->remove($production_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = $this->lang->line('Successfully deleted'); 
            }
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