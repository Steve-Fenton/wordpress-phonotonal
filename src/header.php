<?php
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
$title = wp_title('', false);
if (strlen($title) == 0) {
	$title = 'Phonotonal';
}
?><!DOCTYPE html>
<html lang="en" dir="ltr">
<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo $title ?></title>
	<meta name="viewport" content="width=device-width" />
	<meta name="author" content="Steve Fenton">
	<meta name="msapplication-TileColor" content="#6C94C7"/>
	<meta name="msapplication-square150x150logo" content="/fenton-150.png"/>
	<meta name="google-site-verification" content="TBC" />
	<meta name="msvalidate.01" content="TBC" />
	<link rel="apple-touch-icon" href="/fenton-150.png" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="constrain">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="title"><img src="<?php echo get_template_directory_uri().'/lock-up-600.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
</header>
<nav class="sticky">
	<ul>
		<li><a href="https://www.phonotonal.com/">home</a></li>
		<li><a href="https://www.phonotonal.com/section/music/">music</a></li>
		<li><a href="https://www.phonotonal.com/section/words/">words</a></li>
		<li><a href="https://www.phonotonal.com/section/culture/">culture</a></li>
	</ul>
</nav>

<div>