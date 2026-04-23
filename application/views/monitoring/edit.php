<div id="main">
  <div class="main-container">
    <div class="page-header-card">
      <div>
        <h4><i class="ph ph-pencil-simple me-2 text-primary"></i>Edit Monitoring Log</h4>
        <p>Update information for the selected monitoring entry.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('monitoring') ?>" class="text-decoration-none">Monitoring</a></li>
          <li class="breadcrumb-item active">Edit Log</li>
        </ol>
      </nav>
    </div>

    <section class="content">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <form role="form" action="<?php echo base_url('monitoring/update/'.$monitoring_data['id']) ?>" method="post">
              <div class="card-body p-4">
                <?php echo validation_errors(); ?>

                <div class="row g-4">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="apiary" class="form-label fw-bold">Target Apiary</label>
                      <select class="form-select rounded-3" id="apiary" name="apiary">
                        <option value="">Select Apiary</option>
                        <?php foreach ($apiaries as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>" <?php if($monitoring_data['apiary_id'] == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['location'] ?> - <?php echo $v['beekeeper_name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="monitoring_date" class="form-label fw-bold">Monitoring Date</label>
                      <input type="date" class="form-control rounded-3" id="monitoring_date" name="monitoring_date" value="<?php echo !empty($monitoring_data['monitoring_date']) ? $monitoring_data['monitoring_date'] : date('Y-m-d', strtotime($monitoring_data['created_at'])); ?>">
                    </div>
                  </div>
                  
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="action" class="form-label fw-bold">Primary Action</label>
                      <select class="form-select rounded-3" id="action" name="action">
                        <option value="none" <?php if($monitoring_data['action'] == 'none') { echo "selected='selected'"; } ?>>None / Observation Only</option>
                        <option value="inspect" <?php if($monitoring_data['action'] == 'inspect') { echo "selected='selected'"; } ?>>Inspect</option>
                        <option value="treat" <?php if($monitoring_data['action'] == 'treat') { echo "selected='selected'"; } ?>>Treat</option>
                        <option value="harvest" <?php if($monitoring_data['action'] == 'harvest') { echo "selected='selected'"; } ?>>Harvest</option>
                        <option value="feed" <?php if($monitoring_data['action'] == 'feed') { echo "selected='selected'"; } ?>>Feed</option>
                        <option value="relocate" <?php if($monitoring_data['action'] == 'relocate') { echo "selected='selected'"; } ?>>Relocate</option>
                        <option value="alert" <?php if($monitoring_data['action'] == 'alert') { echo "selected='selected'"; } ?>>Alert / Emergency</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="mb-3">
                      <label for="observation" class="form-label fw-bold">Observations</label>
                      <textarea type="text" class="form-control rounded-3" id="observation" name="observation" rows="3"><?php echo $monitoring_data['observation'] ?></textarea>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="mb-3">
                      <label for="report" class="form-label fw-bold">Detailed Report / Findings</label>
                      <textarea type="text" class="form-control rounded-3" id="report" name="report" rows="5"><?php echo $monitoring_data['report'] ?></textarea>
                    </div>
                  </div>
                  
                  <div class="col-12 mt-0">
                    <p class="small text-muted">Last updated on: <?php echo date('F j, Y, g:i a', strtotime($monitoring_data['created_at'])) ?></p>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-light p-4 border-0 d-flex justify-content-end gap-2">
                <a href="<?php echo base_url('monitoring/') ?>" class="btn btn-light px-4 rounded-3">Cancel</a>
                <button type="submit" class="btn btn-primary px-4 rounded-3">Update Log Entry</button>
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
  $("#mainMonitoringNav").addClass('active');
});
</script>
