<?php 

class Model_apiary extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//--> Get the data
	public function getApiaryData($id = null)
	{
		if($id) {
			$sql = "SELECT apiary.*,beekeeper_register_id,directory 
			FROM apiary 
			JOIN beekeeper ON apiary.beekeeper_id = beekeeper.id
			WHERE apiary.id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM apiary ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveApiaryData()
	{
		$sql = "SELECT apiary.*,location,beekeeper_name 
		        FROM apiary 
		        JOIN beekeeper ON apiary.beekeeper_id = beekeeper_id
		        ORDER BY beekeeper_name, location DESC";
		$query = $this->db->query($sql, array());
		return $query->result_array();
	}

	public function create($data)
	{
		//---> The id is returned to the controller so that the update form
		//     of apiary can be opened to continue encoding the datas
		if($data) {
			$insert = $this->db->insert('apiary', $data);
			$insert_id = $this->db->insert_id();
			return ($insert == true) ? $insert_id : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('apiary', $data);
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

		// 	$document_data = $this->model_apiary->getDocumentByApiary($id);
		// 	foreach ($document_data as $key => $value)
		// 	{
         
  //       	if($value['document.id']) {
  //           //--> Get the link of the document for deleting the document on the directory
  //           $document_data = $this->model_apiary->getDocument($value['document.id']);
  //           $doc_link = '/upload/documents/'.$document_data['directory'].'/'.$document_data['doc_name'];
  //           unlink(FCPATH . $doc_link);
  //           //--> Delete the document in the document table
  //           $delete = $this->model_apiary->removeDocument($value['document.id']);
		// 	}
		// }

			//Remove the tables attached to beekeeper
			//colony - production - document - inquiry 
			
			$this->db->where('apiary_id', $id);
			$delete = $this->db->delete('colony');
			$this->db->where('apiary_id', $id);		
			$delete = $this->db->delete('document');		

			//delete the beekeeper
			$this->db->where('id', $id);
			$delete = $this->db->delete('apiary');
		    return ($delete == true) ? true : false;

	}
}

	public function countTotalApiary($year)
	{
		$sql = "SELECT * FROM apiary
		WHERE ? BETWEEN year(date_begin) AND year(date_end)";
		$query = $this->db->query($sql, array($year));
		return $query->num_rows();
	}

/*
	public function countTotalApiaryProvince($map_id)
	{
		$sql = "SELECT * FROM apiary
		LEFT JOIN province ON apiary.province_id = province.id
		WHERE map_id = ?";
		$query = $this->db->query($sql, array($map_id));
		return $query->num_rows();
	}*/

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
	public function getDocumentByApiary($id = null)
	{
		$sql = "SELECT document.*,directory 
		FROM document
		     JOIN beekeeper ON document.beekeeper_id = beekeeper.id 
		WHERE document.apiary_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();

	}
	public function getApiaryBeekeeper($id = null)
	{
		$sql = "SELECT * FROM apiary WHERE beekeeper_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
		
	}

	public function getApiaryDocument($apiary_id)
	{
		
		//only document type related to apiary (2=apiary 3=association 4=activity 5=environment)

		$sql = "SELECT document.*,name,directory
		FROM document 
			LEFT JOIN document_type ON document.document_type_id = document_type.id
			JOIN beekeeper ON document.beekeeper_id = beekeeper.id			
		WHERE apiary_id = ?";
		$query = $this->db->query($sql, array($apiary_id));
		return $query->result_array();


	}

	//---> Validate if the apiary have some documents attached
	public function checkIntegrity($id)
	{
		$num_rows = 0;
		
		$sql = "SELECT * FROM document WHERE apiary_id = ?";
		$query = $this->db->query($sql, array($id));
		$num_rows =$num_rows + $query->num_rows();

		$sql = "SELECT * FROM colony WHERE apiary_id = ?";
		$query = $this->db->query($sql, array($id));
		$num_rows = $num_rows + $query->num_rows();

		return $num_rows;

		
	}

}