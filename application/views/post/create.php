<div id="main">
  <div class="main-container">
    <div class="page-header-card mb-4">
      <div>
        <h4><i class="ph ph-newspaper me-2 text-primary"></i><?php echo $this->lang->line('Add Post'); ?></h4>
        <p>Publish a new announcement or news item.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none small text-secondary">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('post') ?>" class="text-decoration-none small text-secondary"><?php echo $this->lang->line('Post'); ?></a></li>
          <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Add Post'); ?></li>
        </ol>
      </nav>
    </div>

<!-----------------------------------------------------------  Main ------------------------------------------------------------------>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3 border-0 shadow-sm" role="alert">
            <i class="ph ph-check-circle me-2"></i><?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3 border-0 shadow-sm" role="alert">
            <i class="ph ph-warning-circle me-2"></i><?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if(validation_errors()): ?>
            <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border-0 rounded-3 mb-4 p-3">
                <i class="ph ph-warning-circle mb-2 fs-5"></i>
                <div class="small fw-medium"><?php echo validation_errors(); ?></div>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm rounded-4 bg-white">
            <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-pencil-line me-2 text-primary"></i>Create New Post</h5>
            </div>

            <form role="form" action="<?php echo base_url('post/create') ?>" method="post" enctype="multipart/form-data">
              <div class="card-body px-4 py-4">

                <div class="row g-4 mb-4">  
                    <div class="col-md-4">
                        <label for="post_category" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Category'); ?> <font color="red">*</font></label>
                        <select class="form-control select_group" id="post_category" name="post_category" style="width: 100%;">
                            <option value="">Select Category</option>
                            <?php foreach ($post_category as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>" <?php echo set_select('post_category', $v['id']); ?>>
                            <?php echo $v['name'] ?></option>
                            <?php endforeach ?>                          
                        </select>
                    </div>    
                    
                    <div class="col-md-4">
                        <label for="date_from" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Date from'); ?> <font color="red">*</font></label>
                        <input type="date" class="form-control" id="date_from" name="date_from" autocomplete="off" 
                        value="<?php echo set_value('date_from',date('Y-m-d')); ?>"/>
                    </div>

                    <div class="col-md-4">
                        <label for="date_to" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Date to'); ?> <font color="red">*</font></label>
                        <input type="date" class="form-control" id="date_to" name="date_to" autocomplete="off" 
                        value="<?php echo set_value('date_to',date('Y-m-d')); ?>"/>
                    </div> 
                </div>

                <div class="mb-4">  
                    <label for="post_title" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Title'); ?> <font color="red">*</font></label>
                    <input type="text" class="form-control" id="post_title" name="post_title" autocomplete="off" 
                    value="<?php echo set_value('post_title'); ?>" placeholder="Enter post title"/>
                </div>

                <div class="mb-4">
                    <label for="post_text" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Text'); ?> <font color="red">*</font></label>
                    <textarea class="form-control" id="post_text" name="post_text" rows="8" placeholder="Write the content of the post here...">
                        <?php echo set_value('post_text'); ?>
                    </textarea>
                </div>    

                <div class="row g-4 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Upload image'); ?></label>
                        <input type="file" name="post_image" id="post_image" class="form-control">
                        <span class="text-muted small">Max 4MB, JPG/PNG or Office docs</span>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-secondary small text-uppercase d-block mb-3"><?php echo $this->lang->line('Web visibility'); ?></label>
                        <div class="modern-radio-group">
                            <div class="modern-radio-item">
                                <input type="radio" name="web_visibility" id="web_visibility_1" value="1" checked="checked">
                                <label for="web_visibility_1">
                                    <i class="ph ph-eye me-2"></i> <?php echo $this->lang->line('Visible'); ?>
                                </label>
                            </div>
                            <div class="modern-radio-item">
                                <input type="radio" name="web_visibility" id="web_visibility_2" value="2">
                                <label for="web_visibility_2">
                                    <i class="ph ph-eye-slash me-2"></i> <?php echo $this->lang->line('Non visible'); ?>
                                </label>
                            </div>
                        </div>
                    </div>     

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-secondary small text-uppercase d-block mb-3"><?php echo $this->lang->line('Active'); ?></label>
                        <div class="modern-radio-group">
                            <div class="modern-radio-item">
                                <input type="radio" name="active" id="active_1" value="1" checked="checked">
                                <label for="active_1">
                                    <i class="ph ph-check-circle me-2"></i> <?php echo $this->lang->line('Active'); ?>
                                </label>
                            </div>
                            <div class="modern-radio-item">
                                <input type="radio" name="active" id="active_2" value="2">
                                <label for="active_2">
                                    <i class="ph ph-x-circle me-2"></i> <?php echo $this->lang->line('Inactive'); ?>
                                </label>
                            </div>
                        </div>
                    </div>  
                </div>
              </div> <!-- /.card-body -->

              <div class="card-footer bg-transparent border-top border-light py-4 px-4 d-flex gap-2 justify-content-end">
                <a href="<?php echo base_url('post/') ?>" class="btn btn-light px-4 py-2 fw-medium rounded-3"><i class="ph ph-arrow-left me-2"></i><?php echo $this->lang->line('Back'); ?></a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
                    <i class="ph ph-floppy-disk me-2"></i> <?php echo $this->lang->line('Save'); ?>
                </button>
              </div>
            </form>          
        </div>          
      </div>        
    </div>  
  </section>  <!-- /.content -->
</div><!-- /.content-wrapper -->

<!-----------------------------------------------------------  Javascript ------------------------------------------------------------------>
<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2({
      width: '100%'
    });
    
    // Check if wysihtml5 is properly loaded before init
    if ($.fn.wysihtml5) {
        $("#post_text").wysihtml5();
    }

    $("#mainPostNav").addClass('active');
    $("#addPostNav").addClass('active');
    
    // File input init
    if ($.fn.fileinput) {
        $("#post_image").fileinput({
            overwriteInitial: true,
            maxFileSize: 4000,
            showClose: false,
            showCaption: false,
            browseLabel: 'Browse...',
            removeLabel: '',
            browseIcon: '<i class="ph ph-folder-open me-2"></i>',
            removeIcon: '<i class="ph ph-x"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            layoutTemplates: {main2: '{preview} {remove} {browse}'}, 
            allowedFileExtensions: ["jpg", "png", "gif", "pdf", "xls", "xlsx", "doc", "docx", "pptx"],
            theme: "fa5"
        });
    }

  });
</script>