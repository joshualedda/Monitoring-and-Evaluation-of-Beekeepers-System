<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Colony extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = $this->lang->line('Colony');
        $this->data['active_tab'] = $this->input->get('tab') ?? 'colony';

	}

    
    //--> Redirects to the manage colony page
 
	public function index()
	{
        if(!in_array('viewColony', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('colony/index', $this->data);	
	}

    
    //--> It fetches the colony data from the colony table 
    //    This function is called from the datatable ajax function
    public function fetchColonyDataByApiary($apiary_id)
    {
        $result = array('data' => array());
        $data = $this->model_colony->getColonyDataByApiary($apiary_id);

        foreach ($data as $key => $value) {


            $buttons = '';

            $species_name = $value['species_name'];

            if(in_array('updateColony', $this->permission)) {
                $buttons .= '<a href="'.base_url('colony/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';
                $species_name = '<a href="'.base_url('colony/update/'.$value['id']).'">'.$value['species_name'].'</a>';}  

            if(in_array('deleteColony', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';}

            if(in_array('viewColony', $this->permission)) {
                $buttons .= '<a href="'.base_url('report0C/REP0C/'.$value['id']).'" target="_blank" class="btn-dt btn-dt-print" title="Print"><i class="ph ph-printer"></i></a>';}
           
            $result['data'][$key] = array(
                $species_name,
                $value['beekeeper_name'],
                $value['location'],
                $value['phase_name'],
                $value['total_colony'],
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }       
	public function fetchColonyData()
	{
		$result = array('data' => array());

        $data = $this->model_colony->getColonyData();

		foreach ($data as $key => $value) {


            $buttons = '';

            $species_name = $value['species_name'];

            if(in_array('updateColony', $this->permission)) {
                $buttons .= '<a href="'.base_url('colony/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';
                $species_name = '<a href="'.base_url('colony/update/'.$value['id']).'">'.$value['species_name'].'</a>';}  

            if(in_array('deleteColony', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';}

            if(in_array('viewColony', $this->permission)) {
                $buttons .= '<a href="'.base_url('report0C/REP0C/'.$value['id']).'" target="_blank" class="btn-dt btn-dt-print" title="Print"><i class="ph ph-printer"></i></a>';}
           
			$result['data'][$key] = array(
				$species_name,
                $value['beekeeper_name'],
                $value['location'],
                $value['phase_name'],
				$value['total_colony'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

  
   //--> If the validation is not true (not valid), then it redirects to the create page.
   //    If the validation for each input field is valid then it inserts the data into the database 
   //    and it sends the operation message into the session flashdata and display on the manage colony page
   
	public function create($id=null)
	{
		if(!in_array('createColony', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

       
        $this->form_validation->set_rules('species', $this->lang->line('Species'), 'trim|required');
        $this->form_validation->set_rules('apiary', $this->lang->line('Apiary'), 'trim|required');
        $this->form_validation->set_rules('phase', $this->lang->line('Phase'), 'trim|required');   
        $this->form_validation->set_rules('total_colony', $this->lang->line('Total'), 'trim|required');         
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
            // true case, we are creating the colony - everything is valid
          	$data = array(
                'apiary_id' => $this->input->post('apiary'),                
                'total_colony' => $this->input->post('total_colony'),
                'species_id' => $this->input->post('species'),
                'phase_id' => $this->input->post('phase'),
                'remark' => $this->input->post('remark'),
                'updated_by' => $this->session->user_id,         		
        	);

        	$create = $this->model_colony->create($data);

        	if($create == false) {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('colony/create', 'refresh');}
            else {
                 //The create return the colony_id created if it's 
                              if($id==null)
              {
                $apiary_id = $create;
                redirect('colony/update/'.$apiary_id, 'refresh');
              }
              else {
                redirect('apiary/update/'.$id."?tab=colony",'refresh');
              }
          }
        }

        //--> We are in the preparation of the form and we prepare 
        //    the drop-down list needed in the create form        
      	
		$this->data['phase'] = $this->model_phase->getActivePhase(); 
        $this->data['species'] = $this->model_species->getActiveSpecies();
        $this->data['apiary'] = $this->model_apiary->getActiveApiaryData();     
        $this->data['fromApiary']=$id;
        $this->render_template('colony/create', $this->data);
       	
	}

 

    
    //--> If the validation is not true (not valid), then it redirects to the edit colony page 
    //    If the validation is true (valid) then it updates the data into the database 
    //    and it sends the operation message into the session flashdata and display on the manage colony page
   
	public function update($colony_id)
	{      
        if(!in_array('updateColony', $this->permission)) {
            redirect('dashboard', 'refresh');}

        if(!$colony_id) {redirect('dashboard', 'refresh');}

        $this->form_validation->set_rules('species', $this->lang->line('Species'), 'trim|required');
        $this->form_validation->set_rules('apiary', $this->lang->line('Apiary'), 'trim|required');
        $this->form_validation->set_rules('phase', $this->lang->line('Phase'), 'trim|required');   
        $this->form_validation->set_rules('total_colony', $this->lang->line('Total'), 'trim|required');         
        $this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        //--->  Validation of the form
        if ($this->form_validation->run() == TRUE) {
            // true case            
            $data = array(
                'apiary_id' => $this->input->post('apiary'),               
                'total_colony' => $this->input->post('total_colony'),
                'species_id' => $this->input->post('species'),
                'phase_id' => $this->input->post('phase'),
                'remark' => $this->input->post('remark'),
                'updated_by' => $this->session->user_id,  
            );
            
            $update = $this->model_colony->update($data, $colony_id);

            if($update == true) {
                //$msg_error = $this->lang->line('Successfully updated'); 
                //$this->session->set_flashdata('success', $msg_error);
                redirect('colony/update/'.$colony_id."?tab=colony", 'refresh');
            } else {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('colony/update/'.$colony_id, 'refresh');}
        }

        //--> We are in edit of the form, preparation of the drop down list
        //    and reading of the colony data

        $this->data['phase'] = $this->model_phase->getActivePhase(); 
        $this->data['species'] = $this->model_species->getActiveSpecies();
        $this->data['apiary'] = $this->model_apiary->getActiveApiaryData();              
        $this->data['document_type'] = $this->model_document_type->getActiveDocumentType();
        $colony_data = $this->model_colony->getColonyData($colony_id);
        $this->data['colony_data'] = $colony_data;
        $this->render_template('colony/edit', $this->data); 
    
	}


    
    //--> It removes the data from the database
    //    and it returns the response into the json format
    
	public function remove()
	{
        if(!in_array('deleteColony', $this->permission)) {
            redirect('dashboard', 'refresh');}
        
         $colony_id = $this->input->post('colony_id');

        $response = '';
        $response = array();

            if($colony_id) {
            $delete = $this->model_colony->remove($colony_id);
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



    
    //--> It fetches the colony data from the colony table 
    //    This function is called from the datatable ajax function
   
    public function fetchColonyBeekeeper($id)
    {
        $result = array('data' => array());

        $data = $this->model_colony->getColonyBeekeeper($id);   

        foreach ($data as $key => $value) 
        {

            $phase_data = $this->model_phase->getPhaseData($value['phase_id']);       
            $species_data = $this->model_species->getBeeTypeData($value['species_id']);
            $species_data = $this->model_species->getSpeciesData($value['species_id']);

            $buttons = '';   

            if(in_array('updateColony', $this->permission)) {
                $buttons .= '<a href="'.base_url('colony/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';} 

            if(in_array('deleteColony', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeColony('.$value['id'].')" data-toggle="modal" data-target="#removeColonyModal"><i class="ph ph-trash"></i></button>';}  

            if(in_array('viewColony', $this->permission)) {
                $buttons .= '<a href="'.base_url('report0C/REP0C/'.$value['id']).'" target="_blank" class="btn-dt btn-dt-print" title="Print"><i class="ph ph-printer"></i></a>';}      
                
            
            $result['data'][$key] = array(
                $value['colony_no'],
                $value['total_colony'],
                $species_data['name'],
                $value['area_size'],
                $phase_data['name'],
                $species_data['name'],
                $value['date_begin'],
                $value['date_end'],
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }




    
    //-------------------------------------   DOCUMENT ------------------------------------------------------

   
    //--> It fetches the document data from the document table 
    //    This function is called from the datatable ajax function
    
    public function fetchColonyDocument($id)
    {
        $result = array('data' => array());

        $data = $this->model_colony->getColonyDocument($id);   

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
                $document_type,
                $doc_link,
                $value['doc_size'],
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }


  
    //    This function is invoked from another function to upload the documents into the assets folder
    //    of the apiary
    
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

        if ( ! $this->upload->do_upload('colony_document')){
            $msg_error = $this->lang->line('This type of document is not allowed or the document is too large.'); 
            $this->session->set_flashdata('warning', $msg_error);
            redirect('colony/update/'.$this->session->colony_id."?tab=document", 'refresh');
            }
        else
            {
            //---> Create the document in the table document

            $data = array(
                'beekeeper_id' => $this->session->beekeeper_id, 
                'colony_id' => $this->session->colony_id, 
                'doc_size' => $this->upload->data('file_size'),
                'doc_type' => $this->upload->data('file_type'),
                'doc_name' => $this->upload->data('file_name'),
                'document_type_id' => $this->input->post('document_type'), 
                'updated_by' => $this->session->user_id,       
            );

            $create = $this->model_colony->createDocument($data);

            if($create == true) {
                //--->  Upload the document
                $data = array('upload_data' => $this->upload->data());
                redirect('colony/update/'.$this->session->colony_id."?tab=document", 'refresh');
            } else {
                $msg_error = $this->lang->line('Error occurred'); 
                $this->session->set_flashdata('error', $msg_error);
                redirect('colony/', 'refresh');}

            
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
            $document_data = $this->model_colony->getDocument($document_id);
            $doc_link = '/upload/documents/'.$document_data['directory'].'/'.$document_data['doc_name'];
            unlink(FCPATH . $doc_link);
            //--> Delete the document in the document table
            $delete = $this->model_colony->removeDocument($document_id);
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