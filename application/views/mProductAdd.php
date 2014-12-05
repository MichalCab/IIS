<div class="col w10 last bottomlast">
	<form action="/<?php echo $this->router->class; ?>/add" method="post">
		<p>
			<label for="nazov">Názov:</label>
			<input type="text" name="nazov" id="nazov" value="<?php echo (isset($product->nazov) ? $product->nazov : ''); ?>" size="60" class="text" />
			<br />
		</p>
		<p>
			<label for="popis">Popis:</label>
			<input type="text" name="popis" id="popis" value="<?php echo (isset($product->popis) ? $product->popis : ''); ?>" size="60" class="text" />
			<br />
		</p>
		<p>
			<label for="cena">Cena:</label>
			<input type="text" name="cena" id="cena" value="<?php echo (isset($product->cena) ? $product->cena : ''); ?>" size="60" class="text" />
			<br />
		</p>
		<p>
		    <div id="table" class="help">
            	<div class="col w10 last">
            		<div class="content">
            			<table><tbody>
            			    <tr>
            			        <th>Názov</th>
            					<th>Množstvo</th>
            					<th>Nákupná cena</th>
            					<th>Na sklade</th>
            				</tr>
            				<?php
            				    $myproduct = (isset($product)) ? (array) $product : null;
            				    if(!empty($materials)): ?>
            				    <?php foreach ($materials as $item): ?>
                    				<tr>
                    				    <td><?php echo $item->nazov; ?></td>
                    				    <td><input type="text" name="<?php echo $item->id; ?>" id="<?php echo $item->id; ?>" value="<?php echo (isset($myproduct[$item->id]) ? $myproduct[$item->id] : '0'); ?>" size="60" class="text" min="0" /></td>
                    				    <td><?php echo $item->nakupnaCena; ?></td>
                    				    <td><?php echo $item->naSklade; ?></td>
                    				</tr>
                				<?php endforeach; ?>
            				<?php else:?>
            				    <tr>
            				        <td colspan="4">V systéme nie sú žiadne materiály.</td>
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