<div id="main">
  <div class="main-container">
    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-buildings me-2 text-primary"></i>Satellite Centers</h4>
        <p>Manage and monitor all regional satellite centers.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active">Satellite Centers</li>
        </ol>
      </nav>
    </div>

    <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div id="messages"></div>

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?php echo $this->session->flashdata('success'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?php echo $this->session->flashdata('error'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <div class="dt-card">
            <div class="dt-card-header">
              <h5 class="mb-0">All Centers</h5>
              <?php if(in_array('createBeekeeper', $user_permission)): ?>
                <a href="<?php echo base_url('satellite_centers/create') ?>" class="btn-dt-add">
                  <i class="ph ph-plus mb-1"></i> Add Center
                </a>
              <?php endif; ?>
            </div>
            <div class="dt-card-body p-0">
              <div class="datatable-wrapper">
                <table id="manageTable" class="table align-middle mb-0">
                  <thead>
                    <tr>
                      <th width="25%">Center Name</th>
                      <th width="15%">Region</th>
                      <th width="15%">Province</th>
                      <th width="15%">Municipality</th>
                      <th width="15%">Barangay</th>
                      <th width="15%">Controls</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<?php if(in_array('deleteBeekeeper', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-danger d-flex align-items-center">
          <i class="ph ph-warning-circle me-2 fs-3"></i> Delete Center
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" action="<?php echo base_url('satellite_centers/remove') ?>" method="post" id="removeForm">
        <div class="modal-body px-4 py-4">
          <p class="text-secondary mb-4">Are you sure you want to remove this satellite center? This action cannot be undone.</p>
          <p class="fw-bold fs-5 text-dark mb-0">Do you really want to delete?</p>
        </div>
        <div class="modal-footer border-top-0 pt-0 pb-4 px-4 bg-transparent d-flex justify-content-end gap-2">
          <button type="button" class="btn btn-light px-4 py-2 fw-medium rounded-3" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
            <i class="ph ph-trash me-2"></i> Delete
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  $("#satelliteCentersNav").addClass('active');

  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'satellite_centers/fetchSatelliteCentersData',
    'order': []
  });
});

function removeFunc(id) {
  if(id) {
    $("#removeForm").on('submit', function() {
      var form = $(this);
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { satellite_id:id }, 
        dataType: 'json',
        success:function(response) {
          manageTable.ajax.reload(null, false); 
          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
              response.messages+
              '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>');
            $("#removeModal").modal('hide');
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
              response.messages+
              '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>'); 
          }
        }
      }); 
      return false;
    });
  }
}
</script>
