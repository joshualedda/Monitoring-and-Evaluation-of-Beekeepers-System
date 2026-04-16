<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

// Print of a Beekeeper with all the information attached.

class Report0A extends Admin_Controller 
{	 
	public function __construct()
	{
		
		parent::__construct();

		$this->data['page_title'] = $this->lang->line('Report');
		
	}


	public function REP0A($association_id) {	

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
	$this->session->set_flashdata('report_code', 'REP0A');

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

	$cell1 = array('data' => '<strong>'.$this->lang->line('Association').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');
	$this->table->add_row($cell1);		

	// Call to the database
	$REP0A = $this->model_report->get_REP0A($association_id);

	foreach ($REP0A as $rs):
			// $nationality_beekeeper = json_decode($rs->nationality_id);
			// $nationality_to_print = '';
			// // Get the content of each nationality for the beekeeper
			// foreach($nationality_beekeeper as $key=>$value){
			// 	$nationality_data = $this->model_nationality->getNationalityData($nationality_beekeeper[$key]);
			// 	$nationality_to_print = $nationality_to_print.' '.$nationality_data['name'];}			
			
			$cell1 = array('data' => '<strong>'.$this->lang->line('Association Name').':&nbsp;&nbsp;</strong>'.$rs->association_name, 'width' => '50%');
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Focal Person/ President').':&nbsp;&nbsp;</strong>'.$rs->contact_name, 'width' => '50%');	
			$cell2 = array('data' => '<strong>'.$this->lang->line('Active').':&nbsp;&nbsp;</strong>'.$this->lang->line(''.$rs->active.''), 'width' => '25%');			
			$this->table->add_row($cell1, $cell2);

			$cell1 = array('data' => '');	
			$this->table->add_row($cell1);
			$cell1 = array('data' => '<strong>'.$this->lang->line('Location').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Address').':&nbsp;&nbsp;</strong>'.$rs->address, 'width' => '100%');
			$this->table->add_row($cell1);
			$cell1 = array('data' => '<strong>'.$this->lang->line('Region').':&nbsp;&nbsp;</strong>'.$rs->region_name, 'width' => '50%');	
			$cell2 = array('data' => '<strong>'.$this->lang->line('Province').':&nbsp;&nbsp;</strong>'.$rs->province_name, 'width' => '50%');	
			$this->table->add_row($cell1, $cell2);
			$cell1 = array('data' => '<strong>'.$this->lang->line('Lgu').':&nbsp;&nbsp;</strong>'.$rs->lgu_name, 'width' => '50%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Barangay').':&nbsp;&nbsp;</strong>'.$rs->barangay_name, 'width' => '50%');				
			$this->table->add_row($cell1, $cell2);

			$cell1 = array('data' => '');	
			$this->table->add_row($cell1);
			$cell1 = array('data' => '<strong>'.$this->lang->line('Contact').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Email').':&nbsp;&nbsp;</strong>'.$rs->email, 'width' => '50%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Website').':&nbsp;&nbsp;</strong>'.$rs->website, 'width' => '50%');
			$this->table->add_row($cell1, $cell2);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Mobile').':&nbsp;&nbsp;</strong>'.$rs->contact_number	, 'width' => '50%');
			$this->table->add_row($cell1);
			$cell1 = array('data' => '');	
			$this->table->add_row($cell1);
			$cell1 = array('data' => '<strong>'.$this->lang->line('Remark').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');
			$this->table->add_row($cell1);
			$cell1 = array('data' => '<strong>'.$this->lang->line('').'&nbsp;&nbsp;</strong>'.$rs->remark, 'width' => '100%');
			$this->table->add_row($cell1);				

			endforeach;

	//--> Colony

	$cell1 = array('data' => '');	
	$this->table->add_row($cell1);
	$cell1 = array('data' => '<strong>'.$this->lang->line('Beekeeper').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
	$this->table->add_row($cell1);		

	$beekeeper = $this->model_report->get_REP0A_beekeeper($association_id);		

	if ($beekeeper == null) {
	   // If not data found, we indicate in the report first line
	   $this->table->add_row($this->lang->line('No data found'));        
	   }
	else {	

		foreach($beekeeper as $rs):

			$cell1 = array('data' => '<strong>'.$rs->beekeeper_name.'</strong>', 'width' => '100%');
			$this->table->add_row($cell1);

			$cell1 = array('data' => '', 'width' => '7%');
			$cell2 = array('data' => $this->lang->line('Address').':&nbsp;&nbsp;'.$rs->address, 'width' => '93%');
			$this->table->add_row($cell1,$cell2);
			$cell1 = array('data' => '', 'width' => '7%');
			$cell2 = array('data' => $this->lang->line('Region').':&nbsp;&nbsp;'.$rs->region_name, 'width' => '46.5%');
			$cell3 = array('data' => $this->lang->line('Province').':&nbsp;&nbsp;'.$rs->province_name, 'width' => '46.5%');
			$this->table->add_row($cell1,$cell2,$cell3);
			$cell1 = array('data' => '', 'width' => '7%');
			$cell2 = array('data' => $this->lang->line('Lgu').':&nbsp;&nbsp;'.$rs->lgu_name, 'width' => '46.5%');
			$cell3 = array('data' => $this->lang->line('Barangay').':&nbsp;&nbsp;'.$rs->barangay_name, 'width' => '46.5%');
			$this->table->add_row($cell1,$cell2,$cell3);;	

			$cell1 = array('data' => '', 'width' => '7%');
			$cell2 = array('data' => $this->lang->line('Remark').':&nbsp;&nbsp;'.$rs->remark, 'width' => '93%');
			$this->table->add_row($cell1, $cell2);	

			endforeach;	
		}	
			
/*

	//--> Production

	$cell1 = array('data' => '');	
	$this->table->add_row($cell1);
	$cell1 = array('data' => '<strong>'.$this->lang->line('Production').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
	$this->table->add_row($cell1);

	$production = $this->model_report->get_REP0B_production($beekeeper_id);

	if ($production == null) {
	   // If not data found, we indicate in the report first line
	   $this->table->add_row($this->lang->line('No data found'));        
	   }
	else {		

		$cell1 = array('data' => '<strong>'.$this->lang->line('Year').'</strong>', 'width' => '15%');
		$cell2 = array('data' => '<strong>'.$this->lang->line('Beehive Number').'</strong>', 'width' => '25%');
		$cell3 = array('data' => '<strong>'.$this->lang->line('Total Production').'</strong>', 'width' => '25%');
		$cell4 = array('data' => '<strong>'.$this->lang->line('Date').'</strong>', 'width' => '35%');
		
		$this->table->add_row($cell1, $cell2, $cell3, $cell4);

		foreach($production as $rs):		

			$cell1 = array('data' => $rs->year, 'width' => '15%');
			$cell2 = array('data' => $rs->beehive_number, 'width' => '25%');
			$cell3 = array('data' => $rs->total_production, 'width' => '25%');
			$cell4 = array('data' => $rs->production_date, 'width' => '35%');
			$this->table->add_row($cell1, $cell2, $cell3, $cell4);
		 
		 	endforeach;	
		} 	
	*/

	//--> Inquiry
		/*
	$cell1 = array('data' => '');	
	$this->table->add_row($cell1);
	$cell1 = array('data' => '<strong>'.$this->lang->line('Inquiries').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
	$this->table->add_row($cell1);

	$inquiry = $this->model_report->get_REP0B_inquiry($beekeeper_id);

	if ($inquiry == null) {
	   // If not data found, we indicate in the report first line
	   $this->table->add_row($this->lang->line('No data found'));        
	   }
	else {	

		$cell1 = array('data' => '<strong>'.$this->lang->line('Inquiry Type').'</strong>', 'width' => '15%');
		$cell2 = array('data' => '<strong>'.$this->lang->line('Support Type').'</strong>', 'width' => '15%');
		$cell3 = array('data' => '<strong>'.$this->lang->line('Request').'</strong>', 'width' => '20%');
		$cell4 = array('data' => '<strong>'.$this->lang->line('Feedback').'</strong>', 'width' => '20%');
		$cell5 = array('data' => '<strong>'.$this->lang->line('Answered by').'</strong>', 'width' => '15%');
		$cell6 = array('data' => '<strong>'.$this->lang->line('Date').'</strong>', 'width' => '15%');	
		$this->table->add_row($cell1, $cell2, $cell3, $cell4, $cell5, $cell6);
		
		foreach($inquiry as $rs):
			
			$cell1 = array('data' => $rs->inquiry_type_name, 'width' => '15%');
			$cell2 = array('data' => $rs->support_type_name, 'width' => '15%');
			$cell3 = array('data' => $rs->request, 'width' => '20%');
			$cell4 = array('data' => $rs->feedback, 'width' => '20%');
			$cell5 = array('data' => $rs->answered_by, 'width' => '15%');
			$cell6 = array('data' => $rs->inquiry_date, 'width' => '15%');
			$this->table->add_row($cell1, $cell2, $cell3, $cell4, $cell5, $cell6);
		 
		 	endforeach;	
		 }	 	


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
			//$cell4 = array('data' => $rs->beekeeper_no, 'width' => '22%');
			$this->table->add_row($cell1, $cell2, $cell3);
		 
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
	$pdf->Output('Report0A.pdf', 'I');	
	
	
}	
}
