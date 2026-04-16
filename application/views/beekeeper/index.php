<div id="main">
  <div class="main-container">

    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-identification-card me-2 text-primary"></i><?php echo $this->lang->line('Beekeepers'); ?></h4>
        <p>Manage all registered beekeepers and their respective associations.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active"><?php echo $this->lang->line('Beekeepers'); ?></li>
        </ol>
      </nav>
    </div>


  <!--------------------------------------------------- View -------------------------------------------------------------------------->

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
            <h5 class="mb-0">All Beekeepers</h5>
            <?php if(in_array('createBeekeeper', $user_permission)): ?>
              <a href="<?php echo base_url('beekeeper/create') ?>" class="btn-dt-add">
                <i class="ph ph-plus mb-1"></i> <?php echo $this->lang->line('Add Beekeeper'); ?>
              </a>
            <?php endif; ?>
          </div>
          <div class="dt-card-body p-0">
            <div class="datatable-wrapper">
              <table id="manageTable" class="table align-middle mb-0">
                <thead>
                <tr>
                  <th width="30%"><?php echo $this->lang->line('Beekeeper Name'); ?></th>
                  <th width="10%"><?php echo $this->lang->line('Register Id'); ?></th>
                  <th width="20%"><?php echo $this->lang->line('Association'); ?></th>                                        
                  <th width="10%"><?php echo $this->lang->line('Active'); ?></th>
                  <th width="20%"><?php echo $this->lang->line('Action'); ?></th>
                </tr>
                </thead>
              </table>
            </div> <!-- /.datatable-wrapper -->
          </div> <!-- /.dt-card-body -->
        </div> <!-- /.dt-card -->

      </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->

  </section>  <!-- /.content -->
</div> <!-- /.content-wrapper -->


  <!--------------------------------------------------- Delete -------------------------------------------------------------------------->

<?php if(in_array('deleteBeekeeper', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-danger d-flex align-items-center">
          <i class="ph ph-warning-circle me-2 fs-3"></i> 
          <?php echo $this->lang->line('Delete Beekeeper'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('beekeeper/remove') ?>" method="post" id="removeForm">
        <div class="modal-body px-4 py-4">
          <p class="text-secondary mb-3"><?php echo $this->lang->line('All the information about the beekeeper will be deleted.'); ?></p>
          <div class="alert alert-danger mb-3 border-0 bg-danger bg-opacity-10 text-danger rounded-3">
             <i class="ph ph-info me-1"></i> <?php echo $this->lang->line('It will not be possible to recover the colonies, production, inquiry and documents.'); ?>
          </div>
          <p class="text-secondary mb-4"><?php echo $this->lang->line('Change the activity of the beekeeper (inactive) if you want to keep the information.'); ?></p>
          <p class="fw-bold fs-5 text-dark mb-0"><?php echo $this->lang->line('Do you really want to delete?'); ?></p>
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


<!----------------------------------------------------------  J A V A S C R I P T ------------------------------------------- -->


<script type="text/javascript">

var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainBeekeeperNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'beekeeper/fetchBeekeeperData',
    'language': {'url': "<?php echo $this->session->link_language; ?>"}, 
    'order': [[0, 'asc']]
  });

});


// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { beekeeper_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
              response.messages+
              '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>');

            // hide the modal
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
