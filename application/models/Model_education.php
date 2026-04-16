<?php 

class Model_education extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	public function getActiveEducation()
	{
		$sql = "SELECT * FROM education WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the data of the table
	public function getEducationData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM education WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM education";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('education', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('education', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('education');
			return ($delete == true) ? true : false;
		}
	}

	//---> Validate if the education is used in table beekeeper
	public function checkIntegrity($id)
	{
		$sql = "SELECT * FROM beekeeper WHERE education_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->num_rows();
		
	}

}