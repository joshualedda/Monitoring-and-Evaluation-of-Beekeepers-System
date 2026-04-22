<div id="main">
  <div class="main-container">
    <!-- ── Page Header ──────────────────────────────────────── -->
    <div class="page-header-card mb-4">
      <div>
        <div class="d-flex align-items-center gap-3 mb-2">
            <h4 class="mb-0"><i class="ph ph-user-circle-gear me-2 text-primary"></i><?php echo $this->lang->line('Edit Beekeeper'); ?></h4>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-3"><?php echo $beekeeper_data['beekeeper_register_id']; ?></span>
        </div>
        <p class="text-secondary mb-0">Managing profile: <strong><?php echo $beekeeper_data['beekeeper_name']; ?></strong></p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none text-secondary small text-secondary">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('beekeeper') ?>" class="text-decoration-none text-secondary small text-secondary"><?php echo $this->lang->line('Beekeeper'); ?></a></li>
          <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Edit'); ?></li>
        </ol>
      </nav>
    </div>

    <!-- ── Main Content ──────────────────────────────────────── -->
    <section class="content">
      <div id="messages"></div>

      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
          <i class="ph ph-check-circle me-2"></i><?php echo $this->session->flashdata('success'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php elseif($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
          <i class="ph ph-warning-circle me-2"></i><?php echo $this->session->flashdata('error'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php elseif($this->session->flashdata('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
          <i class="ph ph-warning me-2"></i><?php echo $this->session->flashdata('warning'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <?php if(validation_errors()): ?>
        <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-0 rounded-3 mb-4 p-3">
          <div class="small fw-medium"><?php echo validation_errors(); ?></div>
        </div>
      <?php endif; ?>

      <!-- ── Tabbed Card ──────────────────────────────────────── -->
      <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-header bg-transparent border-bottom border-light pt-3 px-4 pb-0">
          <ul class="nav nav-tabs border-0" id="beekeeperTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link <?php echo (($active_tab === 'beekeeper') ? 'active' : ''); ?>" id="profile-tab" data-bs-toggle="tab" data-bs-target="#beekeeper" type="button" role="tab">
                <i class="ph ph-user me-2"></i><?php echo $this->lang->line('Beekeeper'); ?>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link <?php echo (($active_tab === 'apiary') ? 'active' : ''); ?>" id="apiary-tab" data-bs-toggle="tab" data-bs-target="#apiary" type="button" role="tab">
                <i class="ph ph-house-line me-2"></i><?php echo $this->lang->line('Apiary'); ?>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link <?php echo (($active_tab === 'inquiry') ? 'active' : ''); ?>" id="inquiry-tab" data-bs-toggle="tab" data-bs-target="#inquiry" type="button" role="tab">
                <i class="ph ph-question me-2"></i><?php echo $this->lang->line('Inquiries'); ?>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link <?php echo (($active_tab === 'document') ? 'active' : ''); ?>" id="document-tab" data-bs-toggle="tab" data-bs-target="#document" type="button" role="tab">
                <i class="ph ph-files me-2"></i><?php echo $this->lang->line('Documents'); ?>
              </button>
            </li>
          </ul>
        </div>

        <div class="tab-content border-0">
          
          <!-- ── Tab 1: Beekeeper Information ────────────────── -->
          <div class="tab-pane fade <?php echo (($active_tab === 'beekeeper') ? 'show active' : '') ?>" id="beekeeper" role="tabpanel">
            <form role="form" action="<?php echo base_url('beekeeper/update/'.$beekeeper_data['id']) ?>" method="post" enctype="multipart/form-data">
              <div class="card-body p-4">
                <div class="row g-4">
                  <!-- Personal Info Column -->
                  <div class="col-lg-7">
                    <div class="p-4 border border-light rounded-4 bg-light bg-opacity-25 h-100">
                      <h6 class="fw-bold text-dark mb-4 py-1 border-bottom border-primary border-2 d-inline-block">
                        <i class="ph ph-user-focus me-2"></i>Personal Information
                      </h6>
                      
                      <div class="row g-3">
                        <div class="col-md-4">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Beekeeper Id'); ?></label>
                          <input type="text" class="form-control" name="beekeeper_register_id" value="<?php echo set_value('beekeeper_register_id', $beekeeper_data['beekeeper_register_id']); ?>" autocomplete="off" />
                          <input type="hidden" name="directory" value="<?php echo $beekeeper_data['directory']; ?>" />
                        </div>
                        <div class="col-md-8">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Beekeeper Name'); ?> <font color="red">*</font></label>
                          <input type="text" class="form-control" name="beekeeper_name" value="<?php echo set_value('beekeeper_name', $beekeeper_data['beekeeper_name']); ?>" autocomplete="off" />
                        </div>

                        <div class="col-md-6">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Gender'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="gender" name="gender">
                            <option value="">Select Gender</option> 
                            <?php foreach ($gender as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>"<?php if(set_value('gender', $beekeeper_data['gender_id']) == $v['id']) { echo " selected"; } ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>	
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Birth Date'); ?><font color="red">*</font></label>
                          <input type="date" class="form-control" name="birth_date" value="<?php echo set_value('birth_date', $beekeeper_data['birthdate']); ?>" autocomplete="off" />
                        </div>

                        <div class="col-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Nationality'); ?> <font color="red">*</font></label>
                          <?php $nationality_data = json_decode($beekeeper_data['nationality_id']); ?>
                          <select class="form-select select_group" id="nationality" name="nationality[]" multiple="multiple">
                            <?php foreach ($nationality as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>" <?php if ($nationality_data && in_array($v['id'], $nationality_data)) { echo 'selected'; } ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>

                        <div class="col-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Highest Educational Attainment'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="education" name="education">
                            <option value="">Select Attainment</option>
                            <?php foreach ($education as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>"<?php if(set_value('education', $beekeeper_data['education_id']) == $v['id']) { echo " selected"; } ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>	
                          </select>
                        </div>

                        <!-- Location Section -->
                        <div class="col-12 mt-4">
                          <h6 class="fw-bold text-dark mb-3 small text-uppercase text-muted border-bottom pb-2">Location Information</h6>
                        </div>

                        <div class="col-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Address'); ?> <font color="red">*</font></label>
                          <input type="text" class="form-control border-primary border-opacity-25" name="address" value="<?php echo set_value('address', $beekeeper_data['address']); ?>" autocomplete="off" />
                        </div>

                        <div class="col-md-4">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Region'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="region" name="region">
                            <option value="">Select Region</option> 
                            <?php foreach ($region as $k => $v): ?>
                              <option value="<?php echo $v['region_id'] ?>" <?php echo set_select('region', $v['region_id'], ($beekeeper_data['region_id'] == $v['region_id'])); ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Province'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="province" name="province">
                            <option value="">Select Province</option> 
                            <?php foreach ($province as $k => $v): ?>
                              <?php 
                                $selected_region = set_value('region', $beekeeper_data['region_id']);
                                if($selected_region && $v['regCode'] == $this->model_region->getRegionData($selected_region)['regCode']): 
                              ?>
                                <option value="<?php echo $v['province_id'] ?>" <?php echo set_select('province', $v['province_id'], ($beekeeper_data['province_id'] == $v['province_id'])); ?>><?php echo $v['name'] ?></option>
                              <?php endif; ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Municipality'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="municipality" name="municipality">
                            <option value="">Select Municipality</option> 
                            <?php foreach ($municipality as $k => $v): ?>
                              <?php 
                                $selected_province = set_value('province', $beekeeper_data['province_id']);
                                if($selected_province && $v['provCode'] == $this->model_province->getProvinceData($selected_province)['provCode']): 
                              ?>
                                <option value="<?php echo $v['municipality_id'] ?>" <?php echo set_select('municipality', $v['municipality_id'], ($beekeeper_data['municipality_id'] == $v['municipality_id'])); ?>><?php echo $v['name'] ?></option>
                              <?php endif; ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="col-md-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Barangay'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="barangay" name="barangay">
                            <option value="">Select Barangay</option> 
                            <?php foreach ($barangay as $k => $v): ?>
                              <?php 
                                $selected_municipality = set_value('municipality', $beekeeper_data['municipality_id']);
                                if($selected_municipality && $v['citymunCode'] == $this->model_municipality->getMunicipalityData($selected_municipality)['citymunCode']): 
                              ?>
                                <option value="<?php echo $v['barangay_id'] ?>" <?php echo set_select('barangay', $v['barangay_id'], ($beekeeper_data['barangay_id'] == $v['barangay_id'])); ?>><?php echo $v['name'] ?></option>
                              <?php endif; ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Other Info Column -->
                  <div class="col-lg-5">
                    <div class="p-4 border border-light rounded-4 h-100">
                      <h6 class="fw-bold text-dark mb-4 py-1 border-bottom border-primary border-2 d-inline-block">
                        <i class="ph ph-info me-2"></i>Other Details
                      </h6>
                      
                      <div class="row g-3">
                        <div class="col-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Fund Source'); ?> <font color="red">*</font></label>
                          <?php $fund_source_data = json_decode($beekeeper_data['fund_source_id']); ?>
                          <select class="form-select select_group" id="fund_source" name="fund_source[]" multiple="multiple">
                            <?php foreach ($fund_source as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php if ($fund_source_data && in_array($v['id'], $fund_source_data)) { echo 'selected'; } ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>

                        <div class="col-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Category'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="category" name="category">
                            <option value="">Select Category</option>
                            <?php foreach ($category as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>"<?php if(set_value('category', $beekeeper_data['category_id']) == $v['id']) { echo " selected"; } ?>><?php echo $v['name'] ?></option>
                            <?php endforeach ?>	
                          </select>
                        </div>

                        <div class="col-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Association'); ?> <font color="red">*</font></label>
                          <select class="form-select select_group" id="association" name="association">
                            <option value="">Select Association</option>
                            <?php foreach ($association as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>"<?php if(set_value('association', $beekeeper_data['association_id']) == $v['id']) { echo " selected"; } ?>><?php echo $v['association_name'] ?></option>
                            <?php endforeach ?>	
                          </select>
                        </div>

                        <div class="col-12 mt-4">
                          <h6 class="fw-bold text-dark mb-3 small text-uppercase text-muted border-bottom pb-2">Contact Channels</h6>
                        </div>

                        <div class="col-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Email'); ?></label>
                          <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ph ph-envelope"></i></span>
                            <input type="text" class="form-control border-start-0" name="email" value="<?php echo set_value('email', $beekeeper_data['email']); ?>" autocomplete="off" />
                            <a href="mailto:<?php echo $beekeeper_data['email']; ?>" class="btn btn-light border-start border-light"><i class="ph ph-paper-plane-tilt"></i></a>
                          </div>
                        </div>

                        <div class="col-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Contact Number'); ?></label>
                          <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ph ph-phone"></i></span>
                            <input type="text" class="form-control border-start-0" name="contact_number" value="<?php echo set_value('contact_number', $beekeeper_data['contact_number']); ?>" autocomplete="off" />
                          </div>
                        </div>

                        <div class="col-12">
                          <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Website'); ?></label>
                          <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ph ph-globe"></i></span>
                            <input type="text" class="form-control border-start-0" name="website" value="<?php echo set_value('website', $beekeeper_data['website']); ?>" autocomplete="off" />
                          </div>
                        </div>

                        <div class="col-12 pt-3">
                          <label class="form-label fw-semibold text-secondary small text-uppercase d-block mb-3"><?php echo $this->lang->line('Status'); ?></label>
                          <div class="modern-radio-group">
                            <div class="modern-radio-item">
                              <input type="radio" name="active" id="active_1" value="1" <?php if($beekeeper_data['active']=='1') echo "checked='checked'"; ?>>
                              <label for="active_1"><i class="ph ph-check-circle me-2"></i>Active</label>
                            </div>
                            <div class="modern-radio-item">
                              <input type="radio" name="active" id="active_2" value="2" <?php if($beekeeper_data['active']=='2') echo "checked='checked'"; ?>>
                              <label for="active_2"><i class="ph ph-x-circle me-2"></i>Inactive</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Remarks -->
                  <div class="col-12">
                    <div class="p-4 border border-light rounded-4">
                      <h6 class="fw-bold text-dark mb-3 small text-uppercase text-muted border-bottom pb-2">
                        <i class="ph ph-chat-centered-dots me-2"></i>Remarks & Additional Notes
                      </h6>
                      <textarea class="form-control" id="remark" name="remark" rows="4"><?php echo set_value('remark', $beekeeper_data['remark']); ?></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-footer bg-transparent border-top border-light py-4 px-4 d-flex gap-2 justify-content-end">
                <a href="<?php echo base_url('beekeeper/') ?>" class="btn btn-light px-4 py-2 fw-medium rounded-3"><i class="ph ph-x me-2"></i><?php echo $this->lang->line('Close'); ?></a>
                <a href="<?php echo base_url('report0B/REP0B/'.$beekeeper_data['id']); ?>" target="_blank" class="btn btn-success px-4 py-2 fw-medium rounded-3 shadow-sm"><i class="ph ph-printer me-2"></i>Print Report</a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
                  <i class="ph ph-floppy-disk me-2"></i> <?php echo $this->lang->line('Save Changes'); ?>
                </button>
              </div>
            </form>
          </div>

          <!-- ── Tab 2: Apiaries ──────────────────────────────── -->
          <div class="tab-pane fade <?php echo (($active_tab === 'apiary') ? 'show active' : '') ?>" id="apiary" role="tabpanel">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark mb-0"><i class="ph ph-house-line me-2 text-primary"></i>Linked Apiaries</h5>
                <?php if(in_array('createApiary', $user_permission)): ?>
                    <a href="<?php echo base_url('apiary/create/'.$beekeeper_data['id']); ?>" class="btn btn-primary px-4 rounded-3 shadow-sm">
                        <i class="ph ph-plus-circle me-2"></i><?php echo $this->lang->line('Add Apiary'); ?>
                    </a>
                <?php endif; ?>
              </div>

              <div class="table-responsive datatable-wrapper">
                <table id="manageTableApiary" class="table align-middle w-100 mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary small fw-bold"><?php echo $this->lang->line('Apiary Location'); ?></th>
                      <th class="text-uppercase text-secondary small fw-bold"><?php echo $this->lang->line('Area Size'); ?></th>
                      <th class="text-uppercase text-secondary small fw-bold"><?php echo $this->lang->line('Source'); ?></th>
                      <th class="text-uppercase text-secondary small fw-bold"><?php echo $this->lang->line('Topography'); ?></th>
                      <?php if(in_array('updateApiary', $user_permission) || in_array('deleteApiary', $user_permission)): ?>
                      <th class="text-uppercase text-secondary small fw-bold text-end"><?php echo $this->lang->line('Action'); ?></th>
                      <?php endif; ?>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>

          <!-- ── Tab 3: Inquiries ─────────────────────────────── -->
          <div class="tab-pane fade <?php echo (($active_tab === 'inquiry') ? 'show active' : '') ?>" id="inquiry" role="tabpanel">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark mb-0"><i class="ph ph-question me-2 text-primary"></i>Service Inquiries</h5>
                <?php if(in_array('createInquiry', $user_permission)): ?>
                    <button class="btn btn-primary px-4 rounded-3 shadow-sm" data-bs-toggle="modal" onclick="createFunc()" data-bs-target="#createModalInquiry">
                        <i class="ph ph-plus-circle me-2"></i><?php echo $this->lang->line('Add Inquiry'); ?>
                    </button>
                <?php endif; ?>
              </div>

              <div class="table-responsive datatable-wrapper">
                <table id="manageTableInquiry" class="table align-middle w-100 mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary small fw-bold"><?php echo $this->lang->line('Inquiry Type'); ?></th>
                      <th class="text-uppercase text-secondary small fw-bold"><?php echo $this->lang->line('Support Type'); ?></th>
                      <th class="text-uppercase text-secondary small fw-bold"><?php echo $this->lang->line('Request'); ?></th> 
                      <th class="text-uppercase text-secondary small fw-bold"><?php echo $this->lang->line('Feedback'); ?></th>		  
                      <th class="text-uppercase text-secondary small fw-bold"><?php echo $this->lang->line('Date'); ?></th> 								
                      <th class="text-uppercase text-secondary small fw-bold text-end pe-3"><?php echo $this->lang->line('Action'); ?></th>
                    </tr>
                  </thead>
                </table>  
              </div>
            </div>
          </div>

          <!-- ── Tab 4: Documents ─────────────────────────────── -->
          <div class="tab-pane fade <?php echo (($active_tab === 'document') ? 'show active' : '') ?>" id="document" role="tabpanel">
            <div class="card-body p-4">
                <?php if(in_array('createDocument', $user_permission)): ?>
                <div class="bg-light bg-opacity-50 p-4 border border-light rounded-4 mb-5">
                    <h6 class="fw-bold text-dark mb-4 small text-uppercase text-muted border-bottom border-light pb-2">
                        <i class="ph ph-upload-simple me-2"></i>Upload New File
                    </h6>
                    <?php echo form_open_multipart('beekeeper/uploadDocument/' . $beekeeper_data['id'], 'class="row g-3 align-items-end"') ?>
                        <div class="col-md-5">
                            <label class="form-label text-secondary small fw-bold">Type of document <span class="text-danger">*</span></label>
                            <select class="form-control select_group" name="document_type" required>
                                <option value="" hidden selected disabled>Select Type</option>
                                <?php foreach ($document_type as $k => $v): ?>
                                    <option value="<?php echo $v['id'] ?>" ><?php echo $v['name'] ?></option>
                                <?php endforeach ?> 
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label text-secondary small fw-bold">Select File <span class="text-danger">*</span></label>
                            <input type="file" required="required" name="beekeeper_document" class="form-control" />
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-semibold">
                                <i class="ph ph-plus-circle me-1"></i> Add
                            </button>
                        </div>
                    <?php echo "</form>"?>
                </div>
                <?php endif; ?>

                <!-- Modern Card Gallery -->
                <div id="documentGallery" class="row g-3 px-3 pb-4 mt-1">
                    <!-- Cards will be rendered here by JS -->
                    <div class="col-12 text-center py-5 text-muted small">
                        <div class="ph-duotone ph-file-dashed fs-1 mb-2 opacity-50"></div>
                        <p>No documents found</p>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- ── Modals ── -->

<!-- Inquiry Modals -->
<?php if(in_array('createInquiry', $user_permission)): ?>
<div class="modal fade" id="createModalInquiry" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-bottom border-light p-4">
        <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-plus-circle text-primary me-2"></i>Add Inquiry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form role="form" action="<?php echo base_url('inquiry/create') ?>" id="createFormInquiry">
        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label fw-bold text-secondary small text-uppercase">Inquiry Type <font color="red">*</font></label>
            <select name="inquiry_type" id="inquiry_type" class="form-control select2_modal" style="width:100%"><option value="">Select Type</option></select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-secondary small text-uppercase">Support Type <font color="red">*</font></label>
            <select name="support_type" id="support_type" class="form-control select2_modal" style="width:100%"><option value="">Select Type</option></select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-secondary small text-uppercase">Request</label>
            <textarea class="form-control" name="request" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-secondary small text-uppercase">Feedback</label>
            <textarea class="form-control" name="feedback" rows="2"></textarea>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold text-secondary small text-uppercase">Date</label>
              <input type="date" class="form-control" name="inquiry_date">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold text-secondary small text-uppercase">Answered by</label>
              <input type="text" class="form-control" name="answered_by">
            </div>
          </div>
        </div>
        <div class="modal-footer border-top border-light p-4 pt-0">
          <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary rounded-3 px-4">Save Inquiry</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(in_array('updateInquiry', $user_permission)): ?>
<div class="modal fade" id="editModalInquiry" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-bottom border-light p-4">
        <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-pencil-simple-line text-primary me-2"></i>Edit Inquiry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form role="form" action="<?php echo base_url('inquiry/update') ?>" id="editFormInquiry">
        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label fw-bold text-secondary small text-uppercase">Inquiry Type <font color="red">*</font></label>
            <select name="edit_inquiry_type" id="edit_inquiry_type" class="form-control select2_modal" style="width:100%"></select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-secondary small text-uppercase">Support Type <font color="red">*</font></label>
            <select name="edit_support_type" id="edit_support_type" class="form-control select2_modal" style="width:100%"></select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-secondary small text-uppercase">Request</label>
            <textarea class="form-control" id="edit_request" name="edit_request" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-secondary small text-uppercase">Feedback</label>
            <textarea class="form-control" id="edit_feedback" name="edit_feedback" rows="2"></textarea>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold text-secondary small text-uppercase">Date</label>
              <input type="date" class="form-control" id="edit_inquiry_date" name="edit_inquiry_date">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold text-secondary small text-uppercase">Answered by</label>
              <input type="text" class="form-control" id="edit_answered_by" name="edit_answered_by">
            </div>
          </div>
        </div>
        <div class="modal-footer border-top border-light p-4 pt-0">
          <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary rounded-3 px-4">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Delete Modals -->
<?php if(in_array('deleteApiary', $user_permission)): ?>
<div class="modal fade" id="removeApiaryModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom border-light p-4">
        <h5 class="fw-bold mb-0 text-danger-emphasis"><i class="ph ph-warning-octagon me-2"></i>Delete Apiary</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form role="form" action="<?php echo base_url('apiary/remove') ?>" id="removeFormApiary">
        <div class="modal-body p-4">
          <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-0 rounded-3 mb-3 p-3 small">
            <i class="ph ph-warning me-2"></i>This action is permanent and cannot be undone.
          </div>
          <p class="mb-0 text-dark fw-medium">Are you sure you want to delete this apiary and all associated records (colony, production, inquiry)?</p>
        </div>
        <div class="modal-footer border-top border-light p-4 pt-0 justify-content-center">
          <button type="button" class="btn btn-light px-4 rounded-3" data-bs-dismiss="modal">Keep Apiary</button>
          <button type="submit" class="btn btn-danger px-4 rounded-3 shadow-none">Yes, Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(in_array('deleteDocument', $user_permission)): ?>
<div class="modal fade" id="removeDocumentModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom border-light p-4 text-center d-block">
        <div class="text-danger mb-3"><i class="ph ph-trash fs-1"></i></div>
        <h5 class="fw-bold mb-1 text-dark">Remove Document?</h5>
        <p class="text-muted small mb-0">This file will be permanently deleted.</p>
      </div>
      <form role="form" action="<?php echo base_url('beekeeper/removeDocument') ?>" id="removeFormDocument">
        <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
          <button type="button" class="btn btn-light px-4 rounded-3" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger px-4 rounded-3">Confirm Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ── Javascript ── -->
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  var manageTableApiary, manageTableInquiry, manageTableDocument;

  $(document).ready(function() {
    
    // Tab Active States handling
    $('.nav-link').on('click', function(){
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
    });

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

    // Modal selects
    $(".select2_modal").select2({
        width: '100%',
        dropdownParent: $("#createModalInquiry")
    });
    $("#edit_inquiry_type, #edit_support_type").select2({
        width: '100%',
        dropdownParent: $("#editModalInquiry")
    });

    if ($.fn.wysihtml5) { $("#remark").wysihtml5(); }

    // Init DataTables
    manageTableApiary = $('#manageTableApiary').DataTable({
      'ajax': base_url+'apiary/fetchApiaryBeekeeper/'+'<?php echo $beekeeper_data['id']; ?>',
      'language': {'url': "<?php echo $this->session->link_language; ?>"}, 
      'order': [[0, 'asc']],
      'dom': 'rt<"px-3 pb-3 d-flex justify-content-between align-items-center"ip>',
      'columnDefs': [{ targets: -1, className: 'text-end' }]
    });

    manageTableInquiry = $('#manageTableInquiry').DataTable({
      'ajax': base_url+'inquiry/fetchInquiryBeekeeper/'+'<?php echo $beekeeper_data['id']; ?>',
      'language': {'url': "<?php echo $this->session->link_language; ?>"}, 
      'order': [[4, 'desc']],
      'dom': 'rt<"px-3 pb-3 d-flex justify-content-between align-items-center"ip>',
      'columnDefs': [{ targets: -1, className: 'text-end pe-3' }]
    });

    // Replaced DataTable with Card Gallery
    function renderDocuments() {
      $.ajax({
        url: base_url + 'beekeeper/fetchBeekeeperDocument/',
        type: 'POST',
        data: {document_beekeeper_id: '<?php echo $beekeeper_data['id']; ?>'},
        dataType: 'json',
        success: function(response) {
          var gallery = $('#documentGallery');
          gallery.empty();
          
          if(response.data.length === 0) {
            gallery.append('<div class="col-12 text-center py-5 text-muted small"><div class="ph-duotone ph-file-dashed fs-1 mb-2 opacity-50"></div><p>No documents found</p></div>');
            return;
          }

          response.data.forEach(function(doc) {
            var iconClass = 'ph-file';
            var colorClass = 'text-primary';
            var ext = doc.doc_name.split('.').pop().toLowerCase();
            
            if(['pdf'].includes(ext)) { iconClass = 'ph-file-pdf'; colorClass = 'text-danger'; }
            else if(['doc', 'docx'].includes(ext)) { iconClass = 'ph-file-doc'; colorClass = 'text-primary'; }
            else if(['xls', 'xlsx'].includes(ext)) { iconClass = 'ph-file-xls'; colorClass = 'text-success'; }
            else if(['jpg', 'jpeg', 'png', 'gif'].includes(ext)) { iconClass = 'ph-file-image'; colorClass = 'text-warning'; }
            else if(['pptx', 'ppt'].includes(ext)) { iconClass = 'ph-file-ppt'; colorClass = 'text-orange'; }

            var card = `
              <div class="col-md-4 col-lg-3">
                <div class="card h-100 border border-light shadow-sm hover-shadow transition-all rounded-4 overflow-hidden">
                  <div class="card-body p-3">
                    <div class="d-flex align-items-center mb-3">
                      <div class="p-2 bg-light rounded-3 me-3">
                        <i class="ph-duotone ${iconClass} fs-3 ${colorClass}"></i>
                      </div>
                      <div class="overflow-hidden">
                        <h6 class="mb-0 text-dark fw-bold text-truncate small" title="${doc.doc_name}">${doc.doc_name}</h6>
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-normal py-1 px-2 rounded-2 mt-1" style="font-size: 0.65rem;">
                          ${doc.type_name}
                        </span>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top border-light">
                      <span class="text-muted small">${doc.doc_size} KB</span>
                      <div class="d-flex gap-1">
                        <a href="${doc.doc_link}" target="_blank" class="btn btn-sm btn-light border-0 rounded-3 text-primary shadow-none" title="View">
                          <i class="ph ph-eye"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-light border-0 rounded-3 text-danger shadow-none" title="Delete" onclick="removeDocument(${doc.id})" data-bs-toggle="modal" data-bs-target="#removeDocumentModal">
                          <i class="ph ph-trash"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>`;
            gallery.append(card);
          });
        }
      });
    }

    renderDocuments();
    });

    // Inquiry Dropdown Loaders
    var it_select = $('#inquiry_type, #edit_inquiry_type');
    $.ajax({
      url: base_url+'inquiry_type/fetchActiveInquiryType',
      dataType: "JSON", 
      success: function (data) {
        $.each(data, function (key, val) { it_select.append('<option value="' + val.id + '">' + val.name + '</option>'); }); 
      }
    });

    var st_select = $('#support_type, #edit_support_type');
    $.ajax({
      url: base_url+'support_type/fetchActiveSupportType',
      dataType: "JSON", 
      success: function (data) {
        $.each(data, function (key, val) { st_select.append('<option value="' + val.id + '">' + val.name + '</option>'); });  
      }
    });

    // Form Submissions
    $("#createFormInquiry").on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        type: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success:function(response) {
          if(response.success === true) {
            $("#createModalInquiry").modal('hide');
            manageTableInquiry.ajax.reload(null, false);
            $(this)[0].reset();
          }
        }
      });
    });

    // Remove handlers
    $("#removeFormApiary").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                $("#removeApiaryModal").modal('hide');
                manageTableApiary.ajax.reload(null, false);
            }
        });
    });

    $("#removeFormDocument").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                $("#removeDocumentModal").modal('hide');
                manageTableDocument.ajax.reload(null, false);
            }
        });
    });

    // Active link states
    $("#mainBeekeeperNav").addClass('active');
    $("#manageBeekeeperNav").addClass('active');

  });

  // Global functions for buttons in DataTables
  function createFunc() { 
    $("#createFormInquiry")[0].reset(); 
    $(".select2_modal").val(null).trigger('change');
  }

  function removeApiary(id) {
    $("#removeFormApiary").unbind('submit').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: { apiary_id:id }, 
            dataType: 'json',
            success:function(res) {
                $("#removeApiaryModal").modal('hide');
                manageTableApiary.ajax.reload(null, false);
            }
        });
        return false;
    });
  }

  function editInquiry(id) { 
    $.ajax({
      url: base_url + 'inquiry/fetchInquiryDataById/'+id,
      type: 'post',
      dataType: 'json',
      success:function(res) {
        $('#edit_inquiry_type').val(res.inquiry_type_id).trigger('change');
        $('#edit_support_type').val(res.support_type_id).trigger('change');
        $("#edit_request").val(res.request);	     
        $("#edit_feedback").val(res.feedback);	     
        $("#edit_answered_by").val(res.answered_by);
        $("#edit_inquiry_date").val(res.inquiry_date);

        $("#editFormInquiry").unbind('submit').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action') + '/' + id,
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success:function(response) {
                    if(response.success === true) {
                        $("#editModalInquiry").modal('hide');
                        manageTableInquiry.ajax.reload(null, false);
                    }
                }
            });
        });
      }
    });
  }

  function removeInquiry(id) {
    $("#removeFormInquiry").unbind('submit').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: { inquiry_id:id }, 
            dataType: 'json',
            success:function(res) {
                $("#removeModalInquiry").modal('hide');
                manageTableInquiry.ajax.reload(null, false);
            }
        });
    });
  }

  function removeDocument(id) {
    $("#removeFormDocument").unbind('submit').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: { document_id:id }, 
            dataType: 'json',
            success:function(res) {
                $("#removeDocumentModal").modal('hide');
                renderDocuments();
            }
        });
    });
  }
</script>