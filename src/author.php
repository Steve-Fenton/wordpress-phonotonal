<?php
/**
 * The template for displaying tag index pages.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header();

$author = get_queried_object();
$user_name = get_author_name();
$user_link = get_author_posts_url( $author->id );
$user_avatar = get_field('avatar', $author);
?>
<!-- *author* -->
	<div class="constrain-more">
		<h1><?php echo $user_name ?></h1>

		<div class="asym-grid">
			<div>
				<?php echo $author->user_description ?>
			</div>
			<div class="author-img">
				<?php echo wp_get_attachment_image($user_avatar, 'thumbnail'); ?>
			</div>
		</div>
		
	</div>
	<main>
		<?php get_template_part('article', 'index'); ?>
	</main>
<?php get_footer(); ?>