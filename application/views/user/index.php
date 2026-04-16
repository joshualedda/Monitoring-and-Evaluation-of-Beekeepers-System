<div id="main">
  <div class="main-container">
    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-user-circle me-2 text-primary"></i><?php echo $this->lang->line('User'); ?></h4>
        <p>Manage system users and their account settings.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('setting') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active"><?php echo $this->lang->line('User'); ?></li>
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
            <h5 class="mb-0">All Users</h5>
            <?php if(in_array('createUser', $user_permission)): ?>
              <button class="btn-dt-add" data-toggle="modal" onclick="createFunc()" data-target="#addModal">
                <i class="ph ph-plus mb-1"></i> <?php echo $this->lang->line('Add User'); ?>
              </button>
            <?php endif; ?>
          </div>
          <div class="dt-card-body p-0">
            <div class="datatable-wrapper">
              <table id="manageTable" class="table align-middle mb-0">
                <thead>
                <tr>                
                  <th><?php echo $this->lang->line('Username'); ?></th>
                  <th><?php echo $this->lang->line('Email'); ?></th>
                  <th><?php echo $this->lang->line('Name'); ?></th>
                  <th><?php echo $this->lang->line('Phone'); ?></th>
                  <th><?php echo $this->lang->line('Profile'); ?></th>
                  <th><?php echo $this->lang->line('Language'); ?></th>
                <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                  <th><?php echo $this->lang->line('Action'); ?></th>
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

<?php if(in_array('createUser', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-primary d-flex align-items-center">
          <i class="ph ph-user-plus me-2 fs-3"></i> 
          <?php echo $this->lang->line('Add User'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('user/create') ?>" method="post" id="createForm">
        <div class="modal-body px-4 py-4">
          <div class="form-group mb-3">
            <label class="form-label fw-bold"><?php echo $this->lang->line('Profile'); ?></label>
              <select name="profile" id="profile" class="form-control select_create" style="width: 100%;">
              </select>
           </div>  

          <div class="row g-3">
            <div class="col-md-4">
               <div class="form-group mb-3">
                <label for="username" class="form-label fw-bold"><?php echo $this->lang->line('Username'); ?><font color="red"> *</font></label>
                <input type="text" class="form-control rounded-3" id="username" name="username" autocomplete="off">
              </div>
            </div> 
            <div class="col-md-8">
              <div class="form-group mb-3">
                <label for="name" class="form-label fw-bold"><?php echo $this->lang->line('Name'); ?><font color="red"> *</font></label>
                <input type="text" class="form-control rounded-3" id="name" name="name" autocomplete="off">
              </div> 
            </div>
          </div>    

          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="password" class="form-label fw-bold"><?php echo $this->lang->line('Password'); ?> <font color="red">*</font></label>
                <input type="password" class="form-control rounded-3" id="password" name="password" autocomplete="off">
              </div>
            </div>  
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="cpassword" class="form-label fw-bold"><?php echo $this->lang->line('Confirm Password'); ?> <font color="red">*</font></label>
                <input type="password" class="form-control rounded-3" id="cpassword" name="cpassword" autocomplete="off">
              </div>
            </div>
          </div>            

          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="email" class="form-label fw-bold"><?php echo $this->lang->line('Email'); ?><font color="red"> *</font></label>
                <input type="email" class="form-control rounded-3" id="email" name="email" autocomplete="off">
              </div>
            </div>  
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="phone" class="form-label fw-bold"><?php echo $this->lang->line('Phone'); ?></label>
                <input type="text" class="form-control rounded-3" id="phone" name="phone" autocomplete="off">
              </div>
            </div>
          </div> 

           <div class="form-group mb-3">
            <label class="form-label fw-bold"><?php echo $this->lang->line('Region'); ?></label>
              <select name="region" id="region" class="form-control select2" style="width: 100%;">
                <option value="" hidden selected>Select Region</option>
              </select>
           </div>    

          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label fw-bold d-block"><?php echo $this->lang->line('Active'); ?></label>
                  <div class="d-flex gap-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="active" id="active" value="1" checked="checked">
                      <label class="form-check-label" for="active"><?php echo $this->lang->line('Active'); ?></label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="active" id="inactive" value="2">
                      <label class="form-check-label" for="inactive"><?php echo $this->lang->line('Inactive'); ?></label>
                    </div>
                  </div>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label fw-bold d-block"><?php echo $this->lang->line('Language'); ?></label>
                  <div class="d-flex gap-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="language" id="lang_en" value="en" checked="checked">
                      <label class="form-check-label" for="lang_en"><?php echo $this->lang->line('English'); ?></label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="language" id="lang_fr" value="fr">
                      <label class="form-check-label" for="lang_fr"><?php echo $this->lang->line('French'); ?></label>
                    </div>
                  </div>
              </div>
            </div>  
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


<?php if(in_array('updateUser', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-primary d-flex align-items-center">
          <i class="ph ph-user-pencil me-2 fs-3"></i> 
          <?php echo $this->lang->line('Edit User'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('user/update') ?>" method="post" id="updateForm">
        <div class="modal-body px-4 py-4">
          <div id="messages"></div>

          <div class="form-group mb-3">
              <label class="form-label fw-bold"><?php echo $this->lang->line('Profile'); ?></label>
                <select name="edit_profile" id="profile" class="form-control select2" style="width: 100%;">
                </select>
          </div>  

          <div class="row g-3">
            <div class="col-md-4">
               <div class="form-group mb-3">
                <label for="edit_username" class="form-label fw-bold"><?php echo $this->lang->line('Username'); ?><font color="red"> *</font></label>
                <input type="text" class="form-control rounded-3" id="edit_username" name="edit_username" autocomplete="off">
              </div>
            </div> 
            <div class="col-md-8">
              <div class="form-group mb-3">
                <label for="edit_name" class="form-label fw-bold"><?php echo $this->lang->line('Name'); ?><font color="red"> *</font></label>
                <input type="text" class="form-control rounded-3" id="edit_name" name="edit_name" autocomplete="off">
              </div> 
            </div>
          </div>   

          <div class="alert alert-info border-0 rounded-3 mb-3 d-flex align-items-center">
             <i class="ph ph-info me-2 fs-5"></i>
             <div><?php echo $this->lang->line('Leave the password field empty if you don\'t want to change.'); ?></div>
          </div>

          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="edit_password" class="form-label fw-bold"><?php echo $this->lang->line('Password'); ?> <font color="red"> *</font></label>
                <input type="password" class="form-control rounded-3" id="edit_password" name="edit_password" autocomplete="off">
              </div>
            </div>  
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="edit_cpassword" class="form-label fw-bold"><?php echo $this->lang->line('Confirm Password'); ?> <font color="red"> *</font></label>
                <input type="password" class="form-control rounded-3" id="edit_cpassword" name="edit_cpassword" autocomplete="off">
              </div>
            </div>
          </div>            

          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="edit_email" class="form-label fw-bold"><?php echo $this->lang->line('Email'); ?><font color="red"> *</font></label>
                <input type="email" class="form-control rounded-3" id="edit_email" name="edit_email" autocomplete="off">
              </div>
            </div>  
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="edit_phone" class="form-label fw-bold"><?php echo $this->lang->line('Phone'); ?></label>
                <input type="text" class="form-control rounded-3" id="edit_phone" name="edit_phone" autocomplete="off">
              </div>
            </div>
          </div> 

          <div class="form-group mb-3">
              <label class="form-label fw-bold"><?php echo $this->lang->line('Region'); ?></label>
                <select name="edit_region" id="region" class="form-control select2" style="width: 100%;">
                  <option value="" hidden selected>Select Region</option>
                </select>
          </div>     

          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label fw-bold d-block"><?php echo $this->lang->line('Active'); ?></label>
                  <div class="d-flex gap-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="edit_active" id="edit_active_active" value="1">
                      <label class="form-check-label" for="edit_active_active"><?php echo $this->lang->line('Active'); ?></label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="edit_active" id="edit_active_inactive" value="2">
                      <label class="form-check-label" for="edit_active_inactive"><?php echo $this->lang->line('Inactive'); ?></label>
                    </div>
                  </div>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label fw-bold d-block"><?php echo $this->lang->line('Language'); ?></label>
                  <div class="d-flex gap-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="edit_language" id="edit_language_en" value="en">
                      <label class="form-check-label" for="edit_language_en"><?php echo $this->lang->line('English'); ?></label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="edit_language" id="edit_language_fr" value="fr">
                      <label class="form-check-label" for="edit_language_fr"><?php echo $this->lang->line('French'); ?></label>
                    </div>
                  </div>
              </div>
            </div>  
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

<?php if(in_array('deleteUser', $user_permission)): ?>

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
        <h4 class="modal-title fw-bold text-danger d-flex align-items-center">
          <i class="ph ph-warning-circle me-2 fs-3"></i> 
          <?php echo $this->lang->line('Delete User'); ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form role="form" action="<?php echo base_url('user/remove') ?>" method="post" id="removeForm">
        <div class="modal-body px-4 py-4">
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

<!-----------------------------------------------   Javascript  ---------------------------------------------------------------->

<script type="text/javascript">

var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

    //---> creation of the drop-down list Profile
    $profile = $('[id="profile"]');    
    $.ajax({
        url: base_url+'user/fetchProfileData',
        dataType: "JSON", 
        success: function (data) {
            $profile.html('');
            //iterate over the data and append a select option
            $.each(data, function (key, val) {
                $profile.append('<option value="' + val.id + '">' + val.name + '</option>');
            });  
            
        }, 
        error: function () {
        //if there is an error append a 'none available' option
        $profile.html('<option id="-1">none available</option>');
        }
    });


     //---> creation of the drop-down list Region
    $region = $('[id="region"]');    
    $.ajax({
        url: base_url+'region/fetchActiveRegion',
        dataType: "JSON", 
        success: function (data) {           
            //iterate over the data and append a select option
            $.each(data, function (key, val) {
                $region.append('<option value="' + val.id + '">' + val.name + '</option>');
            });              
        }, 
        error: function () {
        //if there is an error append a 'none available' option
        $region.html('<option id="-1">none available</option>');
        }
    });

  $("#userNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'user/fetchUserData',
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
    url: base_url + 'user/fetchUserDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      $('[name="edit_profile"]').val(response.profile_id);
      $("#edit_username").val(response.username);
      $("#edit_name").val(response.name);
      $("#edit_phone").val(response.phone);
      $("#edit_email").val(response.email);
      $('[name="edit_region"]').val(response.region_id);
      if(response.active==1){
          $('input:radio[id=edit_active_active]')[0].checked = true;     
          $('input:radio[id=edit_active_inactive]')[0].checked = false;            
        }else{
          $('input:radio[id=edit_active_active]')[0].checked = false;
          $('input:radio[id=edit_active_inactive]')[0].checked = true;
        }  
      if(response.language=="en"){
          $('input:radio[id=edit_language_en]')[0].checked = true;     
          $('input:radio[id=edit_language_fr]')[0].checked = false;            
        }else{
          $('input:radio[id=edit_language_en]')[0].checked = false;
          $('input:radio[id=edit_language_fr]')[0].checked = true;
        }     

      // submit the edit form 
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
        data: { user_id:id }, 
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


