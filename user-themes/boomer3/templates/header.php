<?php
/*

	This template contain the header for all the normal pages of site
	and the menu of the section.


*/
?>

<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
	
	<meta name="description" content="<?php echo description(); ?>" />
	<meta name="keywords" content="<?php echo keywords(); ?>" />
	<meta name="author" content="<?php echo author(); ?>" />
	
	<?php echo link_tag(theme_url().'css/style.css'); ?>
	<?php echo link_tag(theme_url().'adds-on/nivo-slider/nivo-slider.css'); ?>
	<?php echo link_tag('adds-on/jquery-ui/jquery-ui.css'); ?>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>adds-on/jquery-ui/jquery-ui.js"></script>
</head>
<body>
<div id="page" class="hfeed">
    
    <?php
        // Se  loggato l'admin mostro una striscia che porta all'amministrazione
        if ($this->session->userdata('logged_in')) {
            echo '
		<div id="admin-line">
		    <div class="link_to">Go to administration page</div>
		    <div class="logout">Logout</div>
		</div>
	    ';
	}
    ?>
    
    <header id="branding" role="banner">
	<div id="top-line" class="header-line">
		<div id="top-logo" class="logo">
			<a href="<?php echo base_url(); ?>">
				<img class="logo-img" alt="logo" src="<?php echo theme_url(); ?>images/logo.png" />
			</a>
			
			<div class="menu">
				<?php $this->function_model->print_menu('Main', 0, true); ?>
			</div>
		</div>
	</div>
    </header>