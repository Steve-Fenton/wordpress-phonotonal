<?php
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
$title = wp_title('', false);
if (strlen($title) == 0) {
	$title = 'Home';
}
?><!DOCTYPE html>
<html lang="en" dir="ltr">
<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo $title ?> | <?php bloginfo('name') ?></title>
	<meta name="viewport" content="width=device-width" />
	<meta name="author" content="Steve Fenton">
	<meta name="msapplication-TileColor" content="#6C94C7"/>
	<meta name="msapplication-square150x150logo" content="/fenton-150.png"/>
	<meta name="google-site-verification" content="TBC" />
	<meta name="msvalidate.01" content="TBC" />
	<meta name="robots" content="max-image-preview:large" />
	<meta name="google-site-verification" content="Bo3H4hqOkoriITgPKvJITCqGLv31p5cUm2m536tvxXE" />
	<link rel="dns-prefetch" href="//s.w.org" />
	<link rel="alternate" type="application/rss+xml" title="Phonotonal Feed" href="https://www.phonotonal.com/feed/" />
	<link rel="stylesheet" id="wp-block-library-css"  href="https://www.phonotonal.com/wp-includes/css/dist/block-library/style.min.css?ver=5.9.3"  media="all" />
	<link rel="stylesheet" id="fenton-style-css"  href="https://www.phonotonal.com/wp-content/themes/phonotonal/style.css"  media="all" />
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-36818004-3"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag("js", new Date());
	gtag("config", { "anonymize_ip": true });
	gtag("set", "allow_ad_personalization_signals", false);
	</script>
	<link rel="icon" href="https://www.phonotonal.com/wp-content/uploads/2020/02/cropped-phonotonal-logo-32x32.png" sizes="32x32" />
	<link rel="icon" href="https://www.phonotonal.com/wp-content/uploads/2020/02/cropped-phonotonal-logo-192x192.png" sizes="192x192" />
	<link rel="apple-touch-icon" href="https://www.phonotonal.com/wp-content/uploads/2020/02/cropped-phonotonal-logo-180x180.png" />
	<meta name="msapplication-TileImage" content="https://www.phonotonal.com/wp-content/uploads/2020/02/cropped-phonotonal-logo-270x270.png" />
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