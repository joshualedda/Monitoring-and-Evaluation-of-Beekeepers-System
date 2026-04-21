<?php 

class Model_province extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get the active province data
	public function getActiveProvince()
	{
		$sql = "SELECT province.*, province.provDesc as name, region.regDesc as 'region_name' FROM province join region on province.regCode=region.regCode ORDER BY province.provDesc ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getProvinceDataByRegionId($region_id)
	{
        // Get regCode from region_id first
        $this->load->model('model_region');
        $region = $this->model_region->getRegionData($region_id);
        $regCode = $region['regCode'] ?? '';
        
		$this->db->where('regCode', $regCode);
		$this->db->order_by('provDesc','ASC');
		$query=$this->db->get('province');
		$output='<option value="" hidden selected disabled>Select Province</option>';
		foreach ($query->result() as $row)
		{
			$output .='<option value="'.$row->province_id.'">'.$row->provDesc.'</option>';
		}
		return $output;
	}

	//--> Get the data
	public function getProvinceData($id = null)
	{
		if($id) {
			$sql = "SELECT *, provDesc as name FROM province where province_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT *, provDesc as name FROM province";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('province', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('province_id', $id);
			$update = $this->db->update('province', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('province_id', $id);
			$delete = $this->db->delete('province');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProvince()
	{
		$sql = "SELECT * FROM province";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	//---> Validate if the province is used in table Beekeeper or Colony
	public function checkIntegrity($id)
	{
		
		$num_rows = 0;

        $province = $this->getProvinceData($id);
        if($province) {
            $provCode = $province['provCode'];
            $sql = "SELECT * FROM municipality WHERE provCode = ?";
            $query = $this->db->query($sql, array($provCode));
            $num_rows = $num_rows + $query->num_rows();
        }

		return $num_rows;
		
	}

}