<script>
    $('#submenu').removeClass('mDestroy');
</script>
<div id="table" class="help">
	<h1>Table:</h1>
	<div class="col w10 last">
		<div class="content">
			<table><tbody>
			    <tr>
					<th>Adresa</th>
					<th></th>
				</tr>
				<?php foreach ($addresses as $item): ?>
    				<tr id="<?php echo $item->id; ?>">
    					<td><?php echo $item->adresa; ?></td>
    					<td>
    					   <a href="/<?php echo $this->router->class; ?>/delete" ajax-id="<?php echo $item->id; ?>" class="button ajax mRight"><small class="icon cross"></small><span>Zmazať</span></a>
    					   <a href="/<?php echo $this->router->class; ?>/edit/<?php echo $item->id; ?>" class="button mRight"><small class="icon pencil"></small><span>Upraviť</span></a>
    					</td>
    				</tr>
				<?php endforeach; ?>
			</tbody></table>
		</div>							
	</div>
	<div class="clear"></div>
</div>