<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gmaps extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
        $this->load->model('model_apiary');
        $this->load->model('model_beekeeper');
	}


    /**
     * Modernized Map View using Leaflet & OpenStreetMap
     */
	public function index() 
    {
        if(!in_array('viewApiary', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Apiary Locations Map';
        $apiary_list = $this->model_apiary->getApiaryData();
        
        $processed_apiaries = array();
        foreach($apiary_list as $apiary) {
            if(!empty($apiary['coordinate'])) {
                $coords = explode(',', $apiary['coordinate']);
                if(count($coords) == 2) {
                    $beekeeper = $this->model_beekeeper->getBeekeeperData($apiary['beekeeper_id']);
                    
                    // Count colonies for this apiary
                    $this->db->where('apiary_id', $apiary['id']);
                    $colony_count = $this->db->count_all_results('colony');

                    $processed_apiaries[] = array(
                        'id'        => $apiary['id'],
                        'name'      => $apiary['location'],
                        'beekeeper' => $beekeeper['beekeeper_name'] ?? 'Unknown',
                        'colonies'  => $colony_count,
                        'lat'       => trim($coords[0]),
                        'lng'       => trim($coords[1]),
                        'active'    => (isset($apiary['active']) ? $apiary['active'] : 1)
                    );
                }
            }
        }

        $this->data['apiary_locations'] = $processed_apiaries;
		$this->render_template('map/map_view', $this->data);
	}
	
}