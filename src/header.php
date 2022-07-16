<?php
$cacheTime = (60 * 60) * 24;
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Cache-Control: max-age=' . $cacheTime . ', public');
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + $cacheTime)); 

function wp_get_current_url() {
	return home_url($_SERVER['REQUEST_URI']);
}

function cat_sort_reverse($a, $b) {
	if ($a->parent == $b->parent) {
		return 0;
	}
	return ($a->parent > $b->parent) ? -1 : 1;
}

$title_parts = array();

$title = wp_title('', false);
if (strlen($title) == 0) {
	$title = 'Home';
}

$author_name = get_bloginfo('name');

$qry = get_queried_object();

if ($qry) {
	$qry_type = get_class($qry);
	$meta_description = get_field('meta_description', $qry);
	$meta_keywords = get_field('meta_keywords', $qry);

	switch ($qry_type) {
		case 'WP_Post':
			$post_title = get_the_title($qry);
			$parts = explode('&#8211;', $post_title);
			
			if (count($parts) > 1) {
				$title_parts[] = trim($parts[1]);
			}
			$title_parts[] = trim($parts[0]);

			$post_category = get_the_category($qry->ID);
			uasort($post_category, 'cat_sort_reverse');
			foreach($post_category as $post_cat) {
				$title_parts[] = $post_cat->name;
			}

			if (strlen($meta_description) == 0) {
				$meta_description = wp_trim_words(get_the_excerpt($qry), 20);
			}
		
			if (strlen($meta_keywords) == 0) {
				$meta_keywords = strtolower(implode(',', $parts));
			}

			$author_name = get_the_author_meta('first_name', $qry->post_author) . ' ' . get_the_author_meta('last_name', $qry->post_author);
			break;
		case 'WP_Term':
			$title_parts[] = $qry->name;

			if ($qry->taxonomy == 'category') {
				$parentCatName = get_cat_name($qry->parent);
				if ($parentCatName != null) {
					$title_parts[] = $parentCatName;
				}
			}

			if (strlen($meta_description) == 0) {
				$meta_description = wp_trim_words($qry->description, 20);
			}
		
			if (strlen($meta_keywords) == 0) {
				$meta_keywords = strtolower($qry->name);
			}
			break;
		case 'WP_User':
			$user_display_name = get_the_author_meta('display_name', $qry->ID);
			$title_parts[] = $user_display_name;

			if (strlen($meta_description) == 0) {
				$meta_description = wp_trim_words($qry->user_description, 20);
			}
		
			if (strlen($meta_keywords) == 0) {
				$author_name = $user_display_name;
				$meta_keywords = strtolower($author_name);
			}
			break;
	}

	$title_parts[] = get_bloginfo('name');
}
?><!DOCTYPE html>
<html lang="en" dir="ltr">
<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo preg_replace('/\s+/', ' ', implode(' | ', $title_parts)) ?></title>
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
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="constrain">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="title"><img src="<?php echo get_template_directory_uri().'/lock-up-600.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" width="600" height="170" /></a>
</header>
<nav class="sticky">
	<ul>
	<?php 			
	$slugs = array('music', 'words', 'culture');
	foreach ($slugs as $slug) :
		$c = get_category_by_slug($slug); 
		$args = array('orderby' => 'name', 'parent' => $c->term_id);
		$categories = get_categories($args);
	?>
		<li><a href="<?php echo get_category_link($c) ?>"><?php echo $c->name ?></a>
		<?php if ($categories) : ?>
		<ul>
			<li><a href="<?php echo get_category_link($c) ?>" class="button">All <?php echo $c->name ?></a></li>
		<?php foreach ($categories as $sub) : ?>
			<li><a href="<?php echo get_category_link($sub) ?>" class="button"><?php echo $sub->name ?></a></li>
		<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	 	</li>
	<?php
	endforeach;
	?>
	</ul>
</nav>

<div>