<?php echo $message; ?>
<?= $printMessage; ?>

<?php if ($utenti->num_rows() <=0) { ?>
	
	<div id="utenti">
		
		<div class="main-title">
			<?php echo img(array('src' => 'adds-on/icons/utenti.png')); ?>
			<p>Utenti</p>
		</div>
		<div class="refine">
			<?php echo anchor('admin/utenti', 'Tutti ('.$num_all.')', 'id="refine-all"'); ?> | 
			<?php echo anchor('admin/utenti?tipo=admin', 'Amministratori ('.$num_adm.')', 'id="refine-admin"'); ?> | 
			<?php echo anchor('admin/utenti?tipo=moderator', 'Moderatori ('.$num_mod.')', 'id="refine-moderator"'); ?> | 
			<?php echo anchor('admin/utenti?tipo=user', 'Utenti('.$num_usr.')', 'id="refine-user"'); ?>
		</div>
	
		<div class="utenti-none">
			Nessun Utente <br>
			<?php echo anchor('admin/nuovo_utente', 'Aggiungi Utente', 'title="Aggiungi Utente"'); ?>
		</div>
	
	</div>
	
<?php } else { ?>
	
	<div id="utenti">
		
		<div class="main-title">
			<?php echo img(array('src' => 'adds-on/icons/utenti.png')); ?>
			<p>Utenti</p>
		</div>
		<div class="refine">
			<?php echo anchor('admin/utenti', 'Tutti ('.$num_all.')', 'id="refine-all"'); ?> | 
			<?php echo anchor('admin/utenti?tipo=admin', 'Amministratori ('.$num_adm.')', 'id="refine-admin"'); ?> | 
			<?php echo anchor('admin/utenti?tipo=moderator', 'Moderatori ('.$num_mod.')', 'id="refine-moderator"'); ?> | 
			<?php echo anchor('admin/utenti?tipo=user', 'Utenti('.$num_usr.')', 'id="refine-user"'); ?>
		</div>
		
		<table>
			<tr class="headers">
				<td colspan="2"></td>
				<td style="min-width:150px;">Nome</td>
				<td style="min-width:250px;">Email</td>
				<td style="min-width:100px;" >Ruolo</td>
				<td style="min-width:100px;">Data Registrazione</td>
			</tr>

			<?php foreach ($utenti->result() as $row) { ?>
			
				<tr class="user-element">
						<td style="width: 20px">
							<a href="<?php echo base_url(); ?>admin/utenti/modifica_utente/<?php echo $row->ID_user; ?>" class="mod-icon">
								<?php echo img('adds-on/icons/pencil.png');?>
							</a>
						</td>
						<td style="width: 20px">
							<a href="<?php echo base_url(); ?>admin/utenti/elimina_utente/<?php echo $row->ID_user; ?>" class="del-icon">
								<?php echo img('adds-on/icons/delete_user.png'); ?>
							</a>
						</td>
						<td><?php echo $row->user_login; ?></td>
						<td><?php echo $row->user_email; ?></td>
						<td>
							<?php 
								switch ($row->user_tipo) {
									case "admin":
										echo "Amministratore";
										break;
									case "moderator":
										echo "Moderatore";
										break;
									case "user":
										echo "Utente";
										break;
								}
							?>
						</td>
						<td><?php echo $row->user_registrato; ?></td>						
				</tr>
				
			<?php } ?>
		</table>
	</div>
	
<?php } ?>

<?php 
	if (isset($_GET['tipo'])) {
		echo '
			<script type="text/javascript">
				$("#refine-'.$_GET['tipo'].'").addClass("selected");
			</script>
		';
	} else {
		echo '
			<script type="text/javascript">
				$("#refine-all").addClass("selected");
			</script>
		';
	}
?>