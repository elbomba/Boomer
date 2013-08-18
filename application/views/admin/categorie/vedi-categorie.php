<?php echo $message; ?>
<?= $printMessage; ?>

<?php if ($categorie->num_rows() <= 0) { ?>
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/categorie.png')); ?>
		<p>Categorie</p>
	</div>
	
	<div class="categorie-none">
		Nessuna Categoria<br>
		<?php echo anchor('admin/categorie/nuova_categoria', 'Aggiungi Categoria', 'title="Aggiungi Categoria"'); ?>
	</div>
	
<?php } else { ?>
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/categorie.png')); ?>
		<p>Categorie</p>
	</div>
	
	<div id="categorie" style="margin-top:10px;">
		<table>
			<tr class="headers">
				<td colspan="2"></td>
				<td style="min-width:250px;">Categoria</td>
				<td style="min-width:50px; text-align: center;">Linkabile</td>
				<td style="min-width:50px; text-align: center;">Periodico</td>
				<td style="min-width:50px; text-align: center;">Genitori</td>
				<td style="min-width:50px; text-align: center;">Multimedia</td>
				<td style="min-width:50px; text-align: center;">ImageTitle</td>
				<td style="min-width:50px; text-align: center;">Commentabile</td>
			</tr>
			
			<?php foreach($categorie->result() as $row) { ?>
								
				<tr class="cat_element">
					<td style="width: 20px">
						<a href="<?php echo base_url(); ?>admin/categorie/modifica_categoria/<?php echo $row->ID_categoria; ?>" class="mod-icon">
							<?php echo img('adds-on/icons/pencil.png');?>
						</a>
					</td>
					<td style="width: 20px">
						<a href="<?php echo base_url(); ?>admin/categorie/elimina_categoria/<?php echo $row->ID_categoria; ?>" class="del-icon">
							<?php 
								if ($row->ID_categoria <= 3) {
									
								} else {
									echo img('adds-on/icons/delete.png');
								}
							?>
						</a>
					</td>
					<td><?php echo $row->categoria_nome; ?></td>
					<td style="text-align: center;">
						<?php if($row->categoria_linkable) { ?>
							<input type="checkbox" checked disabled>
						<?php } else { ?>
							<input type="checkbox" disabled>
						<?php } ?>
					</td>
					<td style="text-align: center;">
						<?php if($row->categoria_periodico) { ?>
							<input type="checkbox" checked disabled>
						<?php } else { ?>
							<input type="checkbox" disabled>
						<?php } ?>
					</td>
					<td style="text-align: center;">
						<?php if($row->categoria_genitori) { ?>
							<input type="checkbox" checked disabled>
						<?php } else { ?>
							<input type="checkbox" disabled>
						<?php } ?>
					</td>
					<td style="text-align: center;">
						<?php if($row->categoria_multimedia) { ?>
							<input type="checkbox" checked disabled>
						<?php } else { ?>
							<input type="checkbox" disabled>
						<?php } ?>
					</td>
					<td style="text-align: center;">
						<?php if($row->categoria_imagetitle) { ?>
							<input type="checkbox" checked disabled>
						<?php } else { ?>
							<input type="checkbox" disabled>
						<?php } ?>
					</td>
					<td style="text-align: center;">
						<?php if($row->categoria_commentabile) { ?>
							<input type="checkbox" checked disabled>
						<?php } else { ?>
							<input type="checkbox" disabled>
						<?php } ?>
					</td>
				</tr>
			
			<?php } ?>
			
		</table>
	</div>

<?php } ?>