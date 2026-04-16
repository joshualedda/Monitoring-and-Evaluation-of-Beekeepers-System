<?php 

class Model_species extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	public function getActiveSpecies()
	{
		$sql = "SELECT * FROM species WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the data of the table
	public function getSpeciesData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM species WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM species";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('species', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('species', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('species');
			return ($delete == true) ? true : false;
		}
	}

	//---> Validate if the species is used in table Beekeeper
	public function checkIntegrity($id)
	{
		// select with the wildcard %.  It is possible to have more
		// than one species in beekeeper table.   In this case, the information
		// will appear between bracket ["1"].  The search will be
		// SELECT * FROM beekeeper WHERE species_id LIKE '%["1"]%'  
		$sql = "SELECT * FROM colony WHERE species_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->num_rows();
		
	}
}