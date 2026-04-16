<?php 

class Model_topography extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	public function getActiveTopography()
	{
		$sql = "SELECT * FROM topography WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the data of the table
	public function getTopographyData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM topography WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM topography";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('topography', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('topography', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('topography');
			return ($delete == true) ? true : false;
		}
	}

	//---> Validate if the topography is used in table beekeeper
	public function checkIntegrity($id)
	{
		$this->db->select('*');
		$this->db->from('apiary');
		$this->db->like('topography_id', $id, 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

}