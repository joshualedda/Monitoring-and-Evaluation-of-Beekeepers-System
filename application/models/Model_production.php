<?php 

class Model_production extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	public function getProductionData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM production where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM production";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getProductionBeekeeper($id = null)
	{
		$sql = "SELECT * FROM production WHERE colony_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('production', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('production', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('production');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProduction($year)
	{
		$sql = "SELECT SUM(total_production) AS total_production
		FROM production
		WHERE year = ?";
		$query = $this->db->query($sql, array($year));
		return $query->row_array();
	}



}