<div id="main">
  <div class="main-container">
    <!-- ── Page Header ──────────────────────────────────────── -->
    <div class="page-header-card mb-4">
      <div>
        <h4><i class="ph ph-user-plus me-2 text-primary"></i><?php echo $this->lang->line('Add Beekeeper'); ?></h4>
        <p>Register a new beekeeper in the system database.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none small text-secondary">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('beekeeper') ?>" class="text-decoration-none small text-secondary"><?php echo $this->lang->line('Beekeeper'); ?></a></li>
          <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Add Beekeeper'); ?></li>
        </ol>
      </nav>
    </div>

    <!-- ── Main Content ──────────────────────────────────────── -->
    <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div id="messages"></div>

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3 border-0 shadow-sm" role="alert">
              <i class="ph ph-check-circle me-2"></i><?php echo $this->session->flashdata('success'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3 border-0 shadow-sm" role="alert">
              <i class="ph ph-warning-circle me-2"></i><?php echo $this->session->flashdata('error'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <?php if(validation_errors()): ?>
            <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-0 rounded-3 mb-4 p-3">
              <i class="ph ph-warning-circle mb-2 fs-5"></i>
              <div class="small fw-medium"><?php echo validation_errors(); ?></div>
            </div>
          <?php endif; ?>

          <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
            <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3">
              <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-identification-card me-2 text-primary"></i>Beekeeper Registration Form</h5>
            </div>

            <form role="form" action="<?php echo base_url('beekeeper/create') ?>" method="post" enctype="multipart/form-data">
              <div class="card-body px-4 py-4">
                
                <div class="row g-4">
                  <!-- ── Left Column: Personal Information ──────────────── -->
                  <div class="col-lg-7">
                    <div class="p-4 border border-light rounded-4 bg-light bg-opacity-25 h-100">
                      <h6 class="fw-bold text-dark mb-4 py-1 border-bottom border-primary border-2 d-inline-block">
                        <i class="ph ph-user-focus me-2"></i>Personal Information
                      </h6>
                      
                      <div class="row g-3">
                        <div class="col-md-4">
                          <label for="beekeeper_register_id" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Beekeeper Id'); ?></label>
                          <input type="text" class="form-control" id="beekeeper_register_id" name="beekeeper_register_id" 
                          value="<?php echo set_value('beekeeper_register_id'); ?>" placeholder="Optional ID" autocomplete="off"/>
                        </div>
                        <div class="col-md-8">
                          <label for="beekeeper_name" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Beekeeper Name'); ?> <font color="red">*</font></label>
                          <input type="text" class="form-control" id="beekeeper_name" name="beekeeper_name"  
                          value="<?php echo set_value('beekeeper_name'); ?>" placeholder="Full legal name" autocomplete="off"/>
                        </div>

                        <div class="col-md-6">
                          <label for="gender" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Gender'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="gender" name="gender">
                            <option value="">Select Gender</option> 
                            <?php foreach ($gender as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('gender', $v['id']); ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label for="birth_date" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Birth Date'); ?><font color="red">*</font></label>
                          <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo set_value('birth_date'); ?>" autocomplete="off" />
                        </div>

                        <div class="col-12">
                          <label for="nationality" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Nationality'); ?> <font color="red">*</font></label>
                          <select class="form-control select_group" id="nationality" name="nationality[]" multiple="multiple">
                            <?php foreach ($nationality as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('nationality[]', $v['id']); ?>>
                                <?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>

                        <div class="col-12">
                          <label for="education" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Highest Educational Attainment'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="education" name="education">
                            <option value="">Select Attainment</option> 
                            <?php foreach ($education as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('education', $v['id']); ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>

                        <div class="col-12 mt-4">
                          <h6 class="fw-bold text-dark mb-3 small text-uppercase text-muted border-bottom pb-2">Location Details</h6>
                        </div>

                        <div class="col-12 text-muted small">
                          <i class="ph ph-map-pin me-1"></i> Address provided must be verifiable.
                        </div>

                        <div class="col-12">
                          <label for="address" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Address'); ?> <font color="red">*</font></label>
                          <input type="text" class="form-control border-primary border-opacity-25" id="address" name="address" 
                          value="<?php echo set_value('address'); ?>" placeholder="Street, village, or building no." autocomplete="off"/>
                        </div>

                        <div class="col-md-4">
                          <label for="region" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Region'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="region" name="region">
                            <option value="">Select Region</option> 
                            <?php foreach ($region as $k => $v): ?>
                              <option value="<?php echo $v['region_id'] ?>" <?php echo set_select('region', $v['region_id']); ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="province" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Province'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="province" name="province">
                            <option value="">Select Province</option> 
                            <?php foreach ($province as $k => $v): ?>
                              <?php if(isset($_POST["region"]) && $v['regCode']==$this->model_region->getRegionData($_POST["region"])['regCode']){ ?>
                                <option value="<?php echo $v['province_id'] ?>" <?php echo set_select('province', $v['province_id']); ?>><?php echo $v['name'] ?></option>
                              <?php } ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="municipality" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Municipality'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="municipality" name="municipality">
                            <option value="">Select Municipality</option> 
                            <?php foreach ($municipality as $k => $v): ?>
                              <?php if(isset($_POST["province"]) && $v['provCode']==$this->model_province->getProvinceData($_POST["province"])['provCode']){ ?>
                                <option value="<?php echo $v['municipality_id'] ?>" <?php echo set_select('municipality', $v['municipality_id']); ?>><?php echo $v['name'] ?></option>
                              <?php } ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="col-md-12">
                          <label for="barangay" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Barangay'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="barangay" name="barangay">
                            <option value="">Select Barangay</option> 
                            <?php foreach ($barangay as $k => $v): ?>
                              <?php if(isset($_POST["municipality"]) && $v['citymunCode']==$this->model_municipality->getMunicipalityData($_POST["municipality"])['citymunCode']){ ?>
                                <option value="<?php echo $v['barangay_id'] ?>" <?php echo set_select('barangay', $v['barangay_id']); ?>><?php echo $v['name'] ?></option>
                              <?php } ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- ── Right Column: Other Information ───────────────── -->
                  <div class="col-lg-5">
                    <div class="p-4 border border-light rounded-4 h-100">
                      <h6 class="fw-bold text-dark mb-4 py-1 border-bottom border-primary border-2 d-inline-block">
                        <i class="ph ph-info me-2"></i>Other Information
                      </h6>

                      <div class="row g-3">
                        <div class="col-12">
                          <label for="fund_source" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Fund Source'); ?> <font color="red">*</font></label>
                          <select class="form-control select_group" id="fund_source" name="fund_source[]" multiple="multiple">
                            <?php foreach ($fund_source as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('fund_source[]', $v['id']); ?>>
                                <?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>

                        <div class="col-12">
                          <label for="category" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Category'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="category" name="category">
                            <option value="">Select Category</option> 
                            <?php foreach ($category as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('category', $v['id']); ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>

                        <div class="col-12">
                          <label for="association" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Association'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="association" name="association">
                            <option value="">Select Association</option>
                            <?php foreach ($association as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" <?php echo set_select('association', $v['id']); ?>><?php echo $v['association_name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>

                        <div class="col-12 mt-4">
                          <h6 class="fw-bold text-dark mb-3 small text-uppercase text-muted border-bottom pb-2">Contact Details</h6>
                        </div>

                        <div class="col-12">
                          <label for="email" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Email'); ?></label>
                          <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ph ph-envelope"></i></span>
                            <input type="text" class="form-control border-start-0" id="email" name="email" 
                            value="<?php echo set_value('email'); ?>" placeholder="beekeeper@example.com" autocomplete="off"/>  
                          </div>
                        </div>

                        <div class="col-12">
                          <label for="contact_number" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Contact Number'); ?></label>
                          <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ph ph-phone"></i></span>
                            <input type="text" class="form-control border-start-0" id="contact_number" name="contact_number" 
                            value="<?php echo set_value('contact_number'); ?>" placeholder="+63 000 000 0000" autocomplete="off"/>  
                          </div>
                        </div>

                        <div class="col-12">
                          <label for="website" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Website'); ?></label>
                          <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ph ph-globe"></i></span>
                            <input type="text" class="form-control border-start-0" id="website" name="website" 
                            value="<?php echo set_value('website'); ?>" placeholder="www.example.com" autocomplete="off"/>  
                          </div>
                        </div>

                        <div class="col-12 pt-3">
                          <label class="form-label fw-semibold text-secondary small text-uppercase d-block mb-3"><?php echo $this->lang->line('Status'); ?></label>
                          <div class="modern-radio-group">
                            <div class="modern-radio-item">
                              <input type="radio" name="active" id="active_1" value="1" checked="checked">
                              <label for="active_1">
                                <i class="ph ph-check-circle me-2"></i> <?php echo $this->lang->line('Active'); ?>
                              </label>
                            </div>
                            <div class="modern-radio-item">
                              <input type="radio" name="active" id="active_2" value="2">
                              <label for="active_2">
                                <i class="ph ph-x-circle me-2"></i> <?php echo $this->lang->line('Inactive'); ?>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- ── Remarks ──────────────────────────────────────── -->
                  <div class="col-12">
                    <div class="p-4 border border-light rounded-4">
                      <h6 class="fw-bold text-dark mb-3 small text-uppercase text-muted border-bottom pb-2">
                        <i class="ph ph-chat-centered-dots me-2"></i>Remarks & Additional Notes
                      </h6>
                      <textarea type="text" class="form-control" id="remark" name="remark" rows="4" placeholder="Enter any extra details or observations here..."><?php echo set_value('remark'); ?></textarea>
                    </div>
                  </div>
                </div>

              </div> <!-- /.card-body -->

              <div class="card-footer bg-transparent border-top border-light py-4 px-4 d-flex gap-2 justify-content-end">
                <a href="<?php echo base_url('beekeeper/') ?>" class="btn btn-light px-4 py-2 fw-medium rounded-3"><i class="ph ph-arrow-left me-2"></i><?php echo $this->lang->line('Back'); ?></a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
                  <i class="ph ph-floppy-disk me-2"></i> <?php echo $this->lang->line('Save Beekeeper'); ?>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- ── Javascript ── -->
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    
    // Dependent Dropdowns Logic
    $('#region').change(function(){
      var region_id = $('#region').val();
      if(region_id != '') {
        $.ajax({
          url: base_url + 'province/fetchProvinceDataByRegion',
          method:"POST",
          data:{region_id:region_id},
          success:function(data) {
            $('#province').html('<option value="" hidden selected disabled>Select Province</option>');
            $('#municipality').html('<option value="" hidden selected disabled>Select Municipality</option>');
            $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
            $('#province').html(data); 
            // Trigger select2 update
            $('#province, #municipality, #barangay').trigger('change');
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
            $('#municipality').html('<option value="" hidden selected disabled>Select Municipality</option>');
            $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
            $('#municipality').html(data); 
            $('#municipality, #barangay').trigger('change');
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
            $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
            $('#barangay').html(data); 
            $('#barangay').trigger('change');
          }
        });
      }
    });

    // Init Select2 — single selects with placeholder
    $('#gender, #education, #region, #province, #municipality, #barangay, #category, #association').select2({
        width: '100%',
        placeholder: 'Select an option',
        allowClear: true
    });

    // Init Select2 — multi-selects with placeholder
    $('#nationality').select2({
        width: '100%',
        placeholder: 'Select Nationalities'
    });
    $('#fund_source').select2({
        width: '100%',
        placeholder: 'Select Fund Sources'
    });

    // Initialize Editor
    if ($.fn.wysihtml5) {
      $("#remark").wysihtml5();
    }

    // Navigation active states
    $("#mainBeekeeperNav").addClass('active');
    $("#addBeekeeperNav").addClass('active');
    
    // Multi-select placeholders
    $("#nationality").select2({ placeholder: "Select Nationalities" });
    $("#fund_source").select2({ placeholder: "Select Fund Sources" });

  });
</script>
