<?php 

class Model_post_category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get active information
	public function getActivePostCategory()
	{
		$sql = "SELECT * FROM post_category WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	//--> Get the post_category data
	public function getPostCategoryData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM post_category WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM post_category";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('post_category', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('post_category', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('post_category');
			return ($delete == true) ? true : false;
		}
	}

	//---> Validate if the post_category is used in table post
	public function checkIntegrity($id)
	{
		$sql = "SELECT * FROM post WHERE post_category_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->num_rows();
		
	}

}