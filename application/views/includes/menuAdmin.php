<div id="menu">
	<div id="left"></div>
	<div id="right"></div>
	<ul>
	    <li>
			<a href="/user" <?php echo (($this->router->class == 'user') ? 'class="selected"' : ''); ?>><span>Home</span></a>
		</li>
		<li>
			<a href="/users" <?php echo (($this->router->class == 'users') ? 'class="selected"' : ''); ?>><span>Používatelia</span></a>
		</li>
		<li>
			<a href="/product" <?php echo (($this->router->class == 'product') ? 'class="selected"' : ''); ?>><span>Produkty</span></a>
		</li>
		<li>
			<a href="/areas" <?php echo (($this->router->class == 'areas') ? 'class="selected"' : ''); ?>><span>Oblasti</span></a>
		</li>
		<li>
			<a href="/allorders" <?php echo (($this->router->class == 'allorders') ? 'class="selected"' : ''); ?>><span>Objednávky</span></a>
		</li>
		<li>
			<a href="/material" <?php echo (($this->router->class == 'material') ? 'class="selected"' : ''); ?>><span>Suroviny</span></a>
		</li>
		<li>
			<a href="/addresses" <?php echo (($this->router->class == 'addresses') ? 'class="selected"' : ''); ?>><span>Adresy</span></a>
		</li>
	</ul>
	<div class="clear"></div>
</div>