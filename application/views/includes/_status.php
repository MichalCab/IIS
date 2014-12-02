<script>
    <?php if (isset($ERR)):?>
        $().Message({type:'error',time:4000,text:"<?php echo (($ERR !== TRUE) ? $ERR : 'Operácia neúspešná'); ?>",target:"#errorOnTop",click:true});
    <?php elseif (isset($SUCC)): ?>
        $().Message({type:'success',time:4000,text:"<?php echo (($SUCC !== TRUE) ? $SUCC : 'Operácia úspešná'); ?>",target:"#errorOnTop",click:true});
    <?php endif; ?>
</script>