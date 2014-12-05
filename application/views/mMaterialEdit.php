<div class="col w10 last bottomlast">
	<form action="/<?php echo $this->router->class; ?>/edit/<?php echo $material->id; ?>" method="post">
		<p>
			<label for="nazov">Názov:</label>
			<input type="text" name="nazov" id="nazov" value="<?php echo (isset($material) ? $material->nazov : ''); ?>" size="60" class="text" />
			<br />
		</p>
		<p>
			<label for="nakupnaCena">Nákupná cena:</label>
			<input type="text" name="nakupnaCena" id="nakupnaCena" value="<?php echo (isset($material) ? $material->nakupnaCena : ''); ?>" size="60" class="text" />
			<br />
		</p>
		<p>
			<label for="naSklade">Na sklade:</label>
			<input type="text" name="naSklade" id="naSklade" value="<?php echo (isset($material) ? $material->naSklade : ''); ?>" size="60" class="text" />
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