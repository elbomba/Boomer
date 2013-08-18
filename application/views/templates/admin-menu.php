<!-- Lateral Menu of the administration page -->
<div id="admin-lateral-menu">	
	
	<div id="home-main-menu" class="admin-menu-item">
		<a title="Home" href="/<?php echo site_name(); ?>/admin">
			<div class="menu-name">Home</div>
			<?php echo img(array('src' => 'adds-on/icons/home.png', 'class' => 'menu-image'))?>
		</a>
	</div>
	
	<div id="utenti-main-menu" class="admin-menu-item">
		<a title="Utenti" href="/<?php echo site_name(); ?>/admin/utenti" class="menu-item-link">
			<div class="menu-name">Utenti</div>
			<?php echo img(array('src' => 'adds-on/icons/utenti.png', 'class' => 'menu-image'))?>
		</a>
	</div>
	
	<div id="post-main-menu" class="admin-menu-item">
		<a title="Post" href="/<?php echo site_name(); ?>/admin/post" class="menu-item-link">
			<div class="menu-name">Post</div>
			<?php echo img(array('src' => 'adds-on/icons/post.png', 'class' => 'menu-image'))?>
		</a>
	</div>

	<div id="menu-main-menu" class="admin-menu-item">
		<a title="Menu" href="/<?php echo site_name(); ?>/admin/menu" class="menu-item-link">
			<div class="menu-name">Menu</div>
			<?php echo img(array('src' => 'adds-on/icons/menu.png', 'class' => 'menu-image'))?>
		</a>
	</div>

	<div id="media-main-menu" class="admin-menu-item">
		<a title="Media" href="/<?php echo site_name(); ?>/admin/media" class="menu-item-link">	
			<div class="menu-name">Media</div>
			<?php echo img(array('src' => 'adds-on/icons/media.png', 'class' => 'menu-image'))?>
		</a>	
	</div>

	<div id="categorie-main-menu" class="admin-menu-item">
		<a title="Categorie" href="/<?php echo site_name(); ?>/admin/categorie" class="menu-item-link">
			<div class="menu-name">Categorie</div>
			<?php echo img(array('src' => 'adds-on/icons/categorie.png', 'class' => 'menu-image'))?>
		</a>
	</div>

	<div id="statistiche-main-menu" class="admin-menu-item">
		<a title="Statistiche" href="/<?php echo site_name(); ?>/admin/statistiche" class="menu-item-link">
			<div class="menu-name">Statistiche</div>
			<?php echo img(array('src' => 'adds-on/icons/statistiche.png', 'class' => 'menu-image'))?>
		</a>
	</div>
	
	<div id="newsletter-main-menu" class="admin-menu-item">
		<div class="menu-name">Newsletter</div>
		<?php echo img(array('src' => 'adds-on/icons/newsletter.png', 'class' => 'menu-image'))?>
	</div>
	
	<div id="sms-main-menu" class="admin-menu-item">
		<div class="menu-name">SMS</div>
		<?php echo img(array('src' => 'adds-on/icons/sms.png', 'class' => 'menu-image'))?>
	</div>
	
	<div id="calendario-main-menu" class="admin-menu-item">
		<div class="menu-name">Calendario</div>
		<?php echo img(array('src' => 'adds-on/icons/calendario.png', 'class' => 'menu-image'))?>
	</div>
</div>


<!-- Top Menu -->
<div id="admin-top-menu">
	<div id="home-menu" class="sub-menu">
		<?php echo anchor('admin', 'Riepilogo', 'title="Riepilogo" class="admin-sub-menu-item"'); ?>
	</div>
	
	<div id="utenti-menu" class="sub-menu">
		<?php echo anchor('admin/utenti', 'Vedi Utenti', 'title="Vedi Utenti" class="admin-sub-menu-item"'); ?>
		<?php echo anchor('admin/utenti/nuovo_utente', 'Nuovo Utente', 'title="Nuovo Utente" id="nuovo_utente" class="admin-sub-menu-item"'); ?>
		<div id="modifica_utente" class="admin-sub-menu-item" style="display:none;">Modifica</div>
	</div>
	
	<div id="post-menu" class="sub-menu">
		<?php echo anchor('admin/post', 'Vedi Post', 'title="Vedi Post" class="admin-sub-menu-item"'); ?>
		<?php echo anchor('admin/post/nuovo_post', 'Nuovo Post', 'title="Nuovo Post" id="nuovo_post" class="admin-sub-menu-item"'); ?>
		<div id="modifica_post" class="admin-sub-menu-item" style="display:none;">Modifica</div>
	</div>
	
	<div id="menu-menu" class="sub-menu">
		<?php echo anchor('admin/menu', 'Vedi Menu', 'title="Vedi Menu" class="admin-sub-menu-item"'); ?>
		<?php echo anchor('admin/menu/nuovo_menu', 'Nuovo Menu', 'title="Nuovo Menu" id="nuovo_menu" class="admin-sub-menu-item"'); ?>
		<?php if(isset($_GET['menu'])) { ?>
			<?php echo anchor('admin/menu/nuova_voce/'.$_GET['menu'], 'Nuova Voce', 'title="Nuova Voce" id="nuova_voce" class="admin-sub-menu-item" style="display: none;"'); ?>
		<?php } else { ?>
			<?php echo anchor('admin/menu/nuova_voce', 'Nuova Voce', 'title="Nuova Voce" id="nuova_voce" class="admin-sub-menu-item" style="display: none;"'); ?>
		<?php } ?>
		<div id="modifica_menu" class="admin-sub-menu-item" style="display:none;">Modifica Menu</div>
		<div id="modifica_voce" class="admin-sub-menu-item" style="display:none;">Modifica Voce</div>
	</div>
	
	<div id="media-menu" class="sub-menu">
		<?php echo anchor('admin/media', 'Vedi Media', 'title="Vedi Media" class="admin-sub-menu-item"'); ?>
		<?php echo anchor('admin/media/nuovo_media', 'Nuovo Media', 'title="Nuovo Media" id="nuovo_media" class="admin-sub-menu-item"'); ?>
		<div id="modifica_media" class="admin-sub-menu-item" style="display:none;">Modifica</div>
	</div>
	
	<div id="categorie-menu" class="sub-menu">
		<?php echo anchor('admin/categorie', 'Vedi Categorie', 'title="Vedi Categorie" class="admin-sub-menu-item"'); ?>
		<?php echo anchor('admin/categorie/nuova_categoria', 'Nuova Categoria', 'title="Nuova Categoria" id="nuova_categoria" class="admin-sub-menu-item"'); ?>
		<div id="modifica_categoria" class="admin-sub-menu-item" style="display:none;">Modifica</div>
	</div>
	
	<div id="statistiche-menu" class="sub-menu">
		<?php echo anchor('admin/statistiche', 'Riepilogo', 'title="Riepilogo" class="admin-sub-menu-item"'); ?>
		<?php echo anchor('admin/statistiche/dati_demografici', 'Dati Demografici', 'title="Dati Demografici" id="dati_demografici" class="admin-sub-menu-item"'); ?>
		<?php echo anchor('admin/statistiche/device', 'Device', 'title="Device" id="device" class="admin-sub-menu-item"'); ?>
	</div>
</div>

<!-- Script per mostrare i menu -->
<script type="text/javascript">
	function show(id) {
		if ($("#"+id).css("display") == "none") {
			$(".sub-menu").css("display", "none");
			$("#"+id).toggle();
		} else {
			$(".sub-menu").css("display", "none");
		}
	}
</script>

<div id="main">
<div id="page">