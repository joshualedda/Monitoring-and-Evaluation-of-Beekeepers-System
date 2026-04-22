<!-- Content Wrapper -->
<div id="main">
  <div class="main-container">

  <!-- Page Header -->
  <div class="page-header-card">
    <div>
      <h4><i class="ph ph-pencil-simple me-2 text-warning"></i><?php echo $this->lang->line('Edit Apiary'); ?>: <?php echo $apiary_data['location']; ?></h4>
    </div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 small">
        <li class="breadcrumb-item"><a href="<?php echo base_url('apiary') ?>" class="text-decoration-none small text-secondary">Home</a></li>
        <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Apiary'); ?></li>
      </ol>
    </nav>
  </div>

  <section class="content">

    <div class="row g-4">
      <div class="col-md-12">



        <!-- =====================================================================
             S E C T I O N   1 :   A P I A R Y   D E T A I L S
             ===================================================================== -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3">
            <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-pencil-line me-2 text-primary"></i><?php echo $this->lang->line('Apiary Details'); ?></h5>
          </div>
          
          <form role="form" action="<?php echo base_url('apiary/update/'.$apiary_data['id']); ?>" method="post" enctype="multipart/form-data">
            <div class="card-body px-4 py-4">
              <?php echo validation_errors(); ?>

              <!-- Location & Zip -->
              <div class="row g-4 mb-4">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="location" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Location'); ?> <font color="red">*</font></label>
                    <input type="text" class="form-control" id="location" name="location" autocomplete="off"
                      value="<?php echo set_value('location', $apiary_data['location']); ?>"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="zip_code" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Zip Code'); ?></label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" autocomplete="off"
                      value="<?php echo set_value('zip_code', $apiary_data['zip_code']); ?>"/>
                  </div>
                </div>
              </div>

              <!-- Beekeeper -->
              <div class="form-group mb-4">
                <label for="beekeeper" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Beekeeper Name'); ?> <font color="red">*</font></label>
                <select class="form-control select_group" id="beekeeper_holder" name="beekeeper_holder">
                  <option value="" hidden selected disabled>Select Beekeeper</option>
                  <?php foreach ($beekeeper as $k => $v): ?>
                    <option value="<?php echo $v['id'] ?>"
                      <?php if(set_value('beekeeper', $apiary_data['beekeeper_id']) == $v['id']) { echo "selected='selected'"; } ?>>
                      <?php echo $v['beekeeper_name'] ?> / <?php echo $v['address'] ?>
                    </option>
                  <?php endforeach ?>
                </select>
                <input type="text" name="beekeeper" id="beekeeper" value="<?php echo $apiary_data['beekeeper_id']; ?>" hidden>
              </div>

              <!-- Area, Coordinate, Topography, Source -->
              <div class="row g-4 mb-4">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="area_size" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Area Size'); ?></label>
                    <input type="text" class="form-control" id="area_size" name="area_size" autocomplete="off"
                      value="<?php echo set_value('area_size', $apiary_data['area_size']); ?>"/>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="coordinate" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Coordinate'); ?></label>
                    <input type="text" class="form-control" id="coordinate" name="coordinate" autocomplete="off"
                      value="<?php echo set_value('coordinate', $apiary_data['coordinate']); ?>"/>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="topography" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Topography'); ?> <font color="red">*</font></label>
                    <?php $active_topographies = json_decode($apiary_data['topography_id']); ?>
                    <select class="form-control select_group" id="topography" name="topography[]" multiple="multiple">
                      <?php foreach ($topography as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>" 
                          <?php if(is_array($active_topographies) && in_array($v['id'], $active_topographies)) { echo "selected='selected'"; } ?> >
                          <?php echo $v['name'] ?>
                        </option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="source" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Source'); ?> <font color="red">*</font></label>
                    <?php $active_sources = json_decode($apiary_data['source_id']); ?>
                    <select class="form-control select_group" id="source" name="source[]" multiple="multiple">
                      <?php foreach ($source as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"
                          <?php if(is_array($active_sources) && in_array($v['id'], $active_sources)) { echo "selected='selected'"; } ?> >
                          <?php echo $v['name'] ?>
                        </option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Location Hierarchy -->
              <div class="row g-4 mb-4">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="region" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Region'); ?> <font color="red">*</font></label>
                    <select class="form-control select_group" id="region" name="region">
                      <option value="" hidden selected disabled>Select Region</option>
                      <?php foreach ($region as $k => $v): ?>
                        <option value="<?php echo $v['region_id'] ?>"
                          <?php if(set_value('region', $apiary_data['region_id']) == $v['region_id']) { echo "selected='selected'"; } ?>>
                          <?php echo $v['name'] ?>
                        </option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="province" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Province'); ?> <font color="red">*</font></label>
                    <select class="form-control select_group" id="province" name="province">
                      <option value="" hidden selected disabled>Select Province</option>
                      <?php foreach ($province as $k => $v): ?>
                        <option value="<?php echo $v['province_id'] ?>"
                          <?php if(set_value('province', $apiary_data['province_id']) == $v['province_id']) { echo "selected='selected'"; } ?>>
                          <?php echo $v['name'] ?>
                        </option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="municipality" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Municipality'); ?> <font color="red">*</font></label>
                    <select class="form-control select_group" id="municipality" name="municipality">
                      <option value="" hidden selected disabled>Select Municipality</option>
                      <?php foreach ($municipality as $k => $v): ?>
                        <option value="<?php echo $v['municipality_id'] ?>"
                          <?php if(set_value('municipality', $apiary_data['municipality_id']) == $v['municipality_id']) { echo "selected='selected'"; } ?>>
                          <?php echo $v['name'] ?>
                        </option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="barangay" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Barangay'); ?> <font color="red">*</font></label>
                    <select class="form-control select_group" id="barangay" name="barangay">
                      <option value="" hidden selected disabled>Select Barangay</option>
                      <?php foreach ($barangay as $k => $v): ?>
                        <option value="<?php echo $v['barangay_id'] ?>"
                          <?php if(set_value('barangay', $apiary_data['district_id']) == $v['barangay_id']) { echo "selected='selected'"; } ?>>
                          <?php echo $v['name'] ?>
                        </option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group mb-4">
                <label for="map" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Map'); ?> (Google Maps Embed Code - iframe)</label>
                <textarea class="form-control rounded-3 border-light-subtle" id="map" name="map" rows="3"><?php echo set_value('map', $apiary_data['map']); ?></textarea>
              </div>

              <div class="form-group mb-0">
                <label for="remark" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Remark'); ?></label>
                <textarea class="form-control rounded-3 border-light-subtle" id="remark" name="remark" rows="3"><?php echo trim(set_value('remark', $apiary_data['remark'])); ?></textarea>
              </div>
            </div>
            
            <div class="card-footer bg-transparent border-top border-light py-4 px-4 d-flex gap-2 justify-content-end">
              <a href="<?php echo base_url('apiary/') ?>" class="btn btn-light px-4 py-2 fw-medium rounded-3">
                <i class="ph ph-arrow-left me-2"></i><?php echo $this->lang->line('Close'); ?>
              </a>
              <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
                <i class="ph ph-floppy-disk me-2"></i> <?php echo $this->lang->line('Save Changes'); ?>
              </button>
            </div>
          </form>
        </div>

        <!-- =====================================================================
             S E C T I O N   2 :   C O L O N I E S
             ===================================================================== -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3 d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-hexagon me-2 text-primary"></i><?php echo $this->lang->line('Colonies'); ?></h5>
            <?php if(in_array('createColony', $user_permission)): ?>
              <a href="<?php echo base_url('colony/create/'.$apiary_data['id']); ?>" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                <i class="ph ph-plus"></i> <?php echo $this->lang->line('Add Colony'); ?>
              </a>
            <?php endif; ?>
          </div>
          <div class="card-body px-4 py-4">
            <div class="table-responsive">
              <table id="manageTableColony" class="table table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th><?php echo $this->lang->line('Species'); ?></th>
                    <th><?php echo $this->lang->line('Beekeeper Name'); ?></th>
                    <th><?php echo $this->lang->line('Location'); ?></th>
                    <th><?php echo $this->lang->line('Phase'); ?></th>
                    <th><?php echo $this->lang->line('Total'); ?></th>
                    <th><?php echo $this->lang->line('Action'); ?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>

        <!-- =====================================================================
             S E C T I O P N   3 :   D O C U M E N T S
             ===================================================================== -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3">
            <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-file-text me-2 text-primary"></i><?php echo $this->lang->line('Documents'); ?></h5>
          </div>
          <div class="card-body px-4 py-4">
            <?php if(in_array('createDocument', $user_permission)): ?>
              <div class="mb-4 bg-light p-4 rounded-4 border border-light">
                <h6 class="fw-bold mb-3 small text-uppercase text-secondary"><?php echo $this->lang->line('Add Document'); ?></h6>
                <?php echo form_open_multipart('apiary/uploadDocument/' . $apiary_data['id']); ?>
                  <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                      <label class="form-label fw-semibold text-secondary small text-uppercase">Type of Document</label>
                      <select class="form-control select_group" id="document_type" name="document_type" required>
                        <option value="" hidden selected disabled>Select Type</option>
                        <?php foreach ($document_type as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-md-5">
                      <label class="form-label fw-semibold text-secondary small text-uppercase">File</label>
                      <input type="file" required name="apiary_document" id="apiary_document" class="form-control"/>
                    </div>
                    <div class="col-md-3">
                      <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="ph ph-upload-simple"></i> <?php echo $this->lang->line('Upload'); ?>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            <?php endif; ?>

            <!-- Modern Card Gallery -->
            <div id="documentGallery" class="row g-3 mt-1">
                <!-- Cards will be rendered here by JS -->
                <div class="col-12 text-center py-5 text-muted small">
                    <div class="ph-duotone ph-file-dashed fs-1 mb-2 opacity-50"></div>
                    <p>No documents found</p>
                </div>
            </div>
          </div>
        </div>

        <!-- =====================================================================
             S E C T I O N   4 :   M A P
             ===================================================================== -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3">
            <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-map-trifold me-2 text-primary"></i><?php echo $this->lang->line('Map'); ?></h5>
          </div>
          <div class="card-body px-4 py-4">
            <?php if(!empty($apiary_data['map'])): ?>
              <div class="ratio ratio-16x9 rounded-4 overflow-hidden border">
                <?php echo $apiary_data['map']; ?>
              </div>
            <?php else: ?>
              <div class="text-center py-5 text-muted bg-light rounded-4 border border-dashed">
                <i class="ph ph-map-trifold opacity-25" style="font-size:3rem;"></i>
                <p class="mt-3">No map embed has been set for this apiary yet.</p>
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>

  </section>
  </div>
</div>

<!-- Modals for deletion -->
<?php if(in_array('deleteColony', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="removeColonyModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Delete Colony'); ?></h4>
      </div>
      <form role="form" action="<?php echo base_url('colony/remove') ?>" method="post" id="removeFormColony">
        <div class="modal-body">
          <p><?php echo $this->lang->line('All the information about the colony will be deleted.'); ?></p>
          <p><font color="red"><?php echo $this->lang->line('It will not be possible to recover the colonys, production, inquiry and documents.'); ?></font></p>
          <p><?php echo $this->lang->line('Do you really want to delete?'); ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
          <button type="submit" class="btn btn-danger"><?php echo $this->lang->line('Delete'); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(in_array('deleteDocument', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="removeDocumentModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Delete Document'); ?></h4>
      </div>
      <form role="form" action="<?php echo base_url('apiary/removeDocument') ?>" method="post" id="removeFormDocument">
        <div class="modal-body">
          <p><?php echo $this->lang->line('Do you really want to delete?'); ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
          <button type="submit" class="btn btn-danger"><?php echo $this->lang->line('Delete'); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<script type="text/javascript">
var manageTableColony, manageTableDocument;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  $('#beekeeper_holder').on('change', function() {
    $('#beekeeper').val($(this).val());
  });

  $('#region').change(function(){
    var region_id = $(this).val();
    if(region_id) {
      $.ajax({
        url: base_url + 'province/fetchProvinceDataByRegion',
        method: 'POST', data: {region_id: region_id},
        success: function(data) {
          $('#province').html('<option value="" hidden selected disabled>Select Province</option>');
          $('#municipality').html('<option value="" hidden selected disabled>Select Municipality</option>');
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#province').html(data);
        }
      });
    }
  });

  $('#province').change(function(){
    var province_id = $(this).val();
    if(province_id) {
      $.ajax({
        url: base_url + 'municipality/fetchMunicipalityDataByProvince',
        method: 'POST', data: {province_id: province_id},
        success: function(data) {
          $('#municipality').html('<option value="" hidden selected disabled>Select Municipality</option>');
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#municipality').html(data);
        }
      });
    }
  });

  $('#municipality').change(function(){
    var municipality_id = $(this).val();
    if(municipality_id) {
      $.ajax({
        url: base_url + 'barangay/fetchBarangayDataByMunicipality',
        method: 'POST', data: {municipality_id: municipality_id},
        success: function(data) {
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#barangay').html(data);
        }
      });
    }
  });

  $(".select_group").select2({width: '100%'});
  $("#remark").wysihtml5();
  $("#topography").select2({ placeholder: "Select Topography" });
  $("#source").select2({ placeholder: "Select Source" });

  manageTableColony = $('#manageTableColony').DataTable({
    'ajax': base_url + 'colony/fetchColonyDataByApiary/' + '<?php echo $apiary_data['id']; ?>',
    'language': {'url': "<?php echo $this->session->link_language; ?>"},
    'order': [[0, 'asc']]
  });

  // Replaced DataTable with Card Gallery
  function renderDocuments() {
    $.ajax({
      url: base_url + 'apiary/fetchApiaryDocument/' + '<?php echo $apiary_data['id']; ?>',
      type: 'POST',
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

  $("#mainApiaryNav").addClass('active');
});

function removeColony(id) {
  if(id) {
    $("#removeFormColony").off('submit').on('submit', function() {
      var form = $(this);
      $.ajax({
        url: form.attr('action'), type: form.attr('method'),
        data: { colony_id: id }, dataType: 'json',
        success: function(response) {
          manageTableColony.ajax.reload(null, false);
          if(response.success === true) {
            $("#removeColonyModal").modal('hide');
            toastr.success(response.messages, "Success");
          } else {
            toastr.warning(response.messages, "Warning");
          }
        }
      });
      return false;
    });
  }
}

function removeDocument(id) {
  if(id) {
    $("#removeFormDocument").off('submit').on('submit', function() {
      var form = $(this);
      $.ajax({
        url: form.attr('action'), type: form.attr('method'),
        data: { document_id: id }, dataType: 'json',
        success: function(response) {
            renderDocuments();
          if(response.success === true) {
            $("#removeDocumentModal").modal('hide');
            toastr.success(response.messages, "Success");
          } else {
            toastr.warning(response.messages, "Warning");
          }
        }
      });
      return false;
    });
  }
}
</script>
<?php $this->load->view('templates/alert'); ?>