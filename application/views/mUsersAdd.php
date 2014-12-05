<div class="col w10 last bottomlast">
	<form action="/<?php echo $this->router->class; ?>/add" method="post">
		<p>
			<label for="login">Login:</label>
			<input type="text" name="login" id="login" value="<?php echo (isset($user) ? $user->login : ''); ?>" size="60" class="text" />
			<br />
		</p>
		<p>
			<label for="heslo">Heslo:</label>
			<input type="text" name="heslo" id="heslo" value="" size="60" class="text" />
			<br />
		</p>
		<p>
			<label for="heslo_znovu">Heslo znovu:</label>
			<input type="text" name="heslo_znovu" id="heslo_znovu" value="" size="60" class="text" />
			<br />
		</p>
		<p>
			<label for="typ">Typ:</label>
			<select name="typ" id="typ">
			    <option value="VOD" <?php echo (isset($user) && $user->typ == 'VOD') ? 'selected="selected"': ''; ?>>Vodič</option>
			    <option value="ADM" <?php echo (isset($user) && $user->typ == 'ADM') ? 'selected="selected"': ''; ?>>Administrátor</option>
		 	</select>
			<br />
		</p>
		<p>
			<label for="meno">Meno:</label>
			<input type="text" name="meno" id="meno" value="<?php echo (isset($user) ? $user->meno : ''); ?>" size="60" class="text" />
			<br />
		</p>
		<p>
			<label for="priezvisko">Priezvisko:</label>
			<input type="text" name="priezvisko" id="priezvisko" value="<?php echo (isset($user) ? $user->priezvisko : ''); ?>" size="60" class="text" />
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