<div id="main">
  <div class="main-container">
    <div class="page-header-card mb-4">
      <div>
        <h4><i class="ph ph-newspaper me-2 text-primary"></i><?php echo $this->lang->line('News'); ?></h4>
        <p>Latest announcements, articles, and documents published.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none small text-secondary">Home</a></li>
          <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('News'); ?></li>
        </ol>
      </nav>
    </div>

<!-----------------------------------------------------------  View ------------------------------------------------------------------>
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

        <div class="d-flex justify-content-end mb-4">
            <?php if(in_array('createPost', $user_permission)): ?>         	
                <a href="<?php echo base_url('post/index') ?>" class="btn btn-primary d-flex align-items-center gap-2 rounded-3 shadow-sm px-4">
                    <i class="ph ph-wrench"></i> <?php echo $this->lang->line('Manage Post'); ?> 
                </a>
            <?php endif; ?>
        </div>        

        <div class="row g-4">
        <?php if(!empty($post_data)): ?>
      	    <?php foreach($post_data as $post) : ?>
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white hover-lift transition-all">
                    <div class="row g-0 h-100">
                        <div class="col-md-3 bg-light d-flex align-items-center justify-content-center p-4 border-end border-light position-relative">	
                            <?php 
                                $doc_type = isset($post['doc_type']) ? $post['doc_type'] : '';
                                if(strpos($doc_type,'application/vnd') !== false): 
                            ?>  
                            <img class="img-fluid rounded-3 shadow-sm border border-2 border-white" src="<?php echo site_url(); ?>upload/posts/msoffice.jpg" style="max-height: 180px; object-fit: contain;">
                            <?php elseif(strpos($doc_type,'application/pdf') !== false): ?>  
                            <img class="img-fluid rounded-3 shadow-sm border border-2 border-white" src="<?php echo site_url(); ?>upload/posts/pdf.png" style="max-height: 180px; object-fit: contain;">   
                            <?php else: ?>  
                            <img class="img-fluid rounded-3 shadow-sm border border-2 border-white" src="<?php echo site_url(); ?>upload/posts/<?php echo $post['post_image']; ?>" style="max-height: 200px; object-fit: cover; width: 100%;">
                            <?php endif; ?>   
                            
                            <a href="<?php echo site_url(); ?>upload/posts/<?php echo $post['post_image']; ?>" target="_blank" class="btn btn-light position-absolute top-0 start-0 m-3 rounded-circle shadow border-0" style="width: 36px; height: 36px; padding: 0; display:flex; align-items:center; justify-content:center; opacity: 0.9;">
                                <i class="ph ph-magnifying-glass-plus text-primary fs-5"></i>
                            </a>
                        </div>

                        <div class="col-md-9">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                
                                <div class="mb-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary mb-2 rounded-pill px-3 py-1"><?php echo $post['name']; ?></span>
                                    <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                                        <?php echo $post['post_title']; ?>
                                    </h4>	
                                    <p class="text-muted small mb-0 d-flex align-items-center gap-1">
                                        <i class="ph ph-clock"></i> <?php echo $this->lang->line('Posted on'); ?> <?php echo date('M d, Y g:i A', strtotime($post['updated_date'])); ?>
                                    </p>
                                </div>
                                
                                <div class="text-secondary flex-grow-1 doc-content" style="font-size: 0.95rem; line-height: 1.6;">
                                    <?php 
                                        $news_content = html_entity_decode($post['post_text']); 
                                        $news_content = strip_tags($news_content);
                                        echo (strlen($news_content) > 200) ? substr($news_content, 0, 200) . '...' : $news_content;
                                    ?>		
                                </div>
                                
                                <?php if(in_array('viewPost', $user_permission)): ?>
                                    <div class="mt-4 pt-3 border-top border-light text-end">
                                        <a href="<?php echo base_url('post/view_post/'.$post['post_id']) ?>" class="btn btn-outline-primary rounded-3 px-4 fw-medium d-inline-flex align-items-center gap-2 ui-btn">
                                            <?php echo $this->lang->line('View Post'); ?> <i class="ph ph-arrow-right"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		    <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 bg-white text-center py-5">
                    <div class="card-body py-5">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-light text-secondary rounded-circle" style="width: 80px; height: 80px;">
                                <i class="ph ph-newspaper fs-1"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">No News Available</h4>
                        <p class="text-muted mb-0">There are currently no active announcements or news items to display.</p>
                        
                        <?php if(in_array('createPost', $user_permission)): ?>
                        <div class="mt-4">
                            <a href="<?php echo base_url('post/create') ?>" class="btn btn-primary d-inline-flex align-items-center gap-2 rounded-3 shadow-sm px-4">
                                <i class="ph ph-plus-circle"></i> Create First Post
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>

        <div class="d-flex justify-content-center mt-5">
            <?php echo $this->pagination->create_links(); ?>
        </div>

	</div>
  </div>
 </section>
</div>

<style>
    .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.06) !important; border-color: #e2e8f0; }
    .transition-all { transition: all 0.2s ease; }
    .doc-content img { max-width: 100%; height: auto; border-radius: 0.5rem; margin-top: 1rem; }
    .ui-btn:hover i { transform: translateX(4px); transition: transform 0.2s; }
    .btn-outline-primary { border-color: #e2e8f0; color: #475569; }
    .btn-outline-primary:hover { background-color: #f8fafc; color: #1a4b9c; border-color: #cbd5e1; }
</style>
