<div class="col w10 last bottomlast">
	<form action="/<?php echo $this->router->class; ?>/add" method="post">
		<p>
			<label for="termin">Termin:</label>
			<input type="text" name="termin" id="termin" value="<?php echo (isset($order->termin) ? $order->termin : ''); ?>" size="60" class="text datepicker" />
			<br />
		</p>
		<p>
			<label for="adresa">Adresa:</label>
			<select name="adresa" id="adresa">
			     <option value="null">Osobný odber</option>
			     <?php foreach($addresses as $item):?>
			         <option value="<?php echo $item->id; ?>" <?php echo (isset($order->adresa) && $order->adresa == $item->id) ? 'selected="selected"': ''; ?>><?php echo $item->adresa; ?></option>
			     <?php endforeach;?>
			</select>
			<br />
		</p>
		<p>
		    <div id="table" class="help">
            	<div class="col w10 last">
            		<div class="content">
            			<table><tbody>
            			    <tr>
            			        <th>Názov</th>
            					<th>Popis</th>
            					<th>Množstvo</th>
            					<th>Cena</th>
            				</tr>
            				<?php
            				    $myorder = (isset($order)) ? (array) $order : null; 
            				    if(!empty($products)): ?>
            				    <?php foreach ($products as $item): ?>
                    				<tr>
                    				    <td><?php echo $item->nazov; ?></td>
                    				    <td><?php echo $item->popis; ?></td>
                    					<td><input type="number" name="<?php echo $item->id; ?>" id="<?php echo $item->id; ?>" value="<?php echo (isset($myorder[$item->id])) ? $myorder[$item->id] : '0'; ?>" size="60" class="text" min="0" /></td>
                    					<td><?php echo $item->cena; ?></td>
                    				</tr>
                				<?php endforeach; ?>
            				<?php else:?>
            				    <tr>
            				        <td colspan="4">Prepáčte, aktuálne nie sú žiadne produkty v ponuke.</td>
            				    </tr>
            				<?php endif;?>
            			</tbody></table>
            		</div>							
            	</div>
            	<div class="clear"></div>
            </div>
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