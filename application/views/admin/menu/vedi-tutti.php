<?php echo $message; ?>
<?= $printMessage; ?>

<?php if ($menus->num_rows() <= 0) { ?>
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/menu.png')); ?>
		<p>Menu</p>
	</div>
	Nessun Menu al Momento <br>
	<?php echo anchor('admin/menu/nuovo_menu', 'Aggiungi Menu', 'title="Aggiungi Menu"'); ?>
	
<?php } else { ?>
	
	<div id="menus">
	
		<div class="main-title">
			<?php echo img(array('src' => 'adds-on/icons/menu.png')); ?>
			<p>Menu</p>
		</div>
    
                <div class="menu-explain">
                    In questa pagina vengono mostrati tutti i menu presenti nel nostro sito.
                </div>
        
    		<?php foreach($menus->result() as $row) { ?>

        		<a href="?menu=<?php echo $row->menu_nome; ?>">
                            <div class="menu">
                                <div class="menu-nome">
                                    <?php echo $row->menu_nome; ?>
                                </div>
                                <div class="menu-desc">
                                    <?php echo $row->menu_descrizione; ?>
                                </div>
                            </div>
                        </a>

    		<?php } ?>
			

	</div>
	
<?php } ?>