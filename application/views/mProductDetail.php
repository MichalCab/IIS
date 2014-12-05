<h1>Informácie o objednávke</h1>
<div class="box">
    <div class="head"><div></div></div>
    <div class="desc">
        <div class="col w1"><div class="content"><h3>Názov:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->cislo; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Popis:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->termin; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Cena:</h3></div></div>
        <div class="col w1 last"><div class="content"><?php echo $order->suma; ?></div></div>
        <div class="clear"></div>
        <div class="col w1"><div class="content"><h3>Povolené:</h3></div></div>
        <div class="col w1 last"><div class="content">
            <?php if($order->vybavene == 0): ?>
                <a href="/<?php echo $this->router->class; ?>/set" ajax-id="<?php echo $item->id; ?>" ajax-action="stateChange" ajax-noanimation="true" class="button ajax mRight"><small class="icon check"></small><span>Povoliť</span></a>
            <?php else: ?>
                <a href="/<?php echo $this->router->class; ?>/set" ajax-id="<?php echo $item->id; ?>" ajax-action="stateChange" ajax-noanimation="true" class="button ajax mRight"><small class="icon cross"></small><span>Zakázať</span></a>
            <?php endif; ?>
            </div></div>
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
				<?php foreach ($product_materials as $item): ?>
    				<tr>
    				    <td><?php echo $item->nazov; ?></td>
    					<td><?php echo $item->nakupnaCena; ?></td>
    					<td><?php echo $item->naSklade; ?></td>
    				</tr>
				<?php endforeach; ?>
			</tbody></table>
		</div>							
	</div>
	<div class="clear"></div>
</div>