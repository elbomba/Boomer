<?php echo $message; ?>
<?= $printMessage; ?>

<?php echo form_open('admin/post/nuovo_post', array('style' => 'text-align:center; margin-top:50px;')); ?>
<label for="tipo" id="post_tipo">Seleziona il tipo di post</label>
<select name="tipo">
	<option value="" id="tipo_0">Scegli il tipo di pagina...</option>
	
	<?php foreach($sel_cat->result() as $row) { ?>
		
		<option value="<?php echo $row->ID_categoria; ?>"><?php echo $row->categoria_nome; ?></option>
	
	<?php } ?>
	
</select>

<input type="hidden" name="first" value="1" />

<input type="submit" id="submit_button" value="Continua" />

</form>