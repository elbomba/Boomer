<?php echo $message; ?>
<?= $printMessage; ?>

<div id="modifica_menu_form">
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/menu.png')); ?>
		<p>Modifica del menu "<?php echo $menu->menu_nome; ?>"</p>
	</div>
	
	<?php echo form_open('admin/menu/modifica_menu/'.$menu->ID_menu); ?>
	<fieldset style="margin-top: 20px;">
		
		<div class="edit-line">
			<div class="label">
				<label for="nome" id="menu_nome">Nome Menu</label>
			</div>
			<input type="text" name="nome" id="menu_nome" class="text ui-widget-content ui-corner-all" placeholder="Nome del menu" value="<?php echo $menu->menu_nome; ?>" /><br>
		</div>

		<div class="edit-line">
			<div class="label">
				<label for="desc" id="menu_desc">Pagina Collegata</label>
			</div>
			<textarea name="desc" id="menu_desc"><?php echo $menu->menu_descrizione; ?></textarea>
		</div>
		
		<input type="submit" id="modifica_menu_buttom" value="Modifica" />
	</fieldset>
</div>