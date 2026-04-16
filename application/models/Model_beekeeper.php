
<?php 

class Model_beekeeper extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get the data
	public function getBeekeeperData($id = null)
	{
		if($id) {
			$sql = "SELECT beekeeper.*,association_name
			FROM beekeeper 
			LEFT JOIN association ON beekeeper.association_id = association.id
			where beekeeper.id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT beekeeper.*,association_name
			FROM beekeeper 
			LEFT JOIN association ON beekeeper.association_id = association.id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveBeekeeperData()
	{
		$sql = "SELECT * FROM beekeeper WHERE active = ?
		 ORDER BY beekeeper_name ASC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}


	public function getBeekeeperDocument($id)
	{
			$sql = "SELECT document.*,name,directory,location
			FROM document 
			 	 LEFT JOIN document_type ON document.document_type_id = document_type.id
			 	 LEFT JOIN apiary ON document.apiary_id = apiary.id
			 	 LEFT JOIN colony ON document.colony_id = colony.id
			 	 JOIN beekeeper ON document.beekeeper_id = beekeeper.id
			WHERE document.beekeeper_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();

	}


	public function create($data)
	{
		//---> The id is returned to the controller so that the update form
		//     of beekeeper can be opened to continue encoding the datas	
		if($data) {
			$insert = $this->db->insert('beekeeper', $data);
			$insert_id = $this->db->insert_id();
			return ($insert == true) ? $insert_id : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('beekeeper', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		//--> All the information attached to the beekeeper must be deleted

		if($id) {
			// Get the directory of the documents from the beekeeper table
			$sql = "SELECT directory FROM beekeeper where id = ?";
			$query = $this->db->query($sql, array($id));
			$row = $query->row();

			if (isset($row)) {$directory = $row->directory;}			
			$path = "./upload/documents/".$directory;

			// Delete all the documents inside the directory
			// We can delete a directory with rmdir only if it's empty
			$dir = opendir($path);
		    while(false !== ( $file = readdir($dir)) ) {
		        if (( $file != '.' ) && ( $file != '..' )) {
		            $full = $path . '/' . $file;
		            if ( is_dir($full) ) {rrmdir($full);}
		            else {unlink($full);}
		        }
		    }
		    closedir($dir);
		    rmdir($path);

			// Remove the tables attached to beekeeper
			// colony - production - document - inquiry 
			
			$this->db->where('beekeeper_id', $id);
			$delete = $this->db->delete('apiary');
			$this->db->where('beekeeper_id', $id);		
			$delete = $this->db->delete('document');
			$this->db->where('beekeeper_id', $id);		
			$delete = $this->db->delete('inquiry');			

			// delete the beekeeper
			$this->db->where('id', $id);
			$delete = $this->db->delete('beekeeper');
		    return ($delete == true) ? true : false;

		}
	}


	public function countTotalBeekeeper()
	{
		$sql = "SELECT * FROM beekeeper WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function createDocument($data)
	{
		if($data) {
			$insert = $this->db->insert('document', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function removeDocument($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('document');
			return ($delete == true) ? true : false;
		}
	}

	public function getDocument($id = null)
	{
		$sql = "SELECT document.*,directory 
		FROM document
		     JOIN beekeeper ON document.beekeeper_id = beekeeper.id 
		WHERE document.id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();

	}


}