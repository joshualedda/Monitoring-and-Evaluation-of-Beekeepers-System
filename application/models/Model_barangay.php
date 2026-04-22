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
		$sql = "SELECT *, brgyDesc as name FROM barangay ORDER BY brgyDesc ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getBarangayDataByMunicipalityId($municipality_id)
	{
        // Get citymunCode from municipality_id first
        $this->load->model('model_municipality');
        $municipality = $this->model_municipality->getMunicipalityData($municipality_id);
        $citymunCode = $municipality['citymunCode'] ?? '';

		$this->db->where('citymunCode', $citymunCode);
		$this->db->order_by('brgyDesc','ASC');
		$query=$this->db->get('barangay');
		$output='<option value="" hidden selected disabled>Select Barangay</option>';
		foreach ($query->result() as $row)
		{
			$output .='<option value="'.$row->barangay_id.'">'.$row->brgyDesc.'</option>';
		}
		return $output;
	}

	public function getBarangayByMunicipalityId($municipality_id)
	{
        $this->load->model('model_municipality');
        $municipality = $this->model_municipality->getMunicipalityData($municipality_id);
        $citymunCode = $municipality['citymunCode'] ?? '';
        
		$sql = "SELECT *, brgyDesc as name FROM barangay WHERE citymunCode = ? ORDER BY brgyDesc ASC";
		$query = $this->db->query($sql, array($citymunCode));
		return $query->result_array();
	}

	//--> Get the data
	public function getBarangayData($id = null)
	{
		if($id) {
			$sql = "SELECT *, brgyDesc as name FROM barangay where barangay_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT *, brgyDesc as name FROM barangay";
		$query = $this->db->query($sql);
		return $query->result_array();
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
			$this->db->where('barangay_id', $id);
			$update = $this->db->update('barangay', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('barangay_id', $id);
			$delete = $this->db->delete('barangay');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalBarangay()
	{
		$sql = "SELECT * FROM barangay";
		$query = $this->db->query($sql);
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