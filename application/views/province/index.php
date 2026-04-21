<div id="main">
  <div class="main-container">

    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-map-pin me-2 text-primary"></i><?php echo $this->lang->line('Province'); ?></h4>
        <p>Manage provinces and their respective geographic regions.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none small text-secondary">Home</a></li>
          <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Province'); ?></li>
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
              <i class="ph ph-check-circle me-2 fs-4"></i>
              <div><?php echo $this->session->flashdata('success'); ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="d-flex align-items-center">
              <i class="ph ph-warning-circle me-2 fs-4"></i>
              <div><?php echo $this->session->flashdata('error'); ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <div class="dt-card">
          <div class="dt-card-header">
            <h5 class="mb-0">All Provinces</h5>
            <div class="d-flex gap-2">
              <?php if(in_array('viewProvince', $user_permission)): ?>
                <a href="<?php echo base_url('report06/report06/province') ?>" target="_blank" class="btn btn-light border d-flex align-items-center" title="Print List">
                   <i class="ph ph-printer me-2 fs-5"></i> Print
                </a>
              <?php endif; ?>
              <?php if(in_array('createProvince', $user_permission)): ?>
                <button class="btn-dt-add" data-bs-toggle="modal" data-bs-target="#addModal" onclick="createFunc()">
                   <i class="ph ph-plus mb-1"></i> <?php echo $this->lang->line('Add Province'); ?>
                </button>
              <?php endif; ?>
            </div>
          </div>
          <div class="dt-card-body p-0">
            <div class="datatable-wrapper">
              <table id="manageTable" class="table align-middle mb-0">
                <thead>
                <tr>   
                  <th><?php echo $this->lang->line('Name');?></th>             
                  <th><?php echo $this->lang->line('Region'); ?></th>
                  <th><?php echo $this->lang->line('Code'); ?></th>
                  <?php if(in_array('updateProvince', $user_permission) || in_array('deleteProvince', $user_permission)): ?>
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

<?php if(in_array('createProvince', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-dark l-spacing-1 d-flex align-items-center">
          <i class="ph ph-plus-circle me-2 text-primary fs-3"></i> 
          <?php echo $this->lang->line('Add Province'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('province/create') ?>" method="post" id="createForm">
        <div class="modal-body px-4 py-4">
          <div class="mb-3">
              <label class="form-label fw-semibold text-secondary small text-uppercase l-spacing-1"><?php echo $this->lang->line('Region'); ?><font color="red"> *</font></label>
              <select name="region" id="region" class="form-control select2" style="width: 100%;">
                <option value="" hidden selected>Select Region</option>
              </select>
          </div>

          <div class="row g-3 mb-3">
             <div class="col-md-12">
                <label for="province_code" class="form-label fw-semibold text-secondary small text-uppercase l-spacing-1"><?php echo $this->lang->line('Code'); ?></label>
                <input type="text" class="form-control rounded-3" id="province_code" name="province_code" autocomplete="off" placeholder="Enter code">
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


<?php if(in_array('updateProvince', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-dark l-spacing-1 d-flex align-items-center">
          <i class="ph ph-pencil-simple me-2 text-warning fs-3"></i> 
          <?php echo $this->lang->line('Edit Province'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('province/update') ?>" method="post" id="updateForm">
        <div class="modal-body px-4 py-4">
          <div id="messages_edit"></div>
          <div class="mb-3">
              <label class="form-label fw-semibold text-secondary small text-uppercase l-spacing-1"><?php echo $this->lang->line('Region'); ?><font color="red"> *</font></label>
              <select name="edit_province_region" id="edit_region" class="form-control select2" style="width: 100%;">
                <option value="" hidden selected>Select Region</option>
              </select>
          </div>

          <div class="row g-3 mb-3">
             <div class="col-md-12">
                <label for="edit_province_code" class="form-label fw-semibold text-secondary small text-uppercase l-spacing-1"><?php echo $this->lang->line('Code'); ?></label>
                <input type="text" class="form-control rounded-3 shadow-sm border-light-subtle" id="edit_province_code" name="edit_province_code" autocomplete="off" placeholder="Enter code">
              </div>
          </div> 

          <div class="mb-3">
            <label for="edit_province_name" class="form-label fw-semibold text-secondary small text-uppercase l-spacing-1"><?php echo $this->lang->line('Name'); ?><font color="red"> *</font></label>
            <input type="text" class="form-control rounded-3 shadow-sm border-light-subtle" id="edit_province_name" name="edit_province_name" autocomplete="off" placeholder="Enter province name">
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

<?php if(in_array('deleteProvince', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-danger d-flex align-items-center">
          <i class="ph ph-warning-circle me-2 fs-3"></i> 
          <?php echo $this->lang->line('Delete Province'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('province/remove') ?>" method="post" id="removeForm">
        <div class="modal-body px-4 py-4 text-start">
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
    $(".select2").select2({width: '100%'});
  //---> creation of the drop-down list region
    var fetchRegions = function(target) {
        var $select = $(target);
        $.ajax({
            url: base_url+'region/fetchActiveRegion',
            dataType: "JSON", 
            success: function (data) {
                //iterate over the data and append a select option
                $.each(data, function (key, val) {
                    $select.append('<option value="' + val.id + '">' + val.name + '</option>');  
                }); 
            }, 
            error: function () {
                $select.html('<option id="-1">none available</option>');
            }
        });
    }

    fetchRegions('#region');
    fetchRegions('#edit_region');


  $("#provinceNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'province/fetchProvinceData',
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
            '<div class="d-flex align-items-center"><i class="ph ph-check-circle me-2 fs-4"></i><div>'+response.messages+'</div></div>'+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
          '</div>');

          $("#addModal").modal('hide');
          $("#createForm")[0].reset();
          $('#region').val('').trigger('change');
        } else {
          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);
              id.closest('.mb-3, .form-group').find('.text-danger').remove();
              id.after(value);
            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
              '<div class="d-flex align-items-center"><i class="ph ph-warning-circle me-2 fs-4"></i><div>'+response.messages+'</div></div>'+
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
  $('#region').val('').trigger('change');
  $(".text-danger").remove();
}

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: base_url + 'province/fetchProvinceDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      $("#updateForm")[0].reset();
      $(".text-danger").remove();
      
      $('[name="edit_province_region"]').val(response.region_id).trigger('change');
      $("#edit_province_code").val(response.code);
      $("#edit_map_id").val(response.map_id);
      $("#edit_province_name").val(response.name);
      
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
                '<div class="d-flex align-items-center"><i class="ph ph-check-circle me-2 fs-4"></i><div>'+response.messages+'</div></div>'+
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
              '</div>');
              $("#editModal").modal('hide');
            } else {
              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);
                  if(index == 'edit_province_region') id = $("#edit_region");
                  id.closest('.mb-3, .form-group').find('.text-danger').remove();
                  id.after(value);
                });
              } else {
                $("#messages_edit").html('<div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
                  '<div class="d-flex align-items-center"><i class="ph ph-warning-circle me-2 fs-4"></i><div>'+response.messages+'</div></div>'+
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
        data: { province_id:id }, 
        dataType: 'json',
        success:function(response) {
          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
              '<div class="d-flex align-items-center"><i class="ph ph-check-circle me-2 fs-4"></i><div>'+response.messages+'</div></div>'+
              '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>');           
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">'+
              '<div class="d-flex align-items-center"><i class="ph ph-warning-circle me-2 fs-4"></i><div>'+response.messages+'</div></div>'+
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
