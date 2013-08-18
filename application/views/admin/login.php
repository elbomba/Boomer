<?php echo $message; ?>
<?= $printMessage; ?>

<div id="login_form">
	<?php echo form_open('admin'); ?>
	<fieldset>
		<h3 align="center">Login</h3>
		<label for="user" id "userlogin">Username</label>
		<input type="text" name="user" id="userlogin" class="text ui-widget-content ui-corner-all" placeholder="Username or e-Mail" value="<?php echo set_value('user'); ?>"/><br>
		
		<label for="password" id="passwordlogin">Password</label>
		<input type="password" name="password" id="passwordlogin" class="text ui-widget-content ui-corner-all"/><br>
		 
		<input type="submit" id="login-button" value="Login"/>
	</fieldset>
	</form>
</div>