<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NARTDI</title>


  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/website/css/style.css'); ?>" >
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/website/css/mobile.css'); ?>" >
  <script type="text/javascript" src="<?php echo base_url('assets/website/js/mobile.js'); ?>"></script>
	
  <!-- Bootstrap 3.3.7 -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/morris.js/morris.css') ?>">
 
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>

  <!-- DataTables -->
  <script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>

	

 
</head>



<!-----------------------------------------------------------------------------------------------------> 
<!--                                                                                                 --> 
<!--                                       M E N U                                                   -->  
<!--                                                                                                 -->  
<!-----------------------------------------------------------------------------------------------------> 



<body>
	<div id="page">
		<div id="header">
			<div>
				<a href="<?php echo base_url('website/index'); ?>" class="logo"><img  src="<?php echo base_url('assets/website/images/NARTDILogo.jpg'); ?>" alt=""></a>
				<ul id="navigation">
					<li class="menu">
						<a href="<?php echo base_url('website/index'); ?>"><?php echo $this->lang->line('HOME'); ?></a>
					</li>
					<li class="menu">
						<a href="<?php echo base_url('website/about'); ?>"><?php echo $this->lang->line('ABOUT'); ?></a>						
					</li>
					<li class="menu">
						<a href="<?php echo base_url('website/map'); ?>"><?php echo $this->lang->line('MAP'); ?></a>						
					</li>
					<li class="selected">
						<a href="<?php echo base_url('website/news'); ?>"><?php echo $this->lang->line('NEWS'); ?></a>						
					</li>
					<li>
						<a href="<?php echo base_url('website/contact'); ?>"><?php echo $this->lang->line('CONTACT'); ?></a>
					</li>
				</ul>
			</div>
		</div>



<!-----------------------------------------------------------------------------------------------------> 
<!--                                                                                                 --> 
<!--                                       S I N G L E   P O S T                                     -->  
<!--                                                                                                 -->  
<!-----------------------------------------------------------------------------------------------------> 


<div id="body">

	<div class="header">
		<div><h1><?php echo $this->lang->line('Post'); ?></h1></div>
	</div>

		<div class="singlepost">
			<div class="featured">
				<?php if(strpos($post_data['doc_type'],'application/vnd') !== false): ?>  
				           <img src="<?php echo site_url(); ?>assets/images/msoffice.jpg" width="140" height="140">
				        <?php elseif(strpos($post_data['doc_type'],'application/pdf') !== false): ?>  
				           <img src="<?php echo site_url(); ?>assets/images/pdf.png" width="140" height="140">   
				        <?php else: ?>  
				           <img src="<?php echo site_url(); ?>upload/posts/<?php echo $post_data['post_image']; ?>" width="140" height="140">
				        <?php endif; ?> 

				<h1><?php echo $post_data['post_title']; ?></h1>
				<span><?php echo $this->lang->line('Posted on'); ?> <?php echo $post_data['updated_date']; ?> <?php echo $this->lang->line('in'); ?> <strong><?php echo $post_data['name']; ?></strong> <?php echo $this->lang->line('by'); ?> <?php echo $post_data['posted_by']; ?></span>

				<span style="text-align:justify;font-size:15px"><?php echo ($post_data['post_text']); ?></span>

                <a href="<?php echo base_url('website/news') ?>" class="load"><?php echo $this->lang->line('Back to NEWS'); ?></a>
			</div>


		<div class="sidebar">
			<table id="manageTableDocument" class="table table-bordered table-striped" style="width:100%">
		            <thead>		              
		                <th><?php echo $this->lang->line('Document'); ?></th> 
		            </thead>
		    </table>  
			</div>
		</div>	
	</div>


		<div id="footer" >
			<div>
				<p>© National Apiculture Research, Training & Development Institute</p>
			</div>
		</div>

</body>
</html>



<!------------------------------------->
<!-- Javascript part of Document    --->
<!------------------------------------->


<script type="text/javascript">
var manageTableDocument;
var base_url = "<?php echo base_url(); ?>";

  // initialize the datatable 
  manageTableDocument = $('#manageTableDocument').DataTable({
    'ajax': base_url+'website/view_document/'+'<?php echo $post_data['id']; ?>',
    'language': {'url': "<?php echo $this->session->link_language; ?>"}, 
    'order': [[0, "asc"]],
    'searching': false,
    'paging': false,
    'info': false
  });

</script>
