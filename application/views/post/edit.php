<div id="main">
  <div class="main-container">

    <!-- ── Page Header ──────────────────────────────────────── -->
    <div class="page-header-card mb-4">
      <div>
        <h4><i class="ph ph-newspaper me-2 text-primary"></i><?php echo $this->lang->line('Edit Post'); ?></h4>
        <p>Modify existing announcement and manage related documents.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none text-secondary">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('post') ?>" class="text-decoration-none text-secondary"><?php echo $this->lang->line('Post'); ?></a></li>
          <li class="breadcrumb-item active text-primary fw-medium"><?php echo $this->lang->line('Edit Post'); ?></li>
        </ol>
      </nav>
    </div>

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
            <i class="ph ph-warning-circle mb-2 fs-5"></i>
            <div class="small fw-medium"><?php echo validation_errors(); ?></div>
        </div>
      <?php endif; ?>

      <?php 
        $this->session->unset_userdata('post_id');
        if(empty($this->session->userdata('post_id'))) {
            $post_id = array('post_id' => $post_data['id']);
            $this->session->set_userdata($post_id);
        } 
      ?>   

      <div class="card border-0 shadow-sm rounded-4 bg-white">
        <!-- ── Tabs Header ───────────────────────────────────── -->
        <div class="card-header bg-transparent border-bottom border-light pt-3 px-4 pb-0">
          <ul class="nav nav-tabs" id="postTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link <?php echo (($active_tab === 'post' || current_url() == base_url('post/update/'.$post_data['id'].'?tab=post')) ? 'active' : ''); ?>" id="post-tab" data-bs-toggle="tab" data-bs-target="#post" type="button" role="tab"><i class="ph ph-pencil-simple me-2"></i><?php echo $this->lang->line('Post'); ?></button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link <?php echo (($active_tab === 'document') ? 'active' : ''); ?>" id="document-tab" data-bs-toggle="tab" data-bs-target="#document" type="button" role="tab"><i class="ph ph-files me-2"></i><?php echo $this->lang->line('Documents'); ?></button>
            </li>
          </ul>
        </div>

        <div class="tab-content" id="postTabsContent">

          <!-- ── POST TAB ──────────────────────────────────────── -->
          <div class="tab-pane fade <?php echo (($active_tab === 'post') ? 'show active' : '') ?>" id="post" role="tabpanel">
            <form role="form" action="<?php echo base_url('post/update/'.$post_data['id']) ?>" method="post" enctype="multipart/form-data">
              <div class="card-body px-4 py-4">

                <div class="row g-4 mb-4">  				
                  <div class="col-md-4">
                    <label for="post_category" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Category'); ?> <font color="red">*</font></label>
                    <select class="form-control select_group" id="post_category" name="post_category" style="width: 100%;">
                      <option value=""></option> 
                      <?php foreach ($post_category as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>" <?php echo (set_value('post_category', isset($post_data['post_category_id']) ? $post_data['post_category_id'] : '') == $v['id']) ? "selected='selected'" : ""; ?> ><?php echo $v['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>                   

                  <div class="col-md-4">
                    <label for="date_from" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Date from'); ?> <font color="red">*</font></label>
                    <input type="date" class="form-control" id="date_from" name="date_from" autocomplete="off" 
                    value="<?php echo set_value('date_from', isset($post_data['date_from']) ? $post_data['date_from'] : ''); ?>" />
                  </div>	

                  <div class="col-md-4">
                    <label for="date_to" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Date to'); ?> <font color="red">*</font></label>
                    <input type="date" class="form-control" id="date_to" name="date_to" autocomplete="off" 
                    value="<?php echo set_value('date_to', isset($post_data['date_to']) ? $post_data['date_to'] : ''); ?>" />
                  </div>
                </div>                       

                <div class="mb-4">  	
                  <label for="post_title" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Title'); ?> <font color="red">*</font></label>
                  <input type="text" class="form-control" id="post_title" name="post_title" autocomplete="off" 
                    value="<?php echo set_value('post_title', isset($post_data['post_title']) ? $post_data['post_title'] : ''); ?>" />
                </div>  

                <div class="mb-4">
                  <label for="post_text" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Text'); ?> <font color="red">*</font></label>
                  <textarea class="form-control" id="post_text" name="post_text" autocomplete="off" rows="8"><?php echo set_value('post_text', isset($post_data['post_text']) ? $post_data['post_text'] : ''); ?></textarea>
                </div>  

                <div class="row g-4 align-items-end">
                  <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Upload image'); ?></label>  
                    <input type="hidden" id="post_image" name="post_image" value="<?php echo set_value('post_image', isset($post_data['post_image']) ? $post_data['post_image'] : ''); ?>" />
                    
                    <div class="mb-2 d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark shadow-sm border"><i class="ph ph-image me-1"></i>Current: <?php echo basename($post_data['post_image']); ?></span>
                    </div>

                    <input type="file" name="new_image" id="new_image" class="form-control" />
                    <span class="text-muted small">Max 4MB, JPG/PNG</span>
                  </div> 

                  <div class="col-md-4">
                      <label class="form-label fw-semibold text-secondary small text-uppercase d-block mb-3"><?php echo $this->lang->line('Web visibility'); ?></label>
                      <div class="modern-radio-group">
                          <div class="modern-radio-item">
                              <input type="radio" name="web_visibility" id="web_visibility_1" value="1" <?php if($post_data['web_visibility'] == 1) { echo "checked"; } ?>>
                              <label for="web_visibility_1">
                                  <i class="ph ph-eye me-2"></i> <?php echo $this->lang->line('Visible'); ?>
                              </label>
                          </div>
                          <div class="modern-radio-item">
                              <input type="radio" name="web_visibility" id="web_visibility_2" value="2" <?php if($post_data['web_visibility'] == 2) { echo "checked"; } ?>>
                              <label for="web_visibility_2">
                                  <i class="ph ph-eye-slash me-2 text-muted"></i> <?php echo $this->lang->line('Non visible'); ?>
                              </label>
                          </div>
                      </div>
                  </div>     

                  <div class="col-md-4">
                      <label class="form-label fw-semibold text-secondary small text-uppercase d-block mb-3"><?php echo $this->lang->line('Active'); ?></label>
                      <div class="modern-radio-group">
                          <div class="modern-radio-item">
                              <input type="radio" name="active" id="active_1" value="1" <?php if($post_data['active'] == 1) { echo "checked"; } ?>>
                              <label for="active_1">
                                  <i class="ph ph-check-circle me-2"></i> <?php echo $this->lang->line('Active'); ?>
                              </label>
                          </div>
                          <div class="modern-radio-item">
                              <input type="radio" name="active" id="active_2" value="2" <?php if($post_data['active'] == 2) { echo "checked"; } ?>>
                              <label for="active_2">
                                  <i class="ph ph-x-circle me-2 text-muted"></i> <?php echo $this->lang->line('Inactive'); ?>
                              </label>
                          </div>
                      </div>
                  </div>  
                </div>  
              </div> 

              <div class="card-footer bg-transparent border-top border-light py-4 px-4 d-flex gap-2 justify-content-end">
                <a href="<?php echo base_url('post/') ?>" class="btn btn-light px-4 py-2 fw-medium rounded-3"><i class="ph ph-arrow-left me-2"></i><?php echo $this->lang->line('Close'); ?></a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
                    <i class="ph ph-floppy-disk me-2"></i> <?php echo $this->lang->line('Save'); ?>
                </button>
              </div>
            </form>
          </div>

          <!-- ── DOCUMENT TAB ──────────────────────────────────── -->
          <div class="tab-pane fade <?php echo (($active_tab === 'document') ? 'show active' : '') ?>" id="document" role="tabpanel">
            <div class="card-body px-4 py-4">
              
              <?php echo form_open_multipart('post/uploadDocument') ?>
              <div class="d-flex flex-wrap align-items-center gap-3 bg-light p-3 rounded-3 mb-4">
                 <input type="file" required="required" name="post_document" id="post_document" class="form-control" style="max-width: 400px;" />
                 <button type="submit" name="submit" class="btn btn-primary d-inline-flex align-items-center gap-2 rounded-3 shadow-sm">
                    <i class="ph ph-upload-simple"></i> <?php echo $this->lang->line('Add Document'); ?>
                 </button>
              </div>
              <?php echo "</form>"?>

              <div class="datatable-wrapper border shadow-sm rounded-3 mt-4">
                <table id="manageTableDocument" class="table align-middle mb-0" style="width:100%">
                  <thead>
                    <tr>
                      <th><?php echo $this->lang->line('Document'); ?></th>
                      <th><?php echo $this->lang->line('Size'); ?></th>
                      <th><?php echo $this->lang->line('Action'); ?></th>                                    
                    </tr>
                  </thead>
                </table>  
              </div>

            </div> 
            <div class="card-footer bg-transparent border-top border-light py-4 px-4 d-flex gap-2 justify-content-end">
                <a href="<?php echo base_url('post/') ?>" class="btn btn-light px-4 py-2 fw-medium rounded-3"><i class="ph ph-arrow-left me-2"></i><?php echo $this->lang->line('Close'); ?></a>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
</div>

<!-- ── Delete Document Modal ── -->
<?php if(in_array('deleteDocument', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="removeDocumentModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">
          <i class="ph ph-trash text-danger me-2"></i><?php echo $this->lang->line('Delete Document'); ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" action="<?php echo base_url('post/removeDocument') ?>" method="post" id="removeFormDocument">
        <div class="modal-body text-muted">
          <div class="alert alert-danger bg-danger bg-opacity-10 border-0 rounded-3 d-flex align-items-center gap-2 mb-0">
            <i class="ph ph-warning fs-5 text-danger"></i>
            <span><?php echo $this->lang->line('Do you really want to delete?'); ?> This action cannot be undone.</span>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0 gap-2">
          <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">
            <i class="ph ph-x me-1"></i><?php echo $this->lang->line('Close'); ?>
          </button>
          <button type="submit" class="btn btn-danger rounded-3 px-4">
            <i class="ph ph-trash me-1"></i><?php echo $this->lang->line('Delete'); ?>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>


<!-- ── Javascript ── --> 
<script type="text/javascript">
  var manageTableDocument;
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function() {
    $(".select_group").select2({
      width: '100%'
    });
    
    if ($.fn.wysihtml5) {
        $("#post_text").wysihtml5();
    }

    $("#mainPostNav").addClass('active');
    $("#managePostNav").addClass('active');    

    // initialize the datatable 
    manageTableDocument = $('#manageTableDocument').DataTable({
      'ajax': base_url+'post/fetchPostDocument/'+'<?php echo $post_data['id']; ?>',
      'language': {'url': "<?php echo $this->session->link_language; ?>"}, 
      'order': [[0, "asc"]]
    });
  });

  function removeDocument(id) {
    if(id) {
      $("#removeDocumentModal").modal('show');
      $("#removeFormDocument").off('submit').on('submit', function() {
        var form = $(this);
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: { document_id:id }, 
          dataType: 'json',
          success:function(response) {
            manageTableDocument.ajax.reload(null, false); 
            $("#removeDocumentModal").modal('hide');

            if(response.success === true) {
                $("#messages").html('<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">'+
                '<i class="ph ph-check-circle me-2"></i>' + response.messages +
                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible fade show rounded-3 mb-4" role="alert">'+
                '<i class="ph ph-warning me-2"></i>' + response.messages +
                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'); 
            }
          }
        }); 

        return false;
      });
    }
  }
</script>
