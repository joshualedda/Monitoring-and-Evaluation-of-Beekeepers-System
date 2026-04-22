<div id="main">
  <div class="main-container">
    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-file-text me-2 text-primary"></i><?php echo $this->lang->line('Reports'); ?></h4>
        <p>Generate detailed insights and statistical reports.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active fw-medium text-primary"><?php echo $this->lang->line('Reports'); ?></li>
        </ol>
      </nav>
    </div>

    <!-- ── Main Content ──────────────────────────────────────── -->
    <section class="content">
      <div class="row g-4">
        <div class="col-md-12">

          <div id="messages"></div>

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
              <i class="ph ph-check-circle me-2"></i><?php echo $this->session->flashdata('success'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
              <i class="ph ph-warning-circle me-2"></i><?php echo $this->session->flashdata('error'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3">
              <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-funnel me-2 text-primary"></i>Report Criteria</h5>
            </div>
            <form role="form" action="<?php echo base_url('Report/') ?>" method="post" enctype="multipart/form-data">
              <div class="card-body px-4 py-4">
                

                <?php echo validation_errors(); ?>

                <!-- the session variable printdoc is assigned in report.php.  When the index view of report is loaded from the menu 
                     on left side, printdoc is equal to "no" and we present the report form with the criterias.                    
                     When the form is submitted after a report is asked, the session variable printdoc will be equal to "yes" 
                     and the report will be presented in the pdf view of the browser.  -->

                <?php if($this->session->printdoc == 'no') : ?>          

                <div class="row g-4 mb-4">
                  <div class="col-md-12">
                    <div class="form-group p-3 border border-light rounded-4 bg-light bg-opacity-25">
                      <label for="report" class="form-label fw-bold text-dark mb-2">
                        <i class="ph ph-receipt me-2 text-primary"></i><?php echo $this->lang->line('Choose the report'); ?>
                      </label>
                      <select class="form-control select_group" id="report" name="report">
                        <option value=""></option> 
                        <?php foreach ($report as $k => $v): ?>
                        <option value="<?php echo $v['report_code'] ?>"><?php echo $v['report_code'] ?> - <?php echo $this->lang->line($v['report_title']) ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                </div>

                <div class="row g-4 mb-4"> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="region" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Region'); ?></label>
                      <select class="form-control select_group" id="region" name="region">
                        <option value="all"><?php echo $this->lang->line('All Region'); ?></option> 
                        <?php foreach ($region as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="province" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Province'); ?></label>
                      <select class="form-control select_group" id="province" name="province">
                        <option value="all"><?php echo $this->lang->line('All Province'); ?></option> 
                        <?php if($this->session->printdoc == 'yes'): ?>
                        <?php foreach ($province as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>" <?php echo ($this->session->province == $v['id']) ? 'selected' : ''; ?>><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="municipality" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Municipality'); ?></label>
                      <select class="form-control select_group" id="municipality" name="municipality" >
                        <option value="all"><?php echo $this->lang->line('All Municipality'); ?></option> 
                        <?php if($this->session->printdoc == 'yes'): ?>
                        <?php foreach ($municipality as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>" <?php echo ($this->session->municipality == $v['id']) ? 'selected' : ''; ?>><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>                                  
                </div> 


                <div class="row g-4 mb-4">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="beekeeper" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Beekeeper'); ?></label>
                      <select class="form-control select_group" id="beekeeper" name="beekeeper">
                        <option value="all"><?php echo $this->lang->line('All Beekeeper'); ?></option> 
                        <?php foreach ($beekeeper as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['beekeeper_name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="colony" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Colony'); ?></label>
                      <select class="form-control select_group" id="colony" name="colony">
                        <option value="all"><?php echo $this->lang->line('All Colony'); ?></option> 
                        <?php foreach ($colony as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['colony_no'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="word" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Search with a word'); ?></label>
                      <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="ph ph-magnifying-glass"></i></span>
                        <input type="text" class="form-control border-start-0" id="word" name="word" autocomplete="off" placeholder="Keyword..." />
                      </div>
                   </div>
                  </div>   
                </div> 
                

                <div class="row g-4 mb-4">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="category" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Category'); ?></label>
                      <select class="form-control select_group" id="category" name="category" >
                        <option value="all"><?php echo $this->lang->line('All Category'); ?></option> 
                        <?php foreach ($category as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>                       
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="nationality" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Nationality'); ?></label>
                      <select class="form-control select_group" id="nationality" name="nationality">
                        <option value="all"><?php echo $this->lang->line('All Nationality'); ?></option> 
                        <?php foreach ($nationality as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="association" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Association'); ?></label>
                      <select class="form-control select_group" id="association" name="association" >
                        <option value="all"><?php echo $this->lang->line('All Association'); ?></option> 
                        <?php foreach ($association as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>                                  
                </div>  


              <div class="row g-4 mb-4">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="phase" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Phase'); ?></label>
                      <select class="form-control select_group" id="phase" name="phase" >
                        <option value="all"><?php echo $this->lang->line('All Phase'); ?></option> 
                        <?php foreach ($phase as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="species" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Species'); ?></label>
                      <select class="form-control select_group" id="species" name="species" >
                        <option value="all"><?php echo $this->lang->line('All Type'); ?></option> 
                        <?php foreach ($species as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                 <div class="col-md-2">
                    <div class="form-group">
                      <label for="date_from" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Date from'); ?></label>
                      <input type="date" class="form-control" id="date_from" name="date_from" autocomplete="off"  />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="date_to" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Date to'); ?></label>
                      <input type="date" class="form-control" id="date_to" name="date_to" autocomplete="off"  />
                    </div>
                  </div>
                </div>

              <div class="row g-4 mb-4">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="year" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Year'); ?></label>
                      <?php
                      //get the current year
                      $Startyear=date('Y');
                      $endYear=$Startyear-10;

                      // set start and end year range i.e the start year
                      $yearArray = range($Startyear,$endYear);
                      ?>
                      <!-- here you displaying the dropdown list -->
                      <select class="form-control select_group" id="year" name="year">
                        <option value=""></option> 
                          <?php foreach ($yearArray as $year) {
                              // this allows you to select a particular year
                              $selected = ($year == $Startyear) ? 'selected' : '';
                              echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                          }?>
                      </select>
                    </div>
                  </div> 
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="support_type" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Support Type'); ?></label>
                      <select class="form-control select_group" id="support_type" name="support_type" >
                        <option value="all"><?php echo $this->lang->line('All Type'); ?></option> 
                        <?php foreach ($support_type as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inquiry_type" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Inquiry Type'); ?></label>
                      <select class="form-control select_group" id="inquiry_type" name="inquiry_type" >
                        <option value="all"><?php echo $this->lang->line('All Type'); ?></option> 
                        <?php foreach ($inquiry_type as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
              </div>   

            </div> <!-- /.card-body -->

            <div class="card-footer bg-transparent border-top border-light py-4 px-4 d-flex gap-2 justify-content-end">
              <?php if(in_array('viewReport', $user_permission)): ?>
                <button type="reset" id="reset" class="btn btn-light px-4 py-2 fw-medium rounded-3 align-items-center d-flex">
                  <i class="ph ph-arrow-counter-clockwise me-2"></i> <?php echo $this->lang->line('Reset'); ?>
                </button>
                <button type="submit" id="generate" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
                  <i class="ph ph-file-pdf me-2"></i> <?php echo $this->lang->line('Generate'); ?>
                </button>
              <?php endif; ?>
            </div>

            <?php endif; ?>  <!-- printdoc or criteria screen -->



          <!-------------------------------------------------  P R I N T    R E P O R T S  ------------------------------------------- -->      
          <div class="report-preview-container">
            <?php if($this->session->printREP01 == 'yes') : ?> 
              <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-primary text-white py-3 px-4 d-flex align-items-center justify-content-between">
                  <h6 class="mb-0 fw-bold"><i class="ph ph-file-pdf me-2"></i>Report Preview: REP01</h6>
                  <a href="<?php echo base_url("report01/REP01"); ?>" target="_blank" class="btn btn-sm btn-light rounded-pill px-3">Open in New Tab</a>
                </div>
                <div class="card-body p-0">
                  <object data="<?php echo  base_url("report01/REP01"); ?>" width="100%" height="800px" type="application/pdf"> </object>
                </div>
              </div>
            <?php endif; ?>

            <?php if($this->session->printREP02 == 'yes') : ?> 
              <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-primary text-white py-3 px-4 d-flex align-items-center justify-content-between">
                  <h6 class="mb-0 fw-bold"><i class="ph ph-file-pdf me-2"></i>Report Preview: REP02</h6>
                  <a href="<?php echo base_url("report02/REP02"); ?>" target="_blank" class="btn btn-sm btn-light rounded-pill px-3">Open in New Tab</a>
                </div>
                <div class="card-body p-0">
                  <object data="<?php echo  base_url("report02/REP02"); ?>" width="100%" height="800px" type="application/pdf"> </object>
                </div>
              </div>
            <?php endif; ?> 

            <?php if($this->session->printREP03 == 'yes') : ?> 
              <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-primary text-white py-3 px-4 d-flex align-items-center justify-content-between">
                  <h6 class="mb-0 fw-bold"><i class="ph ph-file-pdf me-2"></i>Report Preview: REP03</h6>
                  <a href="<?php echo base_url("report03/REP03"); ?>" target="_blank" class="btn btn-sm btn-light rounded-pill px-3">Open in New Tab</a>
                </div>
                <div class="card-body p-0">
                  <object data="<?php echo  base_url("report03/REP03"); ?>" width="100%" height="800px" type="application/pdf"> </object>
                </div>
              </div>
            <?php endif; ?> 

            <?php if($this->session->printREP04 == 'yes') : ?> 
              <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-primary text-white py-3 px-4 d-flex align-items-center justify-content-between">
                  <h6 class="mb-0 fw-bold"><i class="ph ph-file-pdf me-2"></i>Report Preview: REP04</h6>
                  <a href="<?php echo base_url("report04/REP04"); ?>" target="_blank" class="btn btn-sm btn-light rounded-pill px-3">Open in New Tab</a>
                </div>
                <div class="card-body p-0">
                  <object data="<?php echo  base_url("report04/REP04"); ?>" width="100%" height="800px" type="application/pdf"> </object>
                </div>
              </div>
            <?php endif; ?>  

            <?php if($this->session->printREP05 == 'yes') : ?> 
              <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-primary text-white py-3 px-4 d-flex align-items-center justify-content-between">
                  <h6 class="mb-0 fw-bold"><i class="ph ph-file-pdf me-2"></i>Report Preview: REP05</h6>
                  <a href="<?php echo base_url("report05/REP05"); ?>" target="_blank" class="btn btn-sm btn-light rounded-pill px-3">Open in New Tab</a>
                </div>
                <div class="card-body p-0">
                  <object data="<?php echo  base_url("report05/REP05"); ?>" width="100%" height="800px" type="application/pdf"> </object>
                </div>
              </div>
            <?php endif; ?> 	
          </div>
               
        </div> <!-- col-md-12 -->
      </div> <!-- row -->
    </section> <!-- content -->
  </form>
  </div> <!-- main-container -->
</div> <!-- main -->



 <!----------------------------------------------------------  J A V A S C R I P T ------------------------------------------- -->


<script type="text/javascript">

  $(document).ready(function() {
    $(".select_group").select2({ width: '100%' });
  });

  //--> disable all the parameters 
  //    only the report list is available

  function disable_all(){
    $("#province").prop( 'disabled', true );
    $("#region").prop( 'disabled', true );
    $("#beekeeper").prop( 'disabled', true );
    $("#date_from").prop( 'disabled', true );
    $("#date_to").prop( 'disabled', true );    
    $("#inquiry_type").prop( 'disabled', true );
    $("#generate").prop( 'disabled', true );
    $("#colony").prop( 'disabled', true );
    $("#species").prop( 'disabled', true );
    $("#nationality").prop( 'disabled', true );
    $("#phase").prop( 'disabled', true );
    $("#association").prop( 'disabled', true );
    $("#category").prop( 'disabled', true );
    $("#municipality").prop( 'disabled', true );
    $("#support_type").prop( 'disabled', true );
    $("#word").prop( 'disabled', true );
    $("#year").prop( 'disabled', true );
  }

  // On load, we disable all paramaters
  // In load must be out of ready function to work
  $(window).on('load', function() {disable_all() }); 

  // On reset we disable all parameters
  $("#reset").click(function(){disable_all() });

  //--> Treatment of reports

  $("#report").on('change', function(){

    //--> Disable all the parameters

    disable_all();
    
    //--> Enable the parameters depending on the report chosen

    switch($("#report :selected").val()) {
      case 'REP01':
           $("#region").prop( 'disabled', false );
           $("#province").prop( 'disabled', false );
           $("#municipality").prop( 'disabled', false );
           $("#category").prop( 'disabled', false );
           $("#generate").prop( 'disabled', false );           
           break;
      case 'REP02':
           $("#phase").prop( 'disabled', false );
           $("#region").prop( 'disabled', false );
           $("#province").prop( 'disabled', false );
           $("#species").prop( 'disabled', false );
           $("#generate").prop( 'disabled', false );
           break;
      case 'REP03':
           $("#year").prop( 'disabled', false );
           $("#region").prop( 'disabled', false );
           $("#province").prop( 'disabled', false );
           $("#municipality").prop( 'disabled', false );           
           $("#generate").prop( 'disabled', false );
           break;
	    case 'REP04':
           $("#inquiry_type").prop( 'disabled', false );
           $("#date_from").prop( 'disabled', false );
           $("#date_to").prop( 'disabled', false );
           $("#support_type").prop( 'disabled', false );
           $("#generate").prop('disabled',false);
           break;		
      case 'REP05':
           $("#phase").prop( 'disabled', false );
           $("#species").prop( 'disabled', false );
           $("#generate").prop( 'disabled', false );
           break;     

    }
  });


  // AJAX for Region -> Province -> Municipality
  $('#region').change(function() {
    var region_id = $(this).val();
    if(region_id != 'all') {
      $.ajax({
        url: "<?php echo base_url('Province/fetchProvinceDataByRegion') ?>",
        method: "POST",
        data: {region_id: region_id},
        success: function(data) {
          $('#province').html(data);
          $('#municipality').html('<option value="all">All Municipality</option>');
        }
      });
    } else {
      $('#province').html('<option value="all">All Province</option>');
      $('#municipality').html('<option value="all">All Municipality</option>');
    }
  });

  $('#province').change(function() {
    var province_id = $(this).val();
    if(province_id != 'all') {
      $.ajax({
        url: "<?php echo base_url('Municipality/fetchMunicipalityDataByProvince') ?>",
        method: "POST",
        data: {province_id: province_id},
        success: function(data) {
          $('#municipality').html(data);
        }
      });
    } else {
      $('#municipality').html('<option value="all">All Municipality</option>');
    }
  });


</script>
