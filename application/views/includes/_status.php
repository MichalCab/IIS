<script>
    <?php if (isset($ERR)):?>
        $.noty.defaults = {type: 'Error', text: "<?php echo (($ERR !== TRUE) ? $ERR : 'Operácia neúspešná'); ?>", timeout: 3000, force: false, modal: false, maxVisible: 5, killer: false, closeWith: ['click'], layout: 'top'};
    <?php elseif (isset($SUCC)): ?>
        $.noty.defaults = {type: 'Success', text: <?php echo (($SUCC !== TRUE) ? $SUCC : 'Operácia úspešná'); ?>, timeout: 3000, force: false, modal: false, maxVisible: 5, killer: false, closeWith: ['click'], layout: 'top'};
    <?php endif; ?>
</script>