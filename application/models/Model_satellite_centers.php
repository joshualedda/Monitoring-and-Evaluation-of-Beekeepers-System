<?php 

class Model_satellite_centers extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getSatelliteCentersData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM satellite_centers WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT sc.*, r.regDesc as region_name, p.provDesc as province_name, m.citymunDesc as municipality_name, b.brgyDesc as barangay_name 
                FROM satellite_centers sc
                LEFT JOIN region r ON sc.region_id = r.region_id
                LEFT JOIN province p ON sc.province_id = p.province_id
                LEFT JOIN municipality m ON sc.municipality_id = m.municipality_id
                LEFT JOIN barangay b ON sc.barangay_id = b.barangay_id
                ORDER BY sc.id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('satellite_centers', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('satellite_centers', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('satellite_centers');
			return ($delete == true) ? true : false;
		}
	}

}
