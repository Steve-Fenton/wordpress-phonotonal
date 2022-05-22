<?php
$cacheTime = (60 * 60) * 24;
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Cache-Control: max-age=' . $cacheTime . ', public');
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + $cacheTime)); 

$title = wp_title('', false);
if (strlen($title) == 0) {
	$title = 'Home';
}

$author_name = get_bloginfo('name');
$canonical = get_site_url();

$qry = get_queried_object();

if ($qry) {
	$qry_type = get_class($qry);
	$meta_description = get_field('meta_description', $qry);
	$meta_keywords = get_field('meta_keywords', $qry);

	switch ($qry_type) {
		case 'WP_Post':
			if (strlen($meta_description) == 0) {
				$meta_description = wp_trim_words(get_the_excerpt($qry), 25);
			}
		
			if (strlen($meta_keywords) == 0) {
				$post_title = get_the_title($qry);
				$parts = explode('&#8211;', $post_title);
				$meta_keywords = strtolower(implode(',', $parts));
			}

			$author_name = get_the_author_meta('first_name', $qry->post_author) . ' ' . get_the_author_meta('last_name', $qry->post_author);
			$canonical = get_the_permalink();
			break;
		case 'WP_Term':
			if (strlen($meta_description) == 0) {
				$meta_description = wp_trim_words($qry->description, 25);
			}
		
			if (strlen($meta_keywords) == 0) {
				$meta_keywords = strtolower($qry->name);
			}

			$canonical = get_term_link($qry);
			break;
		case 'WP_User':
			if (strlen($meta_description) == 0) {
				$meta_description = wp_trim_words($qry->user_description, 25);
			}
		
			if (strlen($meta_keywords) == 0) {
				$author_name = get_the_author_meta('display_name', $qry->ID);
				$meta_keywords = strtolower($author_name);
			}

			$canonical = get_author_posts_url($qry->ID);
			break;
	}
}
?><!DOCTYPE html>
<html lang="en" dir="ltr">
<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo $title ?> | <?php bloginfo('name') ?></title>
	<link rel="canonical" href="<?php echo esc_url($canonical) ?>" />
	<meta name="description" content="<?php
	if ($qry) {
        echo str_replace('"', '', $meta_description);
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
	?>" />
	<meta name="keywords" content="<?php
	if ($qry) {
        echo str_replace('"', '', $meta_keywords);
    } else {
        echo 'phonotonal,music,magazine,reviews';
    }
	?>" />
	<meta name="viewport" content="width=device-width" />
	<meta name="author" content="<?php echo $author_name ?>">
	<meta name="theme-color" content="#34a4ba"/>
	<meta name="google-site-verification" content="Bo3H4hqOkoriITgPKvJITCqGLv31p5cUm2m536tvxXE" />
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-B6YBFBMMT8"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'G-B6YBFBMMT8');
	gtag("config", { "anonymize_ip": true });
	gtag("set", "allow_ad_personalization_signals", false);
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="constrain">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="title"><img src="<?php echo get_template_directory_uri().'/lock-up-600.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" width="600" height="170" /></a>
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