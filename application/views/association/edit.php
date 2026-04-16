<div id="main">
  <div class="main-container">

	<section class="content-header">
		<h1><?php echo $this->lang->line('Edit Association'); ?> <?php echo $association_data['association_name']; ?> (<?php echo $association_data['id']; ?>)</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url('association') ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home'); ?></a></li>
			<li class="active"><?php echo $this->lang->line('Association'); ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">  



		<div class="row">
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
				<?php elseif($this->session->flashdata('warning')): ?>
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?php echo $this->session->flashdata('warning'); ?>
					</div>	
				<?php endif; ?>

		<!-- Creation of a session field to keep the association, register id and the directory -->
		<?php $this->session->unset_userdata('id');?>					
		<?php if(empty($this->session->userdata('id'))) {
			$association_id = array('id' => $association_data['id']);
			$this->session->set_userdata($association_id);} ?>  
			<div class="box">
				<form role="form" action="<?php base_url('association/update') ?>" method="post" enctype="multipart/form-data">
				
				<div class="box-body">

					<?php echo validation_errors(); ?>

					                <div class="row">
                  <div class="col-md-6 col-xs-2">
                    <div class="box box-primary with-border">
                      <div class="box-header with-border">
                        <h3 class="box-title">Association Information</h3>
                      </div>
                      <div class="box-body">
                       <div class="row">
                       							 <div class="col-md-12 col-xs-2">   
							<div class="form-group">
								<label for="association_name"><?php echo $this->lang->line('Association Name'); ?> <font color="red">*</font></label>
								<input type="text" class="form-control" id="association_name" name="association_name" autocomplete="off"
								value="<?php echo set_value('association_name', isset($association_data['association_name']) ? $association_data['association_name'] : ''); ?>"/>
							</div>
                       </div>
                   </div>
                   <div class="row">
							 <div class="col-md-12 col-xs-2">   
							<div class="form-group">
								<label for="contact_name"><?php echo $this->lang->line('Focal Person/ President'); ?> <font color="red">*</font></label>
								<input type="text" class="form-control" id="contact_name" name="contact_name" autocomplete="off"
								value="<?php echo set_value('contact_name', isset($association_data['contact_name']) ? $association_data['contact_name'] : ''); ?>"/>
							</div>
						</div>    
                   </div>
                   <div class="row">
                   		<div class="col-md-12 col-xs-2">

					<div class="form-group">
						<label for="address"><?php echo $this->lang->line('Address'); ?> <font color="red">*</font></label>
						<input type="text" class="form-control" id="address" name="address" 
						value="<?php echo set_value('address', isset($association_data['address']) ? $association_data['address'] : ''); ?>"  autocomplete="off"/>
					</div>
                   		</div>
                   </div>
                   <div class="row">
				<div class="col-md-6 col-xs-2"> 
							<div class="form-group">                   
								<label for="region"><?php echo $this->lang->line('Region'); ?> <font color="red">*</font></label>
								<select class="form-control select_group" id="region" name="region">
									<option value="" hidden selected disabled>Select Region</option> 
									<?php foreach ($region as $k => $v): ?>
										<option value="<?php echo $v['id'] ?>" 
										<?php if(set_value('region', isset($association_data['region_id']) ? $association_data['region_id'] : '') == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="col-md-6 col-xs-2"> 
							<div class="form-group">                   
								<label for="province"><?php echo $this->lang->line('Province'); ?> <font color="red">*</font></label>
								<select class="form-control select_group" id="province" name="province">
									<option value="" hidden selected disabled>Select Province</option> 
									<?php foreach ($province as $k => $v): ?>
										<option value="<?php echo $v['id'] ?>" 
										<?php if(set_value('province', isset($association_data['province_id']) ? $association_data['province_id'] : '') == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

                   </div>
                   <div class="row">
					<div class="col-md-6 col-xs-2">
						<div class="form-group">
							<label for="lgu"><?php echo $this->lang->line('Lgu'); ?></label>
							<select class="form-control select_group" id="lgu" name="lgu">
								<option value="" hidden selected disabled>Select LGU</option> 
								<?php foreach ($lgu as $k => $v): ?>
										<option value="<?php echo $v['id'] ?>" 
										<?php if(set_value('lgu', isset($association_data['lgu_id']) ? $association_data['lgu_id'] : '') == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
									<?php endforeach ?>
							</select>
					 </div>
				 </div>    

						<div class="col-md-6 col-xs-2">
							<div class="form-group">
								<label for="barangay"><?php echo $this->lang->line('Barangay'); ?></label>
								<select class="form-control select_group" id="barangay" name="barangay">
									<option value="" hidden selected disabled>Select Barangay</option> 
									<?php foreach ($barangay as $k => $v): ?>
										<option value="<?php echo $v['id'] ?>" 
										<?php if(set_value('barangay', isset($association_data['barangay_id']) ? $association_data['barangay_id'] : '') == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
									<?php endforeach ?>
								</select>
						</div>  

						</div>
				</div>  

                   </div>
           </div>
       </div>
                  <div class="col-md-6 col-xs-2">
                    <div class="box box-primary with-border">
                      <div class="box-header with-border">
                        <h3 class="box-title">Other Information</h3>
                      </div>
                      <div class="box-body">
                       <div class="row">


						<div class="col-md-8 col-xs-2">
							<div class="form-group">
								<label for="email"><?php echo $this->lang->line('Email'); ?></label>
								<input type="text" class="form-control" id="email" name="email" autocomplete="off"
							value="<?php echo set_value('email', isset($association_data['email']) ? $association_data['email'] : ''); ?>"/>
							</div>  
						</div>
				     <div class="col-md-4 col-xs-2">
				     	<div class="form-group">
						  <label for="send_email"><?php echo $this->lang->line('Send mail'); ?></label><br>
				     	  <a href="mailto:<?php echo $association_data['email']; ?>" class="btn btn-warning"><?php echo $this->lang->line('Generate'); ?></a>
				     	</div>  	
				     </div> 	
				     </div>
				     <div class="row">	
					 <div class="col-md-12 col-xs-2">
						<div class="form-group">
							<label for="website"><?php echo $this->lang->line('Website'); ?></label>
								<input type="text" class="form-control" id="website" name="website" autocomplete="off"
							    value="<?php echo set_value('website', isset($association_data['website']) ? $association_data['website'] : ''); ?>"/>
							</div>
						</div> 


                       </div>
                       <div class="row">
					<div class="col-md-12 col-xs-2">
							<div class="form-group">
								<label for="contact_number"><?php echo $this->lang->line('Contact Number'); ?></label>
								<input type="text" class="form-control" id="contact_number" name="contact_number" autocomplete="off"
							    value="<?php echo set_value('contact_number', isset($association_data['contact_number']) ? $association_data['contact_number'] : ''); ?>"/>
							</div>  
						</div>
                       </div>
                       <div class="row">
                       							<div class="col-md-12 col-xs-2">
						  <div class="form-group">
							<label for="active"><?php echo $this->lang->line('Active'); ?> <font color="red">*</font></label>	
																		                    <div class="radio">
		                      <label><input type="radio" name="active" id="active" class="" <?php if($association_data['active']=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('active', 1); ?> />Active&nbsp;&nbsp;&nbsp;&nbsp;</label>
		                      <label><input type="radio" name="active" id="active" class="" <?php if($association_data['active']=='2') echo "checked='checked'"; ?> value="2" <?php echo $this->form_validation->set_radio('active', 2); ?> />Inactive</label>
		                    </div>
						  </div>
						</div>    
                       </div>
                   </div>
               </div>
           </div>
                  <div class="col-md-12 col-xs-2">
                    <div class="box box-primary with-border">
                      <div class="box-header with-border">
                        <h3 class="box-title">Remarks</h3>
                      </div>
                      <div class="box-body">
                       <div class="row">
                       	<div class="col-md-12 col-xs-2">
                       							<div class="form-group">
						<label for="remark"><?php echo $this->lang->line('Remark'); ?></label>
						<textarea type="text" class="form-control" id="remark" name="remark" autocomplete="off">
							<?php echo set_value('remark', isset($association_data['remark']) ? $association_data['remark'] : ''); ?>
						</textarea>
					</div>
                       	</div>
                       </div>
                   </div>
               </div>
           </div>
       </div>


				


					</div> <!-- /end box -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save'); ?></button>					
					<?php echo '<a href="'.base_url('report0B/REP0B/'.$association_data['id']).'" target="_blank" class="btn btn-success"><i class="fa fa-print"></i></a>'; ?>
					<a href="<?php echo base_url('association/') ?>" class="btn btn-warning"><?php echo $this->lang->line('Close'); ?></a>
				</div>



			</form>
		</div>
	</div>
</section>
</div>

<!--Javascript for Association--->


<script type="text/javascript">
	
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    $('#region').change(function(){
      var region_id = $('#region').val();
      if(region_id != '')
      {
       $.ajax({
        url: base_url + 'province/fetchProvinceDataByRegion',
        method:"POST",
        data:{region_id:region_id},
        success:function(data)
        {
          $('#province').html('<option value="" hidden selected disabled>Select Province</option>');
          $('#lgu').html('<option value="" hidden selected disabled>Select LGU</option>');
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#province').html(data); 
          $('#region').click();

        }
      });
     }
     else
     {
       $('#province').html('<option value="" hidden selected disabled>Select Province</option>');
       $('#lgu').html('<option value="" hidden selected disabled>Select LGU</option>');
       $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
     }
   });

    $('#province').change(function(){
      var province_id = $('#province').val();
      if(province_id != '')
      {
       $.ajax({
        url: base_url + 'lgu/fetchLguDataByProvince',
        method:"POST",
        data:{province_id:province_id},
        success:function(data)
        {
          $('#lgu').html('<option value="" hidden selected disabled>Select LGU</option>');
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#lgu').html(data); 
          $('#province').click();     
        }
      });
     }
     else
     {
       $('#lgu').html('<option value="" hidden selected disabled>Select LGU</option>');
       $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
     }
   });

    $('#lgu').change(function(){
      var lgu_id = $('#lgu').val();
      if(lgu_id != '')
      {
       $.ajax({
        url: base_url + 'barangay/fetchBarangayDataByLgu',
        method:"POST",
        data:{lgu_id:lgu_id},
        success:function(data)
        {
          $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
          $('#barangay').html(data); 
          $('#lgu').click();     
        }
      });
     }
     else
     {
       $('#barangay').html('<option value="" hidden selected disabled>Select Barangay</option>');
     }
   });
		$(".select_group").select2({width: '100%'});
		$("#remark").wysihtml5();
		$("#mainAssociationNav").addClass('active');
		$("#manageAssociationNav").addClass('active');
		
	});
</script>




<!-----------------------------------------------------------------------------------------------------> 
<!--                                                                                                 --> 
<!--                                        A P I A R Y                                              -->  
<!--                                                                                                 -->  
<!----------------------------------------------------------------------------------------------------->
