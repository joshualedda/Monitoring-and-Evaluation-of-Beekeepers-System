<?php 

class Model_byproduct extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	public function getByproduct()
	{
		$sql = "SELECT * FROM byproduct WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the byproduct data
	public function getByproductData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM byproduct WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM byproduct";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('byproduct', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('byproduct', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('byproduct');
			return ($delete == true) ? true : false;
		}
	}

	// //---> Validate if the status is used in table Colony
	// public function checkIntegrity($id)
	// {
	// 	$sql = "SELECT * FROM colony WHERE status_id = ?";
	// 	$query = $this->db->query($sql, array($id));
	// 	return $query->num_rows();
		
	// }

}