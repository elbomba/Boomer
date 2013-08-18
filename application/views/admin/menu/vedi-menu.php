<?php echo $message; ?>
<?= $printMessage; ?>

<?php if ($root_menu->num_rows() <= 0) { ?>
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/menu.png')); ?>
		<p>Menu</p>
	</div>
	<div class="menus-none">
		Nessuna Voce di menu al momento <br>
		<?php echo anchor('admin/menu/nuova_voce/'.$menu->menu_nome, 'Aggiungi Voce', 'title="Aggiungi Menu"'); ?>
	</div>
	
<?php } else { ?>
	
	<div id="menus">
	
		<div class="main-title">
			<?php echo img(array('src' => 'adds-on/icons/menu.png')); ?>
			<p>Menu</p>
		</div>
		
		<div class="nome-menu">
			Stai modificando il menu <strong><?php echo $menu->menu_nome; ?></strong>
		</div>
		
		<div class="desc-menu">
			<p>Descrizione:</p>
			<?php echo $menu->menu_descrizione; ?>
		</div>
		
		<div class="back">
			<?php echo anchor('admin/menu', 'Indietro', array('class' => 'menu-back-link')); ?>
		</div>
		<div class="modifica">
			<?php  echo anchor('admin/menu/modifica_menu/'.$menu->ID_menu, 'Modifica', array('class' => 'menu-mod-link')); ?>
		</div>
		<div class="elimina">
			<?php  echo anchor('admin/menu/elimina_menu/'.$menu->ID_menu, 'Elimina', array('class' => 'menu-del-link')); ?>
		</div>
	
		<table style="margin-top: 10px;">
			<tr class="headers">
				<td colspan="2"></td>
				<td style="min-width:100px;">Nome Voce</td>
				<td>Pagina Associata</td>
				<td style="width: 50px;">Ordine</td>
			</tr>
	
			<?php foreach($root_menu->result() as $row) { ?>

				<?php $this->function_model->printMenu($row, 0); ?>
		
			<?php } ?>
			
		</table>
	</div>
	
<?php } ?>

<!-- Javascript per visualizzare i giusti top-menu -->
<script type="text/javascript">
	$(document).ready(function() {
		$("#nuova_voce").css("display", "block");
	});
</script>