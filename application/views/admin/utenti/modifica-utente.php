<?php echo $message; ?>
<?= $printMessage; ?>

<div id="modifica_utente_form">
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/utenti.png')); ?>
		<p>Modifica Utente</p>
	</div>
	
	<?php echo form_open('admin/utenti/modifica_utente/'.$user->ID_user); ?>
	<fieldset id="modifica-utente">
		<h2>Informazioni contatto</h2>
		
		<div class="edit-line">
			<div class="label">
				<label for="login" id="utente_login">Nome utente (Obbligatorio)</label>
			</div>
			<input type="text" name="login" id="utente_login" class="text ui-widget-content ui-corner-all" placeholder="Nome per il login" value="<?php echo $user->user_login; ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="email" id="utente_email">E-mail (Obbligatorio)</label>
			</div>
			<input type="mail" name="email" id="utente_email" class="text ui-widget-content ui-corner-all" placeholder="Email" value="<?php echo $user->user_email; ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="nome" id="utente_nome">Nome</label>
			</div>
			<input type="text" name="nome" id="utente_nome" class="text ui-widget-content ui-corner-all" placeholder="Nome" value="<?php echo $user->user_nome; ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="cognome" id="utente_cognome">Cognome</label>
			</div>
			<input type="text" name="cognome" id="utente_cognome" class="text ui-widget-content ui-corner-all" placeholder="Cognome" value="<?php echo $user->user_cognome; ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="tipo" id="utente_tipo">Tipo di Utente</label>
			</div>
			<select name="tipo" id="utente_tipo">
				<option value="admin" id="tipo-admin">Amministratore</option>
				<option value="moderator" id="tipo-moderator">Moderatore</option>
				<option value="user" id="tipo-user">Utente</option>
			</select>
		</div>
		
		<h2>Cambia Password</h2>
		<div class="edit-line">
			<div class="label">
				<label for="new_password" id="utente_password">Nuova Password</label>
			</div>
			<input type="password" name="new_password" id="utente_new_password" class="text ui-widget-content ui-corner-all" placeholder="Password for login" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="confirm_new_password" id="utente_confirm_new_password">Conferma Password</label>
			</div>
			<input type="password" name="confirm_new_password" id="utente_confirm_new_password" class="text ui-widget-content ui-corner-all" placeholder="Conferma la Password" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="old_password" id="utente_old_password">Vecchia Password</label>
			</div>
			<input type="password" name="old_password" id="utente_old_password" class="text ui-widget-content ui-corner-all" placeholder="Inserisci la vecchia Password" />
		</div>
		
		<input type="submit" id="modifica_utente_button" value="Modifica" class="button" />
	</fieldset>
	</form>
	
</div>


<?php
	// Seleziono il tipo di utente
	echo '
		<script type="text/javascript">
			document.getElementById("tipo-'.$user->user_tipo.'").selected=true;
		</script>
	';
?>