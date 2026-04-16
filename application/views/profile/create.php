  <!-- Content Wrapper. Contains page content -->
  <div id="main">
  <div class="main-container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $this->lang->line('Add Profile'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home'); ?></a></li>
        <li class="active"><?php echo $this->lang->line('Profile'); ?></li>
      </ol>
    </section>



<!-------------------------------------------------  Main ------------------------------------------------------->    

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
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

          <div class="box">
            <div class="box-header"></div>
            <form role="form" action="<?php base_url('profile/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="row">
          <div class="col-md-9 col-xs-9">
            <div class="form-profile">
              <label for="name"><?php echo $this->lang->line('Profile Name'); ?> <font color="red">*</font></label>
              <input type="text" class="form-control" id="name" name="name" >
            </div>
          </div>  

           <div class="col-md-3 col-xs-3">
            <div class="form-profile" align="right">
              <input type="checkbox" name="protected" id="protected" class="minimal" value="1">
              <label for="proctected">&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('Profile Protected'); ?></label>
          </div>  
        </div>
      </div>

        <br>

    <div class="row">

       <!-- < Part on Location -->

        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading bg-black"><?php echo $this->lang->line('Location'); ?></div>
              <div class="panel-body">

                <ul class="chart-legend" style="height:460px">

                <table class="table table-responsive">
                   <thead> 
                      <tr>
                        <th></th>
                        <th><?php echo $this->lang->line('Create'); ?></th>
                        <th><?php echo $this->lang->line('Update'); ?></th>
                        <th><?php echo $this->lang->line('View'); ?></th>
                        <th><?php echo $this->lang->line('Delete'); ?></th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><?php echo $this->lang->line('Region'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createRegion" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateRegion" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewRegion" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteRegion" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Province'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProvince" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProvince" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProvince" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProvince" class="minimal"></td>
                      </tr>
                                            
                      <tr>
                        <td><?php echo $this->lang->line('Lgu'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createLgu" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateLgu" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewLgu" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteLgu" class="minimal"></td>
                      </tr> 
                      <tr>
                        <td><?php echo $this->lang->line('Barangay'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createBarangay" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBarangay" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBarangay" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBarangay" class="minimal"></td>
                      </tr>   
                    </tbody> 
              </table>
            </ul>
          </div></div></div>



 <!-- < Part on Beekeeper -->

        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading bg-black"><?php echo $this->lang->line('Beekeeper'); ?></div>
              <div class="panel-body">

                <ul class="chart-legend" style="height:460px">

                <table class="table table-responsive">
                   <thead> 
                      <tr>
                        <th></th>
                        <th><?php echo $this->lang->line('Create'); ?></th>
                        <th><?php echo $this->lang->line('Update'); ?></th>
                        <th><?php echo $this->lang->line('View'); ?></th>
                        <th><?php echo $this->lang->line('Delete'); ?></th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><?php echo $this->lang->line('Beekeeper'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createBeekeeper" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBeekeeper" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBeekeeper" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBeekeeper" class="minimal"></td>
                      </tr>  
                      <tr>
                        <td><?php echo $this->lang->line('Association'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createAssociation" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateAssociation" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAssociation" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteAssociation" class="minimal"></td>
                      </tr> 
                       <tr>
                        <td><?php echo $this->lang->line('Category'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCategory" class="minimal"></td>
                      </tr> 

                      <tr>
                        <td><?php echo $this->lang->line('Gender'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGender" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGender" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGender" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGender" class="minimal"></td>
                      </tr>

                      <tr>
                        <td><?php echo $this->lang->line('Nationality'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createNationality" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateNationality" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewNationality" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteNationality" class="minimal"></td>
                      </tr> 
                      <tr>
                        <td><?php echo $this->lang->line('Education'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createEducation" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateEducation" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewEducation" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteEducation" class="minimal"></td>
                      </tr> 
                      <tr>
                        <td><?php echo $this->lang->line('Fund Source'); ?> </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createFundSource" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateFundSource" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewFundSource" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteFundSource" class="minimal"></td>
                      </tr>                     
                      <tr>
                        <td><?php echo $this->lang->line('Inquiry'); ?> </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createInquiry" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateInquiry" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewInquiry" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteInquiry" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Inquiry Type'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createInquiryType" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateInquiryType" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewInquiryType" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteInquiryType" class="minimal"></td>
                      </tr> 
                      <tr>
                        <td><?php echo $this->lang->line('Support Type'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSupportType" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSupportType" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSupportType" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSupportType" class="minimal"></td>
                      </tr>
                      
                   </tbody> 
              </table>
            </ul>
          </div></div></div>
                      
                      
<!-- < Part on Colony -->

        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading bg-black"><?php echo $this->lang->line('Colony'); ?></div>
              <div class="panel-body">

                <ul class="chart-legend" style="height:460px">

                <table class="table table-responsive">
                   <thead> 
                      <tr>
                        <th></th>
                        <th><?php echo $this->lang->line('Create'); ?></th>
                        <th><?php echo $this->lang->line('Update'); ?></th>
                        <th><?php echo $this->lang->line('View'); ?></th>
                        <th><?php echo $this->lang->line('Delete'); ?></th>
                      </tr>
                    </thead>

                    <tbody>  

                       <tr>
                        <td><?php echo $this->lang->line('Apiary'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createApiary" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateApiary" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewApiary" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteApiary" class="minimal"></td>
                      </tr>                   

                       <tr>
                        <td><?php echo $this->lang->line('Colony'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createColony" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateColony" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewColony" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteColony" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Species'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSpecies" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSpecies" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSpecies" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSpecies" class="minimal"></td>
                      </tr>
                       <tr>
                        <td><?php echo $this->lang->line('Phase'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPhase" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePhase" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPhase" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePhase" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Source'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSource" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSource" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSource" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSource" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Topography'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createTopography" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateTopography" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewTopography" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteTopography" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Production'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProduction" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProduction" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProduction" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProduction" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Product'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProduct" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('By Product'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createByproduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateByproduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewByproduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteByproduct" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Document'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDocument" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateDocument" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewDocument" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteDocument" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Document Type'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDocumentType" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateDocumentType" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewDocumentType" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteDocumentType" class="minimal"></td>
                      </tr>
                  </tbody> 
              </table>
            </ul>
          </div></div></div>
                      
                      
<!-- < Part on User -->

        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading bg-black"><?php echo $this->lang->line('User'); ?></div>
              <div class="panel-body">

                <ul class="chart-legend" style="height:180px">

                <table class="table table-responsive">
                   <thead> 
                      <tr>
                        <th></th>
                        <th><?php echo $this->lang->line('Create'); ?></th>
                        <th><?php echo $this->lang->line('Update'); ?></th>
                        <th><?php echo $this->lang->line('View'); ?></th>
                        <th><?php echo $this->lang->line('Delete'); ?></th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><?php echo $this->lang->line('User'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Profile'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProfile" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProfile" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProfile" class="minimal"></td>
                      </tr>
                        <tr>
                        <td><?php echo $this->lang->line('My Account'); ?></td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAccount" class="minimal"></td>
                        <td> - </td>
                      </tr>
                  </tbody> 
              </table>
            </ul>
          </div></div></div>
                      
                      
<!-- < Part on Post -->

        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading bg-black"><?php echo $this->lang->line('News'); ?></div>
              <div class="panel-body">

                <ul class="chart-legend" style="height:180px">

                <table class="table table-responsive">
                   <thead> 
                      <tr>
                        <th></th>
                        <th><?php echo $this->lang->line('Create'); ?></th>
                        <th><?php echo $this->lang->line('Update'); ?></th>
                        <th><?php echo $this->lang->line('View'); ?></th>
                        <th><?php echo $this->lang->line('Delete'); ?></th>
                      </tr>
                    </thead>
                  <tbody>    
                       <tr>
                        <td><?php echo $this->lang->line('Category'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPostCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePostCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPostCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePostCategory" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Post'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPost" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePost" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPost" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePost" class="minimal"></td>
                      </tr>

                  </tbody> 
              </table>
            </ul>
          </div></div></div>
                      
<!-- < Part on Menu -->

        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading bg-black"><?php echo $this->lang->line('Menu'); ?></div>
              <div class="panel-body">

                <ul class="chart-legend" style="height:180px">

                <table class="table table-responsive">
                   <thead> 
                      <tr>
                        <th></th>
                        <th><?php echo $this->lang->line('Create'); ?></th>
                        <th><?php echo $this->lang->line('Update'); ?></th>
                        <th><?php echo $this->lang->line('View'); ?></th>
                        <th><?php echo $this->lang->line('Delete'); ?></th>
                      </tr>
                    </thead>
                  <tbody>    
                      <tr>
                        <td><?php echo $this->lang->line('Reports'); ?></td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewReport" class="minimal"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Settings'); ?></td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('System'); ?></td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSystem" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>                  

                  </table>
                  
                </div>
              </div>      <!-- /.box-body -->
            </ul>  
          </div>  

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save'); ?></button>
                <a href="<?php echo base_url('profile/') ?>" class="btn btn-warning"><?php echo $this->lang->line('Back'); ?></a>
              </div>
            </form>
          </div>          <!-- /.box -->
        </div>        <!-- col-md-12 -->
      </div>      <!-- /.row -->      

    </section>    <!-- /.content -->
  </div>  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#mainProfileNav").addClass('active');
    $("#addProfileNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>

