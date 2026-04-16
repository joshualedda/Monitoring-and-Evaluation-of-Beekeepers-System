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
					<li class="selected">
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
<!--                                       A B O U T                                                 -->  
<!--                                                                                                 -->  
<!-----------------------------------------------------------------------------------------------------> 


		<div id="body">
			<div class="header">
				<div>
					<h1>About NARTDI</h1>
				</div>
			</div>

			<div class="footer">
				<div class="sidebar">
					<h1>Vision</h1>
					<p>A national center of excellence leading in the development of a globally competitive apiculture industry.
</p>
					<h1>Mission</h1>
					<p>Promote research, and engage in extension and training services.</p>
				</div>
				<div class="article">

					<h1>Goal</h1>
					<span>1.  Develop and package apiculture technologies.</span>
					<span>2.  Educate farmers and other stakeholders through effective extension approaches.</span>
					<span>3.  Develop and promote quality honeybee products and by-products.</span>
					<span>4.  Sustain the efficiency and effectiveness of apiculture programs, projects, and activities.</span>
					<span>5.  Develop and implement policies, standards, and procedures to promote the apiculture industry.</span>

					<br><br>

					<h1>Project and Programs</h1>
					<span><strong>1. Trainings</strong>
						<ul>
							<li>5-day Beekeeping Training (Provides all the basic topics on beekeeping, includes apiary visitation, practicums and laboratory activities; designed to train potential apiculturists; pre-requisite of the other beekeeping trainings)</li>
							<li>Hands-On Training (A two-month On-The-Job Training; more on apiary works; requires daily log of activities and a summary of report at the end of the training)</li><br>
							<li>Specialized Beekeeping Training  (Has two types of one month training each: 1. Queen Rearing; and 2. Diagnosis and Management of Honeybee Pest and Diseases)</li>
						</ul>	
					</span>
	
					<span><strong>2. Research and Development</strong>
						<ul>
							<li>Bee Botany and Pollination</li>
							<li>Hive Management</li>
							<li>Honeybee Pest and Pesticide Management</li>
							<li>Bee Products Processing and Utilization</li>
							<li>Beekeeping Tools and Equipment</li>
							<li>Socio-Economics and Marketing</li>
						</ul>
					</span>
					<span><strong>3. Extension and Development</strong>
						<ul>
							<li>NARTDI Training Program</li>
							<li>Demonstration Apiary</li>
							<li>Bee Health and Development</li>
							<li>Bee Pasture and Development</li>
							<li>Bee Product Development</li>
							<li>Quality Control Services</li>
							<li>Development and Publication of IEC Materials</li>
						</ul>	

					</span></p>
				
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
