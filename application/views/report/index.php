
<div id="main">
  <div class="main-container">
  <section class="content-header">    
    <h1><?php echo $this->lang->line('Reports'); ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home'); ?></a></li>
      <li class="active"><?php echo $this->lang->line('Reports'); ?></li>
    </ol>
  </section>


<!--------------------------------------------  Main ---------------------------------------------------------->

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        
        
        <div class="box">
          <div class="box-header"></div>
          <!-- /.box-header -->         
          <form role="form" action="<?php base_url('Report/') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                

                <?php echo validation_errors(); ?>

                <!-- the session variable printdoc is assigned in report.php.  When the index view of report is loaded from the menu 
                     on left side, printdoc is equal to "no" and we present the report form with the criterias.                    
                     When the form is submitted after a report is asked, the session variable printdoc will be equal to "yes" 
                     and the report will be presented in the pdf view of the browser.  -->

                <?php if($this->session->printdoc == 'no') : ?>          


                <div class="row">
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="report"><?php echo $this->lang->line('Choose the report'); ?></label>
                      <select class="form-control select_group" id="report" name="report">
                        <option value=""></option> 
                        <?php foreach ($report as $k => $v): ?>
                        <option value="<?php echo $v['report_code'] ?>"><?php echo $v['report_code'] ?> - <?php echo $this->lang->line($v['report_title']) ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                </div>

                <div class="row"> 
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="region"><?php echo $this->lang->line('Region'); ?></label>
                      <select class="form-control select_group" id="region" name="region">
                        <option value="all"><?php echo $this->lang->line('All Region'); ?></option> 
                        <?php foreach ($region as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="province"><?php echo $this->lang->line('Province'); ?></label>
                      <select class="form-control select_group" id="province" name="province">
                        <option value="all"><?php echo $this->lang->line('All Province'); ?></option> 
                        <?php foreach ($province as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="lgu"><?php echo $this->lang->line('Lgu'); ?></label>
                      <select class="form-control select_group" id="lgu" name="lgu" >
                        <option value="all"><?php echo $this->lang->line('All Lgu'); ?></option> 
                        <?php foreach ($lgu as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>                                  
                </div> 


                <div class="row">
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="beekeeper"><?php echo $this->lang->line('Beekeeper'); ?></label>
                      <select class="form-control select_group" id="beekeeper" name="beekeeper">
                        <option value="all"><?php echo $this->lang->line('All Beekeeper'); ?></option> 
                        <?php foreach ($beekeeper as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['beekeeper_name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="colony"><?php echo $this->lang->line('Colony'); ?></label>
                      <select class="form-control select_group" id="colony" name="colony">
                        <option value="all"><?php echo $this->lang->line('All Colony'); ?></option> 
                        <?php foreach ($colony as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['colony_no'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="word"><?php echo $this->lang->line('Search with a word'); ?></label>
                      <input type="text" class="form-control" id="word" name="word" autocomplete="off" />
                   </div>
                  </div>   
                </div> 
                

                <div class="row">
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="category"><?php echo $this->lang->line('Category'); ?></label>
                      <select class="form-control select_group" id="category" name="category" >
                        <option value="all"><?php echo $this->lang->line('All Category'); ?></option> 
                        <?php foreach ($category as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>                       
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="nationality"><?php echo $this->lang->line('Nationality'); ?></label>
                      <select class="form-control select_group" id="nationality" name="nationality">
                        <option value="all"><?php echo $this->lang->line('All Nationality'); ?></option> 
                        <?php foreach ($nationality as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="association"><?php echo $this->lang->line('Association'); ?></label>
                      <select class="form-control select_group" id="association" name="association" >
                        <option value="all"><?php echo $this->lang->line('All Association'); ?></option> 
                        <?php foreach ($association as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>                                  
                </div>  


              <div class="row">
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="phase"><?php echo $this->lang->line('Phase'); ?></label>
                      <select class="form-control select_group" id="phase" name="phase" >
                        <option value="all"><?php echo $this->lang->line('All Phase'); ?></option> 
                        <?php foreach ($phase as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="species"><?php echo $this->lang->line('Species'); ?></label>
                      <select class="form-control select_group" id="species" name="species" >
                        <option value="all"><?php echo $this->lang->line('All Type'); ?></option> 
                        <?php foreach ($species as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                 <div class="col-md-2 col-xs-2">
                    <div class="form-group">
                      <label for="date_from"><?php echo $this->lang->line('Date from'); ?></label>
                      <input type="date" class="form-control" id="date_from" name="date_from" autocomplete="off"  />
                    </div>
                  </div>
                  <div class="col-md-2 col-xs-2">
                    <div class="form-group">
                      <label for="date_to"><?php echo $this->lang->line('Date to'); ?></label>
                      <input type="date" class="form-control" id="date_to" name="date_to" autocomplete="off"  />
                    </div>
                  </div>
                </div>

              <div class="row">
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="year"><?php echo $this->lang->line('Year'); ?></label>
                      <br>
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
                
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="support_type"><?php echo $this->lang->line('Support Type'); ?></label>
                      <select class="form-control select_group" id="support_type" name="support_type" >
                        <option value="all"><?php echo $this->lang->line('All Type'); ?></option> 
                        <?php foreach ($support_type as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="inquiry_type"><?php echo $this->lang->line('Inquiry Type'); ?></label>
                      <select class="form-control select_group" id="inquiry_type" name="inquiry_type" >
                        <option value="all"><?php echo $this->lang->line('All Type'); ?></option> 
                        <?php foreach ($inquiry_type as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
              </div>   


     <br />

      <?php if(in_array('viewReport', $user_permission)): ?>
        <button type="submit" id="generate" class="btn btn-primary"><?php echo $this->lang->line('Generate'); ?></button>
        <button type="reset" id="reset" class="btn btn-primary"><?php echo $this->lang->line('Reset'); ?></button>
        <br /> <br />
      <?php endif; ?>
  
      <?php endif; ?>  <!-- printdoc or criteria screen -->



<!-------------------------------------------------  P R I N T    R E P O R T S  ------------------------------------------- -->      

    <?php if($this->session->printREP01 == 'yes') : ?> 
      <object data="<?php echo  base_url("report01/REP01"); ?>" width="100%" height="1000px" type="application/pdf"> </object>
    <?php endif; ?>

    <?php if($this->session->printREP02 == 'yes') : ?> 
      <object data="<?php echo  base_url("report02/REP02"); ?>" width="100%" height="1000px" type="application/pdf"> </object>
    <?php endif; ?> 

    <?php if($this->session->printREP03 == 'yes') : ?> 
      <object data="<?php echo  base_url("report03/REP03"); ?>" width="100%" height="1000px" type="application/pdf"> </object>
    <?php endif; ?> 

    <?php if($this->session->printREP04 == 'yes') : ?> 
      <object data="<?php echo  base_url("report04/REP04"); ?>" width="100%" height="1000px" type="application/pdf"> </object>
    <?php endif; ?>  

    <?php if($this->session->printREP05 == 'yes') : ?> 
      <object data="<?php echo  base_url("report05/REP05"); ?>" width="100%" height="1000px" type="application/pdf"> </object>
    <?php endif; ?> 	
      

   </div>
       
  </form>
</section>    <!-- /.content -->
</div>  <!-- /.content-wrapper -->




 <!----------------------------------------------------------  J A V A S C R I P T ------------------------------------------- -->


<script type="text/javascript">

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
    $("#lgu").prop( 'disabled', true );
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
           $("#province").prop( 'disabled', false );
           $("#lgu").prop( 'disabled', false );
           $("#category").prop( 'disabled', false );
           $("#generate").prop( 'disabled', false );           
           break;
      case 'REP02':
           $("#phase").prop( 'disabled', false );
           $("#province").prop( 'disabled', false );
           $("#species").prop( 'disabled', false );
           $("#generate").prop( 'disabled', false );
           break;
      case 'REP03':
           $("#year").prop( 'disabled', false );
           $("#lgu").prop( 'disabled', false );           
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


</script>
