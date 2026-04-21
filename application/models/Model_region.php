<?php 

class Model_region extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get the active region data
	public function getActiveRegion()
	{
		$sql = "SELECT *, regDesc as name FROM region ORDER BY regDesc ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getRegionById($id)
	{
		$sql = "SELECT *, regDesc as name FROM region where region_id=?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();		
	}
	//--> Get the data
	public function getRegionData($id = null)
	{
		if($id) {
			$sql = "SELECT *, regDesc as name FROM region where region_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT *, regDesc as name FROM region";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('region', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('region_id', $id);
			$update = $this->db->update('region', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('region_id', $id);
			$delete = $this->db->delete('region');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalRegion()
	{
		$sql = "SELECT * FROM region";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	//---> Validate if the region is used in table Beekeeper, Colony or Inquiry
	
	public function checkIntegrity($id)
	{
		
		$num_rows = 0;

        $region = $this->getRegionData($id);
        if($region) {
            $regCode = $region['regCode'];
            $sql = "SELECT * FROM province WHERE regCode = ?";
            $query = $this->db->query($sql, array($regCode));
            $num_rows = $num_rows + $query->num_rows();
        }

		$sql = "SELECT * FROM user WHERE region_id = ?";
		$query = $this->db->query($sql, array($id));
		$num_rows = $num_rows + $query->num_rows();

		return $num_rows;
		
	}

}