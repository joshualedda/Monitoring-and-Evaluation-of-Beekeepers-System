<?php if($this->session->language == 'en') { ?>
	<embed width=100% height="1000px" src=<?php echo base_url()."assets/documentation/meb_presentation_en.pdf" ?> type="application/pdf"></embed>
<?php } else { ?>
	<embed width=100% height="1000px" src=<?php echo base_url()."assets/documentation/meb_presentation_fr.pdf" ?> type="application/pdf"></embed>
<?php } ?>