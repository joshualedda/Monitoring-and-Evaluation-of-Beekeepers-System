<div id="main">
  <div class="main-container">
    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-activity me-2 text-primary"></i>Monitoring Logs</h4>
        <p>Track inspections, treatments, and harvesting activities.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active">Monitoring</li>
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
              <h5 class="mb-0">All Monitoring Logs</h5>
              <?php if(in_array('createMonitoring', $user_permission) || (isset($_SESSION['profile_id']) && $_SESSION['profile_id'] == 2)): ?>
                <a href="<?php echo base_url('monitoring/create') ?>" class="btn-dt-add">
                  <i class="ph ph-plus mb-1"></i> Add Log
                </a>
              <?php endif; ?>
            </div>
            <div class="dt-card-body p-0">
              <div class="datatable-wrapper">
                <table id="manageTable" class="table align-middle mb-0">
                  <thead>
                    <tr>
                      <th width="20%">Apiary</th>
                      <th width="15%">Date</th>
                      <th width="10%">Action</th>
                      <th width="35%">Observation</th>
                      <th width="20%">Controls</th>
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

<?php if(in_array('deleteMonitoring', $user_permission) || (isset($_SESSION['profile_id']) && $_SESSION['profile_id'] == 2)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-danger d-flex align-items-center">
          <i class="ph ph-warning-circle me-2 fs-3"></i> Delete Log
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" action="<?php echo base_url('monitoring/remove') ?>" method="post" id="removeForm">
        <div class="modal-body px-4 py-4">
          <p class="text-secondary mb-4">Are you sure you want to remove this monitoring log? This action cannot be undone.</p>
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
  $("#mainMonitoringNav").addClass('active');

  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'monitoring/fetchMonitoringData',
    'order': [[1, 'desc']]
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
        data: { monitoring_id:id }, 
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
