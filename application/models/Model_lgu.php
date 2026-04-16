<?php 

class Model_lgu extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get the active lgu data
	public function getActiveLgu()
	{
		$sql = "SELECT lgu.*,province.name as 'province_name' FROM lgu join province on lgu.province_id=province.id WHERE lgu.active = ? ORDER BY lgu.name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	public function getLguDataByProvinceId($province_id)
	{
		$sql = "SELECT * FROM lgu WHERE province_id = $province_id ORDER BY name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	//--> Get the data
	public function getLguData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM lgu where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM lgu";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getLguDataByProvince($province_id)
	{
		$this->db->where('province_id',$province_id);
		$this->db->order_by('name','ASC');
		$query=$this->db->get('lgu');
		$output='<option value="" hidden selected disabled>Select LGU</option>';
		foreach ($query->result() as $row)
		{
			$output .='<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		return $output;
	}
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('lgu', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('lgu', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('lgu');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalLgu()
	{
		$sql = "SELECT * FROM lgu WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	//---> Validate if the lgu is used in table Beekeeper or Colony
	public function checkIntegrity($id)
	{
		
		$num_rows = 0;

		// select with the wildcard %.  It is possible to have more
		// than one municipality in colony table.   In this case, the information
		// will appear between bracket ex:["1"].  The search will be
		// SELECT * FROM colony WHERE municipality_id LIKE '%["1"]%'  

		$sql = "SELECT * FROM barangay WHERE lgu_id = ?";
		$query = $this->db->query($sql, array($id));
		$num_rows = $num_rows + $query->num_rows();
		return $num_rows;
		
	}

}