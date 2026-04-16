<div id="main">
  <div class="main-container">
  <section class="content-header">
    <h1><?php echo $this->lang->line('Add Colony'); ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('colony') ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home'); ?></a></li>
      <li class="active"><?php echo $this->lang->line('Colony'); ?></li>
    </ol>
  </section>

<!-----------------------------------------------------------  Main ------------------------------------------------------------------>

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
        <?php endif; ?>

        
        <div class="box">
          <div class="box-header"></div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('colony/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <!-- /row divide by 3-->
                <div class="row">

                  <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="species"><?php echo $this->lang->line('Species'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="species" name="species">
                          <option value="" hidden selected disabled>Select Species</option>
                          <?php foreach ($species as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>" <?php echo set_select('species', $v['id']); ?>>
                          <?php echo $v['name'] ?></option>
                          <?php endforeach ?>                          
                     </select>
                  </div>   
                </div> 
    
                <div class="col-md-3 col-xs-3">
                  <div class="form-group">
                        <label for="total_colony"><?php echo $this->lang->line('Total'); ?><font color="red">*</font></label>
                        <input type="text" class="form-control" id="total_colony" name="total_colony" autocomplete="off" 
                        value="<?php echo set_value('total_colony'); ?>" />
                      </div>
                    </div> 

                    <div class="col-md-3 col-xs-3">
                    <div class="form-group">
                      <label for="phase"><?php echo $this->lang->line('Phase'); ?> <font color="red">*</font></label>
                      <select class="form-control select_group" id="phase" name="phase">
                        <option value="" hidden selected disabled>Select Phase</option>
                        <?php foreach ($phase as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>" <?php echo set_select('phase', $v['id']); ?>>
                          <?php echo $v['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>              
                </div>

                  
                <div class="form-group">
                  <label for="apiary"><?php echo $this->lang->line('Apiary'); ?> <font color="red">*</font></label>
                  <select class="form-control select_group" id="apiary_holder" name="apiary_holder" <?php if($fromApiary!=null) echo 'disabled=disabled';?>>
                        <option value="" hidden selected disabled>Select Apiary</option>
                                                                           <?php foreach ($apiary as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>" 
                                <?php if(set_value('apiary_holder', isset($fromApiary) ? $fromApiary : '') == $v['id']) { echo "selected='selected'"; } ?> >
                                <?php echo $v['location'] ?>/
                                <?php echo $v['beekeeper_name'] ?></option>
                            <?php endforeach ?>
                      </select>
                      <input type="text" name="apiary" id="apiary" value="<?php echo $fromApiary ?>" hidden>
                </div>
      

                 

                <div class="form-group">
                  <label for="remark"><?php echo $this->lang->line('Remark'); ?></label>
                  <textarea type="text" class="form-control" id="remark" name="remark" autocomplete="off">
                    <?php echo set_value('remark'); ?>
                  </textarea>
                </div>  

                
              </div> <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save'); ?></button>
                <a href="<?php echo base_url('colony/') ?>" class="btn btn-warning"><?php echo $this->lang->line('Back'); ?></a>
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
    $("#remark").wysihtml5();

    $("#mainColonyNav").addClass('active');
    $("#addColonyNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#colony_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        layoutTemplates: {main2: '{preview} ' +  ' {remove} {browse}'}, 
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>