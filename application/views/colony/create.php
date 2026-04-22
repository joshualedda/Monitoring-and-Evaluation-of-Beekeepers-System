<div id="main">
  <div class="main-container">
  <div class="page-header-card">
    <div>
      <h4><i class="ph ph-plus-circle me-2 text-primary"></i><?php echo $this->lang->line('Add Colony'); ?></h4>
    </div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 small">
        <li class="breadcrumb-item"><a href="<?php echo base_url('colony') ?>" class="text-decoration-none small text-secondary">Home</a></li>
        <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Colony'); ?></li>
      </ol>
    </nav>
  </div>

<!-----------------------------------------------------------  Main ------------------------------------------------------------------>

  <section class="content">

    <div class="row g-4 mb-4">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php if(validation_errors()): ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php echo validation_errors(); ?>
          </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-pencil-line me-2 text-primary"></i>Create New Colony</h5>
          </div>
          <!-- /.card-header -->
          <form role="form" action="<?php echo base_url('colony/create') ?>" method="post" enctype="multipart/form-data">
              <div class="card-body px-4 py-4">

                <div class="row g-4 mb-4">
                  <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                      <label for="species" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Species'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="species" name="species" required>
                          <option value="" hidden selected disabled>Select Species</option>
                          <?php foreach ($species as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>" <?php echo set_select('species', $v['id']); ?>>
                          <?php echo $v['name'] ?></option>
                          <?php endforeach ?>                          
                     </select>
                    </div>   
                  </div> 
    
                  <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label for="total_colony" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Total'); ?> <font color="red">*</font></label>
                        <input type="number" class="form-control" id="total_colony" name="total_colony" autocomplete="off" required
                        value="<?php echo set_value('total_colony'); ?>" />
                    </div>
                  </div> 

                  <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                      <label for="phase" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Phase'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="phase" name="phase" required>
                        <option value="" hidden selected disabled>Select Phase</option>
                        <?php foreach ($phase as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>" <?php echo set_select('phase', $v['id']); ?>>
                          <?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row g-4 mb-4">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="apiary" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Apiary'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="apiary_holder" name="apiary_holder" <?php if($fromApiary!=null) echo 'disabled=disabled';?> required>
                            <option value="" hidden selected disabled>Select Apiary</option>
                            <?php foreach ($apiary as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" 
                                  <?php if(set_value('apiary_holder', isset($fromApiary) ? $fromApiary : '') == $v['id']) { echo "selected='selected'"; } ?> >
                                  <?php echo $v['location'] ?> - <?php echo $v['beekeeper_name'] ?>
                                </option>
                            <?php endforeach ?>
                      </select>
                      <input type="text" name="apiary" id="apiary" value="<?php echo $fromApiary ?>" hidden>
                    </div>
                  </div>
                </div>

                <div class="row g-4 mb-4">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="remark" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Remark'); ?></label>
                      <textarea type="text" class="form-control" id="remark" name="remark" rows="3" autocomplete="off"><?php echo set_value('remark'); ?></textarea>
                    </div>  
                  </div>
                </div>
                
              </div> <!-- /.card-body -->

              <div class="card-footer bg-transparent border-top border-light py-3 px-4 d-flex justify-content-between align-items-center">
                <a href="<?php echo base_url('colony/') ?>" class="btn btn-light rounded-3 px-4">
                  <i class="ph ph-arrow-left me-2"></i> <?php echo $this->lang->line('Back'); ?>
                </a>
                <button type="submit" class="btn btn-primary rounded-3 px-4">
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
  var apiary_holder=document.getElementById('apiary_holder');
  apiary_holder.onchange=function()
  {
    document.getElementById('apiary').value=apiary_holder.value;
  }
  $(document).ready(function() {
    $(".select_group").select2({width: '100%'});
    if ($.fn.wysihtml5) { $("#remark").wysihtml5(); }

    $("#mainColonyNav").addClass('active');
    $("#addColonyNav").addClass('active');
  });
</script>