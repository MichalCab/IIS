<div id="table" class="help">
	<h1>Table:</h1>
	<div class="col w10 last">
		<div class="content">
			<table><tbody>
			    <tr>
					<th>Adresa</th>
					<th>Oblasť</th>
				</tr>
				<?php if(!empty($addresses)): ?>
				    <?php foreach ($addresses as $item): ?>
        				<tr id="<?php echo $item->id; ?>">
        					<td><?php echo $item->adresa; ?></td>
        					<td>
        					     <select class="ajax-change" ajax-id="<?php echo $item->id; ?>" ajax-noanimation="true" ajax-data="mAddresses" ajax-action="stateChange" href="/addresses/assignarea">
                    			     <option value="null">Žiadna</option>
                    			     <?php foreach($areas as $area):?>
                    			         <option value="<?php echo $area->id; ?>" <?php echo ($item->oblast == $area->id) ? 'selected="selected"': ''; ?>><?php echo $area->nazov; ?></option>
                    			     <?php endforeach;?>
                    		 	 </select>
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