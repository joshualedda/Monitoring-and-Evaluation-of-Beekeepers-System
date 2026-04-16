<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NARTDI</title> 
	
  <!-- Bootstrap 3.3.7 -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
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

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/website/css/style.css'); ?>" >
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/website/css/mobile.css'); ?>" >
  <script type="text/javascript" src="<?php echo base_url('assets/website/js/mobile.js'); ?>"></script>

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



		


		<div id="body">
			<div class="header">
				<div>
					<h1><?php echo $this->lang->line('NEWS'); ?></h1>
				</div>
			</div>


<!-----------------------------------------------------------------------------------------------------> 
<!--                                                                                                 --> 
<!--                                       N E W S                                                   -->  
<!--                                                                                                 -->  
<!-----------------------------------------------------------------------------------------------------> 


			<div class="news">
				<div class="featured">
					<ul>
						<?php if(!empty($post_data)): ?>
						<?php foreach($post_data as $post) : ?>

						<li>							
							<?php 
                                $doc_type = isset($post['doc_type']) ? $post['doc_type'] : '';
                                if(strpos($doc_type,'application/vnd') !== false): 
                            ?>  
					           <img src="<?php echo site_url(); ?>assets/images/msoffice.jpg" width="180" height="140" style="object-fit: cover;">
					        <?php elseif(strpos($doc_type,'application/pdf') !== false): ?>  
					           <img src="<?php echo site_url(); ?>assets/images/pdf.png" width="180" height="140" style="object-fit: contain;">   
					        <?php else: ?>  
					           <img src="<?php echo site_url(); ?>upload/posts/<?php echo $post['post_image']; ?>" width="180" height="140" style="object-fit: cover;">
					        <?php endif; ?> 

							<div>
								<h1 style="margin-bottom: 5px;"><?php echo $post['post_title']; ?></h1>
								<span style="color: #666; font-size: 13px; display: block; margin-bottom: 15px;">
                                    <?php echo $this->lang->line('Posted on'); ?> <?php echo date('M d, Y', strtotime($post['updated_date'])); ?> 
                                    <?php echo $this->lang->line('in'); ?> <strong><?php echo $post['name']; ?></strong>
                                </span>

								<span style="text-align:justify;font-size:15px; display: block; margin-bottom: 20px; color: #444; line-height: 1.6;">
                                    <?php 
                                        $news_content = html_entity_decode($post['post_text']); 
                                        $news_content = strip_tags($news_content);
                                        echo (strlen($news_content) > 200) ? substr($news_content, 0, 200) . '...' : $news_content;
                                    ?>
                                </span>
								  
          						<a href="<?php echo base_url('website/view_news/'.$post['post_id']) ?>" class="more" style="display: inline-block; padding: 8px 15px; background: #005bc4; color: #fff; text-decoration: none; border-radius: 4px; font-size: 13px;"><?php echo $this->lang->line('View Post'); ?></a>
							</div>
						</li>

						 <?php endforeach; ?>
						<?php else: ?>
						<li style="text-align: center; padding: 60px 20px; background: #f9f9f9; border-radius: 8px; border: 1px dashed #ccc;">
							<div style="font-size: 40px; color: #aaa; margin-bottom: 15px;">📰</div>
							<h3 style="color: #555; margin-bottom: 10px;">No News Available</h3>
							<p style="color: #777; font-size: 15px;">There are currently no active announcements or news items to display at this time.</p>
						</li>
						<?php endif; ?>
						<?php echo $this->pagination->create_links(); ?>
					</ul>

				</div>
			</div>
		</div>



		<div id="footer" >
			<div>
				<p>© National Apiculture Research, Training & Development Institute</p>
			</div>
		</div>
	</div>
</body>
</html>
