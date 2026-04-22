<?php 

class Model_production extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getProductionData($id = null)
	{
		if($id) {
			$sql = "SELECT production.*, CONCAT('Colony ', colony.id, ' (', IFNULL(apiary.location, 'Unknown'), ')') as colony_number, product.name as product_name
			FROM production 
			JOIN colony ON production.colony_id = colony.id
            LEFT JOIN apiary ON colony.apiary_id = apiary.id
            JOIN product ON production.product_id = product.id
			WHERE production.id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT production.*, CONCAT('Colony ', colony.id, ' (', IFNULL(apiary.location, 'Unknown'), ')') as colony_number, product.name as product_name
        FROM production 
        JOIN colony ON production.colony_id = colony.id
        LEFT JOIN apiary ON colony.apiary_id = apiary.id
        JOIN product ON production.product_id = product.id
        ORDER BY production.id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('production', $data);
			$insert_id = $this->db->insert_id();
			return ($insert == true) ? $insert_id : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('production', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('production');
		    return ($delete == true) ? true : false;
		}
	}

	public function countTotalProduction($year)
	{
		$sql = "SELECT COALESCE(SUM(total_production), 0) AS total FROM production WHERE year = ?";
		$query = $this->db->query($sql, array($year));
		$result = $query->row_array();
		return $result['total'] ?? 0;
	}

	public function getProductionColony($colony_id)
	{
		$sql = "SELECT production.*, product.name as product_name
        FROM production 
        JOIN product ON production.product_id = product.id
        WHERE production.colony_id = ?
        ORDER BY production.id DESC";
		$query = $this->db->query($sql, array($colony_id));
		return $query->result_array();
	}

    public function getMonthlyProduction($year)
    {
        $sql = "SELECT month, SUM(total_production) as total 
                FROM production 
                WHERE year = ? 
                GROUP BY month 
                ORDER BY FIELD(month, 'January','February','March','April','May','June','July','August','September','October','November','December')";
        $query = $this->db->query($sql, array($year));
        return $query->result_array();
    }
}