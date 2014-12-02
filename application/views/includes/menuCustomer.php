<div id="menu">
	<div id="left"></div>
	<div id="right"></div>
	<ul>
		<li>
			<a href="/user" <?php echo (($this->router->class == 'user') ? 'class="selected"' : ''); ?>><span>Home</span></a>
		</li>
		<li>
			<a href="/address" <?php echo (($this->router->class == 'address') ? 'class="selected"' : ''); ?>><span>Adresy</span></a>
		</li>
		<li>
			<a href="/order" <?php echo (($this->router->class == 'order') ? 'class="selected"' : ''); ?>><span>Objednávky</span></a>
		</li>
	</ul>
	<div class="clear"></div>
</div>