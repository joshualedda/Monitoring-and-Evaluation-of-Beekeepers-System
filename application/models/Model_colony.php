<?php 

class Model_colony extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get the data
	public function getColonyData($id = null)
	{
		if($id) {
			$sql = "SELECT colony.*,beekeeper_register_id,directory,
			               location,beekeeper_name,species.name as 'species_name',
			               phase.name as 'phase_name' 
			FROM colony 
			     JOIN apiary ON colony.apiary_id = apiary.id
			     JOIN beekeeper ON apiary.beekeeper_id = beekeeper.id			     			 
				 JOIN species ON colony.species_id = species.id
				 JOIN phase ON colony.phase_id = phase.id
			WHERE colony.id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT colony.*,beekeeper_register_id,directory,
			               location,beekeeper_name,species.name as 'species_name',
			               phase.name as 'phase_name'  
			FROM colony 
			     JOIN apiary ON colony.apiary_id = apiary.id	
			     JOIN beekeeper ON apiary.beekeeper_id = beekeeper.id			     			 
				 JOIN species ON colony.species_id = species.id
				 JOIN phase ON colony.phase_id = phase.id
			ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getColonyDataByApiary($id = null)
	{
		if($id) {
			$sql = "SELECT colony.*,beekeeper_register_id,directory,
			               location,beekeeper_name,species.name as 'species_name',
			               phase.name as 'phase_name' 
			FROM apiary 
			     JOIN colony ON colony.apiary_id = apiary.id
			     JOIN beekeeper ON apiary.beekeeper_id = beekeeper.id			     			 
				 JOIN species ON colony.species_id = species.id
				 JOIN phase ON colony.phase_id = phase.id
			WHERE apiary.id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}

		$sql = "SELECT colony.*,beekeeper_register_id,directory,
			               location,beekeeper_name,species.name as 'species_name',
			               phase.name as 'phase_name'  
			FROM colony 
			     JOIN apiary ON colony.apiary_id = apiary.id	
			     JOIN beekeeper ON apiary.beekeeper_id = beekeeper.id			     			 
				 JOIN species ON colony.species_id = species.id
				 JOIN phase ON colony.phase_id = phase.id
			ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}

	public function getActiveColonyData()
	{
		$sql = "SELECT * FROM colony ORDER BY species_id DESC";
		$query = $this->db->query($sql, array());
		return $query->result_array();
	}

	public function create($data)
	{
		//---> The id is returned to the controller so that the update form
		//     of colony can be opened to continue encoding the datas
		if($data) {
			$insert = $this->db->insert('colony', $data);
			$insert_id = $this->db->insert_id();
			return ($insert == true) ? $insert_id : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('colony', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			//Get the directory of the documents from the beekeeper table
			// $sql = "SELECT directory FROM beekeeper join apiary on apiary.beekeeper_id=beekeeper.id where apiary.id = ?";
			// $query = $this->db->query($sql, array($id));
			// $row = $query->row();

			// if (isset($row)) {$directory = $row->directory;}			
			// $path = "./upload/documents/".$directory;

			// // Delete all the documents inside the directory
			// // We can delete a directory with rmdir only if it's empty
			// $dir = opendir($path);
		 //    while(false !== ( $file = readdir($dir)) ) {
		 //        if (( $file != '.' ) && ( $file != '..' )) {
		 //            $full = $path . '/' . $file;
		 //            if ( is_dir($full) ) {rrmdir($full);}
		 //            else {unlink($full);}
		 //        }
		 //    }
		 //    closedir($dir);
		 //    rmdir($path);

			//Remove the tables attached to beekeeper
			//colony - production - document - inquiry 
			
			$this->db->where('colony_id', $id);
			$delete = $this->db->delete('production');
			$this->db->where('colony_id', $id);		
			$delete = $this->db->delete('document');		

			//delete the beekeeper
			$this->db->where('id', $id);
			$delete = $this->db->delete('colony');
		    return ($delete == true) ? true : false;

		}
	}

	public function countTotalColony()
	{
		$sql = "SELECT * FROM colony";
		$query = $this->db->query($sql, array());
		return $query->num_rows();
	}


	public function countTotalColonyByProvince($province_id)
	{
		$sql = "SELECT * FROM colony
		LEFT JOIN apiary ON colony.apiary_id = apiary.id
		WHERE apiary.province_id = ?";
		$query = $this->db->query($sql, array($province_id));
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

	public function getColonyBeekeeper($id = null)
	{
		$sql = "SELECT * FROM colony WHERE beekeeper_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
		
	}

	public function getColonyDocument($colony_id)
	{
		
		//only document type related to colony (2=colony 3=association 4=activity 5=environment)

		$sql = "SELECT document.*,name,directory
		FROM document 
			LEFT JOIN document_type ON document.document_type_id = document_type.id
			JOIN beekeeper ON document.beekeeper_id = beekeeper.id			
		WHERE colony_id = ?";
		$query = $this->db->query($sql, array($colony_id));
		return $query->result_array();


	}

	//---> Validate if the colony have some documents attached
	public function checkIntegrity($id)
	{
		$sql = "SELECT * FROM document WHERE colony_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->num_rows();
		
	}

}