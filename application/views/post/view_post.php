<div id="main">
  <div class="main-container">

    <!-- ── Page Header ──────────────────────────────────────── -->
    <div class="page-header-card mb-4">
      <div>
        <h4><i class="ph ph-article me-2 text-primary"></i><?php echo $this->lang->line('News Article'); ?></h4>
        <p>Viewing complete announcement details and associated documents.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none text-secondary">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('post/index') ?>" class="text-decoration-none text-secondary"><?php echo $this->lang->line('News'); ?></a></li>
          <li class="breadcrumb-item active text-primary fw-medium"><?php echo $post_data['post_title']; ?></li>
        </ol>
      </nav>
    </div>

    <!-- ── Main Content ──────────────────────────────────────── -->
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
      <?php endif; ?>

      <div class="d-flex justify-content-end mb-4 gap-2">
        <?php if(in_array('updatePost', $user_permission)): ?>         	
          <a href="<?php echo base_url('post/update/'.$post_data['id']) ?>" class="btn btn-primary d-inline-flex align-items-center gap-2 rounded-3 shadow-sm px-4">
            <i class="ph ph-pencil-simple"></i> <?php echo $this->lang->line('Edit Post'); ?> 
          </a>
        <?php endif; ?>
        <a href="<?php echo base_url('post/index') ?>" class="btn btn-light d-inline-flex align-items-center gap-2 rounded-3 px-4">
           <i class="ph ph-arrow-left"></i> Back to News
        </a>
      </div>   

      <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        
        <div class="card-body p-0">
           <!-- Article Header Block -->
           <div class="bg-light p-4 p-md-5 border-bottom border-light">
                <span class="badge bg-primary bg-opacity-10 text-primary mb-3 rounded-pill px-3 py-2 fs-6 border border-primary-subtle">
                    <i class="ph ph-folder me-1"></i> <?php echo $post_data['name']; ?>
                </span>
                
                <h1 class="fw-bold text-dark mb-3" style="font-size: 2.25rem; line-height: 1.3;">
                    <?php echo $post_data['post_title']; ?>
                </h1>

                <div class="d-flex align-items-center text-secondary gap-3 small">
                    <div class="d-flex align-items-center gap-1">
                        <i class="ph ph-calendar-blank"></i> 
                        <?php echo $this->lang->line('Posted on'); ?> <?php echo date('F d, Y h:i A', strtotime($post_data['updated_date'])); ?>
                    </div>
                </div>
           </div>

           <!-- Article Body Content -->
           <div class="row g-0">
               <?php if(!empty($post_data['post_image'])): ?>
               <div class="col-lg-3 col-md-4 bg-white p-4 border-end border-light text-center position-relative">
                    <?php 
                        $doc_type = isset($post_data['doc_type']) ? $post_data['doc_type'] : '';
                        if(strpos($doc_type,'application/vnd') !== false): 
                    ?>  
                        <img class="img-fluid rounded-3 shadow-sm border border-2 border-white w-100 mb-3" src="<?php echo site_url(); ?>upload/posts/msoffice.jpg" style="object-fit: contain; max-width: 250px;">
                    <?php elseif(strpos($doc_type,'application/pdf') !== false): ?>  
                        <img class="img-fluid rounded-3 shadow-sm border border-2 border-white w-100 mb-3" src="<?php echo site_url(); ?>upload/posts/pdf.png" style="object-fit: contain; max-width: 250px;">   
                    <?php else: ?>  
                        <img class="img-fluid rounded-3 shadow-sm border border-2 border-white w-100 mb-3" src="<?php echo site_url(); ?>upload/posts/<?php echo $post_data['post_image']; ?>" style="object-fit: cover; max-width: 250px;">
                    <?php endif; ?>

                    <a href="<?php echo site_url(); ?>upload/posts/<?php echo $post_data['post_image']; ?>" target="_blank" class="btn btn-outline-primary w-100 rounded-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="ph ph-magnifying-glass-plus"></i> View Original Media
                    </a>
               </div>
               <div class="col-lg-9 col-md-8 p-4 p-md-5">
               <?php else: ?>
               <div class="col-12 p-4 p-md-5">
               <?php endif; ?>

                    <div class="text-secondary doc-content" style="font-size: 1.05rem; line-height: 1.8;">
                        <?php echo html_entity_decode($post_data['post_text']); ?>	
                    </div>

               </div>
           </div>
        </div>

        <div class="card-footer bg-light border-top border-light p-4 p-md-5">
            <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                <i class="ph ph-files text-primary"></i> Attached Documents
            </h5>
            
            <div class="datatable-wrapper border bg-white shadow-sm rounded-3">
                <table id="manageTableDocument" class="table align-middle mb-0" style="width:100%">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary small fw-semibold bg-light"><?php echo $this->lang->line('Document'); ?></th>
                        <th class="text-uppercase text-secondary small fw-semibold bg-light"><?php echo $this->lang->line('Size'); ?></th>
                        <th class="text-uppercase text-secondary small fw-semibold bg-light text-end pe-4"><?php echo $this->lang->line('Action'); ?></th>                                    
                    </tr>
                    </thead>
                </table>  
            </div>
        </div>

      </div>

    </section>
  </div>
</div>

<style>
    .doc-content h1, .doc-content h2, .doc-content h3 { color: #1e293b; font-weight: 700; margin-top: 1.5rem; margin-bottom: 1rem; }
    .doc-content p { margin-bottom: 1.5rem; }
    .doc-content img { max-width: 100%; height: auto; border-radius: 0.5rem; display: block; margin: 2rem auto; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); }
</style>

<!-- ── Javascript ── -->
<script type="text/javascript">
  var manageTableDocument;
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function() {
      $("#mainPostNav").addClass('active');

      manageTableDocument = $('#manageTableDocument').DataTable({
        'ajax': base_url+'post/fetchPostDocumentView/'+'<?php echo $post_data['id']; ?>',
        'language': {'url': "<?php echo $this->session->link_language; ?>"}, 
        'order': [[0, "asc"]],
        'dom': '<"px-3 pt-3"f>t<"px-3 pb-3 d-flex justify-content-between align-items-center"ip>',
        'pageLength': 5,
        'lengthChange': false,
        'info': false,
        'columnDefs': [
            { targets: 2, className: 'text-end pe-4' }
        ]
      });
  });
</script>
