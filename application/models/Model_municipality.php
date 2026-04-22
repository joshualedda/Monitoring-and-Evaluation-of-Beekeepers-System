<?php 

class Model_municipality extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get the active municipality data
	public function getActiveMunicipality()
	{
		$sql = "SELECT municipality.*, municipality.citymunDesc as name FROM municipality ORDER BY citymunDesc ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getMunicipalityDataByProvinceId($province_id)
	{
        // Get provCode from province_id first
        $this->load->model('model_province');
        $province = $this->model_province->getProvinceData($province_id);
        $provCode = $province['provCode'] ?? '';

		$this->db->where('provCode', $provCode);
		$this->db->order_by('citymunDesc','ASC');
		$query=$this->db->get('municipality');
		$output='<option value="" hidden selected disabled>Select Municipality</option>';
		foreach ($query->result() as $row)
		{
			$output .='<option value="'.$row->municipality_id.'">'.$row->citymunDesc.'</option>';
		}
		return $output;
	}

	public function getMunicipalityByProvinceId($province_id)
	{
        $this->load->model('model_province');
        $province = $this->model_province->getProvinceData($province_id);
        $provCode = $province['provCode'] ?? '';
        
		$sql = "SELECT *, citymunDesc as name FROM municipality WHERE provCode = ? ORDER BY citymunDesc ASC";
		$query = $this->db->query($sql, array($provCode));
		return $query->result_array();
	}

	//--> Get the data
	public function getMunicipalityData($id = null)
	{
		if($id) {
			$sql = "SELECT *, citymunDesc as name FROM municipality where municipality_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT *, citymunDesc as name FROM municipality";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('municipality', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('municipality_id', $id);
			$update = $this->db->update('municipality', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('municipality_id', $id);
			$delete = $this->db->delete('municipality');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalMunicipality()
	{
		$sql = "SELECT * FROM municipality";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
