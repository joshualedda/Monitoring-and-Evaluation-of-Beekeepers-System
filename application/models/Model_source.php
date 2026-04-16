<?php 

class Model_source extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	public function getActiveSource()
	{
		$sql = "SELECT * FROM source WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the data of the table
	public function getSourceData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM source WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM source";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('source', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('source', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('source');
			return ($delete == true) ? true : false;
		}
	}

	//---> Validate if the source is used in table beekeeper
	public function checkIntegrity($id)
	{
		$this->db->select('*');
		$this->db->from('apiary');
		$this->db->like('source_id', $id, 'both');
		$query = $this->db->get();
		return $query->num_rows();		
	}

}