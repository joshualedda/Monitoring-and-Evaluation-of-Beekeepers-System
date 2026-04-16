<?php 

class Model_gender extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	public function getActiveGender()
	{
		$sql = "SELECT * FROM gender WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the data of the table
	public function getGenderData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM gender WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM gender";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('gender', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('gender', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('gender');
			return ($delete == true) ? true : false;
		}
	}

	//---> Validate if the gender is used in table beekeeper
	public function checkIntegrity($id)
	{
		$sql = "SELECT * FROM beekeeper WHERE gender_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->num_rows();
		
	}

}