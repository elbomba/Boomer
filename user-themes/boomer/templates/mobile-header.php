<?php
/*

	This template contain the header for all the normal pages of site
	and the menu of the section.


*/
?>

<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="shortcut icon" href="favicon.ico" />
	
	<meta name="description" content="<?php echo description(); ?>" />
	<meta name="keywords" content="<?php echo keywords(); ?>" />
	<meta name="author" content="<?php echo author(); ?>" />
	
	<?php echo link_tag(theme_url().'css/mobile-style.css'); ?>
	<?php echo link_tag('adds-on/jquery-ui/jquery-ui.css'); ?>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>adds-on/jquery-ui/jquery-ui.js"></script>
</head>
<body>
<div id="page" class="hfeed">
    
    <header id="branding" role="banner">
	<div id="top-line" class="header-line">
            <a href="<?php echo base_url(); ?>">
                <img class="logo-img" alt="logo" src="<?php echo theme_url(); ?>images/logo.png" />
            </a>
	    <div class="menu">
		<?php $this->function_model->print_menu('Main', 0); ?>
	    </div>
	</div>
    </header>