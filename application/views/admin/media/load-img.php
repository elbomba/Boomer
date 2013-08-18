<!-- Load javascript of loader -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.form.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
	//elements
	var progressbox = $('#progressbox');
	var progressbar = $('#progressbar');
	var statustxt = $('#statustxt');
	var submitbutton = $('#submit');
	var myform = $('#upload');
	var output = $('#output');
	var completed = '0%';
    
	$(myform).ajaxForm({
	    beforeSend: function() { //before sending form
	        submitbutton.attr('disabled', ''); //disable upload button
        	statustxt.empty();
		progressbox.slideDown(); //show progressbar
		progressbar.width(completed); //initial value 0% of progressbar
		statustxt.html(completed); //set status text
		statustxt.css('color', '#000'); //initial color of status text
	    },
	    uploadProgress: function(event, position, total, percentComplete) { //on progress
	        progressbar.width(percentComplete + '%'); //update progressbar percent complete
	        statustxt.html(percentComplete + '%'); //update status text
	        if (percentComplete > 50) {
	            statustxt.css('color', '#fff'); //change status text to white after 50%
	        }
	    },
	    complete: function(response) { //on complete
	        output.html(response.responseText); //update element with received data
	        myform.resetForm(); //reser form
	        submitbutton.removeAttr('disabled');
	        progressbox.slideUp(); //hide progressbar
	    }
	});
    });
</script>

<form id="upload" action="<?php echo base_url(); ?>adds-on/loader/image-file-loader.php" method="post" enctype="multipart/form-data">
    
    <div class="edit-line">
	<div class="label">
	    <label for="file">File: </label>
	</div>
        <input type="file" name="file[]" id="file" accept="image/*" multiple /><br>
    </div>
    <input type="submit" id="submit" name="submit" value="Carica" />
</form>

<div id="progressbox"><div id="progressbar"></div><div id="statustxt"></div></div>
<div id="output"></div>

</fieldset>
</div> <!-- Close div type-media -->