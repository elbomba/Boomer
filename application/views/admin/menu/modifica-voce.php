<?php echo $message; ?>
<?= $printMessage; ?>

<div id="modifica_voce_form">
	<?php echo form_open('admin/menu/modifica_voce/'.$voce->ID_menu_item); ?>
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/menu.png')); ?>
		<p>Modifica della voce di menu "<?php echo $voce->menu_item_nome; ?>"</p>
	</div>
	
	<div class="back">
		<?php echo anchor('admin/menu?menu='.$nome_menu, 'Indietro', array('class' => 'menu-back-link')); ?>
	</div>
	
	<fieldset style="margin-top: 20px;">

		<div class="edit-line">
			<div class="label">
				<label for="nome" id="menu_nome">Nome Menu</label>
			</div>
			<input type="text" name="nome" id="menu_nome" class="text ui-widget-content ui-corner-all" placeholder="Nome del menu" value="<?php echo $voce->menu_item_nome; ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="ordine" id="menu_ordine">Ordine</label>
			</div>	
			<input type="number" name="ordine" id="menu_ordine" class="text ui-widget-content ui-corner-all" value="<?php echo $voce->menu_item_ordine; ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="pagina" id="menu_pagina">Pagina Collegata</label>
			</div>
			<select name="pagina">
				<option value="0" id="post_0">Nessuna Pagina</option> <!-- Gen perchè così nella funzione -->
			
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
				<option value="0" id="men_0">Nessun Genitore...</option>
			
				<!-- Creo l'array dei possibili id -->
				<?php foreach($pos_menu->result() as $row) { ?>
				
					<?php $poss[] = $row->ID_menu_item; ?>
				
				<?php } ?>
			
				<!-- Stampo i possibili genitori -->
				<?php foreach($root_menu->result() as $row) { ?>
				
					<?php echo $row->menu_item_nome; ?>
				
					<?php $this->function_model->printPossibleMenusOptions($row, 0, $poss); ?>
				
				<?php } ?>
			
			</select>
		</div>
		
		<input type="submit" id="modifica_menu_buttom" value="Modifica" />
	</fieldset>
</div>



<?php

// Script per selzionare gli elementi del dom
echo '
	<script type="text/javascript">
		document.getElementById("post_'.$voce->menu_item_link.'").selected=true;
		document.getElementById("men_'.$voce->menu_item_genitore.'").selected=true;
	</script>
';

?>