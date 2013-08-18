<?php echo $message; ?>
<?= $printMessage; ?>

<div id="nuova_voce_form">
	<?php echo form_open('admin/menu/nuova_voce/'.$nome); ?>
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/menu.png')); ?>
		<p>Nuova voce di <?php echo $nome; ?></p>
	</div>
	
	<fieldset style="margin-top: 20px;">
		
		<input type="hidden" name="main" value="<?php echo $this->menu_model->get_menu($nome)->ID_menu; ?>" />
		
		<div class="edit-line">
			<div class="label">
				<label for="nome" id="menu_nome">Nome Voce</label>
			</div>
			<input type="text" name="nome" id="menu_nome" class="text ui-widget-content ui-corner-all" placeholder="Nome del menu" value="<?php echo set_value('nome'); ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="ordine" id="menu_ordine">Ordine</label>
			</div>
			<input type="number" name="ordine" id="menu_ordine" class="text ui-widget-content ui-corner-all" value="<?php echo set_value('ordine'); ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="pagina" id="menu_pagina">Pagina Collegata</label>
			</div>
			<select name="pagina">
				<option value="0" id="post_0">Nessuna Pagina</option>
			
				<?php foreach($pagine->result() as $row) { ?>
				
					<?php $this->function_model->printPostsOptions($row, 0); ?>
				
				<?php } ?>
			
			</select>
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="genitore" id="menu_genitore">Genitore</label>
			</div>
			<select name="genitore">
				<option value="0" id="men_0">Nessun Genitore</option>
			
				<!-- print menu options -->
				<?php foreach($root_menu->result() as $row) { ?>
				
					<?php $this->function_model->printMenusOptions($row, 0); ?>
				
				<?php } ?>
			
			</select>
		</div>
		
		<input type="submit" id="nuovo_menu_buttom" value="Crea" />
	</fieldset>
</div>