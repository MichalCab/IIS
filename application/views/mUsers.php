<script>
    $('#submenu').removeClass('mDestroy');
</script>
<div id="table" class="help">
	<h1>Používatelia:</h1>
	<div class="col w10 last">
		<div class="content">
			<table><tbody>
			    <tr>
					<th>Login</th>
					<th>Typ</th>
					<th>Meno</th>
					<th>Priezvisko</th>
					<th></th>
				</tr>
				<?php
				    $userRoles['ADM'] = 'Administrátor';
				    $userRoles['VOD'] = 'Vodič';
				    $userRoles['ZAK'] = 'Zákazník';
				if(count($users) > 1): ?>
				    <?php foreach ($users as $item): if ($this->userData->id == $item->id) continue;?>
        				<tr id="<?php echo $item->id; ?>">
        					<td><?php echo $item->login; ?></td>
        					<td><?php echo $userRoles[$item->typ]; ?></td>
        					<td><?php echo $item->meno; ?></td>
        					<td><?php echo $item->priezvisko; ?></td>
        					<td>
        					   <a href="/<?php echo $this->router->class; ?>/delete" ajax-id="<?php echo $item->id; ?>" ajax-action="delete" class="button ajax mRight"><small class="icon cross"></small><span>Zmazať</span></a>
        					   <?php if(!$item->evidovany): ?>
        					       <a href="/<?php echo $this->router->class; ?>/set" ajax-id="<?php echo $item->id; ?>" ajax-erase="true" ajax-action="stateChange" ajax-noanimation="true" class="button ajax mRight"><small class="icon check"></small><span>Aktivovať</span></a>
        					   <?php endif;?>
        					</td>
        				</tr>
    				<?php endforeach; ?>
				<?php else: ?>
				    <tr>
    					<td colspan="2">V systéme nie sú užívatelia</td>
    				</tr>
				<?php endif;?>
			</tbody></table>
		</div>							
	</div>
	<div class="clear"></div>
</div>