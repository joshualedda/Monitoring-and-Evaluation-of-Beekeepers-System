<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Production');

	}

	public function index()
	{
		if(!in_array('viewProduction', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$product_data = $this->model_product->getProductData();
		$this->data['product_name'] = $product_data;

		$this->render_template('production/index', $this->data);	
	}

	public function fetchProductData() 
	{
		$data = $this->model_product->getProductData();
		echo json_encode($data);

	}

	public function fetchProductDataById($id)
	{	
		if($id) {
			$data = $this->model_product->getProductData($id);
			echo json_encode($data);
		}
	}
	
    //--> It fetches the production data from the production table 
    //    This function is called from the datatable ajax function
    
    public function fetchProductionBeekeeper($id)
    {
        $result = array('data' => array());

        $data = $this->model_production->getProductionBeekeeper($id);  

        foreach ($data as $key => $value) {

        	$product_data = $this->model_product->getProductData($value['product_id']);

            $buttons = '';

            if(in_array('updateProduction', $this->permission)) {
               $buttons .= '<button type="button" class="btn btn-default" onclick="editProduction('.$value['id'].')" data-toggle="modal" data-target="#editModalProduction"><i class="fa fa-pencil"></i></button>';
            }

            if(in_array('deleteProduction', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeProduction('.$value['id'].')" data-toggle="modal" data-target="#removeModalProduction"><i class="fa fa-trash"></i></button>';
            }
  
            $result['data'][$key] = array(
                $product_data['name'],                             
                $value['total_production'],
                $value['gross_income'],
                $value['cost'],
                $value['net_income'],                      
                $value['production_date'],                
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }

	
	//--> It retrieves the specific production information via a production id
	//   and returns the data in json format
	
	public function fetchProductionDataById($id) 
	{
		if($id) {
			$data = $this->model_production->getProductionData($id);
			echo json_encode($data);
		}
	}



	//--> If the validation is not true (not valid), then it provides the validation error on the json format
    //    If the validation for each input is valid then it creates the data into the database and 
    //    returns an appropriate message in the json format.

	public function create()
	{
		if(!in_array('createProduction', $this->permission)) {redirect('dashboard', 'refresh');}

		$response = array();

		$this->form_validation->set_rules('product', $this->lang->line('Product'), 'trim|required');
		$this->form_validation->set_rules('production_income', $this->lang->line('Production Income'), 'trim|required');
		$this->form_validation->set_rules('production_cost', $this->lang->line('Production Cost'), 'trim|required');
		$this->form_validation->set_rules('production_net', $this->lang->line('Net Income'), 'trim|required');
		$this->form_validation->set_rules('production_date', $this->lang->line('Product Date'), 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'colony_id' => $this->input->post('colony_id'),
        		'product_id' => $this->input->post('product'),
        		'total_production' => $this->input->post('total_production'),
        		'gross_income' => $this->input->post('production_income'),
        		'cost' => $this->input->post('production_cost'),
        		'net_income' => $this->input->post('production_net'),        		
        		'production_date' => $this->input->post('production_date'),
        		    		
        	);

        	$create = $this->model_production->create($data);

        	if($create == true) 
        		{$response['success'] = true;
        		$response['messages'] = $this->lang->line('Successfully created');}
        	else 
        		{$response['success'] = false;
        		$response['messages'] = $this->lang->line('Error in the database while creating the information');}			
        	
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
		if(!in_array('updateProduction', $this->permission)) {redirect('dashboard', 'refresh');}

		$response = array();

		if($id) {

			$this->form_validation->set_rules('edit_product', $this->lang->line('Product'), 'trim|required');
					$this->form_validation->set_rules('edit_production_income', $this->lang->line('Production Income'), 'trim|required');
		$this->form_validation->set_rules('edit_production_cost', $this->lang->line('Production Cost'), 'trim|required');
		$this->form_validation->set_rules('edit_production_net', $this->lang->line('Net Income'), 'trim|required');

			$this->form_validation->set_rules('edit_production_date', $this->lang->line('Product date'), 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	
				$data = array(
					'colony_id' => $this->input->post('colony_id'),
        			'product_id' => $this->input->post('edit_product'),
        			'total_production' => $this->input->post('edit_total_production'),
        			'gross_income' => $this->input->post('edit_production_income'),
        			'cost' => $this->input->post('edit_production_cost'),
        			'net_income' => $this->input->post('edit_production_net'),           		
        			'production_date' => $this->input->post('edit_production_date'),	        		    
				);

		        $update = $this->model_production->update($data, $id);	
	        	
	        	if($update == true) 
	        		{$response['success'] = true;
	        		$response['messages'] = $this->lang->line('Successfully updated');}
	        	else 
	        		{$response['success'] = false;
	        		$response['messages'] = $this->lang->line('Error in the database while updating the information');}			
	        	}  //end form validation is true
	        else   //form validation is false
	        	{$response['successa'] = false;
	        	foreach ($_POST as $key => $value) {$response['messages'][$key] = form_error($key);}
	            }
		}  //else no id
		else {
			$response['successb'] = false;
    		$response['messages'] = $this->lang->line('Error please refresh the page again');
		}

		echo json_encode($response);
	}




	public function remove()
	{
		if(!in_array('deleteProduction', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$production_id = $this->input->post('production_id');

		$response = '';
		$response = array();
		
		if($production_id) {			
			$delete = $this->model_production->remove($production_id);
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