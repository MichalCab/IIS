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
					<th>Popis</th>
					<th>Cena</th>
					<th>Povolené</th>
					<th></th>
				</tr>
				<?php if(!empty($products)): ?>
				    <?php foreach ($products as $item): ?>
        				<tr id="<?php echo $item->id; ?>">
        					<td><?php echo $item->nazov; ?></td>
        					<td><?php echo $item->popis; ?></td>
        					<td><?php echo $item->cena; ?></td>
        					<td><?php echo ($item->povolene) ? 'Áno' : "Nie"; ?></td>
        					<td>
        					   <a href="/<?php echo $this->router->class; ?>/delete" ajax-id="<?php echo $item->id; ?>" ajax-action="statusChange" class="button ajax mRight"><small class="icon cross"></small><span>Zmazať</span></a>
        					   <a href="/<?php echo $this->router->class; ?>/get/<?php echo $item->id; ?>" class="button mRight"><small class="icon looking_glass"></small><span>Detail</span></a>
        					</td>
        				</tr>
    				<?php endforeach; ?>
				<?php else: ?>
				    <tr>
    					<td colspan="4">V systéme nie je žiaden materiál</td>
    				</tr>
				<?php endif;?>
			</tbody></table>
		</div>							
	</div>
	<div class="clear"></div>
</div>