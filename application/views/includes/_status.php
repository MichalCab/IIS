<?php if (isset($ERR)): ?>
    <div id="wrapper_ERR" class="active">
        <?php echo (($ERR !== TRUE) ? $ERR : 'Operácia neúspešná'); ?>
    </div>
<?php elseif (isset($SUCC)): ?>
    <div id="wrapper_SUCC" class="active">
        <?php echo (($SUCC !== TRUE) ? $SUCC : 'Operácia úspešná'); ?>
    </div>
<?php endif; ?>