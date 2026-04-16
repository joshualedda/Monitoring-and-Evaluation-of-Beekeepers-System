<?php 

class Model_product extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	public function getActiveProduct()
	{
		$sql = "SELECT * FROM product WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the product data
	public function getProductData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM product WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM product";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('product', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('product', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('product');
			return ($delete == true) ? true : false;
		}
	}

	//---> Validate if the product is used in table Colony
	public function checkIntegrity($id)
	{
		$sql = "SELECT * FROM production WHERE product_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->num_rows();
		
	}

}