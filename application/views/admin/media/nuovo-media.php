<?php echo $message; ?>
<?= $printMessage; ?>

<div id="aggiungi_media_form">
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/media.png')); ?>
		<p>Carica Media</p>
	</div>
	
	<div class="type-media">
		<fieldset style="margin-top: 20px;">
			<div class="edit-line">
				<div class="label">
					<label for="tipo" id="media_tipo">Seleziona il tipo di Media</label>
				</div>
				<select id="tipo">
					<option id="tipo_" name="tipo" value="">Segli il tipo di file...</option>
					<option id="tipo_img" name="tipo" value="img">Immagine</option>
					<option id="tipo_audio" name="tipo" value="audio">Audio</option>
					<option id="tipo_vid" name="tipo" value="vid">Video</option>
					<option id="tipo_pdf" name="tipo" value="pdf">PDF</option>
				</select>
			</div>
	
	<script type="text/javascript">
		$("#tipo").change(function() {
			var tipo = $("#tipo").val();
			window.location.assign("nuovo_media?tipo="+tipo);
		});
	</script>

	<?php
		// Script per selzionare gli elementi del dom
		echo '
			<script type="text/javascript">
				document.getElementById("tipo_'.$tipo.'").selected=true;
			</script>
		';
	?>