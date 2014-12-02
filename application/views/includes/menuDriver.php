<div id="menu">
	<div id="left"></div>
	<div id="right"></div>
	<ul>
		<li>
			<a href="/user" <?php echo (($this->router->class == 'user') ? 'class="selected"' : ''); ?>><span>Home</span></a>
		</li>
		<li>
			<a href="/orders" <?php echo (($this->router->class == 'orders') ? 'class="selected"' : ''); ?>><span>Obejdnávky</span></a>
		</li>
	</ul>
	<div class="clear"></div>
</div>