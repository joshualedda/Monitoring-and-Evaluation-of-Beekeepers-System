<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Monitoring';

		$this->load->model('model_monitoring');
		$this->load->model('model_apiary');
	}

	public function index()
	{
        if(!in_array('viewMonitoring', $this->permission) && (!isset($_SESSION['profile_id']) || $_SESSION['profile_id'] != 2)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('monitoring/index', $this->data);	
	}

	public function fetchMonitoringData()
	{
		$result = array('data' => array());
        
        $can_update = in_array('updateMonitoring', $this->permission) || (isset($_SESSION['profile_id']) && $_SESSION['profile_id'] == 2);
        $can_delete = in_array('deleteMonitoring', $this->permission) || (isset($_SESSION['profile_id']) && $_SESSION['profile_id'] == 2);

		$data = $this->model_monitoring->getMonitoringData();        

		foreach ($data as $key => $value) {
            $buttons = '';

            if($can_update) {
                $buttons .= '<a href="'.base_url('monitoring/update/'.$value['id']).'" class="btn-dt btn-dt-edit" title="Edit"><i class="ph ph-pencil-simple"></i></a>';
            }

            if($can_delete) { 
                $buttons .= ' <button type="button" class="btn-dt btn-dt-delete" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="ph ph-trash"></i></button>';
            }

            $action_badge = '<span class="badge bg-secondary">'.ucfirst($value['action']).'</span>';
            if($value['action'] == 'alert') $action_badge = '<span class="badge bg-danger">Alert</span>';
            if($value['action'] == 'harvest') $action_badge = '<span class="badge bg-success">Harvest</span>';
            if($value['action'] == 'treat') $action_badge = '<span class="badge bg-warning">Treat</span>';

            $m_date = !empty($value['monitoring_date']) ? date('M d, Y', strtotime($value['monitoring_date'])) : date('M d, Y', strtotime($value['created_at']));

			$result['data'][$key] = array(
				$value['apiary_name'],
				$m_date,
                $action_badge,
				$value['observation'],
				$buttons
			);
		}

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($result));
	}

	public function create()
	{
		if(!in_array('createMonitoring', $this->permission) && (!isset($_SESSION['profile_id']) || $_SESSION['profile_id'] != 2)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('apiary', 'Apiary', 'trim|required');
		$this->form_validation->set_rules('action', 'Action', 'trim|required');
		$this->form_validation->set_rules('monitoring_date', 'Monitoring Date', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'apiary_id' => $this->input->post('apiary'),
                'monitoring_date' => $this->input->post('monitoring_date'),
                'observation' => $this->input->post('observation'),
                'report' => $this->input->post('report'),
                'action' => $this->input->post('action')
            );

            $create = $this->model_monitoring->create($data);

            if($create) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('monitoring/', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('monitoring/create', 'refresh');
            }
        }

        $this->data['apiaries'] = $this->model_apiary->getActiveApiaryData();
		$this->render_template('monitoring/create', $this->data);
	}

	public function update($id)
	{      
		if(!in_array('updateMonitoring', $this->permission) && (!isset($_SESSION['profile_id']) || $_SESSION['profile_id'] != 2)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) { redirect('dashboard', 'refresh'); }

		$this->form_validation->set_rules('apiary', 'Apiary', 'trim|required');
		$this->form_validation->set_rules('action', 'Action', 'trim|required');
		$this->form_validation->set_rules('monitoring_date', 'Monitoring Date', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="alert alert-warning">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'apiary_id' => $this->input->post('apiary'),
                'monitoring_date' => $this->input->post('monitoring_date'),
                'observation' => $this->input->post('observation'),
                'report' => $this->input->post('report'),
                'action' => $this->input->post('action')
            );

            $update = $this->model_monitoring->update($data, $id);

            if($update) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('monitoring/', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('monitoring/update/'.$id, 'refresh');
            }
        }

        $this->data['monitoring_data'] = $this->model_monitoring->getMonitoringData($id);
        $this->data['apiaries'] = $this->model_apiary->getActiveApiaryData();
        $this->render_template('monitoring/edit', $this->data); 
	}

	public function remove()
	{
		if(!in_array('deleteMonitoring', $this->permission) && (!isset($_SESSION['profile_id']) || $_SESSION['profile_id'] != 2)) {
            redirect('dashboard', 'refresh');
        }
		
		$id = $this->input->post('monitoring_id');
		$response = array();

		if($id) {
			$delete = $this->model_monitoring->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";
			} else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the information";
			}
		} else {
			$response['success'] = false;
			$response['messages'] = "Refesh the page again!!";
		}

		echo json_encode($response);
	}

    public function get_apiary_logs($id)
    {
        if(!$id) return;
        $logs = $this->model_monitoring->getMonitoringByApiary($id);
        
        foreach($logs as &$l) {
            $l['date_formatted'] = !empty($l['monitoring_date']) ? date('M d, Y', strtotime($l['monitoring_date'])) : date('M d, Y', strtotime($l['created_at']));
            $l['action_title'] = ucfirst($l['action']);
        }

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($logs));
    }
}
