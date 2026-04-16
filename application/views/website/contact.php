<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NARTDI</title>
	
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
					<li class="menu">
						<a href="<?php echo base_url('website/news'); ?>"><?php echo $this->lang->line('NEWS'); ?></a>						
					</li>
					<li class="selected">
						<a href="<?php echo base_url('website/contact'); ?>"><?php echo $this->lang->line('CONTACT'); ?></a>
					</li>
				</ul>
			</div>
		</div>



<!-----------------------------------------------------------------------------------------------------> 
<!--                                                                                                 --> 
<!--                                       C O N T A C T                                             -->  
<!--                                                                                                 -->  
<!-----------------------------------------------------------------------------------------------------> 


		<div id="body" class="contact">
			<div class="header">
				<div>
					<h1>Contact</h1>
				</div>
			</div>
			<div class="body">

			</div>
			<div class="footer">
				<div class="contact">
					<h1>INQUIRY FORM</h1>
					<form action="index.html">
						<input type="text" name="Name" value="Name" onblur="this.value=!this.value?'Name':this.value;" onfocus="this.select()" onclick="this.value='';">
						<input type="text" name="Email" value="Email" onblur="this.value=!this.value?'Email':this.value;" onfocus="this.select()" onclick="this.value='';">
						<input type="text" name="Subject" value="Subject" onblur="this.value=!this.value?'Subject':this.value;" onfocus="this.select()" onclick="this.value='';">
						<textarea name="meassage" cols="50" rows="7">Share your thoughts</textarea>
						<input type="submit" value="Send" id="submit">
					</form>
				</div>
				<div class="section">
					<h1>WE’D LOVE TO HEAR FROM YOU.</h1>
					<p>Just fill the form and we will answer as soon as possible.</p>
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
