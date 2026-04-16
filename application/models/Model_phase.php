<?php 

class Model_phase extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	public function getActivePhase()
	{
		$sql = "SELECT * FROM phase WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the data of the table
	public function getPhaseData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM phase WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM phase";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('phase', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('phase', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('phase');
			return ($delete == true) ? true : false;
		}
	}

	//---> Validate if the phase is used in table Colony
	public function checkIntegrity($id)
	{
		$sql = "SELECT * FROM colony WHERE phase_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->num_rows();
		
	}

}