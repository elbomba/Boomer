<?php
/*

	This template contain the header for the dministrator section
	and the menu of the section.


*/
?>

<html>
<head>
	<?php echo link_tag('css/admin-style.css'); ?>
	<?php echo link_tag('adds-on/jquery-ui/jquery-ui.css'); ?>
	<title><?php echo $title; ?></title>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>adds-on/jquery-ui/jquery-ui.js"></script>
</head>
<body>
	
	<div id="container">
		
			<div id="top-page">
				<div class="logo">Boomer</div>
				<?php if ($this->session->userdata('logged_in')){ ?>
					<div class="logout">
						<?php echo anchor('admin/logout', 'Logout', 'title="Logout"'); ?>
					</div>
				<?php } ?>
			</div>
			
			<div id="info-line">
				<?php if ($this->session->userdata('logged_in')){ ?>
					<div class="username">Ciao <?php echo $this->session->userdata('nome'); ?></div>
				<?php } ?>
<!--				<div class="stats">
					<div class="top-stat">
						<p class="num">0</p>
						<p class="desc">Online</p>
					</div>
					<div class="top-stat">
						<p class="num">0</p>
						<p class="desc">Oggi</p>
					</div>
					<div class="top-stat">
						<p class="num">0</p>
						<p class="desc">Totali</p>
					</div>
				</div>
-->			</div>
			
			