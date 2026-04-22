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
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white hover-lift transition-all mb-3">
                    <div class="row g-0">
                        <!-- Post Image -->
                        <div class="col-md-4 position-relative p-0 overflow-hidden border-end">
                            <?php 
                                $doc_type = isset($post['doc_type']) ? $post['doc_type'] : '';
                                if(strpos($doc_type,'application/vnd') !== false): 
                                    $img_src = site_url()."upload/posts/msoffice.jpg";
                                elseif(strpos($doc_type,'application/pdf') !== false): 
                                    $img_src = site_url()."upload/posts/pdf.png";
                                else: 
                                    $img_src = site_url()."upload/posts/".$post['post_image'];
                                endif; 
                            ?>
                            <div class="h-100 bg-light" style="min-height: 240px;">
                                <img class="img-fluid h-100 w-100" src="<?php echo $img_src; ?>" style="object-fit: cover;">
                            </div>
                            
                            <a href="<?php echo $img_src; ?>" target="_blank" class="btn btn-white bg-white position-absolute top-0 end-0 m-3 rounded-circle shadow-sm border-0 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; z-index: 2;">
                                <i class="ph ph-magnifying-glass-plus text-primary fs-5"></i>
                            </a>
                        </div>

                        <!-- Post Content -->
                        <div class="col-md-8">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1"><?php echo $post['name']; ?></span>
                                        <span class="text-muted small d-flex align-items-center gap-1">
                                            <i class="ph ph-clock"></i> <?php echo date('g:i A', strtotime($post['updated_date'])); ?>
                                        </span>
                                    </div>
                                    
                                    <h4 class="fw-bold text-dark mb-2">
                                        <?php echo $post['post_title']; ?>
                                    </h4>
                                    
                                    <!-- Metadata: Author and Slug -->
                                    <div class="d-flex flex-wrap gap-3 text-muted small mt-2">
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="ph ph-calendar text-primary"></i> 
                                            <span class="fw-medium"><?php echo date('M d, Y', strtotime($post['updated_date'])); ?></span>
                                        </div>
                                        <div class="d-flex align-items-center gap-1 border-start ps-3">
                                            <i class="ph ph-user-circle text-primary"></i> 
                                            <span>By <span class="text-dark fw-medium"><?php echo $post['posted_by'] ?? 'Administrator'; ?></span></span>
                                        </div>
                                        <?php if(!empty($post['post_slug'])): ?>
                                        <div class="d-flex align-items-center gap-1 border-start ps-3">
                                            <i class="ph ph-link-simple text-primary"></i> 
                                            <span class="text-primary opacity-75"><?php echo $post['post_slug']; ?></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="text-secondary flex-grow-1 doc-content mb-3" style="font-size: 0.95rem; line-height: 1.6;">
                                    <?php 
                                        $news_content = html_entity_decode($post['post_text']); 
                                        $news_content = strip_tags($news_content);
                                        echo (strlen($news_content) > 180) ? substr($news_content, 0, 180) . '...' : $news_content;
                                    ?>		
                                </div>
                                
                                <div class="mt-auto pt-3 border-top border-light d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">
                                        ID: <span class="fw-mono text-dark">#<?php echo $post['post_id']; ?></span>
                                    </div>
                                    <?php if(in_array('viewPost', $user_permission)): ?>
                                        <a href="<?php echo base_url('post/view_post/'.$post['post_id']) ?>" class="btn btn-outline-primary rounded-pill px-4 btn-sm fw-medium d-inline-flex align-items-center gap-2 ui-btn">
                                            Full Article <i class="ph ph-arrow-right"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
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
