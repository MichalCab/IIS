<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<title>Informační systém Pekárny</title>
		<link rel="stylesheet" href="/css/style.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="/css/myStyle.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript" src="/js/noty/packaged/jquery.noty.packaged.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		<script src="/js/global.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	    <div id="errorOnTop"></div>
	    <?php $this->load->view('includes/_status', (isset($postMsg) ? $postMsg : null));?>
		<div id="header">
			<div class="col w5 bottomlast">
				<a href="" class="logo">
					<h1>IIS - Pekáreň 2014/2015 (xilavs01, xcabmi00)</h1>
				</a>
			</div>
			<div class="col w5 last right bottomlast">
				<p class="last">Prihlásený ako <span class="strong"><?php echo $this->auth->getUserData()->login; ?>,</span> <a href="/user/logout">Logout</a></p>
			</div>
			<div class="clear"></div>
		</div>
		<div id="wrapper">
			<div id="minwidth">
				<div id="holder">
					<?php
					   if ($this->auth->isAdmin())
					       $this->load->view('includes/menuAdmin');
					   elseif ($this->auth->isCustomer())
					       $this->load->view('includes/menuCustomer');
					   elseif ($this->auth->isDriver())
					       $this->load->view('includes/menuDriver');
					 ?>
					 <div id="submenu" class="mDestroy">
                    	 <div class="modules_left">
                    		 <div class="module buttons">
                    			 <a href="/<?php echo $this->router->class; ?>/add" class="button"><small class="icon plus"></small><span>Pridať</span></a>
                    	 	 </div>
                    	 </div>
                    	 <div class="title">
                    	 </div>
                    	 <div class="modules_right">
                    	 </div>
                     </div>
					 <div id="desc">
	                     <div class="body">
					          <?php $this->load->view($view, (isset($data) ? $data : null));?>
					     </div>
                     	 <div class="clear"></div>
                    	 <div id="body_footer">
                    		 <div id="bottom_left"><div id="bottom_right"></div></div>
                    	 </div>
                     </div>
				</div>
			</div>
		</div>
		<div id="footer">
			<p class="last">Copyright 2014 - Created by Michal Cáb and Filip Ilavský<a href=""></a></p>
		</div>
	</body>
</html>
