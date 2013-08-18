<?php echo $message; ?>
<?= $printMessage; ?>

<div id="statistiche_container">	
    <div class="main-title">
        <?php echo img(array('src' => 'adds-on/icons/home.png')); ?>
        <p>Home</p>
    </div>
    
    <div class="home-content">
        Benvenuto <?php echo $this->session->userdata('nome'); ?>.
    </div>