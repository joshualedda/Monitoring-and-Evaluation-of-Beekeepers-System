<?php 

class Model_monitoring extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getMonitoringData($id = null)
	{
		if($id) {
			$sql = "SELECT monitoring.*, apiary.location as apiary_name 
                    FROM monitoring 
                    JOIN apiary ON monitoring.apiary_id = apiary.id 
                    WHERE monitoring.id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT monitoring.*, apiary.location as apiary_name 
                FROM monitoring 
                JOIN apiary ON monitoring.apiary_id = apiary.id 
                ORDER BY monitoring.id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('monitoring', $data);
			$insert_id = $this->db->insert_id();
			return ($insert == true) ? $insert_id : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('monitoring', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('monitoring');
			return ($delete == true) ? true : false;
		}
	}

    public function getMonitoringByApiary($apiary_id)
    {
        $sql = "SELECT * FROM monitoring WHERE apiary_id = ? ORDER BY id DESC";
        $query = $this->db->query($sql, array($apiary_id));
        return $query->result_array();
    }
}
