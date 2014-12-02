<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<title>Pekáreň - REGISTER</title>
		<script src="/js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<script src="/js/global.js" type="text/javascript" charset="utf-8"></script>
		<script src="/js/modal.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="/css/style.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="/css/myStyle.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>
	    <div id="errorOnTop"></div>
	    <?php $this->load->view('includes/_status', (isset($postMsg) ? $postMsg : null)); ?>
	    <div id="wrapper">
			<div id="menu">
				<div id="left"></div>
				<div id="right"></div>
				<h2>Registrácia</h2>
				<div class="clear"></div>		
			</div>
			<div id="desc">
				<div class="body">
					<div class="col w10 last bottomlast">
						<form action="/user/add" method="post">
							<p>
								<label for="login">Login:</label>
								<input type="text" name="login" id="login" value="" size="60" class="text" />
								<br />
							</p>
							<p>
								<label for="heslo">Heslo:</label>
								<input type="password" name="heslo" id="heslo" value="" size="60" class="text" />
								<br />
							</p>
							<p>
								<label for="heslo">Heslo znovu:</label>
								<input type="password" name="heslo_znovu" id="heslo_znovu" value="" size="60" class="text" />
								<br />
							</p>
							<p>
								<label for="login">Meno:</label>
								<input type="text" name="meno" id="meno" value="" size="60" class="text" />
								<br />
							</p>
							<p>
								<label for="heslo">Priezvisko:</label>
								<input type="password" name="priezvisko" id="priezvisko" value="" size="60" class="text" />
								<br />
							</p>
							<p class="last">
								<input type="submit" value="Send" class="novisible" />
								<a href="" class="button form_submit"><small class="icon play"></small><span>Odoslať</span></a>
								<br />
							</p>
							<div class="clear"></div>
						</form>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<div id="body_footer">
					<div id="bottom_left"><div id="bottom_right"></div></div>
				</div>
			</div>		
		</div>
	</body>
</html>