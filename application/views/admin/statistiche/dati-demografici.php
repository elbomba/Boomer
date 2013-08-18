<?php echo $message; ?>
<?= $printMessage; ?>

<div id="statistiche_container">	
    <div class="main-title">
        <?php echo img(array('src' => 'adds-on/icons/statistiche.png')); ?>
        <p>Statistiche</p>
    </div>

    <div class="riepilogo-statistiche">
        <p>Dati Demografici</p>
        <div id="loader"></div>
    </div>
</div>

<script type="text/javascript">
    $.get("<?php echo base_url(); ?>admin/statistiche/load/demografica", function(data) {
        $(".riepilogo-statistiche").append(data);
        $("#loader").css("display", "none");
    });
</script>