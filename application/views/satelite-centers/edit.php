<div id="main">
  <div class="main-container">
    <div class="page-header-card mb-4">
      <div>
        <h4><i class="ph ph-pencil-simple me-2 text-primary"></i>Edit Satellite Center</h4>
        <p>Update information for the selected satellite center.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('satellite_centers') ?>" class="text-decoration-none">Satellite Centers</a></li>
          <li class="breadcrumb-item active">Edit Center</li>
        </ol>
      </nav>
    </div>

    <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <?php if(validation_errors()): ?>
            <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-0 rounded-3 mb-4 p-3">
              <i class="ph ph-warning-circle mb-2 fs-5"></i>
              <div class="small fw-medium"><?php echo validation_errors(); ?></div>
            </div>
          <?php endif; ?>

          <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
            <form role="form" action="<?php echo base_url('satellite_centers/update/'.$satellite_data['id']) ?>" method="post">
              <div class="card-body p-4">
                <div class="row g-4">
                  <div class="col-md-12">
                    <label for="satellite_name" class="form-label fw-bold">Satellite Center Name <font color="red">*</font></label>
                    <input type="text" class="form-control rounded-3" id="satellite_name" name="satellite_name" value="<?php echo $satellite_data['satellite_name']; ?>" placeholder="Enter name of the center" autocomplete="off"/>
                  </div>

                  <div class="col-md-6">
                    <label for="region" class="form-label fw-bold">Region <font color="red">*</font></label>
                    <select class="form-select rounded-3" id="region" name="region">
                      <option value="">Select Region</option> 
                      <?php foreach ($region as $k => $v): ?>
                        <option value="<?php echo $v['region_id'] ?>" <?php if($satellite_data['region_id'] == $v['region_id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="province" class="form-label fw-bold">Province <font color="red">*</font></label>
                    <select class="form-select rounded-3" id="province" name="province">
                      <option value="">Select Province</option> 
                      <?php foreach ($province as $k => $v): ?>
                        <option value="<?php echo $v['province_id'] ?>" <?php if($satellite_data['province_id'] == $v['province_id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="municipality" class="form-label fw-bold">Municipality <font color="red">*</font></label>
                    <select class="form-select rounded-3" id="municipality" name="municipality">
                      <option value="">Select Municipality</option> 
                      <?php foreach ($municipality as $k => $v): ?>
                        <option value="<?php echo $v['municipality_id'] ?>" <?php if($satellite_data['municipality_id'] == $v['municipality_id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="barangay" class="form-label fw-bold">Barangay <font color="red">*</font></label>
                    <select class="form-select rounded-3" id="barangay" name="barangay">
                      <option value="">Select Barangay</option> 
                      <?php foreach ($barangay as $k => $v): ?>
                        <option value="<?php echo $v['barangay_id'] ?>" <?php if($satellite_data['barangay_id'] == $v['barangay_id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="coordinate" class="form-label fw-bold">Coordinate (Lat, Long)</label>
                    <input type="text" class="form-control rounded-3" id="coordinate" name="coordinate" value="<?php echo $satellite_data['coordinate']; ?>" placeholder="Example: 16.612, 120.316" autocomplete="off"/>
                    <div class="form-text small text-muted">Paste coordinates from Google Maps for precise pinning.</div>
                  </div>

                  <div class="col-md-12">
                    <label for="map" class="form-label fw-bold">Google Maps Link</label>
                    <textarea class="form-control rounded-3" id="map" name="map" rows="2" placeholder="Paste the full Google Maps URL here..."><?php echo $satellite_data['map']; ?></textarea>
                  </div>
                </div>
              </div>

              <div class="card-footer bg-light p-4 border-0 d-flex justify-content-end gap-2">
                <a href="<?php echo base_url('satellite_centers/') ?>" class="btn btn-light px-4 rounded-3">Cancel</a>
                <button type="submit" class="btn btn-primary px-4 rounded-3">Update Center</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    $("#satelliteCentersNav").addClass('active');

    $('#region').change(function(){
      var region_id = $('#region').val();
      if(region_id != '') {
        $.ajax({
          url: base_url + 'province/fetchProvinceDataByRegion',
          method:"POST",
          data:{region_id:region_id},
          success:function(data) {
            $('#province').html(data); 
            $('#municipality').html('<option value="" hidden selected disabled>Select Municipality</option>');
            $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          }
        });
      }
    });

    $('#province').change(function(){
      var province_id = $('#province').val();
      if(province_id != '') {
        $.ajax({
          url: base_url + 'municipality/fetchMunicipalityDataByProvince',
          method:"POST",
          data:{province_id:province_id},
          success:function(data) {
            $('#municipality').html(data); 
            $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          }
        });
      }
    });

    $('#municipality').change(function(){
      var municipality_id = $('#municipality').val();
      if(municipality_id != '') {
        $.ajax({
          url: base_url + 'barangay/fetchBarangayDataByMunicipality',
          method:"POST",
          data:{municipality_id:municipality_id},
          success:function(data) {
            $('#barangay').html(data); 
          }
        });
      }
    });
  });
</script>
