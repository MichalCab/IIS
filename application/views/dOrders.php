<div id="table" class="help">
    <h1>Objednavky:</h1>
	<div class="col w10 last">
		<div class="content">
			<table><tbody>
			    <tr>
			        <th>Číslo</th>
					<th>Termin</th>
					<th>Suma</th>
					<th>Vybaveno</th>
					<th>Adresa</th>
					<th>Osoba</th>
					<th></th>
				</tr>
				<?php if(!empty($orders)):?>
    				<?php foreach ($orders as $item): ?>
        				<tr id="<?php echo $item->id; ?>">
        				    <td><?php echo $item->cislo; ?></td>
        					<td><?php echo $item->termin; ?></td>
        					<td><?php echo $item->suma; ?></td>
        					<td><?php echo ($item->vybavene == 0) ? 'Nie' : 'Áno'; ?></td>
        					<td><?php echo ($item->adresa == NULL) ? 'Osobný odber' : $item->adresa; ?></td>
        					<td><?php echo $item->meno.' '.$item->priezvisko; ?></td>
        					<td>
        					   <a href="/<?php echo $this->router->class; ?>/get/<?php echo $item->id; ?>" class="button mRight"><small class="icon looking_glass"></small><span>Detail</span></a>
        					</td>
        				</tr>
    				<?php endforeach; ?>
				<?php else:?>
				    <tr>
				        <td colspan="7">
				            Nemáte žiadnu objednávku
				        </td>
				    </tr>
				<?php endif;?>
			</tbody></table>
		</div>							
	</div>
	<div class="clear"></div>
</div>