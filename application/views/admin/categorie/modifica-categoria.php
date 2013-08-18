<?php echo $message; ?>
<?= $printMessage; ?>

<div id="modifica_categoria_form">
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/categorie.png')); ?>
		<p>Modifica Categorie</p>
	</div>
	
	<?php echo form_open('admin/categorie/modifica_categoria/'.$categoria->ID_categoria); ?>
	<fieldset style="margin-top: 20px;" id="edit-categoria">

		<div class="edit-line">
			<div class="label">
				<label for="nome" id="categoria_nome">Nome Categoria</label>
			</div>
			<input type="text" name="nome" id="categoria_nome" class="text ui-widget-content ui-corner-all" placeholder="Nome della Categoria" value="<?php echo $categoria->categoria_nome; ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="linkable" id="categoria_linkable">E' una categoria linkabile da menu?</label>
			</div>
			<?php if ($categoria->categoria_linkable) { ?>
				<input type="checkbox" name="linkable" id="categoria_linkable" checked />
			<?php } else { ?>
				<input type="checkbox" name="linkable" id="categoria_linkable" />
			<?php } ?>
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="periodico" id="categoria_periodico">E' una pagina periodica?</label>
			</div>
			<?php if ($categoria->categoria_periodico) { ?>
				<input type="checkbox" name="periodico" id="categoria_periodico" checked />
			<?php } else { ?>
				<input type="checkbox" name="periodico" id="categoria_periodico" />
			<?php } ?>
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="genitori" id="categoria_genitori">La pagina pu&ograve avere genitori?</label>
			</div>
			<?php if ($categoria->categoria_genitori) { ?>
				<input type="checkbox" name="genitori" id="categoria_genitori" checked />
			<?php } else { ?>
				<input type="checkbox" name="genitori" id="categoria_genitori" />
			<?php } ?>
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="multimedia" id="categoria_multimedia">La pagina pu&ograve contenere file multimediali?</label>
			</div>
			<?php if ($categoria->categoria_multimedia) { ?>
				<input type="checkbox" name="multimedia" id="categoria_multimedia" checked />
			<?php } else { ?>
				<input type="checkbox" name="multimedia" id="categoria_multimedia" />
			<?php } ?>
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="imagetitle" id="categoria_imagetitle">La pagina ha un'immagine come titolo?</label>
			</div>
			<?php if ($categoria->categoria_imagetitle) { ?>
				<input type="checkbox" name="imagetitle" id="categoria_imagetitle" checked />
			<?php } else { ?>
				<input type="checkbox" name="imagetitle" id="categoria_imagetitle" />
			<?php } ?>
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="commentabile" id="categoria_commentabile">La pagina &egrave commentabile?</label>
			</div>
			<?php if ($categoria->categoria_commentabile) { ?>
				<input type="checkbox" name="commentabile" id="categoria_commentabile" checked />
			<?php } else { ?>
				<input type="checkbox" name="commentabile" id="categoria_commentabile" />
			<?php } ?>
		</div>
		
		<input type="submit" id="modifica_categoria_button" value="Modifica" />
	</fieldset>
	</form>
</div>