<?php
/**
 * The template for displaying category index pages.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header(); 

$cat = get_queried_object();
?>
<!-- *cat* -->
	<div class="constrain-more">
		<h1><?php single_cat_title(); ?></h1>
		<p>You can subscribe to the <a href="/section/<?php echo $cat->slug ?>/feed"><?php echo $cat->name ?> category micro-feed</a>.</p>
		<div>
			<?php echo str_replace('<br />', '<br /><br />', category_description($cat)) ?>
		</div>
	</div>
	<main>
		<?php get_template_part('article', 'index'); ?>
	</main>
<?php get_footer(); ?>