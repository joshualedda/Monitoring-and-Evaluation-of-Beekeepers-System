<?php 

class Model_association extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	
	public function getActiveAssociation()
	{
		$sql = "SELECT * FROM association WHERE active = ? ORDER BY association_name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the data of the table

	public function getAssociationData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM association WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM association";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('association', $data);
			$insert_id = $this->db->insert_id();
			return ($insert == true) ? $insert_id : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('association', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('association');
			return ($delete == true) ? true : false;
		}
	}

	//---> Validate if the property type is used in table Beekeeper

	public function checkIntegrity($id)
	{
		$sql = "SELECT * FROM beekeeper WHERE association_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->num_rows();
		
	}

}