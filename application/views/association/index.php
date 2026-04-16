<div id="main">
  <div class="main-container">
    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-users me-2 text-primary"></i><?php echo $this->lang->line('Association'); ?></h4>
        <p>Manage beekeeper associations and organizations.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active"><?php echo $this->lang->line('Association'); ?></li>
        </ol>
      </nav>
    </div>


  <!-----------------------------------------------------------  View ------------------------------------------------------------------>

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
            <h5 class="mb-0">All Associations</h5>
            <div class="d-flex gap-2">
              <?php if(in_array('viewAssociation', $user_permission)): ?>
                 <a href="<?php echo base_url('report07/report07'); ?>" target="_blank" class="btn btn-light border d-flex align-items-center">
                   <i class="ph ph-printer me-2 fs-5"></i> Print
                 </a>
              <?php endif; ?>
              <?php if(in_array('createAssociation', $user_permission)): ?>
                <a href="<?php echo base_url('association/create') ?>" class="btn-dt-add text-decoration-none">
                  <i class="ph ph-plus mb-1"></i> <?php echo $this->lang->line('Add Association'); ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
          <div class="dt-card-body p-0">
            <div class="datatable-wrapper">
              <table id="manageTable" class="table align-middle mb-0">
                <thead>
                <tr>       
                  <th><?php echo $this->lang->line('Name'); ?></th>
                  <th><?php echo $this->lang->line('Contact'); ?></th> 
                  <th><?php echo $this->lang->line('Remark'); ?></th>
                  <th width="10%"><?php echo $this->lang->line('Active'); ?></th>
                  <?php if(in_array('updateAssociation', $user_permission) || in_array('deleteAssociation', $user_permission)): ?>
                    <th width="15%"><?php echo $this->lang->line('Action'); ?></th>
                  <?php endif; ?>
                </tr>
                </thead>
              </table>
            </div> <!-- /.datatable-wrapper -->
          </div> <!-- /.dt-card-body -->
        </div> <!-- /.dt-card -->

      </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->    

  </section>
</div>  <!-- /.content-wrapper -->


<!-----------------------------------------------------------  Delete  ------------------------------------------------------------------>

<?php if(in_array('deleteAssociation', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-danger d-flex align-items-center">
          <i class="ph ph-warning-circle me-2 fs-3"></i> 
          <?php echo $this->lang->line('Delete Association'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('association/remove') ?>" method="post" id="removeForm">
        <div class="modal-body px-4 py-4">
          <p class="text-secondary mb-4"><?php echo $this->lang->line('Do you really want to delete?'); ?></p>
        </div>
        <div class="modal-footer border-top-0 pt-0 pb-4 px-4 bg-transparent d-flex justify-content-end gap-2">
          <button type="button" class="btn btn-light px-4 py-2 fw-medium rounded-3" data-bs-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
          <button type="submit" class="btn btn-danger px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
            <i class="ph ph-trash me-2"></i> <?php echo $this->lang->line('Delete'); ?>
          </button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<!-----------------------------------------------   Javascript  ---------------------------------------------------------------->

<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  $("#associationNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'association/fetchAssociationData',
    'language': {'url': "<?php echo $this->session->link_language; ?>"}, 
    'order': [[0, 'asc']]
  });
});


// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").unbind('submit').on('submit', function() {
      var form = $(this);
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { association_id:id }, 
        dataType: 'json',
        success:function(response) {
          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
              response.messages+
              '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>');           
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
              response.messages+
              '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>'); 
          }
          $("#removeModal").modal('hide');
        }
      }); 

      return false;
    });
  }
}
</script>
