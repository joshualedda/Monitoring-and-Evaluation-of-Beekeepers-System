<div id="main">
  <div class="main-container">
  <div class="page-header-card">
    <div>
      <h4><i class="ph ph-plus-circle me-2 text-primary"></i><?php echo $this->lang->line('Add Apiary'); ?></h4>
    </div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 small">
        <li class="breadcrumb-item"><a href="<?php echo base_url('apiary') ?>" class="text-decoration-none small text-secondary">Home</a></li>
        <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Apiary'); ?></li>
      </ol>
    </nav>
  </div>

<!-----------------------------------------------------------  Main ------------------------------------------------------------------>

  <section class="content">

    <div class="row g-4 mb-4">
      <div class="col-md-12 col-xs-12">



        
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-pencil-line me-2 text-primary"></i>Create New Apiary</h5>
            </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('apiary/create') ?>" method="post" enctype="multipart/form-data">
              <div class="card-body px-4 py-4">

                <?php echo validation_errors(); ?>

                <!-- /row divide by 3-->
                <div class="row g-4 mb-4">
                 
                                    <div class="col-md-6 col-xs-6">
                    <div class="form-group">  
                      <label for="location" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Location'); ?> <font color="red">*</font></label>
                      <input type="text" class="form-control" id="location" name="location" autocomplete="off" 
                      value="<?php echo set_value('location'); ?>"/>
                    </div>  
                  </div>
                  <div class="col-md-6 col-xs-3">
                    <div class="form-group">
                      <label for="zip_code" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Zip Code'); ?></label>
                      <input type="text" class="form-control" id="zip_code" name="zip_code" autocomplete="off" 
                      value="<?php echo set_value('zip_code'); ?>"/>
                    </div>
                  </div>
			      

    
                </div>

                  
                <div class="form-group">
                  <label for="beekeeper" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Beekeeper Name'); ?> <font color="red">*</font></label>
                  <select class="form-control select_group" id="beekeeper_holder" name="beekeeper_holder" <?php if($fromBeekeeper!=null) echo 'disabled=disabled';?>>
                        <option value="" hidden selected disabled>Select Beekeeper</option> 
                                                   <?php foreach ($beekeeper as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" 
                                <?php if(set_value('beekeeper', isset($fromBeekeeper) ? $fromBeekeeper : '') == $v['id']) { echo "selected='selected'"; } ?> >
                                <?php echo $v['beekeeper_name'] ?>/
                                <?php echo $v['address'] ?></option>
                            <?php endforeach ?>
                      </select>
                   <input type="text" name="beekeeper" id="beekeeper" value="<?php echo $fromBeekeeper ?>" hidden>
                </div>



                <!-- /row divide by 4-->
                <div class="row g-4 mb-4">                  

                  <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="area_size" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Area Size'); ?></label>
                      <input type="text" class="form-control" id="area_size" name="area_size" autocomplete="off" 
                      value="<?php echo set_value('area_size'); ?>" />
                    </div>
                  </div> 

                  <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="coordinate" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Coordinate'); ?></label>
                      <input type="text" class="form-control" id="coordinate" name="coordinate" autocomplete="off" 
                      value="<?php echo set_value('coordinate'); ?>"/>
                    </div>
                  </div>
				  
          <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="topography" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Topography'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="topography" name="topography[]" multiple="multiple">
                        <?php foreach ($topography as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>" <?php echo set_select('topography', $v['id']); ?>>
                          <?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>  

                  <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="source" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Source'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="source" name="source[]" multiple="multiple">
                        
                        <?php foreach ($source as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>" <?php echo set_select('source', $v['id']); ?>>
                          <?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>   
                            
                </div>
                <!-- /end row divide by 4-->

                <!-- /row divide by 4-->
                <div class="row g-4 mb-4">
				
				 <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="region" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Region'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="region" name="region">
                      <option value="" hidden selected disabled>Select Region</option>
                        <?php foreach ($region as $k => $v): ?>
                        <option value="<?php echo $v['region_id'] ?>" <?php echo set_select('region', $v['region_id']); ?>>
                          <?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>	
                                              
                                  
                  <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="province" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Province'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="province" name="province">
                        <option value="" hidden selected disabled>Select Province</option>
                        <?php foreach ($province as $k => $v): ?>
                        <?php if(isset($_POST["region"]) && isset($v['regCode'])) { ?>
                        <option value="<?php echo $v['province_id'] ?>" <?php echo set_select('province', $v['province_id']); ?>>
                          <?php echo $v['name'] ?></option>
                        <?php } ?>
                        <?php endforeach ?>
                      </select>
                    </div>  
                  </div>
                  <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="municipality" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Municipality'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="municipality" name="municipality">
                        <option value="" hidden selected disabled>Select Municipality</option>
                        <?php foreach ($municipality as $k => $v): ?>
                        <?php if(isset($_POST["province"])) { ?> 
                        <option value="<?php echo $v['municipality_id'] ?>" <?php echo set_select('municipality', $v['municipality_id']); ?>>
                          <?php echo $v['name'] ?></option>
                        <?php } ?>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
				  <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="barangay" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Barangay'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="barangay" name="barangay">
                        <option value="" hidden selected disabled>Select Barangay</option>
                        <?php foreach ($barangay as $k => $v): ?>
                        <?php if(isset($_POST['municipality'])) { ?>
                        <option value="<?php echo $v['barangay_id'] ?>" <?php echo set_select('barangay', $v['barangay_id']); ?>>
                          <?php echo $v['name'] ?></option>
                        <?php } ?>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>       
				  
                </div>                            
                 
                <div class="form-group mb-4">
                  <label for="map" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Map'); ?> (Google Maps Embed Code - iframe)</label>
                  <textarea type="text" class="form-control rounded-3 border-light-subtle" id="map" name="map" autocomplete="off" rows="3"><?php echo set_value('map'); ?></textarea>
                </div>                      

                <div class="form-group mb-4">
                  <label for="remark" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Remark'); ?></label>
                  <textarea type="text" class="form-control rounded-3 border-light-subtle" id="remark" name="remark" autocomplete="off" rows="3"><?php echo set_value('remark'); ?></textarea>
                </div>  

              </div> <!-- /.card-body -->

              <div class="card-footer bg-transparent border-top border-light py-4 px-4 d-flex gap-2 justify-content-end">
                <a href="<?php echo base_url('apiary/') ?>" class="btn btn-light px-4 py-2 fw-medium rounded-3"><i class="ph ph-arrow-left me-2"></i><?php echo $this->lang->line('Back'); ?></a>
                <button onclick="removeAttribute()" type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
                  <i class="ph ph-floppy-disk me-2"></i> <?php echo $this->lang->line('Save'); ?>
                </button>
              </div>
            </form>          
        </div>          
      </div>        
    </div>  

  </section>  <!-- /.content -->
</div><!-- /.content-wrapper -->


<!-----------------------------------------------------------  Javascript ------------------------------------------------------------------>

<script type="text/javascript">
var beekeeper_holder=document.getElementById('beekeeper_holder');
beekeeper_holder.onchange=function()
{
  document.getElementById('beekeeper').value=beekeeper_holder.value;
}


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
          $('#municipality').html('<option value="" hidden selected disabled>Select Municipality</option>');
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#province').html(data); 
          $('#region').click();

        }
      });
     }
     else
     {
       $('#province').html('<option value="" hidden selected disabled>Select Province</option>');
       $('#municipality').html('<option value="" hidden selected disabled>Select Municipality</option>');
       $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
     }
   });

    $('#province').change(function(){
      var province_id = $('#province').val();
      if(province_id != '')
      {
       $.ajax({
        url: base_url + 'municipality/fetchMunicipalityDataByProvince',
        method:"POST",
        data:{province_id:province_id},
        success:function(data)
        {
          $('#municipality').html('<option value="" hidden selected disabled>Select Municipality</option>');
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#municipality').html(data); 
          $('#province').click();     
        }
      });
     }
     else
     {
       $('#municipality').html('<option value="" hidden selected disabled>Select Municipality</option>');
       $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
     }
   });

    $('#municipality').change(function(){
      var municipality_id = $('#municipality').val();
      if(municipality_id != '')
      {
       $.ajax({
        url: base_url + 'barangay/fetchBarangayDataByMunicipality',
        method:"POST",
        data:{municipality_id:municipality_id},
        success:function(data)
        {
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#barangay').html(data); 
          $('#municipality').click();     
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

    $("#topography").select2({
      placeholder: "Select  Topography"
    });
    $("#source").select2({
      placeholder: "Select Source"
    });

    $("#mainApiaryNav").addClass('active');
    $("#addApiaryNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#apiary_image").fileinput({
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
<?php $this->load->view('templates/alert'); ?>