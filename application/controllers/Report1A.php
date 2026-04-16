<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

// Print of a colony with all the information attached

class Report1A extends Admin_Controller 
{	 
	public function __construct()
	{
		
		parent::__construct();

		$this->data['page_title'] = $this->lang->line('Report');
		
	}


	public function REP1A($apiary_id) {	

		
	// Orientation (Landscape or Portrait, format, character, keepmargin, )
	// Orientation is not working here but works in AddPage('L')
	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	
	// Set some basic 
	$pdf->SetHeaderMargin(13);
	$pdf->SetTopMargin(23);
	$pdf->setFooterMargin(20);
	$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
	$pdf->SetDisplayMode('real', 'default');

	// Create a session variable to use the title in the header of tcpdf (library tcpdf / Pdf.php)
	$this->session->set_flashdata('report_code', 'REP1A');
	
	// set font for the report
	$pdf->SetFont('dejavusans', '', 8);


	// Generate HTML table data from MySQL 		

	$template = array (
              'table_open'          => '<table border="0" cellpadding="4" cellspacing="0">',
              'heading_row_start'   => '<tr bgcolor="rgb(235,235,235)">',
              'heading_row_end'     => '</tr>',
              'heading_cell_start'  => '',
              'heading_cell_end'    => '',
              'row_start'           => '<tr>',
              'row_end'             => '</tr>',
              'cell_start'          => '<td>',
              'cell_end'            => '</td>',
              'row_alt_start'       => '<tr>',
              'row_alt_end'         => '</tr>',
              'cell_alt_start'      => '<td>',
              'cell_alt_end'        => '</td>',
              'table_close'         => '</table>'
              );

	$this->table->set_template($template);

	// Get the colony information
	//$REP1A = $this->model_apiary->getApiaryData($apiary_id);
	$REP1A = $this->model_report->get_REP1A($apiary_id);
		foreach($REP1A as $rs):

		$cell1 = array('data' => '<strong>'.$this->lang->line('Apiary').': '.$rs->location.' </strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');
		$this->table->add_row($cell1);
	//}		


	//get colony
	//foreach($REP1A as $rs):
			  $cell1 = array('data' => ' Bee Keeper: '.$rs->beekeeper_name, 'width' => '45%');	
			   $cell2 = array('data' => $this->lang->line('Address').':&nbsp;&nbsp;'.$rs->address, 'width' => '45%');
			
			 $this->table->add_row($cell1,$cell2);		 

			 $cell1 = array('data' => ' Total Colony: '.$rs->total_colony, 'width' => '100%');	
			 $this->table->add_row($cell1);		 
			 $cell2 = array('data' => ' Remarks: '.$rs->remark, 'width' => '100%');
			 $this->table->add_row($cell2);

			 $cell1 = array('data' => '', 'width' => '7%');
			 $cell2 = array('data' => $this->lang->line('Species').':&nbsp;&nbsp;'.$rs->name, 'width' => '45%');
			 $cell3 = array('data' => $this->lang->line('Phase').':&nbsp;&nbsp;'.$rs->phase_name, 'width' => '45%');			 		
			 $this->table->add_row($cell1, $cell2, $cell3);

		/*	 $cell1 = array('data' => '', 'width' => '7%');
			 $cell2 = array('data' => $this->lang->line('Bee Type').':&nbsp;&nbsp;'.$rs->bee_type_name, 'width' => '31%');
			 $cell3 = array('data' => $this->lang->line('Status').':&nbsp;&nbsp;'.$rs->status_name, 'width' => '31%');
			 $cell4 = array('data' => $this->lang->line('Phase').':&nbsp;&nbsp;'.$rs->phase_name, 'width' => '31%');
			 $this->table->add_row($cell1, $cell2, $cell3, $cell4);

			 $cell1 = array('data' => '', 'width' => '7%');
			 $cell2 = array('data' => $this->lang->line('Date begin').':&nbsp;&nbsp;'.$rs->date_begin, 'width' => '31%');
			 $cell3 = array('data' => $this->lang->line('Date end').':&nbsp;&nbsp;'.$rs->date_end, 'width' => '31%');
			 $this->table->add_row($cell1, $cell2, $cell3);

			 $cell1 = array('data' => '', 'width' => '7%');
			 $cell2 = array('data' => $this->lang->line('Province').':&nbsp;&nbsp;'.$rs->province_name, 'width' => '31%');
			 $cell3 = array('data' => $this->lang->line('Municipality').':&nbsp;&nbsp;'.$rs->municipality_name, 'width' => '62%');
			 $this->table->add_row($cell1, $cell2, $cell3);	

			 $cell1 = array('data' => '', 'width' => '7%');
			 $cell2 = array('data' => $this->lang->line('Remark').':&nbsp;&nbsp;'.$rs->remark, 'width' => '93%');
			 $this->table->add_row($cell1, $cell2);	

			// $beekeeper_id = $rs->beekeeper_id;
*/
			endforeach;	

/*
	// Get the colony information

	$cell1 = array('data' => '');	
	$this->table->add_row($cell1);
	$cell1 = array('data' => '<strong>'.$this->lang->line('Beekeeper').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
	$this->table->add_row($cell1);	
		
	$REP0B = $this->model_report->get_REP0B($beekeeper_id);		

	foreach ($REP0B as $rs):
			$origin_beekeeper = json_decode($rs->origin_id);
			$origin_to_print = '';
			// Get the content of each origin for the beekeeper
			foreach($origin_beekeeper as $key=>$value){
				$origin_data = $this->model_origin->getNationalityData($origin_beekeeper[$key]);
				$origin_to_print = $origin_to_print.' '.$origin_data['name'];}			
			
			$cell1 = array('data' => '<strong>'.$this->lang->line('Beekeeper Name').':&nbsp;&nbsp;</strong>'.$rs->beekeeper_name, 'width' => '50%');
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Register Id').':&nbsp;&nbsp;</strong>'.$rs->beekeeper_register_id, 'width' => '50%');	
			$cell2 = array('data' => '<strong>'.$this->lang->line('Active').':&nbsp;&nbsp;</strong>'.$this->lang->line(''.$rs->active.''), 'width' => '25%');
			$cell3 = array('data' => '<strong>'.$this->lang->line('Rating').':&nbsp;&nbsp;</strong>'.$rs->rating_name, 'width' => '25%');				
			$this->table->add_row($cell1, $cell2, $cell3);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Association').':&nbsp;&nbsp;</strong>'.$rs->association_name, 'width' => '50%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Nationality').':&nbsp;&nbsp;</strong>'.$origin_to_print, 'width' => '50%');
			$this->table->add_row($cell1, $cell2);

			$cell1 = array('data' => '');	
			$this->table->add_row($cell1);
			$cell1 = array('data' => '<strong>'.$this->lang->line('Location').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Address').':&nbsp;&nbsp;</strong>'.$rs->address, 'width' => '100%');
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Province').':&nbsp;&nbsp;</strong>'.$rs->province_name, 'width' => '33%');	
			$cell2 = array('data' => '<strong>'.$this->lang->line('Municipality').':&nbsp;&nbsp;</strong>'.$rs->municipality_name, 'width' => '33%');
			$cell3 = array('data' => '<strong>'.$this->lang->line('City').':&nbsp;&nbsp;</strong>'.$rs->city_name, 'width' => '34%');				
			$this->table->add_row($cell1, $cell2, $cell3);

			$cell1 = array('data' => '<strong>'.$this->lang->line('District').':&nbsp;&nbsp;</strong>'.$rs->district, 'width' => '33%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Postal Box').':&nbsp;&nbsp;</strong>'.$rs->postal_box, 'width' => '33%');	
			$cell3 = array('data' => '<strong>'.$this->lang->line('Postal Code').':&nbsp;&nbsp;</strong>'.$rs->postal_code, 'width' => '33%');				
			$this->table->add_row($cell1, $cell2, $cell3);

			$cell1 = array('data' => '');	
			$this->table->add_row($cell1);
			$cell1 = array('data' => '<strong>'.$this->lang->line('Contact').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Email').':&nbsp;&nbsp;</strong>'.$rs->email, 'width' => '50%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Website').':&nbsp;&nbsp;</strong>'.$rs->website, 'width' => '50%');
			$this->table->add_row($cell1, $cell2);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Director Name').':&nbsp;&nbsp;</strong>'.$rs->director_name, 'width' => '50%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Director Register Id').':&nbsp;&nbsp;</strong>'.$rs->director_register_id, 'width' => '50%');
			$this->table->add_row($cell1, $cell2);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Phone').':&nbsp;&nbsp;</strong>'.$rs->phone, 'width' => '50%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Mobile').':&nbsp;&nbsp;</strong>'.$rs->mobile, 'width' => '50%');
			$this->table->add_row($cell1, $cell2);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Remark').':&nbsp;&nbsp;</strong>'.$rs->remark, 'width' => '100%');
			$this->table->add_row($cell1);				

			endforeach;

	
	//--> Document

	$cell1 = array('data' => '');	
	$this->table->add_row($cell1);
	$cell1 = array('data' => '<strong>'.$this->lang->line('Document').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
	$this->table->add_row($cell1);

	$document = $this->model_report->get_REP0B_document($beekeeper_id);

	if ($document == null) {
	   // If not data found, we indicate in the report first line
	   $this->table->add_row($this->lang->line('No data found'));        
	   }
	else {	

		$cell1 = array('data' => '<strong>'.$this->lang->line('Type').'</strong>', 'width' => '22%');
		$cell2 = array('data' => '<strong>'.$this->lang->line('Name').'</strong>', 'width' => '38%');
		$cell3 = array('data' => '<strong>'.$this->lang->line('Size').'</strong>', 'width' => '18%');
		$cell4 = array('data' => '<strong>'.$this->lang->line('Colony').'</strong>', 'width' => '22%');		
		$this->table->add_row($cell1, $cell2, $cell3, $cell4);	

		foreach($document as $rs):		

			$cell1 = array('data' => $rs->document_type_name, 'width' => '22%');
			$cell2 = array('data' => $rs->doc_name, 'width' => '38%');
			$cell3 = array('data' => $rs->doc_size, 'width' => '18%');
			$cell4 = array('data' => $rs->colony_no, 'width' => '22%');
			$this->table->add_row($cell1, $cell2, $cell3, $cell4);
		 
		 	endforeach;
		} 		 	 	
	
*/
	// Generate the table in html format using the table class of codeigniter
	$html = $this->table->generate();		
	
	// Add a page and change the orientation
	$pdf->AddPage('P');
	
	// Output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// Reset pointer to the last page
	$pdf->lastPage();

	ob_end_clean();

	// Close and output PDF document
	// (I - Inline, D - Download, F - File)
	$pdf->Output('Report1A.pdf', 'I');	
	
	
}	
}