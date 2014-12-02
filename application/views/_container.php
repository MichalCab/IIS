<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<title>Gray Admin Template</title>
		<link rel="stylesheet" href="/css/style.css" type="text/css" media="screen" charset="utf-8" />
		<script src="/js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<script src="/js/global.js" type="text/javascript" charset="utf-8"></script>
		<script src="/js/modal.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="header">
			<div class="col w5 bottomlast">
				<a href="" class="logo">
					<img src="images/logo.gif" alt="Logo" />
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
					 <?php $this->load->view($view, $data);?>
				</div>
			</div>
		</div>
		<div id="footer">
			<p class="last">Copyright 2014 - Gray Admin Template - Created by <a href=""></a></p>
		</div>
	</body>
</html>