<?php echo $message; ?>
<?= $printMessage; ?>

<div id="nuovo_menu_form">
	<?php echo form_open('admin/menu/nuovo_menu'); ?>
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/menu.png')); ?>
		<p>Nuovo Menu</p>
	</div>
	
	<fieldset style="margin-top: 20px;">
		
		<div class="edit-line">
			<div class="label">
				<label for="nome" id="menu_nome">Nome Menu</label>
			</div>
			<input type="text" name="nome" id="menu_nome" class="text ui-widget-content ui-corner-all" placeholder="Nome del menu" value="<?php echo set_value('nome'); ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="desc" id="menu_desc">Descrizione del Menu</label>
			</div>
			<textarea name="desc" id="menu_desc"><?php echo set_value('desc'); ?></textarea>
		</div>
		
		<input type="submit" id="nuovo_menu_buttom" value="Crea" />
	</fieldset>
</div>