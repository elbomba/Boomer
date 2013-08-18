<?php echo $message; ?>
<?= $printMessage; ?>

<div id="aggiungi_categoria_form">
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/categorie.png')); ?>
		<p>Nuova Categoria</p>
	</div>
	
	<?php echo form_open('admin/categorie/nuova_categoria'); ?>
	<fieldset style="margin-top: 20px;" id="nuova-categoria">

		<div class="edit-line">
			<div class="label">
				<label for="nome" id="categoria_nome">Nome Categoria</label>
			</div>
			<input type="text" name="nome" id="categoria_nome" class="text ui-widget-content ui-corner-all" placeholder="Nome Categoria" value="<?php echo set_value('nome'); ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="linkable" id="categoria_linkable">E' una categoria linkabile da menu?</label>
			</div>
			<input type="checkbox" name="linkable" id="categoria_linkable" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="periodico" id="categoria_periodico">E' una pagina periodica?</label>
			</div>
			<input type="checkbox" name="periodico" id="categoria_periodico" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="genitori" id="categoria_genitori">La pagina pu&ograve avere genitori?</label>
			</div>
			<input type="checkbox" name="genitori" id="categoria_genitori" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="multimedia" id="categoria_multimedia">La pagina pu&ograve contenere file multimediali?</label>
			</div>
			<input type="checkbox" name="multimedia" id="categoria_multimedia" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="imagetitle" id="categoria_imagetitle">La pagina ha un'immagine come titolo?</label>
			</div>
			<input type="checkbox" name="imagetitle" id="categoria_imagetitle" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="commentabile" id="categoria_commentabile">La pagina &egrave commentabile?</label>
			</div>
			<input type="checkbox" name="commentabile" id="categoria_commentabile" />
		</div>
		
		<input type="submit" id="aggiungi_nuova_categoria" value="Aggiungi" />
	</fieldset>
	</form>
</div>