
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NARTDI</title>
	

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/website/css/style.css'); ?>" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/website/css/mobile.css'); ?>" >
	<script type="text/javascript" src="<?php echo base_url('assets/website/js/mobile.js'); ?>"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
					<li class="selected">
						<a href="<?php echo base_url('website/index'); ?>"><?php echo $this->lang->line('HOME'); ?></a>
					</li>
					<li class="menu">
						<a href="<?php echo base_url('website/about'); ?>"><?php echo $this->lang->line('ABOUT'); ?></a>						
					</li>
					<li class="menu">
						<a href="<?php echo base_url('website/map'); ?>"><?php echo $this->lang->line('MAP'); ?></a>						
					</li>
					<li class="menu">
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
<!--                                       C A R O U S E L                                           -->  
<!--                                                                                                 -->  
<!-----------------------------------------------------------------------------------------------------> 

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="<?php echo site_url(); ?>assets/website/images/nartdi1.jpg" width="1200" height="400" >
        <div class="carousel-caption">
          <h2><strong></strong></h2>
          <p>Welcome</p>
        </div>      
      </div>

      <div class="item">
        <img src="<?php echo site_url(); ?>assets/website/images/nartdi2.jpg" width="1200" height="400" >
        <div class="carousel-caption">
          <h2><strong>></strong></h2>
          <p></p>
        </div>      
      </div>
    
      <div class="item">
        <img src="<?php echo site_url(); ?>assets/website/images/nartdi3.jpg" width="1200" height="400" >
        <div class="carousel-caption">nartdi
          <h2><strong></strong></h2>
          <p></p>
        </div>      
      </div>

      <div class="item">
        <img src="<?php echo site_url(); ?>assets/website/images/nartdi4.jpg" width="1200" height="400" >
        <div class="carousel-caption">
          <h2><strong></strong></h2>
          <p></p>
        </div>      
      </div>

      <div class="item">
        <img src="<?php echo site_url(); ?>assets/website/images/nartdi5.jpg" width="1200" height="400" >
        <div class="carousel-caption">
          <h2><strong></strong></h2>
          <p></p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

</div>



<!-----------------------------------------------------------------------------------------------------> 
<!--                                                                                                 --> 
<!--                                       H O M E   P A G E                                         -->  
<!--                                                                                                 -->  
<!-----------------------------------------------------------------------------------------------------> 

		<div id="body">
			<div class="header">
      </div>  


			<div class="body">
				<div class="row">
					<div class="col-md-9 col-xs-9">
						<h1>NARTDI</h1>
						<h2>Welcome in the Beekeepers database.</h2>
						<p>You will find in this website all the information about the beekeepers in the Philippines.</p>
					</div>


          <div class="col-md-3 col-xs-3">
            <div class="sidebar">
            <h2><?php echo $this->lang->line('Login to the database'); ?></h2>
            <a href="<?php echo base_url('auth/login') ?>" class="btn btn-success"><?php echo $this->lang->line('Login'); ?></a>
           
          </div>

				</div>
			</div>
			
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
