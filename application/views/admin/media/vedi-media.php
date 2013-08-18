<?php echo $message; ?>
<?= $printMessage; ?>

<?php if ($media->num_rows() <= 0) { ?>
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/media.png')); ?>
		<p>Media</p>
	</div>
	
	<div class="media-none">
		Nessun media al momento <br>
		<?php echo anchor('admin/media/nuovo_media', 'Aggiungi Media', 'title="Aggiungi Media"'); ?>
	</div

<?php } else { ?>

	<div class="main-title" style="margin-bottom: 20px;">
		<?php echo img(array('src' => 'adds-on/icons/media.png')); ?>
		<p>Media</p>
	</div>
	
	<?php echo form_open('admin/media'); ?>
		<label for="ricerca" id="mostra">Mostra:</label>
		<select name="ricerca">
			<option value="" id="tipo_all">Tutti</option>
			<option value="image" id="tipo_image">Immagini</option>
			<option value="audio" id="tipo_audio">Audio</option>
			<option value="video" id="tipo_video">Video</option>
			<option value="pdf" id="tipo_pdf">PDF</option>
		</select>
		<input type="submit" id="affina" value="Affina Ricerca" />
	</form>
	
	<div id="Posts">
		<table>
			<tr class="headers">
				<td colspan="2"></td>
				<td style="width:100px; text-align: center;">Thumb</td>
				<td style="min-width:175px;">Nome</td>
				<td style="min-width:100px;">Tipo</td>
				<td style="min-width:200px;">Percorso</td>
				<td style="width: 80px;">Data</td>
			</tr>
			
			<?php foreach($media->result() as $row) { ?>
				
				<tr class="media-element">
					<td style="width: 20px">
						<a href="<?php echo base_url(); ?>admin/media/modifica_media/<?php echo $row->ID_media; ?>" class="mod-icon">
							<?php echo img('adds-on/icons/pencil.png');?>
						</a>
					</td>
					<td style="width: 20px">
						<a href="<?php echo base_url(); ?>admin/media/elimina_media/<?php echo $row->ID_media; ?>" class="del-icon">
							<?php echo img('adds-on/icons/delete.png');?>
						</a>
					</td>
					<td style="text-align: center;">
					<?php
						switch($row->media_tipo) {
							case "image":
								echo '<img src="'.$row->media_thumb_link.'" alt="Thumbnail" class="media-preview clickable" title="'.$row->media_link.'">';
								break;
							case "audio":
								echo img(array('src' => 'adds-on/icons/music.png', 'alt' => 'Audio', 'class' => 'media-preview'));
								break;
							case "video":
								echo img(array('src' => 'adds-on/icons/video.png', 'alt' => 'Video', 'class' => 'media-preview'));
								break;
							case "pdf":
								echo img(array('src' => 'adds-on/icons/pdf.png', 'alt' => 'PDF', 'class' => 'media-preview'));
								break;
						}
					?>
					</td>
					<td><?php echo $row->media_nome; ?></td>
					<td><?php echo $row->media_tipo; ?></td>
					<td><?php echo $row->media_link; ?></td>
					<td><?php echo $row->media_data; ?></td>
				</tr>
				
			<?php } ?>
			
		</table>
	</div>

<?php } ?>

<!-- Creao il posto dove mostrare le immagini -->
<div id="show-image"><img class="show-image-content" src="../adds-on/icons/loading.gif"/></div>

<!-- Mostro le immagini -->
<script type="text/javascript">
	$(function() {
		$( "#show-image" ).dialog({
			autoOpen: false,
				modal: true,
				minWidth: 850,
			show: {
			        effect: "blind",
			        duration: 1000
			},
			hide: {
			        effect: "blind",
			        duration: 1000
			},
			dialogClass: "show-image-dialog"
		});
		$( ".clickable" ).click(function() {
			$(".show-image-content").attr("src", $(this).attr("title"));
		      	$( "#show-image" ).dialog( "open" );
		});
  	});
</script>