<script>
    $('#submenu').removeClass('mDestroy');
</script>
<div id="table" class="help">
	<h1>Table:</h1>
	<div class="col w10 last">
		<div class="content">
			<table><tbody>
			    <tr>
					<th>Názov</th>
					<th>Nákupná cena</th>
					<th>Na sklade</th>
					<th></th>
				</tr>
				<?php if(!empty($products)): ?>
				    <?php foreach ($products as $item): ?>
        				<tr id="<?php echo $item->id; ?>">
        					<td><?php echo $item->nazov; ?></td>
        					<td><?php echo $item->nakupnaCena; ?></td>
        					<td><?php echo $item->naSklade; ?></td>
        					<td>
        					   <a href="/<?php echo $this->router->class; ?>/delete" ajax-id="<?php echo $item->id; ?>" ajax-action="delete" class="button ajax mRight"><small class="icon cross"></small><span>Vypnúť</span></a>
        					</td>
        				</tr>
    				<?php endforeach; ?>
				<?php else: ?>
				    <tr>
    					<td colspan="4">Nemáte žiadnu adresu</td>
    				</tr>
				<?php endif;?>
			</tbody></table>
		</div>							
	</div>
	<div class="clear"></div>
</div>