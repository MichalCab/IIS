<div class="box">
    <div class="head"><div></div></div>
    <h2>Informácie o užívateľovy</h2>
    <div class="desc">
        <div class="col w1"><div class="content"><h3>Číslo:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->cislo; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Termin:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->meno; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Suma:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->priezvisko; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Vybaveno:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo ($order->vybavene == 0) ? 'Nie' : 'Áno'; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Adresa:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo ($order->adresa == NULL) ? 'Osobný odber' : $order->adresa; ?></div></div>
        <div class="clear"></div>
    </div>
    <div class="bottom"><div></div></div>
</div>
<div id="table" class="help">
	<h1>Table:</h1>
	<div class="col w10 last">
		<div class="content">
			<table><tbody>
			    <tr>
			        <th>Názov</th>
					<th>Množstvo</th>
					<th>Popis</th>
					<th>Cena</th>
				</tr>
				<?php foreach ($order_products as $item): ?>
    				<tr id="<?php echo $item->nazov; ?>">
    					<td><?php echo $item->mnozstvo; ?></td>
    					<td><?php echo $item->popis; ?></td>
    					<td><?php echo $item->cena; ?></td>
    				</tr>
				<?php endforeach; ?>
			</tbody></table>
		</div>							
	</div>
	<div class="clear"></div>
</div>