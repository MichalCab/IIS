<h1>Informácie o objednávke</h1>
<div class="box">
    <div class="head"><div></div></div>
    <div class="desc">
        <div class="col w1"><div class="content"><h3>Číslo:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->cislo; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Termin:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->termin; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Suma:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->suma; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Vybaveno:</h3></div></div>
        <div class="col w1 last"><div class="content">
            <?php if($order->vybavene == 0): ?>
                <a href="/<?php echo $this->router->class; ?>/set/<?php echo $item->id; ?>" class="button"><small class="icon check"></small><span>Označiť za vybavené</span></a>
            <?php else: ?>
                Áno
            <?php endif; ?>
            </div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Adresa:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo ($order->adresa == NULL) ? 'Osobný odber' : $order->adresa; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Osoba:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->meno.' '.$order->priezvisko; ?></div></div>
        <div class="clear"></div>
    </div>
    <div class="bottom"><div></div></div>
</div>
<div id="table" class="help">
	<div class="col w10 last">
		<div class="content">
			<table><tbody>
			    <tr>
			        <th>Názov</th>
					<th>Množstvo</th>
					<th>Popis</th>
				</tr>
				<?php foreach ($order_products as $item): ?>
    				<tr>
    				    <td><?php echo $item->nazov; ?></td>
    					<td><?php echo $item->mnozstvo; ?></td>
    					<td><?php echo $item->popis; ?></td>
    				</tr>
				<?php endforeach; ?>
			</tbody></table>
		</div>							
	</div>
	<div class="clear"></div>
</div>