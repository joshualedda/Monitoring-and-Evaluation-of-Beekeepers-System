<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Report03 extends Admin_Controller 
{	 
	public function __construct()
	{
		
		parent::__construct();

		$this->data['page_title'] = $this->lang->line('Report03');;
		
	}


	public function REP03() {	

		// Orientation (Landscape or Portrait, format, character, keepmargin, )
		// Orientation is not working here but works in AddPage('L')
		$pdf = new Pdf('P', 'mm', 'LETTER', true, 'UTF-8', false);
		
		// Set some basic 
		$pdf->SetHeaderMargin(13);
		$pdf->SetTopMargin(23);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->SetDisplayMode('real', 'default');

		// Create a session variable to use the title in the header of tcpdf (library tcpdf / Pdf.php)
	    $this->session->set_flashdata('report_code', 'REP03');

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
	              'row_alt_start'       => '<tr bgcolor="rgb(251,251,251)">',
	              'row_alt_end'         => '</tr>',
	              'cell_alt_start'      => '<td>',
	              'cell_alt_end'        => '</td>',
	              'table_close'         => '</table>'
	              );

		$this->table->set_template($template);

		$this->table->set_heading('<th width="15%" height="28"><strong>'.$this->lang->line('Register Id').'</strong></th>', 
          '<th width="30%" height="28"><strong>'.$this->lang->line('Beekeeper Name').'</strong></th>',
          '<th width="15%" height="28" align="right"><strong>'.$this->lang->line('Beehive Number').'</strong></th>',
          '<th width="15%" height="28" align="right"><strong>'.$this->lang->line('Total Production').'</strong></th>',
      	  '<th width="15%" height="28" align="right"><strong>'.$this->lang->line('Production Date').'</strong></th>',
      	  '<th width="10%" height="28" align="left"><strong>'.$this->lang->line('Year').'</strong></th>'
      	   );


 	
		// Call to the database
		$REP03 = $this->model_report->get_REP03();	

		$total_beehive_number = 0;	
		$total_total_production = 0;


		if ($REP03 == null) {
			// If not data found, we indicate in the report first line
			$this->table->add_row($this->lang->line('No data found'));       
		}
		else {
			foreach ($REP03 as $rs):
				$total_beehive_number =  $total_beehive_number + $rs->beehive_number; 
				$total_total_production =  $total_total_production + $rs->total_production;
				
				$cell1 = array('data' => $rs->beekeeper_register_id, 'width' => '15%');
				$cell2 = array('data' => $rs->beekeeper_name, 'width' => '30%');
				$cell3 = array('data' => number_format($rs->beehive_number,2), 'width' => '15%', 'align' => 'right');
				$cell4 = array('data' => number_format($rs->total_production,2), 'width' => '15%', 'align' => 'right');				
				$cell5 = array('data' => $rs->production_date, 'width' => '15%', 'align' => 'left');
				$cell6 = array('data' => $rs->year, 'width' => '10%', 'align' => 'left');
				$this->table->add_row($cell1, $cell2, $cell3, $cell4, $cell5, $cell6);
			endforeach;
		}

		$blank_line = array('data' => '');
		$this->table->add_row($blank_line);

		//Print the total

		$cell1 = array('data' => '<strong>'.$this->lang->line('Total Production').'</strong>', 'width' => '45%', 'bgcolor'=> 'rgb(235,235,235)', 'height'=>'23', 'valign' => 'center');
		$cell2 = array('data' => number_format($total_beehive_number,2), 'width' => '15%', 'align' => 'right', 'bgcolor'=> 'rgb(235,235,235)', 'height'=>'23');
		$cell3 = array('data' => number_format($total_total_production,2), 'width' => '15%', 'align' => 'right', 'bgcolor'=> 'rgb(235,235,235)', 'height'=>'23');		
		$cell4 = array('data' => '', 'width' => '25%', 'align' => 'left', 'bgcolor'=> 'rgb(235,235,235)', 'height'=>'23');
		$this->table->add_row($cell1, $cell2, $cell3, $cell4);

		// Generate the table in html format using the table class of codeigniter
		$html = $this->table->generate();		
		
		// Add a page and change the orientation/size
		$pdf->AddPage('P','LETTER');
		
		// Output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		
		// Reset pointer to the last page
		$pdf->lastPage();

		// Close and output PDF document
		// (I - Inline, D - Download, F - File)
		$pdf->Output('Report03.pdf', 'I');	
	
	
}	
}