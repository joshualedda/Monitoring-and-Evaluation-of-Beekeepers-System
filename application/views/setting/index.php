<div id="main">
  <div class="main-container">

    <div class="page-header-card mb-4">
      <div>
        <h4><i class="ph ph-gear me-2 text-primary"></i><?php echo $this->lang->line('Settings'); ?></h4>
        <p>System configuration and module management components.</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>" class="text-decoration-none small text-secondary">Home</a></li>
          <li class="breadcrumb-item active small text-primary fw-medium"><?php echo $this->lang->line('Settings'); ?></li>
        </ol>
      </nav>
    </div>

  <!-------------------------------------------------  Main ------------------------------------------------------->
  
  <section class="content">

  <?php if($user_permission): ?>

    <div class="row g-4">

       <!-- Location Module -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift bg-white">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-light-primary rounded-4 text-primary d-flex align-items-center justify-content-center">
                        <i class="ph ph-map-pin fs-2"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1 text-dark"><?php echo $this->lang->line('Location'); ?></h5>
                        <p class="text-muted small mb-0">Regional management</p>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pb-4 pt-2">
                <div class="d-flex flex-column">  
                <?php if(in_array('createRegion', $user_permission) || in_array('updateRegion', $user_permission) || in_array('viewRegion', $user_permission) || in_array('deleteRegion', $user_permission)): ?>
                    <a href="<?php echo base_url('region/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-primary opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Region'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>  
                
                <?php if(in_array('createProvince', $user_permission) || in_array('updateProvince', $user_permission) || in_array('viewProvince', $user_permission) || in_array('deleteProvince', $user_permission)): ?>
                    <a href="<?php echo base_url('province/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-primary opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Province'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>                

                <?php if(in_array('createLgu', $user_permission) || in_array('updateLgu', $user_permission) || in_array('viewLgu', $user_permission) || in_array('deleteLgu', $user_permission)): ?>
                    <a href="<?php echo base_url('lgu/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-primary opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Lgu'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>  

                <?php if(in_array('createBarangay', $user_permission) || in_array('updateBarangay', $user_permission) || in_array('viewBarangay', $user_permission) || in_array('deleteBarangay', $user_permission)): ?>
                    <a href="<?php echo base_url('barangay/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light mb-0">
                        <span><i class="ph ph-circle me-2 text-primary opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Barangay'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>  
                </div>  
            </div>
          </div>
        </div>

      
        <!-- Beekeeper Module -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift bg-white">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-light-warning rounded-4 text-warning d-flex align-items-center justify-content-center">
                        <i class="ph ph-users-three fs-2"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1 text-dark"><?php echo $this->lang->line('Beekeeper'); ?></h5>
                        <p class="text-muted small mb-0">Member configuration</p>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pb-4 pt-2">
                <div class="d-flex flex-column">  
                   <?php if(in_array('createAssociation', $user_permission) || in_array('updateAssociation', $user_permission) || in_array('viewAssociation', $user_permission) || in_array('deleteAssociation', $user_permission)): ?>
                    <a href="<?php echo base_url('association/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-warning opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Association'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>

                <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                    <a href="<?php echo base_url('category/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-warning opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Category'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>               

                <?php if(in_array('createGender', $user_permission) || in_array('updateGender', $user_permission) || in_array('viewGender', $user_permission) || in_array('deleteGender', $user_permission)): ?>
                    <a href="<?php echo base_url('gender/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-warning opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Gender'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>

               <?php if(in_array('createNationality', $user_permission) || in_array('updateNationality', $user_permission) || in_array('viewNationality', $user_permission) || in_array('deleteNationality', $user_permission)): ?>
                    <a href="<?php echo base_url('nationality/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-warning opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Nationality'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?> 

              <?php if(in_array('createEducation', $user_permission) || in_array('updateEducation', $user_permission) || in_array('viewEducation', $user_permission) || in_array('deleteEducation', $user_permission)): ?>
                    <a href="<?php echo base_url('education/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-warning opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Education'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>

                <?php if(in_array('createFund_Source', $user_permission) || in_array('updateFund_Source', $user_permission) || in_array('viewInquiryFund_Source', $user_permission) || in_array('deleteFund_Source', $user_permission)): ?>
                    <a href="<?php echo base_url('fund_source/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-warning opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Fund Source'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>    

                <?php if(in_array('createInquiryType', $user_permission) || in_array('updateInquiryType', $user_permission) || in_array('viewInquiryType', $user_permission) || in_array('deleteInquiryType', $user_permission)): ?>
                    <a href="<?php echo base_url('inquiry_type/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-warning opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Inquiry Type'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>    

                <?php if(in_array('createSupportType', $user_permission) || in_array('updateSupportType', $user_permission) || in_array('viewSupportType', $user_permission) || in_array('deleteSupportType', $user_permission)): ?>
                    <a href="<?php echo base_url('support_type/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light mb-0">
                        <span><i class="ph ph-circle me-2 text-warning opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Support Type'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>      
               
                </div>
            </div>
          </div>
        </div>  


        <!-- Apiary and Colony Module -->
        <div class="col-12 col-md-6 col-lg-4">   
          <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift bg-white">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-light-info rounded-4 text-info d-flex align-items-center justify-content-center">
                        <i class="ph ph-cube fs-2"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1 text-dark"><?php echo $this->lang->line('Apiary and Colony'); ?></h5>
                        <p class="text-muted small mb-0">Sites and yields</p>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pb-4 pt-2">
                <div class="d-flex flex-column">   
                <?php if(in_array('createSpecies', $user_permission) || in_array('updateSpecies', $user_permission) || in_array('viewSpecies', $user_permission) || in_array('deleteSpecies', $user_permission)): ?>
                    <a href="<?php echo base_url('species/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-info opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Species'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>  
                
                <?php if(in_array('createSource', $user_permission) || in_array('updateSource', $user_permission) || in_array('viewSource', $user_permission) || in_array('deleteSource', $user_permission)): ?>
                    <a href="<?php echo base_url('source/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-info opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Source'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>

                <?php if(in_array('createTopography', $user_permission) || in_array('updateTopography', $user_permission) || in_array('viewTopography', $user_permission) || in_array('deleteTopography', $user_permission)): ?>
                    <a href="<?php echo base_url('topography/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-info opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Topography'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>

                <?php if(in_array('createPhase', $user_permission) || in_array('updatePhase', $user_permission) || in_array('viewPhase', $user_permission) || in_array('deletePhase', $user_permission)): ?>
                    <a href="<?php echo base_url('phase/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-info opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Phase'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>

                 <?php if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                    <a href="<?php echo base_url('product/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-info opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Product'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>

                 <?php if(in_array('createByproduct', $user_permission) || in_array('updateByproduct', $user_permission) || in_array('viewByproduct', $user_permission) || in_array('deleteByproduct', $user_permission)): ?>
                    <a href="<?php echo base_url('byproduct/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-info opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('By Product'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                <?php endif; ?>

                <?php if(in_array('createDocumentType', $user_permission) || in_array('updateDocumentType', $user_permission) || in_array('viewDocumentType', $user_permission) || in_array('deleteDocumentType', $user_permission)): ?>
                    <a href="<?php echo base_url('document_type/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light mb-0">
                        <span><i class="ph ph-circle me-2 text-info opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Document Type'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                  <?php endif; ?>
                </div>
            </div>
          </div>
        </div>  


        <!-- User Management Module -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift bg-white">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-4 text-white d-flex align-items-center justify-content-center" style="background-color: #6366f1;">
                        <i class="ph ph-identification-card fs-2"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1 text-dark"><?php echo $this->lang->line('User'); ?></h5>
                        <p class="text-muted small mb-0">Account controls</p>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pb-4 pt-2">
                <div class="d-flex flex-column">    
                 <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                      <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                        <a href="<?php echo base_url('user') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                           <span><i class="ph ph-circle me-2 opacity-50" style="color: #6366f1; font-size: 0.65rem;"></i><?php echo $this->lang->line('User'); ?></span>
                           <i class="ph ph-caret-right text-muted small opacity-50"></i>
                        </a>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if(in_array('createProfile', $user_permission) || in_array('updateProfile', $user_permission) || in_array('viewProfile', $user_permission) || in_array('deleteProfile', $user_permission)): ?> 
                      <?php if(in_array('updateProfile', $user_permission) || in_array('viewProfile', $user_permission) || in_array('deleteProfile', $user_permission)): ?>
                        <a href="<?php echo base_url('profile') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light mb-0">
                           <span><i class="ph ph-circle me-2 opacity-50" style="color: #6366f1; font-size: 0.65rem;"></i><?php echo $this->lang->line('Profile'); ?></span>
                           <i class="ph ph-caret-right text-muted small opacity-50"></i>
                        </a>
                        <?php endif; ?>
                  <?php endif; ?>
                </div>  
            </div>
          </div>
        </div>  


        <!-- News Module -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift bg-white">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-light-danger rounded-4 text-danger d-flex align-items-center justify-content-center">
                        <i class="ph ph-newspaper fs-2"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1 text-dark"><?php echo $this->lang->line('News'); ?></h5>
                        <p class="text-muted small mb-0">Communications</p>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pb-4 pt-2">
                <div class="d-flex flex-column">    
                  <?php if(in_array('createPostCategory', $user_permission) || in_array('updatePostCategory', $user_permission) || in_array('viewPostCategory', $user_permission) || in_array('deletePostCategory', $user_permission)): ?>
                    <a href="<?php echo base_url('post_category/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                        <span><i class="ph ph-circle me-2 text-danger opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Category'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                  <?php endif; ?>

                  <?php if(in_array('createPost', $user_permission) || in_array('updatePost', $user_permission) || in_array('viewPost', $user_permission) || in_array('deletePost', $user_permission)): ?>
                    <a href="<?php echo base_url('post/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light mb-0">
                        <span><i class="ph ph-circle me-2 text-danger opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Post'); ?></span>
                        <i class="ph ph-caret-right text-muted small opacity-50"></i>
                    </a>
                  <?php endif; ?>                  
                </div>  
            </div>
          </div>
        </div>
       
        <!-- System Module -->
        <?php if(in_array('updateSystem', $user_permission)): ?>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift bg-white">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-secondary bg-opacity-10 rounded-4 text-dark d-flex align-items-center justify-content-center">
                        <i class="ph ph-terminal fs-2"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1 text-dark"><?php echo $this->lang->line('System'); ?></h5>
                        <p class="text-muted small mb-0">Maintenance logs</p>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pb-4 pt-2">
                <div class="d-flex flex-column"> 
                  <a href="<?php echo base_url('backup/database_backup') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                      <span><i class="ph ph-circle me-2 text-dark opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Backup Database'); ?></span>
                      <i class="ph ph-caret-right text-muted small opacity-50"></i>
                  </a>
                  <a href="<?php echo base_url('backup/zip_upload') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                      <span><i class="ph ph-circle me-2 text-dark opacity-50" style="font-size: 0.65rem;"></i>File Backup</span>
                      <i class="ph ph-caret-right text-muted small opacity-50"></i>
                  </a>       
                  <a href="<?php echo base_url('documentation/user_guide/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                      <span><i class="ph ph-circle me-2 text-dark opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Documentation'); ?></span>
                      <i class="ph ph-caret-right text-muted small opacity-50"></i>
                  </a>
                  <a href="<?php echo base_url('documentation/test_case/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light">
                      <span><i class="ph ph-circle me-2 text-dark opacity-50" style="font-size: 0.65rem;"></i><?php echo $this->lang->line('Test Case'); ?></span>
                      <i class="ph ph-caret-right text-muted small opacity-50"></i>
                  </a>
                  <a href="<?php echo base_url('documentation/database_schema/') ?>" class="text-decoration-none text-secondary hover-primary transition-all py-2 px-3 rounded-3 ui-link d-flex align-items-center justify-content-between border-bottom border-light mb-0">
                      <span><i class="ph ph-circle me-2 text-dark opacity-50" style="font-size: 0.65rem;"></i>Schema</span>
                      <i class="ph ph-caret-right text-muted small opacity-50"></i>
                  </a>
                </div>  
            </div>
          </div>
        </div>
        <?php endif; ?>
       
    </div>    <!-- row --> 

  <?php endif; ?> <!-- user permission info -->
          
  </section>   <!-- main section --> 

</div> <!-- Content Wrapper. Contains page content -->

<style>
    .bg-light-primary  { background-color: #e8f1ff; }
    .bg-light-danger   { background-color: #fff0f0; }
    .bg-light-info     { background-color: #e6f7ff; }
    .bg-light-warning  { background-color: #fff9e6; }
    .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important; }
    .transition-all { transition: all 0.2s ease; }
    .ui-link { border: 1px solid transparent; }
    .ui-link:hover { background-color: #f8f9fa; border-color: #f1f3f5 !important; }
    .ui-link:hover span i.ph-circle { opacity: 1 !important; transform: scale(1.2); }
    .ui-link:hover i.ph-caret-right { opacity: 1 !important; transform: translateX(3px); color: #1a4b9c !important; }
    .ui-link i { transition: all 0.2s ease; }
</style>

<script>
    $(document).ready(function() {
        $("#settingNav").addClass('active');
    });
</script>
