<?php
/**
 * The template for displaying tag index pages.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header();

$tag = get_queried_object();
?>
<!-- *tag* -->
	<div class="constrain-more">
		<h1><?php single_tag_title(); ?></h1>
		<p>You can subscribe to the <a href="/interest/<?php echo $tag->slug ?>/feed"><?php echo $tag->name ?> tag micro-feed</a>.</p>
		<div>
			<?php echo tag_description($tag); ?>
		</div>
	</div>
	<main class="article-grid">
		<?php get_template_part('article', 'index'); ?>
	</main>
<?php get_footer(); ?>