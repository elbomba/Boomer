<?php echo $message; ?>
<?= $printMessage; ?>

<script type="text/javascript" src="<?php echo base_url(); ?>adds-on/ckeditor/ckeditor.js"></script>

<div id="aggiungi_pagina_form">
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/post.png')); ?>
		<p>Nuova <?php echo $cat->categoria_nome; ?></p>
	</div>
	
	<?php echo form_open('admin/post/nuovo_post'); ?>
	<fieldset style="margin-top: 20px;">
		
		<input type="hidden" name="tipo" value="<?php echo $cat->ID_categoria; ?>" />
		<input type="hidden" name="author" value="<?php $this->session->userdata('id'); ?>" />
		
		<div class="edit-line">
			<div class="label">
				<label for="titolo" id="pagina_titolo">Titolo</label>
			</div>
			<input type="text" name="titolo" id="pagina_titolo" class="text ui-widget-content ui-corner-all" placeholder="Titolo della pagina" value="<?php echo set_value('titolo'); ?>" />
		</div>
		
		<?php if($cat->categoria_genitori) { ?>
			<div class="edit-line">
				<div class="label">
					<label for="genitore" id="pagina_genitore">Genitore</label>
				</div>
				<select name="genitore">
					<option value="0">Scegli una pagina...</option>
					<!-- tutte le posts -->
					<?php foreach($posts->result() as $row) { ?>
				
						<?php $this->function_model->printPostsOptions($row, 0); ?>
				
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
				<input type="url" name="imagetitle" id="post_imagetitle" class="text ui-widget-content ui-corner-all" value="<?php echo set_value('imagetitle'); ?>" />
			</div>
			
		<?php } ?>
		
		<div class="edit-line">
			<div class="label">
				<label for="ordine" id="pagina_ordine">Ordine</label>
			</div>
			<input type="number" name="ordine" id="pagina_ordine" class="text ui-widget-content ui-corner-all" value="<?php echo set_value('ordine'); ?>" />
		</div>

		<div class="edit-line">
			<div class="label">
				<label for="stato" id="pagina_stato">Stato pagina al salvataggio</label>
			</div>
			<select name="stato">
				<option value="1">Pubblicato</option>
				<option value="0">Non Pubblicato</option>
			</select>
		</div>
		
		<!-- Vedo se categoria è periodica -->
		<?php if($cat->categoria_periodico) { ?>
			<div class="edit-line">
				<div class="label">
					<label for="data_da" id="pagina_data_da">Dal</label>
				</div>
				<input type="date" name="data_da" id="post_da" />
			</div>
			
			<div class="edit-line">
				<div class="label">
					<label for="data_a" id="pagina_data_a">Al</label>
				</div>
				<input type="date" name="data_a" id="post_a" />
			</div>
			
		<?php } ?>
		
		<br>
		<label for="contenuto" id="pagina_contenuto">Contenuto:</label><br>
		<textarea name="contenuto"><?php echo set_value('contenuto'); ?></textarea>
		<script>
			CKEDITOR.replace('contenuto');
		</script>
		
		<br>
		<label for="script" id="pagina_script">Script</label><br>
		<textarea name="script" id="pagina_script" class="text ui-widget-content ui-corner-all" placeholder="Inserisci lo script" value="<?php echo set_value('script'); ?>" /></textarea><br>
		
		<input type="submit" id="aggiungi_pagina_button" value="Aggiungi" />
	</fieldset>
	</form>
</div>