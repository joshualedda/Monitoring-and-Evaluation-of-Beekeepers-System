<?php if($this->session->language == 'fr') { ?>
	<embed width=100% height="1000px" src=<?php echo base_url()."assets/documentation/meb_user_guide_fr.pdf" ?> type="application/pdf"></embed>
<?php } else { ?>
	<embed width=100% height="1000px" src=<?php echo base_url()."assets/documentation/meb_user_guide_en.pdf" ?> type="application/pdf"></embed>
<?php } ?>