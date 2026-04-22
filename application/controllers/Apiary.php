<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apiary extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Apiary');
        $this->data['active_tab'] = $this->input->get('tab') ?? 'apiary';

	}

    
    //--> Redirects to the manage apiary page
 
	public function index()
	{
        if(!in_array('viewApiary', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('apiary/index', $this->data);	
	}

    
    //--> It fetches the apiary data from the apiary table 
    //    This function is called from the datatable ajax function
    
	public function fetchApiaryData()
	{
		$result = array('data' => array());

        $data = $this->model_apiary->getApiaryData();

		foreach ($data as $key => $value) {

            //$source_data = $this->model_source->getSourceData($value['source_id']);
           // $topography_data = $this->model_topography->getTopographyData($value['topography_id']);
            $beekeeper_data = $this->model_beekeeper->getBeekeeperData($value['beekeeper_id']);

            //source data fecth it here
            $source_apiary = json_decode($value['source_id']);
            $source_list = '';
            if (!$source_apiary == null) {
                foreach($source_apiary as $keysource=>$valuesource){

                $source_datam = $this->model_source->getSourceData($source_apiary[$keysource]);
                $source_list = $source_list.' '.$source_datam['name'];
                }  

            }  

            //topography data fecth it here
           $topography_apiary = json_decode($value['topography_id']);
            $topography_list = '';
            if (!$topography_apiary == null) {
                foreach($topography_apiary as $keytopography=>$valuetopography){

              $topography_datam = $this->model_topography->getTopographyData($topography_apiary[$keytopography]);
              $topography_list = $topography_list.' '.$topography_datam['name'];
               }  

            } 


            $buttons = '';

            $location = $value['location'];

            if(in_array('updateApiary', $this->permission)) {
                if(!in_array('regional', $this->permission) || in_array($value['region_id'], $this->permission)){
                $buttons .= '<a href="'.base_url('apiary/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';
                $location = '<a href="'.base_url('apiary/update/'.$value['id']).'">'.$value['location'].'</a>';}  
            }
            if(in_array('deleteApiary', $this->permission)) { 
                if(!in_array('regional', $this->permission) || in_array($value['region_id'], $this->permission)){
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';}
                    }
            if(in_array('viewApiary', $this->permission)) {
                $buttons .= '<a href="'.base_url('report1A/REP1A/'.$value['id']).'" target="_blank" class="btn-dt btn-dt-print" title="Print"><i class="ph ph-printer"></i></a>';}
           
			$result['data'][$key] = array(				
				$location,
                $beekeeper_data['beekeeper_name'],
                $source_list,
				$topography_list,
				$buttons
			);

           
		} // /foreach

		echo json_encode($result);
	}	

  
   //--> If the validation is not true (not valid), then it redirects to the create page.
   //    If the validation for each input field is valid then it inserts the data into the database 
   //    and it sends the operation message into the session flashdata and display on the manage apiary page
   
	public function create($id=null)
	{

		if(!in_array('createApiary', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('location', $this->lang->line('Location'), 'trim|required'); 
        $this->form_validation->set_rules('topography[]', $this->lang->line('Topography'), 'trim|required');       
        $this->form_validation->set_rules('beekeeper', $this->lang->line('Beekeeper'), 'trim|required');
        $this->form_validation->set_rules('source[]', $this->lang->line('Source'), 'trim|required'); 
        $this->form_validation->set_rules('region', $this->lang->line('Region'), 'trim|required'); 
        $this->form_validation->set_rules('province', $this->lang->line('Province'), 'trim|required'); 
        $this->form_validation->set_rules('municipality', $this->lang->line('Municipality'), 'trim|required');  
		$this->form_validation->set_rules('barangay', $this->lang->line('Barangay'), 'trim|required');   		
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
            // true case, we are creating the apiary - everything is valid
          	$data = array(
				'beekeeper_id' => $this->input->post('beekeeper'),
			    'region_id' => $this->input->post('region'),
                'province_id' => $this->input->post('province'),
				'municipality_id' => $this->input->post('municipality'),
				'district_id' => $this->input->post('barangay'),                
                'coordinate' => $this->input->post('coordinate'),                
                'location' => $this->input->post('location'),
                'map' => $this->input->post('map'),                
                'source_id' => json_encode($this->input->post('source')),                
                'remark' => $this->input->post('remark'),                
                'topography_id' => json_encode($this->input->post('topography')),
                'area_size' => $this->input->post('area_size'),
                'updated_by' => $this->session->user_id,         		
        	);

        	$create = $this->model_apiary->create($data);

        	if($create == false) {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('apiary/create', 'refresh');}
            else {
                 //The create return the apiary_id created if it's successful
              if($id==null)
              {
                $apiary_id = $create;
                redirect('apiary/update/'.$apiary_id, 'refresh');
              }
              else {
                redirect('beekeeper/update/'.$id."?tab=apiary",'refresh');
              }

            }
        	  
        }

        //--> We are in the preparation of the form and we prepare 
        //    the drop-down list needed in the create form        
        if(!in_array('regional', $this->permission))
        {
             $this->data['region'] = $this->model_region->getActiveRegion(); 
        }
        else
        {
             $this->data['region'] = $this->model_region->getRegionById(end($this->permission)); 
        }
		$this->data['province'] = $this->model_province->getActiveProvince();  
		$this->data['municipality'] = $this->model_municipality->getActiveMunicipality();	
		$this->data['barangay'] = $this->model_barangay->getActiveBarangay();		
		$this->data['source'] = $this->model_source->getActiveSource(); 
        $this->data['topography'] = $this->model_topography->getActiveTopography();
        $this->data['beekeeper'] = $this->model_beekeeper->getActiveBeekeeperData();  
        $this->data['fromBeekeeper'] =$id;


        $this->render_template('apiary/create', $this->data);
       	
	}


    public function date_check()
    {
        if ($this->input->post('date_end') < $this->input->post('date_begin') )
            {$this->form_validation->set_message('date_check', $this->lang->line('The date End should be greater or equal to the date Begin.'));
            return FALSE;
            }
        else
            {return TRUE;}
    }

    

    
    //--> If the validation is not true (not valid), then it redirects to the edit apiary page 
    //    If the validation is true (valid) then it updates the data into the database 
    //    and it sends the operation message into the session flashdata and display on the manage apiary page
   
	public function update($apiary_id)
	{      
        if(!in_array('updateApiary', $this->permission)) {redirect('dashboard', 'refresh');}
         $apiary_data = $this->model_apiary->getApiaryData($apiary_id);
        if(in_array('regional', $this->permission))
            {
                if(!in_array($apiary_data['region_id'],$this->permission))
                    {
                        redirect('dashboard', 'refresh');
                    }
                    else
                    {
                        $this->data['region']=$this->model_region->getRegionById($apiary_data['region_id']);
                    }
            }
            else
            {
                        $this->data['region'] = $this->model_region->getActiveRegion();
            }

        if(!$apiary_id) {redirect('dashboard', 'refresh');}

        // Set session variables for document upload
        $this->session->set_userdata('apiary_id', $apiary_id);
        $this->session->set_userdata('beekeeper_id', $apiary_data['beekeeper_id']);
        $this->session->set_userdata('directory', "upload/documents/".$apiary_data['beekeeper_id']."/");

        $this->form_validation->set_rules('location', $this->lang->line('Location'), 'trim|required'); 
        $this->form_validation->set_rules('topography[]', $this->lang->line('Topography'), 'trim|required');       
        $this->form_validation->set_rules('beekeeper', $this->lang->line('Beekeeper'), 'trim|required');
        $this->form_validation->set_rules('source[]', $this->lang->line('Source'), 'trim|required'); 
        $this->form_validation->set_rules('region', $this->lang->line('Region'), 'trim|required'); 
        $this->form_validation->set_rules('province', $this->lang->line('Province'), 'trim|required'); 
        $this->form_validation->set_rules('municipality', $this->lang->line('Municipality'), 'trim|required');  
        $this->form_validation->set_rules('barangay', $this->lang->line('Barangay'), 'trim|required');    		
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        //--->  Validation of the form
        if ($this->form_validation->run() == TRUE) {
            // true case            
            $data = array(
                'beekeeper_id' => $this->input->post('beekeeper'),
			    'region_id' => $this->input->post('region'),
                'province_id' => $this->input->post('province'),
				'municipality_id' => $this->input->post('municipality'),
				'district_id' => $this->input->post('barangay'),                
                'coordinate' => $this->input->post('coordinate'),                
                'location' => $this->input->post('location'),
                'map' => $this->input->post('map'),                
                'source_id' => json_encode($this->input->post('source')),
                'remark' => $this->input->post('remark'),                
                'topography_id' => json_encode($this->input->post('topography')),
                'area_size' => $this->input->post('area_size'),		
                'updated_by' => $this->session->user_id,   
            );
            
            $update = $this->model_apiary->update($data, $apiary_id);

            if($update == true) {
                //$msg_error = $this->lang->line('Successfully updated'); 
                //$this->session->set_flashdata('success', $msg_error);
                redirect('apiary/update/'.$apiary_id."?tab=apiary", 'refresh');
            } else {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('apiary/update/'.$apiary_id, 'refresh');}
        }

        //--> We are in edit of the form, preparation of the drop down list
        //    and reading of the apiary data
        $this->data['document_type'] =$this->model_document_type->getActiveDocumentType();
		$this->data['province'] = $this->model_province->getActiveProvince();  
		$this->data['municipality'] = $this->model_municipality->getActiveMunicipality();	
		$this->data['barangay'] = $this->model_barangay->getActiveBarangay();		
		$this->data['source'] = $this->model_source->getActiveSource(); 
        $this->data['topography'] = $this->model_topography->getActiveTopography();
        $this->data['beekeeper'] = $this->model_beekeeper->getActiveBeekeeperData();       
        $this->data['apiary_data'] = $apiary_data;
        $this->render_template('apiary/edit', $this->data); 
    
	}


    
    //--> It removes the data from the database
    //    and it returns the response into the json format
    
	public function remove()
	{
        if(!in_array('deleteApiary', $this->permission)) {
            redirect('dashboard', 'refresh');}
        
        $apiary_id = $this->input->post('apiary_id');

        $response = '';
        $response = array();

            if($apiary_id) {
            $delete = $this->model_apiary->remove($apiary_id);
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



    
    //--> It fetches the apiary data from the apiary table 
    //    This function is called from the datatable ajax function
   
    public function fetchApiaryBeekeeper($id)
    {
        $result = array('data' => array());

        $data = $this->model_apiary->getApiaryBeekeeper($id);   

        foreach ($data as $key => $value) 
        {

           $source_apiary = json_decode($value['source_id']);
            $source_list = '';
            if (!$source_apiary == null) {
                foreach($source_apiary as $keysource=>$valuesource){

                $source_datam = $this->model_source->getSourceData($source_apiary[$keysource]);
                $source_list = $source_list.' '.$source_datam['name'];
                }  

            }  

            //topography data fecth it here
           $topography_apiary = json_decode($value['topography_id']);
            $topography_list = '';
            if (!$topography_apiary == null) {
                foreach($topography_apiary as $keytopography=>$valuetopography){

              $topography_datam = $this->model_topography->getTopographyData($topography_apiary[$keytopography]);
              $topography_list = $topography_list.' '.$topography_datam['name'];
               }  

            } 

            $buttons = '';   

            if(in_array('updateApiary', $this->permission)) {
                $buttons .= '<a href="'.base_url('apiary/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';} 

            if(in_array('deleteApiary', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeApiary('.$value['id'].')" data-toggle="modal" data-target="#removeApiaryModal"><i class="ph ph-trash"></i></button>';}  

            if(in_array('viewApiary', $this->permission)) {
                $buttons .= '<a href="'.base_url('report1A/REPA1/'.$value['id']).'" target="_blank" class="btn-dt btn-dt-print" title="Print"><i class="ph ph-printer"></i></a>';}
                
            
            $result['data'][$key] = array(
                $value['location'],
                $value['area_size'],
                $source_list,
                $topography_list,
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }




    
    //-------------------------------------   DOCUMENT ------------------------------------------------------

   
    //--> It fetches the document data from the document table 
    //    This function is called from the datatable ajax function
    
    public function fetchApiaryDocument($id)
    {
        $result = array('data' => array());

        $data = $this->model_apiary->getApiaryDocument($id);   

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
           
            $document_type = $this->lang->line($value['name']);
  
            $result['data'][$key] = array(
                'id' => $value['id'],
                'type_name' => $document_type,
                'doc_name' => $value['doc_name'],
                'doc_size' => $value['doc_size'],
                'doc_type' => $value['doc_type'],
                'doc_link' => $link,
                'view_link' => $doc_link,
                'buttons' => $buttons,
                // Backward compatibility
                0 => $document_type,
                1 => $doc_link,
                2 => $value['doc_size'],
                3 => $buttons
            );
        } // /foreach

        echo json_encode($result);
    }


  
    //    This function is invoked from another function to upload the documents into the assets folder
    //    of the beekeeper
    
    public function uploadDocument($apiary_id = null)
    {
        if(!$apiary_id) {
            $apiary_id = $this->session->apiary_id;
        }

        if(!$apiary_id) {
            redirect('apiary/', 'refresh');
        }

        // Fetch apiary data early for directory path building
        $apiary_data = $this->model_apiary->getApiaryData($apiary_id);
        if(!$apiary_data) {
            redirect('apiary/', 'refresh');
        }
        $beekeeper_id = $apiary_data['beekeeper_id'];

        if(!in_array('updateDocument', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $directory = "upload/documents/".$beekeeper_id;
        $config['upload_path'] = './'.$directory;
        $config['allowed_types'] = 'gif|jpg|png|pdf|xls|xlsx|docx|doc|pptx';
        $config['max_size'] = '4000';

        if(!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('apiary_document')){
            $msg_error = $this->upload->display_errors('', ''); 
            $this->session->set_flashdata('warning', $msg_error);
            redirect('apiary/update/'.$apiary_id."?tab=document", 'refresh');
            }
        else
            {
            //---> Create the document in the table document

            // IDs already fetched above

            $data = array(
                'beekeeper_id' => $beekeeper_id, 
                'apiary_id' => $apiary_id, 
                'colony_id' => null,
                'doc_size' => $this->upload->data('file_size'),
                'doc_type' => $this->upload->data('file_type'),
                'doc_name' => $this->upload->data('file_name'),
                'document_type_id' => $this->input->post('document_type'), 
                'updated_by' => $this->session->user_id,       
            );

            $create = $this->model_apiary->createDocument($data);

            if($create == true) {
                //--->  Upload the document
                $data = array('upload_data' => $this->upload->data());
                $msg_success = $this->lang->line('Successfully uploaded'); 
                $this->session->set_flashdata('success', $msg_success);
                redirect('apiary/update/'.$apiary_id."?tab=document", 'refresh');
            } else {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('apiary/', 'refresh');}

            
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
            $document_data = $this->model_apiary->getDocument($document_id);
            $doc_link = '/upload/documents/'.$document_data['directory'].'/'.$document_data['doc_name'];
            unlink(FCPATH . $doc_link);
            //--> Delete the document in the document table
            $delete = $this->model_apiary->removeDocument($document_id);
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