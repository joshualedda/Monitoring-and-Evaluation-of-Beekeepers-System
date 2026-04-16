<?php 

class Model_user extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	public function getUserData($id = null)
	{
		if($id) {
			$sql = "SELECT user.*,profile.name AS 'profile_name'
			FROM user 
			JOIN profile ON user.profile_id = profile.id
			WHERE user.id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT user.*,profile.name AS 'profile_name'
			FROM user 
			JOIN profile ON user.profile_id = profile.id
			ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	public function getUserProfile($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM user WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			$result = $query->row_array();

			$profile_id = $result['profile_id'];
			$p_sql = "SELECT * FROM profile WHERE id = ?";
			$p_query = $this->db->query($p_sql, array($profile_id));
			$q_result = $p_query->row_array();
			return $q_result;
		}
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('user', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('user', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('user');
			return ($delete == true) ? true : false;
		}
	}

	public function edit($data = array(), $id = null)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('user', $data);		
			
		return ($update == true) ? true : false;	
	}

}