
<!-- Content Wrapper. Contains page content -->
<div id="main">
  <div class="main-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo $this->lang->line('Add Association'); ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('association') ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home'); ?></a></li>
      <li class="active"><?php echo $this->lang->line('Association'); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
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
            <form role="form" action="<?php base_url('user/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="row">
                  <div class="col-md-6 col-xs-2">
                    <div class="box box-primary with-border">
                      <div class="box-header with-border">
                        <h3 class="box-title">Association Information</h3>
                      </div>
                      <div class="box-body">
                       <div class="row">
                         <div class="col-md-12 col-xs-2">
                          <div class="form-group">
                            <label for="association_name"><?php echo $this->lang->line('Association Name'); ?> <font color="red">*</font></label>
                            <input type="text" class="form-control" id="association_name" name="association_name"  
                            value="<?php echo set_value('association_name'); ?>" autocomplete="off"/>
                          </div>
                        </div>  
                      </div>
                      <div class="row">
                       <div class="col-md-12 col-xs-2">
                        <div class="form-group">
                          <label for="contact_name"><?php echo $this->lang->line('Focal Person/ President'); ?> <font color="red">*</font></label>
                          <input type="text" class="form-control" id="contact_name" name="contact_name"  
                          value="<?php echo set_value('contact_name'); ?>" autocomplete="off"/>
                        </div>
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-xs-2">
                        <div class="form-group">
                          <label for="address"><?php echo $this->lang->line('Address'); ?> <font color="red">*</font></label>
                          <input type="text" class="form-control" id="address" name="address" 
                          value="<?php echo set_value('address'); ?>" autocomplete="off"/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-2">
                        <div class="form-group">
                          <label for="region"><?php echo $this->lang->line('Region'); ?> <font color="red">*</font></label>
                          <select class="form-control select_group" id="region" name="region">
                            <option value="" hidden selected disabled>Select Region</option> 
                            <?php foreach ($region as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('region', $v['id']); ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>  
                      </div>

                      <div class="col-md-6 col-xs-2">
                        <div class="form-group">
                          <label for="province"><?php echo $this->lang->line('Province'); ?> <font color="red">*</font></label>
                          <select class="form-control select_group" id="province" name="province">
                            <option value=""hidden selected disabled>Select Province</option> 
                            <?php foreach ($province as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('province', $v['id']); ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>  
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-md-6 col-xs-2">
                        <div class="form-group">
                          <label for="lgu"><?php echo $this->lang->line('Lgu'); ?></label>
                          <select class="form-control select_group" id="lgu" name="lgu">
                            <option value="" hidden selected disabled>Select LGU</option> 
                            <?php foreach ($lgu as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('lgu', $v['id']); ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6 col-xs-2">
                        <div class="form-group">
                          <label for="barangay"><?php echo $this->lang->line('Barangay'); ?></label>
                          <select class="form-control select_group" id="barangay" name="barangay">
                            <option value="" hidden selected disabled>Select Barangay</option> 
                            <?php foreach ($barangay as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('barangay', $v['id']); ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xs-2">
                <div class="box box-primary with-border">
                  <div class="box-header with-border">
                    <h3 class="box-title">Other Information</h3>
                  </div>
                  <div class="box-body">
                   <div class="row">
                    <div class="col-md-12 col-xs-2">
                      <div class="form-group">
                       <label for="email"><?php echo $this->lang->line('Email'); ?></label>
                       <input type="text" class="form-control" id="email" name="email" 
                       value="<?php echo set_value('email'); ?>" autocomplete="off"/>  
                     </div>
                   </div> 
                 </div>
                 <div class="row">
                  <div class="col-md-12 col-xs-2">
                    <div class="form-group">
                      <label for="website"><?php echo $this->lang->line('Website'); ?></label>
                      <input type="text" class="form-control" id="website" name="website" 
                      value="<?php echo set_value('website'); ?>" autocomplete="off"/>  
                    </div>        
                  </div>   
                </div>
                <div class="row">
                  <div class="col-md-12 col-xs-2">
                    <div class="form-group">
                     <label for="contact_number"><?php echo $this->lang->line('Contact Number'); ?></label>
                     <input type="text" class="form-control" id="contact_number" name="contact_number" 
                     value="<?php echo set_value('contact_number'); ?>" autocomplete="off"/>  
                   </div>
                 </div> 
               </div>
               <div class="row">
                <div class="col-md-12 col-xs-2">
                  <div class="form-group">
                    <label for="active"><?php echo $this->lang->line('Active'); ?> <font color="red">*</font></label>          
                                              <div class="radio">
                      <label><input type="radio" name="active" id="active" value="1" checked="checked" >Active&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      <label><input type="radio" name="active" id="active" value="2" >Inactive</label>
                  </div>   
                  </div>        
                </div>  
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xs-2">
          <div class="box box-primary with-border">
            <div class="box-header with-border">
              <h3 class="box-title">Remarks</h3>
            </div>
            <div class="box-body">
             <div class="row">
              <div class="col-md-12 col-xs-2">
                <div class="form-group">
                  <textarea type="text" class="form-control" id="remark" name="remark" autocomplete="off">
                    <?php echo set_value('remark'); ?>
                  </textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- /.box-body -->

<div class="box-footer">
  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save'); ?></button>
  <a href="<?php echo base_url('association/') ?>" class="btn btn-warning"><?php echo $this->lang->line('Back'); ?></a>
</div>
</form>       <!-- /.box-body -->
</div>        <!-- /.box -->
</div>      <!-- col-md-12 -->
</div>    <!-- /.row -->


</section>  <!-- /.content -->
</div>  <!-- /.content-wrapper -->





<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    $('#region').change(function(){
      var region_id = $('#region').val();
      if(region_id != '')
      {
       $.ajax({
        url: base_url + 'province/fetchProvinceDataByRegion',
        method:"POST",
        data:{region_id:region_id},
        success:function(data)
        {
          $('#province').html('<option value="" hidden selected disabled>Select Province</option>');
          $('#lgu').html('<option value="" hidden selected disabled>Select LGU</option>');
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#province').html(data); 
          $('#region').click();

        }
      });
     }
     else
     {
       $('#province').html('<option value="" hidden selected disabled>Select Province</option>');
       $('#lgu').html('<option value="" hidden selected disabled>Select LGU</option>');
       $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
     }
   });

    $('#province').change(function(){
      var province_id = $('#province').val();
      if(province_id != '')
      {
       $.ajax({
        url: base_url + 'lgu/fetchLguDataByProvince',
        method:"POST",
        data:{province_id:province_id},
        success:function(data)
        {
          $('#lgu').html('<option value="" hidden selected disabled>Select LGU</option>');
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#lgu').html(data); 
          $('#province').click();     
        }
      });
     }
     else
     {
       $('#lgu').html('<option value="" hidden selected disabled>Select LGU</option>');
       $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
     }
   });

    $('#lgu').change(function(){
      var lgu_id = $('#lgu').val();
      if(lgu_id != '')
      {
       $.ajax({
        url: base_url + 'barangay/fetchBarangayDataByLgu',
        method:"POST",
        data:{lgu_id:lgu_id},
        success:function(data)
        {
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#barangay').html(data); 
          $('#lgu').click();     
        }
      });
     }
     else
     {
       $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
     }
   });

    $(".select_group").select2({width: '100%'});
    $("#remark").wysihtml5();

    $("#mainAssociationNav").addClass('active');
    $("#addAssociationNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>'; 
    $("#association_image").fileinput({
      overwriteInitial: true,
      maxFileSize: 1500,
      showClose: false,
      showCaption: false,
      browseLabel: '',
      removeLabel: '',
      browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
      removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-1',
      msgErrorClass: 'alert alert-block alert-danger',
      layoutTemplates: {main2: '{preview} ' +  ' {remove} {browse}'}, 
      allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#associationNav").addClass('active');
    $("#message").wysihtml5();
  });
</script>

