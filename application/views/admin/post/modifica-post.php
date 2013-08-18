<?php echo $message; ?>
<?= $printMessage; ?>

<script type="text/javascript" src="<?php echo base_url(); ?>adds-on/ckeditor/ckeditor.js"></script>

<div id="modifica_post_form">
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/post.png')); ?>
		<p>Modifica <?php echo $cat->categoria_nome; ?></p>
	</div>
	
	<?php echo form_open('admin/post/modifica_post/'.$post->ID_post); ?>
	<fieldset style="margin-top: 20px;">

		<div class="edit-line">
			<div class="label">
				<label for="titolo" id="pagina_titolo">Titolo</label>
			</div>
			<input type="text" name="titolo" id="pagina_titolo" class="text ui-widget-content ui-corner-all" placeholder="Titolo della pagina" value="<?php echo $post->post_titolo; ?>" />
		</div>
		
		<?php if($cat->categoria_genitori) { ?>
			<div class="edit-line">
				<div class="label">
					<label for="genitore" id="pagina_genitore">Genitore</label>
				</div>	
				<select name="genitore" id="pagine_genitore">
					<option value="0" id="post_0">Scegli una pagina...</option>
					<!-- Recupero le possibili pagine genitori -->
					<?php foreach($pos_post->result() as $row) { ?>
				
						<?php $poss[] = $row->ID_post; ?>
				
					<?php } ?>
			
					<!-- tutte le pagine -->
					<?php foreach($root_posts->result() as $row) { ?>
				
						<?php $this->function_model->printPossiblePostsOptions($row, 0, $poss); ?>
				
					<?php } ?>
				</select>
			</div>
		<?php } ?>
		
		<!-- Vedo se ha immagine di titolo -->
		<?php if($cat->categoria_imagetitle) { ?>
			<div class="edit-line">
				<div class="label">
					<label for="imagetitle" id="post_imagetitle">Immagine di Copertina</label>
				</div>
				<input type="url" name="imagetitle" id="post_imagetitle" class="text ui-widget-content ui-corner-all" value="<?php echo $post->post_imagetitle; ?>" placeholder="Link all'imaggine" />
			</div>
			
		<?php } ?>
		
		<div class="edit-line">
			<div class="label">
				<label for="ordine" id="pagina_ordine">Ordine</label>
			</div>	
			<input type="number" name="ordine" id="pagina_ordine" class="text ui-widget-content ui-corner-all" value="<?php echo $post->post_ordine; ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="stato" id="pagina_stato">Stato della pagina</label>
			</div>
			<select name="stato" id="pagina_stato_sel">
				<option value="1" id="s_1">Pubblicato</option>
				<option value="0" id="s_0">Non Pubblicato</option>
			</select>
		</div>
		
		<!-- Vedo se categoria è periodica -->
		<?php if($cat->categoria_periodico) { ?>
			
			<div class="edit-line">
				<div class="label">
					<label for="data_da" id="pagina_data_da">Dal</label>
				</div>
				<input type="date" name="data_da" id="post_da" value="<?php echo $post->post_data_da; ?>" />
			</div>
			
			<div class="edit-line">
				<div class="label">
					<label for="data_a" id="pagina_data_a">Al</label>
				</div>
				<input type="date" name="data_a" id="post_a" value="<?php echo $post->post_data_a; ?>" />
			</div>
			
		<?php } ?>
		
		<br>
		<label for="contenuto" id="pagina_contenuto">Contenuto:</label><br>
		<textarea name="contenuto"><?php echo $post->post_content; ?></textarea>
		<script>
			CKEDITOR.replace('contenuto');
		</script>
		
		<br>
		<label for="script" id="pagina_script">Script:</label><br>
		<textarea name="script" id="pagina_script" class="text ui-widget-content ui-corner-all" placeholder="Inserisci lo script" value="<?php echo $post->post_script; ?>" /></textarea><br>
		
		<input type="submit" id="modifica_pagina_button" value="Salva" />
	</fieldset>
	</form>
</div>



<?php

// Script per selzionare gli elementi del dom
echo '
	<script type="text/javascript">
		document.getElementById("post_'.$post->post_genitore.'").selected=true;
		document.getElementById("s_'.$post->post_stato.'").selected=true;
	</script>
';

?>