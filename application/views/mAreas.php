<script>
    $('#submenu').removeClass('mDestroy');
</script>
<div id="table" class="help">
	<h1>Oblasti:</h1>
	<div class="col w10 last">
		<div class="content">
			<table><tbody>
			    <tr>
					<th>Názov</th>
					<th>Spravuje</th>
					<th></th>
				</tr>
				<?php if(!empty($areas)): ?>
				    <?php foreach ($areas as $item): ?>
        				<tr id="<?php echo $item->id; ?>">
        					<td><?php echo $item->nazov; ?></td>
        					<td>
        					     <select class="ajax-change" ajax-id="<?php echo $item->id; ?>" ajax-noanimation="true" ajax-data="mAreas" ajax-action="stateChange" href="/areas/assigndriver">
                    			     <option value="null">Nikto</option>
                    			     <?php foreach($drivers as $driver):?>
                    			         <option value="<?php echo $driver->id; ?>" <?php echo ($item->spravuje == $driver->id) ? 'selected="selected"': ''; ?>><?php echo $driver->meno.' '.$driver->priezvisko; ?></option>
                    			     <?php endforeach;?>
                    		 	 </select>
        					</td>
        					<td>
        					   <a href="/<?php echo $this->router->class; ?>/delete" ajax-id="<?php echo $item->id; ?>" ajax-action="delete" class="button ajax mRight"><small class="icon cross"></small><span>Zmazať</span></a>
        					</td>
        				</tr>
    				<?php endforeach; ?>
				<?php else: ?>
				    <tr>
    					<td colspan="2">V systéme nie je žiadna adresa</td>
    				</tr>
				<?php endif;?>
			</tbody></table>
		</div>							
	</div>
	<div class="clear"></div>
</div>