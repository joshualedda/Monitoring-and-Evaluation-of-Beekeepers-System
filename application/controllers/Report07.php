<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

// Print of a Beekeeper with all the information attached.

class Report07 extends Admin_Controller 
{	 
	public function __construct()
	{
		
		parent::__construct();

		$this->data['page_title'] = $this->lang->line('Association');
		
	}


	public function report07() {	

		// Orientation (Landscape or Portrait, format, character, keepmargin, )
		// Orientation and size is not working here but works in AddPage('L','LETTER')
		$pdf = new Pdf('L', 'mm', 'LETTER', true, 'UTF-8', false);
		
		// Set some basic 
		$pdf->SetHeaderMargin(13);
		$pdf->SetTopMargin(23);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->SetDisplayMode('real', 'default');


        // Create a session variable to use the title in the header of tcpdf (library tcpdf / Pdf.php)
	    $this->session->set_flashdata('report_code', 'REP07');	

		// set font for the report
		$pdf->SetFont('dejavusans', '', 7.5);

		
		
		// Generate HTML table data from MySQL

		$template = array (
			'table_open'            => '<table border="0" cellpadding="4" cellspacing="0">',

	        'thead_open'            => '<thead>

				  <tr>
				     <td width="100%" align="center"><strong><font size="14">'.strtoupper('Association').'</font></strong></td>
				  </tr>
				  <tr><td></td></tr>',

	        'thead_close'           => '</thead>',

	        'heading_row_start'     => '<tr bgcolor="rgb(235,235,235)">',
	        'heading_row_end'       => '</tr>',
	        'heading_cell_start'    => '',
	        'heading_cell_end'      => '',

	        'tbody_open'            => '<tbody>',
	        'tbody_close'           => '</tbody>',

	        'row_start'             => '<tr>',
	        'row_end'               => '</tr>',
	        'cell_start'            => '<td>',
	        'cell_end'              => '</td>',

	        'row_alt_start'         => '<tr bgcolor="rgb(251,251,251)">',
	        'row_alt_end'           => '</tr>',
	        'cell_alt_start'        => '<td>',
	        'cell_alt_end'          => '</td>',

		    'table_close'        => '</table>');

		$this->table->set_template($template);

		$this->table->set_heading(
			'<th width="17%" height="28"><strong>Name</strong></th>',
								  '<th width="5%" height="28"><strong>Code</strong></th>',
								  '<th width="13%" height="28"><strong>Focal Person/President</strong></th>',
								  '<th width="10%" height="28"><strong>Address</strong></th>',
								  '<th width="10%" height="28"><strong>Barangay</strong></th>',
								  '<th width="7%" height="28"><strong>Lgu</strong></th>',
								  '<th width="10%" height="28"><strong>Province</strong></th>',
								  '<th width="5%" height="28"><strong>Region</strong></th>',
								  '<th width="8%" height="28"><strong>Contact</strong></th>',
								  '<th width="10%" height="28"><strong>Email Address</strong></th>',
								  '<th width="5%" height="28"><strong>Active</strong></th>' );
  	
		// Call to the database

		$result = $this->model_report->getReport07();
		if ($result == null) {
			// If not data found, we indicate in the report first line
			$this->table->add_row('No data found');        
		}
		else {
			foreach ($result as $rs):
				$cell1 = array('data' => $rs->name, 'width' => '17%');
				$cell2 = array('data' => $rs->code, 'width' => '5%');
				$cell3 = array('data' => $rs->contact_name, 'width' => '13%');
				$cell4 = array('data' => $rs->address, 'width' => '10%');
				$cell5 = array('data' => $rs->barangay_name, 'width' => '10%');
				$cell6 = array('data' => $rs->lgu_name, 'width' => '7%');
				$cell7 = array('data' => $rs->province_name, 'width' => '10%');
				$cell8 = array('data' => $rs->region_name, 'width' => '5%');
				$cell9 = array('data' => $rs->contact_number, 'width' => '8%');
				$cell10 = array('data' => $rs->email, 'width' => '10%');
				$cell11= array('data' => $rs->active, 'width' => '5%');

				$this->table->add_row($cell1, $cell2,$cell3,$cell4,$cell5,$cell6,$cell7,$cell8,$cell9,$cell10,$cell11);
			endforeach;
		}

		// Generate the table in html format using the table class of codeigniter
		$html = $this->table->generate();	
		
		
		// Add a page and change the orientation/size
		$pdf->AddPage('L','FOLIO');

		// Output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// Reset pointer to the last page
		$pdf->lastPage();
		ob_end_clean();
		// Close and output PDF document
		// (I - Inline, D - Download, F - File)
		$pdf->Output('report07.pdf', 'I');	
	
	
}
}