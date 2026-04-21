<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Beekeeper extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Beekeeper');
        $this->data['active_tab'] = $this->input->get('tab') ?? 'beekeeper';
        
	}
    

    //--> It only redirects to the manage beekeeper page

	public function index()
	{
        if(!in_array('viewBeekeeper', $this->permission)) {redirect('dashboard', 'refresh');}

		$this->render_template('beekeeper/index', $this->data);	
	}


    //-->  It Fetches the beekeeper data from the beekeeper table 
    //     this function is called from the datatable ajax function
    
	public function fetchBeekeeperData()
	{
		$result = array('data' => array());

		$data = $this->model_beekeeper->getBeekeeperData();        

		foreach ($data as $key => $value) 
        {

            $beekeeper_name = $value['beekeeper_name'];

            $buttons = '';

            if(in_array('updateBeekeeper', $this->permission)) {
                if(!in_array('regional', $this->permission) || in_array($value['region_id'], $this->permission)){
                $buttons .= '<a href="'.base_url('beekeeper/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';
                $beekeeper_name = '<a href="'.base_url('beekeeper/update/'.$value['id']).'">'.$value['beekeeper_name'].'</a>';}
            }

            if(in_array('deleteBeekeeper', $this->permission)) { 
                if(!in_array('regional', $this->permission) || in_array($value['region_id'], $this->permission)){
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';}          
            }
            if(in_array('viewBeekeeper', $this->permission)) {
                $buttons .= '<a href="'.base_url('report0B/REP0B/'.$value['id']).'" target="_blank" class="btn-dt btn-dt-print" title="Print"><i class="ph ph-printer"></i></a>';} 

            $active = ($value['active'] == 1) ? '<span class="dt-badge dt-badge-success">'.$this->lang->line('Active').'</span>' : '<span class="dt-badge dt-badge-warning">'.$this->lang->line('Inactive').'</span>';            
              
			$result['data'][$key] = array(
				$beekeeper_name,
				$value['beekeeper_register_id'],
                $value['association_name'],
				$active,
				$buttons
			);

            // For conversion only, to delete after conversion
            // This will create directory for all companies     
            $path = "./upload/documents/".$value['beekeeper_register_id'];
            if(!is_dir($path))  {mkdir($path,0755,TRUE);}            

		} // /foreach

		echo json_encode($result);
	}




    //-->  If the validation is not valid, then it redirects to the create page.
    //     If the validation for each input field is valid then it inserts the data into the database 
    //     It send the operation message into the session flashdata and display on the manage beekeeper page

    public function create()
    {
        if(!in_array('createBeekeeper', $this->permission)) {redirect('dashboard', 'refresh');}

        //$this->form_validation->set_rules('beekeeper_register_id', $this->lang->line('Register Id'), 'trim|required|is_unique[beekeeper.beekeeper_register_id]');
        $this->form_validation->set_rules('beekeeper_name', $this->lang->line('Beekeeper Name'), 'trim|required');
        $this->form_validation->set_rules('category', $this->lang->line('Category'), 'trim|required');
        $this->form_validation->set_rules('association', $this->lang->line('Association'), 'trim|required');
        $this->form_validation->set_rules('nationality[]', $this->lang->line('Nationality'), 'trim|required');
        $this->form_validation->set_rules('gender', $this->lang->line('Gender'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('Address'), 'trim|required');
        $this->form_validation->set_rules('region', $this->lang->line('Region'), 'trim|required'); 
        $this->form_validation->set_rules('province', $this->lang->line('Province'), 'trim|required');  
        $this->form_validation->set_rules('lgu', $this->lang->line('Lgu'), 'trim|required'); 
        $this->form_validation->set_rules('birth_date', $this->lang->line('Birth Date'), 'trim|required|valid_date');
        $this->form_validation->set_rules('education', $this->lang->line('Highest Educational Attainment'), 'trim|required');  
        $this->form_validation->set_rules('fund_source[]', $this->lang->line('Fund Source'), 'trim|required');       
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
            // True case, we create the new beekeeper
            $data = array(
                'active' => $this->input->post('active'),
                'address' => $this->input->post('address'),
                'region_id' => $this->input->post('region'),
                'province_id' => $this->input->post('province'),
                'municipality_id' => $this->input->post('lgu'),
                'beekeeper_name' => $this->input->post('beekeeper_name'),
                'beekeeper_register_id' => $this->input->post('beekeeper_register_id'),
                'directory' => $this->input->post('beekeeper_register_id'),
                'email' => $this->input->post('email'),                
                'contact_number' => $this->input->post('contact_number'),
                'gender_id'=> $this->input->post('gender'),
                'education_id' => $this->input->post('education'),
                'birthdate'=> $this->input->post('birth_date'),
                'nationality_id' => json_encode($this->input->post('nationality')),
                'fund_source_id' => json_encode($this->input->post('fund_source')),
                'association_id' => $this->input->post('association'),
                'category_id' => $this->input->post('category'),
                'remark' => $this->input->post('remark'),               
                'website' => $this->input->post('website'), 
                'updated_by' => $this->session->user_id,               
            );

            $create = $this->model_beekeeper->create($data);

            if($create == false) {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('beekeeper/create', 'refresh');}
            else {
                $beekeeper_id = $create;
                //---> Create the directory for deposit of documents-->
                $path = "./upload/documents/".$beekeeper_id;
         $data = array(
                'directory' => $beekeeper_id,
            );
          $update = $this->model_beekeeper->update($data, $beekeeper_id);
                //---> Create the folder if it does not exists
                if(!is_dir($path))  {mkdir($path,0755,TRUE);} 
                //The create return the beekeeper_id created if it's successful
                redirect('beekeeper/update/'.$beekeeper_id, 'refresh');}
             
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
        $this->data['lgu'] = $this->model_municipality->getActiveMunicipality(); 
        $this->data['nationality'] = $this->model_nationality->getActiveNationality();
        $this->data['fund_source'] = $this->model_fund_source->getActiveFund_Source();  
        $this->data['association'] = $this->model_association->getActiveAssociation();      
        $this->data['category'] = $this->model_category->getActiveCategory();          
        $this->data['gender'] =$this->model_gender->getActiveGender();    
        $this->data['education'] =$this->model_education->getActiveEducation();
        $this->render_template('beekeeper/create', $this->data);
       
    }


    //--> If the validation is not valid, then it redirects to the edit beekeeper page 
    //    If the validation is successful then it updates the data into the database 
    //    and it send the operation message into the session flashdata and display on the manage beekeeper page
    
    public function update($beekeeper_id)
    {      
        $beekeeper_data = $this->model_beekeeper->getBeekeeperData($beekeeper_id);
        if(!in_array('updateBeekeeper', $this->permission)) {redirect('dashboard', 'refresh');}
        if(in_array('regional', $this->permission))
            {
                if(!in_array($beekeeper_data['region_id'],$this->permission))
                    {
                        redirect('dashboard', 'refresh');
                    }
                    else
                    {
                        $this->data['region']=$this->model_region->getRegionById($beekeeper_data['region_id']);
                    }
            }
            else
            {
                        $this->data['region'] = $this->model_region->getActiveRegion();
            }
        if(!$beekeeper_id) {redirect('dashboard', 'refresh');}

        $this->form_validation->set_rules('beekeeper_name', $this->lang->line('Beekeeper Name'), 'trim|required');
        $this->form_validation->set_rules('category', $this->lang->line('Category'), 'trim|required');
        $this->form_validation->set_rules('association', $this->lang->line('Association'), 'trim|required');
        $this->form_validation->set_rules('nationality[]', $this->lang->line('Nationality'), 'trim|required');
        $this->form_validation->set_rules('gender', $this->lang->line('Gender'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('Address'), 'trim|required');
        $this->form_validation->set_rules('region', $this->lang->line('Region'), 'trim|required'); 
        $this->form_validation->set_rules('province', $this->lang->line('Province'), 'trim|required');  
        $this->form_validation->set_rules('lgu', $this->lang->line('Lgu'), 'trim|required');
        $this->form_validation->set_rules('birth_date', $this->lang->line('Birth Date'), 'trim|required|valid_date');
        $this->form_validation->set_rules('education', $this->lang->line('Highest Educational Attainment'), 'trim|required');  
        $this->form_validation->set_rules('fund_source[]', $this->lang->line('Fund Source'), 'trim|required');          
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');
     

        if ($this->form_validation->run() == TRUE) {          
                            
            $data = array(
                'active' => $this->input->post('active'),
                'address' => $this->input->post('address'),
                'region_id' => $this->input->post('region'),
                'province_id' => $this->input->post('province'),
                'municipality_id' => $this->input->post('lgu'),
                'beekeeper_name' => $this->input->post('beekeeper_name'),
                'beekeeper_register_id' => $this->input->post('beekeeper_register_id'),
                'email' => $this->input->post('email'),         
                'education_id' => $this->input->post('education'),       
                'contact_number' => $this->input->post('contact_number'),
                'gender_id'=> $this->input->post('gender'),
                'birthdate'=> $this->input->post('birth_date'),
                'fund_source_id' =>json_encode($this->input->post('fund_source')),
                'nationality_id' => json_encode($this->input->post('nationality')),
                'association_id' => $this->input->post('association'),
                'category_id' => $this->input->post('category'),
                'remark' => $this->input->post('remark'),               
                'website' => $this->input->post('website'),                 
                'updated_by' => $this->session->user_id,    
            );

            $update = $this->model_beekeeper->update($data, $beekeeper_id);

            if($update == true) {
                //$msg_error = $this->lang->line('Successfully updated'); 
                //$this->session->set_flashdata('success', $msg_error);
                redirect('beekeeper/update/'.$beekeeper_id."?tab=beekeeper", 'refresh');
            } else {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('beekeeper/update/'.$beekeeper_id, 'refresh');}
        }

        //--> We are in edit of the form, preparation of the drop down list
        //    and reading of the beekeeper data
             
        $this->data['nationality'] = $this->model_nationality->getActiveNationality();  
        $this->data['association'] = $this->model_association->getActiveAssociation();      
        $this->data['category'] = $this->model_category->getActiveCategory();             
        $this->data['fund_source'] = $this->model_fund_source->getActiveFund_Source();
        $this->data['gender'] = $this->model_gender->getActiveGender();
        $this->data['education'] = $this->model_education->getActiveEducation();
        $this->data['document_type'] = $this->model_document_type->getActiveDocumentType();
        //$beekeeper_data = $this->model_beekeeper->getBeekeeperData($beekeeper_id);

        
        $this->data['province'] = $this->model_province->getProvinceDataByRegionId($beekeeper_data['region_id']); 
        $this->data['lgu'] = $this->model_municipality->getMunicipalityDataByProvinceId($beekeeper_data['province_id']); 
        $this->data['beekeeper_data'] = $beekeeper_data;
        $this->render_template('beekeeper/edit', $this->data); 
         
    }


    public function remove()
    {
        if(!in_array('deleteBeekeeper', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $beekeeper_id = $this->input->post('beekeeper_id');

        $response = '';
        $response = array();
        
        if($beekeeper_id) {
            $delete = $this->model_beekeeper->remove($beekeeper_id);
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


    

    

//-------------------------------------   DOCUMENT ------------------------------------------------------

    
    //--> It Fetches the document data from the document table 
    //    this function is called from the datatable ajax function
    
    public function fetchBeekeeperDocument()
    {
        $result = array('data' => array());

        $id = $this->input->post('document_beekeeper_id');

        $data = $this->model_beekeeper->getBeekeeperDocument($id);  

        foreach ($data as $key => $value) {

            $link = base_url('upload/documents/'.$value['directory'].'/'.$value['doc_name']);
            $doc_link = '<a href="'.$link.'" target="_blank" >'.($value['doc_name']).'</a>';

            $buttons = '';

            if(in_array('viewDocument', $this->permission)) {
                $buttons .= '<a href="'.$link.'" target="_blank" class="btn-dt btn-dt-view" title="View"><i class="ph ph-magnifying-glass"></i></a>';
            }

            if(in_array('deleteDocument', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeDocument('.$value['id'].')" data-toggle="modal" data-target="#removeDocumentModal"><i class="ph ph-trash"></i></button>';   
            }           
  
            $result['data'][$key] = array(
                $value['name'],
                $doc_link,
                $value['doc_size'],
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }



    //-->  This function is invoked from another function to upload the documents into the assets folder
    //     of the beekeeper

    public function uploadDocument()
    {

        if(!in_array('updateDocument', $this->permission)) {
            redirect('dashboard', 'refresh');
        }



        $directory = $this->session->directory;
        $config['upload_path'] = './'.$directory;
        $config['allowed_types'] = 'gif|jpg|png|pdf|xls|xlsx|docx|doc|pptx';
        $config['max_size'] = '4000';        

        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('beekeeper_document')) {
            $msg_error = $this->lang->line('This type of document is not allowed or the document is too large.'); 
            $this->session->set_flashdata('warning', $msg_error);
            redirect('beekeeper/update/'.$this->session->beekeeper_id."?tab=document", 'refresh');
            }
        else
            {
            //---> Create the document in the table document
           
            $doc_link = $directory.$this->upload->data('file_name');

            $data = array(
                'beekeeper_id' => $this->session->beekeeper_id, 
                'doc_size' => $this->upload->data('file_size'),
                'doc_type' => $this->upload->data('file_type'),
                'doc_name' => $this->upload->data('file_name'),
                'document_type_id' => $this->input->post('document_type'),  
                'updated_by' => $this->session->user_id,                 
            );

            $create = $this->model_beekeeper->createDocument($data);
            
            if($create == true) {
                //--->  Upload the document
                $data = array('upload_data' => $this->upload->data());
                redirect('beekeeper/update/'.$this->session->beekeeper_id."?tab=document", 'refresh');
            } else {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('beekeeper/', 'refresh');}

            
        }
    } 



    public function removeDocument()
    {
        if(!in_array('deleteDocument', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $document_id = $this->input->post('document_id');
        $response = array();

        if($document_id) {
            //--> Get the link of the document for deleting the document on the directory
            $document_data = $this->model_beekeeper->getDocument($document_id);
            $doc_link = '/upload/documents/'.$document_data['directory'].'/'.$document_data['doc_name'];
            unlink(FCPATH . $doc_link);
            //--> Delete the document in the document table
            $delete = $this->model_beekeeper->removeDocument($document_id);
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

?>