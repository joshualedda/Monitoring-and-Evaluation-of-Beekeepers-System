<div id="main">
  <div class="main-container">
    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-plus-circle me-2 text-primary"></i><?php echo $this->lang->line('Add Production'); ?></h4>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('production') ?>" class="text-decoration-none small text-secondary">Home</a></li>
          <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Production'); ?></li>
        </ol>
      </nav>
    </div>

    <section class="content">
      <div class="row g-4 mb-4">
        <div class="col-md-12 col-xs-12">

          <div id="messages"></div>

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>
          
          <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-transparent border-bottom border-light pt-4 px-4 pb-3">
                  <h5 class="fw-bold mb-0 text-dark"><i class="ph ph-pencil-line me-2 text-primary"></i>Create New Production Record</h5>
              </div>
            <form role="form" action="<?php echo base_url('production/create') ?>" method="post">
                <div class="card-body px-4 py-4">

                  <?php echo validation_errors(); ?>

                  <div class="row g-4 mb-4">
                    <div class="col-md-6 col-xs-6">
                      <div class="form-group">
                        <label for="colony_id" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Colony'); ?> <font color="red">*</font></label>
                        <select class="form-control select_group" id="colony_id" name="colony_id" required>
                          <option value="" hidden selected disabled>Select Colony</option>
                          <?php foreach ($colonies as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>" <?php echo set_select('colony_id', $v['id']); ?>><?php echo 'Colony ' . $v['id'] . ' (' . ($v['location'] ?? 'Unknown location') . ')'; ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                      <div class="form-group">
                        <label for="product_id" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Product'); ?> <font color="red">*</font></label>
                        <select class="form-control select_group" id="product_id" name="product_id" required>
                          <option value="" hidden selected disabled>Select Product</option>
                          <?php foreach ($products as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>" <?php echo set_select('product_id', $v['id']); ?>><?php echo $v['name'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row g-4 mb-4">
                    <div class="col-md-4 col-xs-4">
                      <div class="form-group">
                        <label for="total_production" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Total Production') ?: 'Total Production'; ?></label>
                        <input type="text" class="form-control" id="total_production" name="total_production" autocomplete="off" value="<?php echo set_value('total_production'); ?>" />
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-4">
                      <div class="form-group">
                        <label for="production_date" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Production Date') ?: 'Production Date'; ?></label>
                        <input type="date" class="form-control" id="production_date" name="production_date" autocomplete="off" value="<?php echo set_value('production_date'); ?>" />
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-4">
                      <div class="form-group">
                        <label for="year" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Year') ?: 'Year'; ?> <font color="red">*</font></label>
                        <input type="text" class="form-control" id="year" name="year" autocomplete="off" value="<?php echo set_value('year', date('Y')); ?>" required />
                      </div>
                    </div>
                  </div>

                  <div class="row g-4 mb-4">
                    <div class="col-md-4 col-xs-4">
                      <div class="form-group">
                        <label for="cost" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Production Cost') ?: 'Production Cost'; ?></label>
                        <input type="number" step="0.01" class="form-control" id="cost" name="cost" autocomplete="off" value="<?php echo set_value('cost'); ?>" />
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-4">
                      <div class="form-group">
                        <label for="gross_income" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Production Income') ?: 'Gross Income'; ?></label>
                        <input type="number" step="0.01" class="form-control" id="gross_income" name="gross_income" autocomplete="off" value="<?php echo set_value('gross_income'); ?>" />
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-4">
                      <div class="form-group">
                        <label for="net_income" class="form-label fw-semibold text-secondary small text-uppercase"><?php echo $this->lang->line('Net Income') ?: 'Net Income'; ?></label>
                        <input type="number" step="0.01" class="form-control" id="net_income" name="net_income" autocomplete="off" value="<?php echo set_value('net_income'); ?>" />
                      </div>
                    </div>
                  </div>

                </div>

                <div class="card-footer bg-transparent border-top border-light py-4 px-4 d-flex gap-2 justify-content-end">
                  <a href="<?php echo base_url('production') ?>" class="btn btn-light px-4 py-2 fw-medium rounded-3"><i class="ph ph-arrow-left me-2"></i><?php echo $this->lang->line('Back'); ?></a>
                  <button type="submit" class="btn btn-primary px-4 py-2 fw-medium rounded-3 shadow-sm d-flex align-items-center">
                    <i class="ph ph-floppy-disk me-2"></i> <?php echo $this->lang->line('Save'); ?>
                  </button>
                </div>
              </form>          
          </div>          
        </div>        
      </div>  

    </section>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2({width: '100%'});
  });
</script>
<?php $this->load->view('templates/alert'); ?>
