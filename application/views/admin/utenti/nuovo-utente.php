<?php echo $message; ?>
<?= $printMessage; ?>

<div id="aggiungi_utente_form">
	
	<div class="main-title">
		<?php echo img(array('src' => 'adds-on/icons/utenti.png')); ?>
		<p>Nuovo Utente</p>
	</div>
	
	<?php echo form_open('admin/utenti/nuovo_utente'); ?>
	
	<fieldset id="nuovo-utente">
		<?php echo $this->input->post('tipo'); ?>
		<div class="edit-line">
			<div class="label">
				<label for="tipo" id="utente_tipo">Tipo di Utente</label>
			</div>
			<select name="tipo" id="utente_tipo">
				<option>Scegli il tipo di utente...</option>
				<option value="admin" id="tipo-admin">Amministratore</option>
				<option value="moderator" id="tipo-moderator">Moderatore</option>
				<option value="user" id="tipo-user">Utente</option>
			</select>
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="login" id="utente_login">Nome utente (Obbligatorio)</label>
			</div>
			<input type="text" name="login" id="utente_login" class="text ui-widget-content ui-corner-all" placeholder="Nome per il login" value="<?php echo set_value('login'); ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">	
				<label for="email" id="utente_email">E-mail (Obbligatorio)</label>
			</div>
			<input type="mail" name="email" id="utente_email" class="text ui-widget-content ui-corner-all" placeholder="Email" value="<?php echo set_value('email'); ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="nome" id="utente_nome">Nome</label>
			</div>
			<input type="text" name="nome" id="utente_nome" class="text ui-widget-content ui-corner-all" placeholder="Nome" value="<?php echo set_value('nome'); ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="cognome" id="utente_cognome">Cognome</label>
			</div>
			<input type="text" name="cognome" id="utente_cognome" class="text ui-widget-content ui-corner-all" placeholder="Cognome" value="<?php echo set_value('cognome'); ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="password" id="utente_password">Password</label>
			</div>
			<input type="password" name="password" id="utente_password" class="text ui-widget-content ui-corner-all" placeholder="Password for login" value="<?php echo set_value('password'); ?>" />
		</div>
		
		<div class="edit-line">
			<div class="label">
				<label for="confirm_password" id="utente_confirm_password">Conferma Password</label>
			</div>
			<input type="password" name="confirm_password" id="utente_confirm_password" class="text ui-widget-content ui-corner-all" placeholder="Conferma la Password" value="<?php echo set_value('confirm_password'); ?>" />
		</div>
		
		<input type="submit" id="aggiungi_utente_button" value="Aggiungi" />
	</fieldset>
	</form>
</div>