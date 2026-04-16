<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

// Print of a colony with all the information attached

class Report0C extends Admin_Controller 
{	 
	public function __construct()
	{
		
		parent::__construct();

		$this->data['page_title'] = $this->lang->line('Report');
		
	}


	public function REP0C($colony_id) {	

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
	$this->session->set_flashdata('report_code', 'REP0C');
	
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

	$cell1 = array('data' => '');	
	$this->table->add_row($cell1);
	$cell1 = array('data' => '<strong>'.$this->lang->line('Colony').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
	$this->table->add_row($cell1);	
		
	$colony_report = $this->model_report->get_REP0C($colony_id);		

	foreach ($colony_report as $rs):
			$species = json_decode($rs->species_id);
			$species_to_print = '';
			// Get the content of each specy for the colony
			foreach($species as $key=>$value){
				$colony_data = $this->model_colony->getColonyData($species[$key]);
				$species_to_print = $species_to_print.' '.$colony_data['name'];}			
			
			$cell1 = array('data' => '<strong>'.$this->lang->line('Species Name').':&nbsp;&nbsp;</strong>'.$rs->species_name, 'width' => '50%');
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Total').':&nbsp;&nbsp;</strong>'.$rs->total_colony, 'width' => '50%');	
			$cell2 = array('data' => '<strong>'.$this->lang->line('Phase').':&nbsp;&nbsp;</strong>'.$rs->phase_name, 'width' => '50%');	
			$this->table->add_row($cell1, $cell2);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Location').':&nbsp;&nbsp;</strong>'.$rs->apiary_location, 'width' => '50%');				
			$this->table->add_row($cell1);	

			endforeach;

			//--> Production
	$cell1 = array('data' => '');	
	$this->table->add_row($cell1);
	$cell1 = array('data' => '<strong>'.$this->lang->line('Beekeeper').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
	$this->table->add_row($cell1);	
		
	$beekeeper_report = $this->model_report->get_REP0C_beekeeper($colony_id);		

	foreach ($beekeeper_report as $rs):
			$beekeeper = json_decode($rs->id);
			$beekeeper_to_print = '';
			$nationality_beekeeper = json_decode($rs->nationality_id);
			$nationality_to_print = '';
			$source_beekeeper = json_decode($rs->fund_source_id);
			$source_to_print = '';
			// Get the content of each production for the colony
			foreach($beekeeper as $key=>$value){
				$beekeeper_data = $this->model_production->getBeekeeperData($beekeeper[$key]);
				$beekeeper_to_print = $beekeeper_to_print.' '.$beekeeper_data['id'];}	
			foreach($nationality_beekeeper as $key=>$value){
				$nationality_data = $this->model_nationality->getNationalityData($nationality_beekeeper[$key]);
				$nationality_to_print = $nationality_to_print.' '.$nationality_data['name'];}

			$source_beekeeper = json_decode($rs->fund_source_id);
			$source_to_print = '';
			// Get the content of each nationality for the beekeeper
			foreach($source_beekeeper as $key=>$value){
				$source_data = $this->model_fund_source->getFund_SourceData($source_beekeeper[$key]);
				$source_to_print = $source_to_print.' '.$source_data['name'];}			
			
			$cell1 = array('data' => '<strong>'.$this->lang->line('Beekeeper').':&nbsp;&nbsp;</strong>'.$rs->beekeeper_name, 'width' => '50%');
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Gender').':&nbsp;&nbsp;</strong>'.$rs->gender_name, 'width' => '50%');	
			$cell2 = array('data' => '<strong>'.$this->lang->line('Nationality').':&nbsp;&nbsp;</strong>'.$nationality_to_print, 'width' => '50%');				
			$this->table->add_row($cell1, $cell2);


			$cell1 = array('data' => '<strong>'.$this->lang->line('Association').':&nbsp;&nbsp;</strong>'.$rs->association_id, 'width' => '50%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Highest Educational Attainment').':&nbsp;&nbsp;</strong>'.$rs->education_name, 'width' => '50%');
			$this->table->add_row($cell1, $cell2);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Fund Source').':&nbsp;&nbsp;</strong>'.$source_to_print, 'width' => '50%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Active').':&nbsp;&nbsp;</strong>'.$this->lang->line(''.$rs->active.''), 'width' => '50%');
			$this->table->add_row($cell1,$cell2);		

			$cell1 = array('data' => '<strong>'.$this->lang->line('Address').':&nbsp;&nbsp;</strong>'.$rs->address, 'width' => '100%');
			$this->table->add_row($cell1);
			$cell1 = array('data' => '<strong>'.$this->lang->line('Region').':&nbsp;&nbsp;</strong>'.$rs->region_name, 'width' => '50%');	
			$cell2 = array('data' => '<strong>'.$this->lang->line('Province').':&nbsp;&nbsp;</strong>'.$rs->province_name, 'width' => '50%');	
			$this->table->add_row($cell1, $cell2);
			$cell1 = array('data' => '<strong>'.$this->lang->line('Lgu').':&nbsp;&nbsp;</strong>'.$rs->lgu_name, 'width' => '50%');
			$cell2 = array('data' => '<strong>'.$this->lang->line('Barangay').':&nbsp;&nbsp;</strong>'.$rs->barangay_name, 'width' => '50%');				
			$this->table->add_row($cell1, $cell2);

			endforeach;


		//--> Production
	$cell1 = array('data' => '');	
	$this->table->add_row($cell1);
	$cell1 = array('data' => '<strong>'.$this->lang->line('Production').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
	$this->table->add_row($cell1);	
		
	$production_report = $this->model_report->get_REP0C_production($colony_id);		

	foreach ($production_report as $rs):
			$production = json_decode($rs->product_id);
			$production_to_print = '';
			// Get the content of each production for the colony
			foreach($production as $key=>$value){
				$production_data = $this->model_production->getProductionData($production[$key]);
				$production_to_print = $production_to_print.' '.$production_data['id'];}			
			
			$cell1 = array('data' => '<strong>'.$this->lang->line('Product').':&nbsp;&nbsp;</strong>'.$rs->product_name, 'width' => '50%');
			$this->table->add_row($cell1);

			$cell1 = array('data' => '<strong>'.$this->lang->line('Total Production').':&nbsp;&nbsp;</strong>'.$rs->total_production, 'width' => '50%');	
			$cell2 = array('data' => '<strong>'.$this->lang->line('Production Date').':&nbsp;&nbsp;</strong>'.$rs->production_date, 'width' => '50%');	
			$this->table->add_row($cell1, $cell2);

			// $cell1 = array('data' => '<strong>'.$this->lang->line('Gross Income').':&nbsp;&nbsp;</strong>'.$rs->gross_income, 'width' => '50%');
			// $cell1 = array('data' => '<strong>'.$this->lang->line('Production Cost').':&nbsp;&nbsp;</strong>'.$rs->cost, 'width' => '50%');
			// $cell1 = array('data' => '<strong>'.$this->lang->line('Net Income').':&nbsp;&nbsp;</strong>'.$rs->net_income, 'width' => '50%');				
			// $this->table->add_row($cell1, $cell2, $cell3);	

			endforeach;
	
	//--> Document

	$cell1 = array('data' => '');	
	$this->table->add_row($cell1);
	$cell1 = array('data' => '<strong>'.$this->lang->line('Document').'</strong>', 'height' => '20', 'width' => '100%', 'bgcolor' => 'rgb(235,235,235)');	
	$this->table->add_row($cell1);

	$document = $this->model_report->get_REP0C_document($colony_id);

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
			// $cell3 = array('data' => $rs->doc_size, 'width' => '18%');
			$cell4 = array('data' => $rs->colony_no, 'width' => '22%');
			$this->table->add_row($cell1, $cell2, $cell4);
		 
		 	endforeach;
		} 		 	 	
	

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
	$pdf->Output('Report0C.pdf', 'I');	
	
	
}	
}