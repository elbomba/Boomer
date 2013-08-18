<?php echo $message; ?>
<?= $printMessage; ?>

<?php if ($posts->num_rows() <= 0) { ?>
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/post.png')); ?>
		<p>Post</p>
	</div>
	
	<div class="post-none">
		Nessuna Pagina al Momento <br>
		<?php echo anchor('admin/post/nuova_pagina', 'Aggiungi Pagina', 'title="Aggiungi Pagina"'); ?>
	</div

<?php } else { ?>
	
	<div class="main-title" style="margin-bottom: 20px;">
		<?php echo img(array('src' => 'adds-on/icons/post.png')); ?>
		<p>Post</p>
	</div>
	
	<?php echo form_open('admin/post'); ?>
		<label for="ricerca" id="mostra">Mostra:</label>
		<select name="ricerca">
			<option value="0" id="cat_0">Tutti</option>
		<?php foreach($categorie->result() as $row) { ?>
			<?php if($row->ID_categoria == $sel_cat) { ?>
				
				<option value="<?php echo $row->ID_categoria; ?>" id="cat_<?php echo $row->ID_categoria; ?>" selected><?php echo $row->categoria_nome; ?></option>
				
			<?php } else { ?>
				
				<option value="<?php echo $row->ID_categoria; ?>" id="cat_<?php echo $row->ID_categoria; ?>"><?php echo $row->categoria_nome; ?></option>
				
			<?php } ?>
		<?php } ?>
		</select>
		<input type="submit" id="affina" value="Affina Ricerca" />
	</form>
		
	<div id="Posts">
		<table>
			<tr class="headers">
				<td colspan="2"></td>
				<td style="min-width:175px;">Titolo</td>
				<td style="min-width:100px;">Tipo</td>
				<td style="min-width:100px;">Genitore</td>
				<td style="min-width:150px;">Autore</td>
				<td style="min-width:80px;">Stato</td>
				<td style="min-width:80px;">Data</td>
				<td style="width: 50px;">Ordine</td>
			</tr>
			
			<?php foreach($root_post->result() as $row) { ?>
				
				<?php $this->function_model->printPost($row, 0) ?>
				
			<?php } ?>
			
		</table>
	</div>
	
<?php } ?>