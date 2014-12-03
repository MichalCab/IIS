<div class="col w10 last bottomlast">
	<form action="/<?php echo $this->router->class; ?>/add" method="post">
		<p>
			<label for="adresa">Adresa:</label>
			<input type="text" name="adresa" id="adresa" value="<?php echo (isset($address) ? $address->adresa : ''); ?>" size="60" class="text" />
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