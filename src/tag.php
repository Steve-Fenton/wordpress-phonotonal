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
	<main class="interest">
		<h1><?php single_tag_title(); ?></h1>
		<div class="constrain-more">
			<h2 id="about">About <?php single_tag_title(); ?></h3>
			<div>
				<?php echo str_replace('<br />', '<br /><br />', tag_description($tag)) ?>
			</div>
			<p>You can subscribe to the <a href="/interest/<?php echo $tag->slug ?>/feed"><?php echo $tag->name ?> tag micro-feed</a>.</p>
		</div>
		<h2><?php single_tag_title(); ?> Articles</h2>
		<?php get_template_part('article', 'index'); ?>
	</main>
<?php get_footer(); ?>