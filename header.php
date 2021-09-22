<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  <!--  adding the responsive ability -->
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php bloginfo('name'); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<?php wp_head(); ?>
</head>
<body>
<header>
	<div class="container">
		<h1><?php bloginfo('name'); ?></h1>
		<span><?php bloginfo('description'); ?></span>
	</div>
</header>

<nav class="main-nav">
<div class="container">
<?php $args = array('theme_location' => 'primary');?>
<?php wp_nav_menu($args); ?>
</div>
</nav>