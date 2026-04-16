  <div id="main">
  <div class="main-container">
    <section class="content-header">
      <h1><?php echo $this->lang->line('Edit Profile'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home'); ?></a></li>
        <li><a href="<?php echo base_url('profile/') ?>"><?php echo $this->lang->line('Profile'); ?></a></li>
        <li class="active"><?php echo $this->lang->line('Edit Profile'); ?></li>
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
            <form role="form" action="<?php base_url('profile/update') ?>" method="post">
              <div class="box-body">

         <?php echo validation_errors(); ?>

         <div class="row">
            <div class="col-md-9 col-xs-9">
              <div class="form-profile">
                <label for="name"><?php echo $this->lang->line('Profile Name'); ?> <font color="red">*</font></label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $profile_data['name']; ?>"
                 <?php if($profile_data['protected'] == 1) {echo 'disabled';} ?>>
                 <?php if($profile_data['protected'] == 1) {
                  echo '<input type="hidden" id="name" name="name" value='.$profile_data['name'].'>';
                }; ?>

              </div>
            </div>  

             <div class="col-md-3 col-xs-3">
              <div class="form-checkbox" align="right">
                <input type="checkbox" name="protected" id="protected" class="minimal" value="1"
                 <?php if($profile_data['protected'] == 1) {echo "checked"; } ?>>
                <label for="proctected">&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('Profile Protected'); ?></label>
            </div>  
          </div>
        </div> 

        <?php $serialize_permission = unserialize($profile_data['permission']); ?>

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
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createRegion" <?php if($serialize_permission) {
                          if(in_array('createRegion', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateRegion" <?php if($serialize_permission) {
                          if(in_array('updateRegion', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewRegion" <?php if($serialize_permission) {
                          if(in_array('viewRegion', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteRegion" <?php if($serialize_permission) {
                          if(in_array('deleteRegion', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Province'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createProvince" <?php if($serialize_permission) {
                          if(in_array('createProvince', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateProvince" <?php if($serialize_permission) {
                          if(in_array('updateProvince', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProvince" <?php if($serialize_permission) {
                          if(in_array('viewProvince', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteProvince" <?php if($serialize_permission) {
                          if(in_array('deleteProvince', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                                               
                      <tr>
                        <td><?php echo $this->lang->line('Lgu'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createLgu" <?php if($serialize_permission) {
                          if(in_array('createLgu', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateLgu" <?php if($serialize_permission) {
                          if(in_array('updateLgu', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewLgu" <?php if($serialize_permission) {
                          if(in_array('viewLgu', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteLgu" <?php if($serialize_permission) {
                          if(in_array('deleteLgu', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>   
                      <tr>
                        <td><?php echo $this->lang->line('Barangay'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createBarangay" <?php if($serialize_permission) {
                          if(in_array('createBarangay', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateBarangay" <?php if($serialize_permission) {
                          if(in_array('updateBarangay', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewBarangay" <?php if($serialize_permission) {
                          if(in_array('viewBarangay', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteBarangay" <?php if($serialize_permission) {
                          if(in_array('deleteBarangay', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
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
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createBeekeeper" <?php if($serialize_permission) {
                          if(in_array('createBeekeeper', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateBeekeeper" <?php if($serialize_permission) {
                          if(in_array('updateBeekeeper', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewBeekeeper" <?php if($serialize_permission) {
                          if(in_array('viewBeekeeper', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteBeekeeper" <?php if($serialize_permission) {
                          if(in_array('deleteBeekeeper', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Association'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createAssociation" <?php if($serialize_permission) {
                          if(in_array('createAssociation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateAssociation" <?php if($serialize_permission) {
                          if(in_array('updateAssociation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewAssociation" <?php if($serialize_permission) {
                          if(in_array('viewAssociation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteAssociation" <?php if($serialize_permission) {
                          if(in_array('deleteAssociation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Gender'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createGender" <?php if($serialize_permission) {
                          if(in_array('createGender', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateGender" <?php if($serialize_permission) {
                          if(in_array('updateGender', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewGender" <?php if($serialize_permission) {
                          if(in_array('viewGender', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteGender" <?php if($serialize_permission) {
                          if(in_array('deleteGender', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>   
                      <tr>
                        <td><?php echo $this->lang->line('Nationality'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createNationality" <?php if($serialize_permission) {
                          if(in_array('createNationality', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateNationality" <?php if($serialize_permission) {
                          if(in_array('updateNationality', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewNationality" <?php if($serialize_permission) {
                          if(in_array('viewNationality', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteNationality" <?php if($serialize_permission) {
                          if(in_array('deleteNationality', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td><?php echo $this->lang->line('Education'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createEducation" <?php if($serialize_permission) {
                          if(in_array('createEducation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateEducation" <?php if($serialize_permission) {
                          if(in_array('updateEducation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewEducation" <?php if($serialize_permission) {
                          if(in_array('viewEducation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteEducation" <?php if($serialize_permission) {
                          if(in_array('deleteEducation', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr> 

                      <tr>
                        <td><?php echo $this->lang->line('Category'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCategory" <?php if($serialize_permission) {
                          if(in_array('createCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCategory" <?php if($serialize_permission) {
                          if(in_array('updateCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCategory" <?php if($serialize_permission) {
                          if(in_array('viewCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCategory" <?php if($serialize_permission) {
                          if(in_array('deleteCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>            
                      <tr>
                        <td><?php echo $this->lang->line('Fund Source'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createFund_Source" <?php if($serialize_permission) {
                          if(in_array('createFund_Source', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateFund_Source" <?php if($serialize_permission) {
                          if(in_array('updateFund_Source', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewFund_Source" <?php if($serialize_permission) {
                          if(in_array('viewFund_Source', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteFund_Source" <?php if($serialize_permission) {
                          if(in_array('deleteFund_Source', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>                      
                      <tr>
                        <td><?php echo $this->lang->line('Inquiry'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createInquiry" <?php if($serialize_permission) {
                          if(in_array('createInquiry', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateInquiry" <?php if($serialize_permission) {
                          if(in_array('updateInquiry', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewInquiry" <?php if($serialize_permission) {
                          if(in_array('viewInquiry', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteInquiry" <?php if($serialize_permission) {
                          if(in_array('deleteInquiry', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                       <tr>
                        <td><?php echo $this->lang->line('Inquiry Type'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createInquiryType" <?php if($serialize_permission) {
                          if(in_array('createInquiryType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateInquiryType" <?php if($serialize_permission) {
                          if(in_array('updateInquiryType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewInquiryType" <?php if($serialize_permission) {
                          if(in_array('viewInquiryType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteInquiryType" <?php if($serialize_permission) {
                          if(in_array('deleteInquiryType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                       <tr>
                        <td><?php echo $this->lang->line('Support Type'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createSupportType" <?php if($serialize_permission) {
                          if(in_array('createSupportType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSupportType" <?php if($serialize_permission) {
                          if(in_array('updateSupportType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewSupportType" <?php if($serialize_permission) {
                          if(in_array('viewSupportType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteSupportType" <?php if($serialize_permission) {
                          if(in_array('deleteSupportType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
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
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createApiary" <?php if($serialize_permission) {
                          if(in_array('createApiary', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateApiary" <?php if($serialize_permission) {
                          if(in_array('updateApiary', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewApiary" <?php if($serialize_permission) {
                          if(in_array('viewApiary', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteApiary" <?php if($serialize_permission) {
                          if(in_array('deleteApiary', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>                          

                       <tr>
                        <td><?php echo $this->lang->line('Colony'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createColony" <?php if($serialize_permission) {
                          if(in_array('createColony', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateColony" <?php if($serialize_permission) {
                          if(in_array('updateColony', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewColony" <?php if($serialize_permission) {
                          if(in_array('viewColony', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteColony" <?php if($serialize_permission) {
                          if(in_array('deleteColony', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>                      
                      <tr>
                        <td><?php echo $this->lang->line('Species'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createSpecies" <?php if($serialize_permission) {
                          if(in_array('createSpecies', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSpecies" <?php if($serialize_permission) {
                          if(in_array('updateSpecies', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewSpecies" <?php if($serialize_permission) {
                          if(in_array('viewSpecies', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteSpecies" <?php if($serialize_permission) {
                          if(in_array('deleteSpecies', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      
                      <tr>
                        <td><?php echo $this->lang->line('Phase'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createPhase" <?php if($serialize_permission) {
                          if(in_array('createPhase', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updatePhase" <?php if($serialize_permission) {
                          if(in_array('updatePhase', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewPhase" <?php if($serialize_permission) {
                          if(in_array('viewPhase', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deletePhase" <?php if($serialize_permission) {
                          if(in_array('deletePhase', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Topography'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createTopography" <?php if($serialize_permission) {
                          if(in_array('createTopography', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateTopography" <?php if($serialize_permission) {
                          if(in_array('updateTopography', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewTopography" <?php if($serialize_permission) {
                          if(in_array('viewTopography', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteTopography" <?php if($serialize_permission) {
                          if(in_array('deleteTopography', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Source'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createSource" <?php if($serialize_permission) {
                          if(in_array('createSource', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSource" <?php if($serialize_permission) {
                          if(in_array('updateSource', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewSource" <?php if($serialize_permission) {
                          if(in_array('viewSource', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteSource" <?php if($serialize_permission) {
                          if(in_array('deleteSource', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Production'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createProduction" <?php if($serialize_permission) {
                          if(in_array('createProduction', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateProduction" <?php if($serialize_permission) {
                          if(in_array('updateProduction', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProduction" <?php if($serialize_permission) {
                          if(in_array('viewProduction', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteProduction" <?php if($serialize_permission) {
                          if(in_array('deleteProduction', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Product'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createProduct" <?php if($serialize_permission) {
                          if(in_array('createProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateProduct" <?php if($serialize_permission) {
                          if(in_array('updateProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProduct" <?php if($serialize_permission) {
                          if(in_array('viewProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteProduct" <?php if($serialize_permission) {
                          if(in_array('deleteProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('By Product'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createByproduct" <?php if($serialize_permission) {
                          if(in_array('createByproduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateByproduct" <?php if($serialize_permission) {
                          if(in_array('updateByproduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewByproduct" <?php if($serialize_permission) {
                          if(in_array('viewByproduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteByproduct" <?php if($serialize_permission) {
                          if(in_array('deleteByproduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Document'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createDocument" <?php if($serialize_permission) {
                          if(in_array('createDocument', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateDocument" <?php if($serialize_permission) {
                          if(in_array('updateDocument', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewDocument" <?php if($serialize_permission) {
                          if(in_array('viewDocument', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteDocument" <?php if($serialize_permission) {
                          if(in_array('deleteDocument', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                                           <tr>
                        <td><?php echo $this->lang->line('Document Type'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createDocumentType" <?php if($serialize_permission) {
                          if(in_array('createDocumentType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateDocumentType" <?php if($serialize_permission) {
                          if(in_array('updateDocumentType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewDocumentType" <?php if($serialize_permission) {
                          if(in_array('viewDocumentType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteDocumentType" <?php if($serialize_permission) {
                          if(in_array('deleteDocumentType', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
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
                        <td><input type="checkbox" class="minimal" name="permission[]" id="permission" class="minimal" value="createUser" <?php if($serialize_permission) {
                          if(in_array('createUser', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateUser" <?php 
                        if($serialize_permission) {
                          if(in_array('updateUser', $serialize_permission)) { echo "checked"; } 
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewUser" <?php 
                        if($serialize_permission) {
                          if(in_array('viewUser', $serialize_permission)) { echo "checked"; }   
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteUser" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteUser', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Profile'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createProfile" <?php 
                        if($serialize_permission) {
                          if(in_array('createProfile', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateProfile" <?php 
                        if($serialize_permission) {
                          if(in_array('updateProfile', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProfile" <?php 
                        if($serialize_permission) {
                          if(in_array('viewProfile', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteProfile" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteProfile', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                        <tr>
                        <td><?php echo $this->lang->line('My Account'); ?></td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewAccount" <?php 
                        if($serialize_permission) {
                          if(in_array('viewAccount', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td>-</td>
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
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createPostCategory" <?php if($serialize_permission) {
                          if(in_array('createPostCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updatePostCategory" <?php if($serialize_permission) {
                          if(in_array('updatePostCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewPostCategory" <?php if($serialize_permission) {
                          if(in_array('viewPostCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deletePostCategory" <?php if($serialize_permission) {
                          if(in_array('deletePostCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Post'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createPost" <?php if($serialize_permission) {
                          if(in_array('createPost', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updatePost" <?php if($serialize_permission) {
                          if(in_array('updatePost', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewPost" <?php if($serialize_permission) {
                          if(in_array('viewPost', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deletePost" <?php if($serialize_permission) {
                          if(in_array('deletePost', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
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
                      <tr>
                       <td><?php echo $this->lang->line('Reports'); ?></td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewReport" <?php if($serialize_permission) {
                          if(in_array('viewReport', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('Settings'); ?></td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSetting" <?php if($serialize_permission) {
                          if(in_array('updateSetting', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td><?php echo $this->lang->line('System'); ?></td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateSystem" <?php if($serialize_permission) {
                          if(in_array('updateSystem', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
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

