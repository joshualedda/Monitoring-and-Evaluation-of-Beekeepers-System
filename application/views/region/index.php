<div id="main">
  <div class="main-container">
    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-map-trifold me-2 text-primary"></i><?php echo $this->lang->line('Region'); ?></h4>
        <p>Manage geographic regions and their operational status.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('setting') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active"><?php echo $this->lang->line('Region'); ?></li>
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
            <h5 class="mb-0">All Regions</h5>
            <div class="d-flex gap-2">
              <?php if(in_array('viewRegion', $user_permission)): ?>
                <a href="<?php echo base_url('report06/report06/region') ?>" target="_blank" class="btn-dt-print" title="Print List">
                  <i class="ph ph-printer"></i>
                </a>
              <?php endif; ?>
              <?php if(in_array('createRegion', $user_permission)): ?>
                <button class="btn-dt-add" data-toggle="modal" onclick="createFunc()" data-target="#addModal">
                  <i class="ph ph-plus mb-1"></i> <?php echo $this->lang->line('Add Region'); ?>
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
                  <th><?php echo $this->lang->line('Code'); ?></th>
                  <th><?php echo $this->lang->line('Active'); ?></th>
                  <?php if(in_array('updateRegion', $user_permission) || in_array('deleteRegion', $user_permission)): ?>
                    <th><?php echo $this->lang->line('Action'); ?></th>
                  <?php endif; ?>
                </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>    

  </section>
</div>  <!-- /.content-wrapper -->



<!-----------------------------------------------------------  Add ------------------------------------------------------------------>

<?php if(in_array('createRegion', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-primary d-flex align-items-center">
          <i class="ph ph-map-pin-plus me-2 fs-3"></i> 
          <?php echo $this->lang->line('Add Region'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('region/create') ?>" method="post" id="createForm">
        <div class="modal-body px-4 py-4">
          <div class="row g-3">
             <div class="col-md-6 text-start">
               <div class="form-group mb-3 text-start">
                <label for="region_code" class="form-label fw-bold d-block text-start"><?php echo $this->lang->line('Code'); ?><font color="red"> *</font></label>
                <input type="text" class="form-control rounded-3" id="region_code" name="region_code" autocomplete="off">
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label fw-bold d-block"><?php echo $this->lang->line('Status'); ?></label>
                 <div class="d-flex gap-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="active" id="active_add" value="1" checked="checked">
                      <label class="form-check-label" for="active_add"><?php echo $this->lang->line('Active'); ?></label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="active" id="inactive_add" value="2">
                      <label class="form-check-label" for="inactive_add"><?php echo $this->lang->line('Inactive'); ?></label>
                    </div>
                  </div>
              </div>
            </div>
          </div>    

          <div class="form-group mb-3">
            <label for="region_name" class="form-label fw-bold"><?php echo $this->lang->line('Name'); ?><font color="red"> *</font></label>
            <input type="text" class="form-control rounded-3" id="region_name" name="region_name" autocomplete="off">
          </div>
        </div>

        <div class="modal-footer border-top-0 pt-0 pb-4 px-4 bg-transparent">
          <button type="button" class="btn btn-light px-4 py-2 fw-medium rounded-3" data-bs-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
          <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm"><?php echo $this->lang->line('Save'); ?></button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<!-----------------------------------------------------------  Edit ------------------------------------------------------------------>


<?php if(in_array('updateRegion', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-primary d-flex align-items-center">
          <i class="ph ph-map-pin me-2 fs-3"></i> 
          <?php echo $this->lang->line('Edit Region'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('region/update') ?>" method="post" id="updateForm">
        <div class="modal-body px-4 py-4">
          <div id="messages"></div>
          <div class="row g-3">
             <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="edit_region_code" class="form-label fw-bold"><?php echo $this->lang->line('Code'); ?><font color="red"> *</font></label>
                  <input type="text" class="form-control rounded-3" id="edit_region_code" name="edit_region_code" autocomplete="off">
                </div>
             </div>   

             <div class="col-md-6">
                <div class="form-group mb-3">
                  <label class="form-label fw-bold d-block"><?php echo $this->lang->line('Status'); ?></label>
                   <div class="d-flex gap-3">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="edit_active" id="edit_active" value="1">
                        <label class="form-check-label" for="edit_active"><?php echo $this->lang->line('Active'); ?></label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="edit_active" id="edit_inactive" value="2">
                        <label class="form-check-label" for="edit_inactive"><?php echo $this->lang->line('Inactive'); ?></label>
                      </div>
                    </div>
               </div>
             </div>
          </div>   

          <div class="form-group mb-3">
            <label for="edit_region_name" class="form-label fw-bold"><?php echo $this->lang->line('Name'); ?><font color="red"> *</font></label>
            <input type="text" class="form-control rounded-3" id="edit_region_name" name="edit_region_name" autocomplete="off">
          </div>
        </div>

        <div class="modal-footer border-top-0 pt-0 pb-4 px-4 bg-transparent">
          <button type="button" class="btn btn-light px-4 py-2 fw-medium rounded-3" data-bs-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
          <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm"><?php echo $this->lang->line('Save'); ?></button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<!-----------------------------------------------------------  Delete  ------------------------------------------------------------------>

<?php if(in_array('deleteRegion', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4 text-center">
        <h4 class="modal-title fw-bold text-danger d-flex align-items-center mx-auto">
          <i class="ph ph-warning-circle me-2 fs-3"></i> 
          <?php echo $this->lang->line('Delete Region'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('region/remove') ?>" method="post" id="removeForm">
        <div class="modal-body px-4 py-4 text-center">
          <p class="fw-bold fs-5 text-dark mb-0"><?php echo $this->lang->line('Do you really want to delete?'); ?></p>
        </div>
        <div class="modal-footer border-top-0 pt-0 pb-4 px-4 bg-transparent d-flex justify-content-center gap-2">
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

$(document).ready(function() {

  $("#regionNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchRegionData',
    'language': {'url': "<?php echo $this->session->link_language; ?>"}, 
    'order': [[0, 'asc']]
  });

  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
            response.messages+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
          '</div>');


          // hide the modal
          $("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
              response.messages+
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
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');  
          $(".text-danger").remove();
}
// edit function
function editFunc(id)
{ 
  $("#updateForm")[0].reset();
  $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');  
  $(".text-danger").remove();
  $.ajax({
    url: 'fetchRegionDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_region_code").val(response.code);
      $("#edit_region_name").val(response.name);
      if(response.active==1){
          $('input:radio[id=edit_active]')[0].checked = true;     
          $('input:radio[id=edit_inactive]')[0].checked = false;            
        }else{
          $('input:radio[id=edit_active]')[0].checked = false;
          $('input:radio[id=edit_inactive]')[0].checked = true;
        }   

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                response.messages+
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                  response.messages+
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
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { region_id:id }, 
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

           // hide the modal
            $("#removeModal").modal('hide');
        }
      }); 

      return false;
    });
  }
}


</script>
