<?php 

class Model_barangay extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get the active barangay data
	public function getActiveBarangay()
	{
		$sql = "SELECT * FROM barangay WHERE active = ? ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	public function getBarangayDataByLguId($lgu_id)
	{
		$sql = "SELECT * FROM barangay WHERE lgu_id = $lgu_id ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	//--> Get the data
	public function getBarangayData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM barangay where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM barangay";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getBarangayDataByLgu($lgu_id)
	{
		$this->db->where('lgu_id',$lgu_id);
		$this->db->order_by('name','ASC');
		$query=$this->db->get('barangay');
		$output='<option value="" hidden selected disabled>Select Barangay</option>';
		foreach ($query->result() as $row)
		{
			$output .='<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		return $output;
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('barangay', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('barangay', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('barangay');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalBarangay()
	{
		$sql = "SELECT * FROM barangay WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	//---> Validate if the barangay is used in table Beekeeper or Colony
	public function checkIntegrity($id)
	{
		
		$num_rows = 0;

		// select with the wildcard %.  It is possible to have more
		// than one municipality in colony table.   In this case, the information
		// will appear between bracket ex:["1"].  The search will be
		// SELECT * FROM colony WHERE municipality_id LIKE '%["1"]%'  
		$sql = "SELECT * FROM beekeeper WHERE barangay_id = ?";
		$query = $this->db->query($sql, array($id));
		$num_rows = $num_rows + $query->num_rows();

		$sql = "SELECT * FROM association WHERE barangay_id = ?";
		$query = $this->db->query($sql, array($id));
		$num_rows = $num_rows + $query->num_rows();

		$sql = "SELECT * FROM apiary WHERE barangay_id = ?";
		$query = $this->db->query($sql, array($id));
		$num_rows = $num_rows + $query->num_rows();

		return $num_rows;
		
	}

}