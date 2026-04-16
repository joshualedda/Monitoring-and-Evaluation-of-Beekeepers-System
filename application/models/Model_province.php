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
		$sql = "SELECT province.*, region.name as 'region_name' FROM province join region on province.region_id=region.id WHERE province.active = ? ORDER BY province.name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	public function getProvinceDataByRegionId($region_id)
	{
		$sql = "SELECT * FROM province WHERE region_id = $region_id ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	//--> Get the data
	public function getProvinceData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM province where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM province";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getProvinceDataByRegion($region_id)
	{
		$this->db->where('region_id',$region_id);
		$this->db->order_by('name','ASC');
		$query=$this->db->get('province');
		$output='<option value="" hidden selected disabled>Select Province</option>';
		foreach ($query->result() as $row)
		{
			$output .='<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		return $output;
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
			$this->db->where('id', $id);
			$update = $this->db->update('province', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('province');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProvince()
	{
		$sql = "SELECT * FROM province WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	//---> Validate if the province is used in table Beekeeper or Colony
	public function checkIntegrity($id)
	{
		
		$num_rows = 0;

		// select with the wildcard %.  It is possible to have more
		// than one municipality in colony table.   In this case, the information
		// will appear between bracket ex:["1"].  The search will be
		// SELECT * FROM colony WHERE municipality_id LIKE '%["1"]%'  

		$sql = "SELECT * FROM lgu WHERE province_id = ?";
		$query = $this->db->query($sql, array($id));
		$num_rows = $num_rows + $query->num_rows();
		return $num_rows;
		
	}

}