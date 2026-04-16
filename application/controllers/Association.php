<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Association extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		$this->data['page_title'] = $this->lang->line('Association');
	}


	//-->  Redirects to the manage association page

	public function index()
	{

		if(!in_array('viewAssociation', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('association/index', $this->data);	
	}	


	//--> It checks if it gets the association id and retreives
	//    the association information from the association model and 
	//    returns the data into json format. 
	//    This function is invoked from the view page.

	public function fetchAssociationDataById($id) 
	{
		if($id) {
			$data = $this->model_association->getAssociationData($id);
			echo json_encode($data);
		}

		return false;
	}


	//-->  Fetches the association value from the association table 
	// this function is called from the datatable ajax function
	
	public function fetchAssociationData()
	{
		$result = array('data' => array());

		$data = $this->model_association->getAssociationData();

		foreach ($data as $key => $value) {

			$buttons = '';

      		$association_name = $value['association_name'];

         

            if(in_array('updateAssociation', $this->permission)) {
                if(!in_array('regional', $this->permission) || in_array($value['region_id'], $this->permission)){
                $buttons .= '<a href="'.base_url('association/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';
                $association_name = '<a href="'.base_url('association/update/'.$value['id']).'">'.$value['association_name'].'</a>';}
            }

			if(in_array('deleteAssociation', $this->permission)) {
                if(!in_array('regional', $this->permission) || in_array($value['region_id'], $this->permission)){
				$buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';
			}
        }
				            if(in_array('viewBeekeeper', $this->permission)) {
                $buttons .= '<a href="'.base_url('report0A/REP0A/'.$value['id']).'" target="_blank" class="btn-dt btn-dt-print" title="Print"><i class="ph ph-printer"></i></a>';} 

			$active = ($value['active'] == 1) ? '<span class="dt-badge dt-badge-success">'.$this->lang->line('Active').'</span>' : '<span class="dt-badge dt-badge-warning">'.$this->lang->line('Inactive').'</span>';

			$result['data'][$key] = array(				
				$association_name,
				$value['contact_name'],
				$value['remark'],
				$active,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}


	//---> Checks the association form validation 
	//     and if the validation is successfully then it inserts the data into the database 
	//     and returns the json format operation messages

	public function create()
	{
        if(!in_array('createAssociation', $this->permission)) {redirect('dashboard', 'refresh');}

        //$this->form_validation->set_rules('association_register_id', $this->lang->line('Register Id'), 'trim|required|is_unique[association.association_register_id]');
        $this->form_validation->set_rules('association_name', $this->lang->line('Association Name'), 'trim|required');
        $this->form_validation->set_rules('contact_name', $this->lang->line('Focal Person/ President'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('Address'), 'trim|required');
        $this->form_validation->set_rules('region', $this->lang->line('Region'), 'trim|required'); 
        $this->form_validation->set_rules('province', $this->lang->line('Province'), 'trim|required');  
        $this->form_validation->set_rules('lgu', $this->lang->line('Lgu'), 'trim|required'); 
        $this->form_validation->set_rules('barangay', $this->lang->line('Barangay'), 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
            // True case, we create the new association
            $data = array(
                'active' => $this->input->post('active'),
                'address' => $this->input->post('address'),
                'region_id' => $this->input->post('region'),
                'province_id' => $this->input->post('province'),
                'lgu_id' => $this->input->post('lgu'),
                'barangay_id' => $this->input->post('barangay'),
                'association_name' => $this->input->post('association_name'),
                'email' => $this->input->post('email'),     
                'contact_name' => $this->input->post('contact_name'),           
                'contact_number' => $this->input->post('contact_number'),
                'remark' => $this->input->post('remark'),               
                'website' => $this->input->post('website'), 
                'updated_by' => $this->session->user_id,               
            );

            $create = $this->model_association->create($data);

            if($create == false) {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('association/create', 'refresh');
            }
            else {
                $association_id = $create;
                redirect('association/update/'.$association_id, 'refresh');
            }
             
        }

        //--> We are in the preparation of the form and we prepare the drop-down list needed in the create form
        if(!in_array('regional', $this->permission))
        {
             $this->data['region'] = $this->model_region->getActiveRegion(); 
        }
        else
        {
             $this->data['region'] = $this->model_region->getRegionById(end($this->permission)); 
        } 
        $this->data['province'] = $this->model_province->getActiveProvince(); 
        $this->data['lgu'] = $this->model_lgu->getActiveLgu(); 
        $this->data['barangay'] = $this->model_barangay->getActiveBarangay();              

        $this->render_template('association/create', $this->data);
       
	}


	//-->  Checks the association form validation 
	//     and if the validation is successfully then it updates the data into the database 
	//     and returns the json format operation messages

	public function update($association_id)
    {      
        if(!in_array('updateAssociation', $this->permission)) {redirect('dashboard', 'refresh');}
         $association_data = $this->model_association->getAssociationData($association_id);
        if(in_array('regional', $this->permission))
            {
                if(!in_array($association_data['region_id'],$this->permission))
                    {
                        redirect('dashboard', 'refresh');
                    }
                    else
                    {
                        $this->data['region']=$this->model_region->getRegionById($association_data['region_id']);
                    }
            }
            else
            {
                        $this->data['region'] = $this->model_region->getActiveRegion();
            }

        if(!$association_id) {redirect('dashboard', 'refresh');}

        //$this->form_validation->set_rules('association_register_id', $this->lang->line('Register Id'), 'trim|required|is_unique[association.association_register_id]');
        $this->form_validation->set_rules('association_name', $this->lang->line('Association Name'), 'trim|required');
        $this->form_validation->set_rules('contact_name', $this->lang->line('Focal Person/ President'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('Address'), 'trim|required');
        $this->form_validation->set_rules('region', $this->lang->line('Region'), 'trim|required'); 
        $this->form_validation->set_rules('province', $this->lang->line('Province'), 'trim|required');  
        $this->form_validation->set_rules('lgu', $this->lang->line('Lgu'), 'trim|required'); 
        $this->form_validation->set_rules('barangay', $this->lang->line('Barangay'), 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');
     

        if ($this->form_validation->run() == TRUE) {  


            //--> The directory where the documents are uploaded is the  
            //    same as association register id.  If the user change the
            //    association register id, we must rename the directory
                         
            $data = array(
                'active' => $this->input->post('active'),
                'address' => $this->input->post('address'),
                'region_id' => $this->input->post('region'),
                'province_id' => $this->input->post('province'),
                'lgu_id' => $this->input->post('lgu'),
                'barangay_id' => $this->input->post('barangay'),
                'association_name' => $this->input->post('association_name'),
                'email' => $this->input->post('email'),      
                'contact_name' => $this->input->post('contact_name'),          
                'contact_number' => $this->input->post('contact_number'),
                'remark' => $this->input->post('remark'),               
                'website' => $this->input->post('website'), 
                'updated_by' => $this->session->user_id,               
            );

            $update = $this->model_association->update($data, $association_id);

            if($update == true) {
                //$msg_error = $this->lang->line('Successfully updated'); 
                //$this->session->set_flashdata('success', $msg_error);
                redirect('association/update/'.$association_id, 'refresh');
            } else {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('association/update/'.$association_id, 'refresh');}
        }

        //--> We are in edit of the form, preparation of the drop down list
        //    and reading of the association data
        $this->data['association_data'] = $association_data;
        $this->data['province'] = $this->model_province->getProvinceDataByRegionId($association_data['region_id']); 
        $this->data['lgu'] = $this->model_lgu->getLguDataByProvinceId($association_data['province_id']); 
        $this->data['barangay'] = $this->model_barangay->getBarangayDataByLguId($association_data['lgu_id']); 
        $this->render_template('association/edit', $this->data); 
       
    }


	//-->  Removes the association information from the database 
	//     and returns the json format operation messages

	public function remove()
	{
		if(!in_array('deleteAssociation', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$association_id = $this->input->post('association_id');

		$response = '';
		$response = array();

		if($association_id) {
			//---> Validate if the information is used in other table
			$total_used = $this->model_association->checkIntegrity($association_id);
			//---> If not used, we can delete
            if ($total_used == 0) {        
				$delete = $this->model_association->remove($association_id);
				if($delete == true) {
					$response['success'] = true;
					$response['messages'] = $this->lang->line('Successfully deleted');}
				else {
					$response['success'] = false;
					$response['messages'] = $this->lang->line('Error in the database while deleting the information');}
				}

			else {
				//---> There is at least one table having this information
				$response['success'] = false;
				$response['messages'] = $this->lang->line('At least one beekeeper uses this information.  You cannot delete.');}

		}
		else {
			$response['success'] = false;
			$response['messages'] = $this->lang->line('Refresh the page again');}

		echo json_encode($response);
	}

}