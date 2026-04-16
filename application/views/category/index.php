<div id="main">
  <div class="main-container">

    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-tag me-2 text-primary"></i><?php echo $this->lang->line('Category'); ?></h4>
        <p>Manage various beekeeping categories and classifications.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none small text-secondary">Home</a></li>
          <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Category'); ?></li>
        </ol>
      </nav>
    </div>


  <!-----------------------------------------------------------  View ------------------------------------------------------------------>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="d-flex align-items-center">
              <i class="ph ph-check-circle me-3 fs-4"></i>
              <div><?php echo $this->session->flashdata('success'); ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="d-flex align-items-center">
              <i class="ph ph-warning-circle me-3 fs-4"></i>
              <div><?php echo $this->session->flashdata('error'); ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <div class="dt-card">
          <div class="dt-card-header">
            <h5 class="mb-0">All Categories</h5>
            <div class="d-flex gap-2">
              <?php if(in_array('viewCategory', $user_permission)): ?>
                <a href="<?php echo base_url('report06/report06/category'); ?>" target="_blank" class="btn btn-light border d-flex align-items-center" title="Print List">
                   <i class="ph ph-printer me-2 fs-5"></i> Print
                </a>
              <?php endif; ?>
              <?php if(in_array('createCategory', $user_permission)): ?>
                <button class="btn-dt-add" data-bs-toggle="modal" data-bs-target="#addModal" onclick="createFunc()">
                   <i class="ph ph-plus mb-1"></i> <?php echo $this->lang->line('Add Category'); ?>
                </button>
              <?php endif; ?>
            </div>
          </div>
          <div class="dt-card-body p-0">
            <div class="datatable-wrapper">
              <table id="manageTable" class="table align-middle mb-0">
                <thead>
                <tr>                
                  <th><?php echo $this->lang->line('Name'); ?></th>
                  <th width="15%"><?php echo $this->lang->line('Active'); ?></th>
                  <?php if(in_array('updateCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
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



<!-----------------------------------------------------------  Add ------------------------------------------------------------------>

<?php if(in_array('createCategory', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-dark l-spacing-1 d-flex align-items-center">
          <i class="ph ph-plus-circle me-2 text-primary fs-3"></i> 
          <?php echo $this->lang->line('Add Category'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('category/create') ?>" method="post" id="createForm">
        <div class="modal-body px-4 py-4 text-start">
          <div class="mb-4">
            <label for="category_name" class="form-label fw-semibold text-secondary small text-uppercase l-spacing-1"><?php echo $this->lang->line('Name'); ?><font color="red"> *</font></label>
            <input type="text" class="form-control rounded-3 shadow-sm border-light-subtle" id="category_name" name="category_name" autocomplete="off" autofocus placeholder="Enter category name">
          </div>

          <div class="row align-items-center g-3">
              <div class="col-12">
                  <label class="form-label fw-semibold text-secondary small text-uppercase l-spacing-1 mb-2"><?php echo $this->lang->line('Status'); ?></label>
                  <div class="radio-group modern-radio-group d-flex gap-2">
                      <div class="modern-radio-item flex-fill">
                        <input type="radio" name="active" id="active_1" value="1" checked="checked">
                        <label for="active_1" class="d-flex align-items-center justify-content-center py-2 px-2 rounded-3 border w-100 cursor-pointer transition-all small">
                          <i class="ph ph-check-circle me-1"></i> <?php echo $this->lang->line('Active'); ?>
                        </label>
                      </div>
                      <div class="modern-radio-item flex-fill">
                        <input type="radio" name="active" id="active_2" value="2">
                        <label for="active_2" class="d-flex align-items-center justify-content-center py-2 px-2 rounded-3 border w-100 cursor-pointer transition-all small">
                          <i class="ph ph-x-circle me-1"></i> <?php echo $this->lang->line('Inactive'); ?>
                        </label>
                      </div>
                  </div>
              </div>
          </div>
        </div>

        <div class="modal-footer border-top-0 pt-0 pb-4 px-4 bg-transparent d-flex justify-content-end gap-2">
          <button type="button" class="btn btn-light px-4 py-2 fw-medium rounded-3" data-bs-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
          <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
            <i class="ph ph-floppy-disk me-2"></i> <?php echo $this->lang->line('Save'); ?>
          </button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<!-----------------------------------------------------------  Edit ------------------------------------------------------------------>


<?php if(in_array('updateCategory', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-dark l-spacing-1 d-flex align-items-center">
          <i class="ph ph-pencil-simple me-2 text-warning fs-3"></i> 
          <?php echo $this->lang->line('Edit Category'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('category/update') ?>" method="post" id="updateForm">
        <div class="modal-body px-4 py-4 text-start">
          <div id="messages_edit"></div>

          <div class="mb-4">
            <label for="edit_category_name" class="form-label fw-semibold text-secondary small text-uppercase l-spacing-1"><?php echo $this->lang->line('Name'); ?><font color="red"> *</font></label>
            <input type="text" class="form-control rounded-3 shadow-sm border-light-subtle" id="edit_category_name" name="edit_category_name" autocomplete="off" placeholder="Enter category name">
          </div>

          <div class="row align-items-center g-3">
              <div class="col-12">
                  <label class="form-label fw-semibold text-secondary small text-uppercase l-spacing-1 mb-2"><?php echo $this->lang->line('Status'); ?></label>
                  <div class="radio-group modern-radio-group d-flex gap-2">
                      <div class="modern-radio-item flex-fill">
                        <input type="radio" name="edit_active" id="edit_active_1" value="1">
                        <label for="edit_active_1" class="d-flex align-items-center justify-content-center py-2 px-2 rounded-3 border w-100 cursor-pointer transition-all small">
                          <i class="ph ph-check-circle me-1"></i> <?php echo $this->lang->line('Active'); ?>
                        </label>
                      </div>
                      <div class="modern-radio-item flex-fill">
                        <input type="radio" name="edit_active" id="edit_active_2" value="2">
                        <label for="edit_active_2" class="d-flex align-items-center justify-content-center py-2 px-2 rounded-3 border w-100 cursor-pointer transition-all small">
                          <i class="ph ph-x-circle me-1"></i> <?php echo $this->lang->line('Inactive'); ?>
                        </label>
                      </div>
                  </div>
              </div>
          </div>
        </div>

        <div class="modal-footer border-top-0 pt-0 pb-4 px-4 bg-transparent d-flex justify-content-end gap-2">
          <button type="button" class="btn btn-light px-4 py-2 fw-medium rounded-3" data-bs-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
          <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
            <i class="ph ph-floppy-disk me-2"></i> <?php echo $this->lang->line('Save'); ?>
          </button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<!-----------------------------------------------------------  Delete  ------------------------------------------------------------------>

<?php if(in_array('deleteCategory', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-danger d-flex align-items-center">
          <i class="ph ph-warning-circle me-2 fs-3"></i> 
          <?php echo $this->lang->line('Delete Category'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('category/remove') ?>" method="post" id="removeForm">
        <div class="modal-body px-4 py-4">
          <p class="text-secondary mb-3"><?php echo $this->lang->line('Do you really want to delete?'); ?></p>
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
  $("#categoryNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'category/fetchCategoryData',
    'language': {'url': "<?php echo $this->session->link_language; ?>"}, 
    'order': [[0, 'asc']]
  });

  // submit the create form
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), 
      dataType: 'json',
      success:function(response) {
        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
            '<div class="d-flex align-items-center"><i class="ph ph-check-circle me-3 fs-4"></i><div>'+response.messages+'</div></div>'+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
          '</div>');

          $("#addModal").modal('hide');
          $("#createForm")[0].reset();
        } else {
          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);
              id.closest('.mb-4').find('.text-danger').remove();
              id.after(value);
            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
              '<div class="d-flex align-items-center"><i class="ph ph-warning-circle me-3 fs-4"></i><div>'+response.messages+'</div></div>'+
              '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });
});

function createFunc()
{
  $("#createForm")[0].reset();
  $(".text-danger").remove();
}

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: base_url + 'category/fetchCategoryDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      $("#updateForm")[0].reset();
      $(".text-danger").remove();
      $("#edit_category_name").val(response.name);
      
      if(response.active == 1) {
        $('#edit_active_1').prop('checked', true);
      } else {
        $('#edit_active_2').prop('checked', true);
      }   

      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), 
          dataType: 'json',
          success:function(response) {
            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
                '<div class="d-flex align-items-center"><i class="ph ph-check-circle me-3 fs-4"></i><div>'+response.messages+'</div></div>'+
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
              '</div>');
              $("#editModal").modal('hide');
            } else {
              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);
                  id.closest('.mb-4').find('.text-danger').remove();
                  id.after(value);
                });
              } else {
                $("#messages_edit").html('<div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
                  '<div class="d-flex align-items-center"><i class="ph ph-warning-circle me-3 fs-4"></i><div>'+response.messages+'</div></div>'+
                  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });
    }
  });
}

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
        data: { category_id:id }, 
        dataType: 'json',
        success:function(response) {
          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
              '<div class="d-flex align-items-center"><i class="ph ph-check-circle me-3 fs-4"></i><div>'+response.messages+'</div></div>'+
              '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>');           
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
              '<div class="d-flex align-items-center"><i class="ph ph-warning-circle me-3 fs-4"></i><div>'+response.messages+'</div></div>'+
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
