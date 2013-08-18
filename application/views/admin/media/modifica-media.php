<?php echo $message; ?>
<?= $printMessage; ?>

<div id="modifica_media_form">
	
    <div class="main-title">
	<?php echo img(array('src' => 'adds-on/icons/media.png')); ?>
	<p>Modifica Media</p>
    </div>
	
    <?php echo form_open('admin/media/modifica_media/'.$media->ID_media); ?>
        <fieldset style="margin-top: 20px;">

            <div class="edit-line">
		<div class="label">
        	    <label for="nome" id="media_nome">Nome: </label>
		</div>
		<input type="text" name="nome" id="media_nome" class="text ui-widget-content ui-corner-all" placeholder="Nome del file" value="<?php echo $media->media_nome; ?>" />
	    </div>
            
            <input type="submit" id="modifica_media_button" value="Salva" />
	</fieldset>
    </form>
</div>