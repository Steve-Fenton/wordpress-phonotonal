<?php
/**
 * The template for displaying tag index pages.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header();

$author = get_queried_object();
?>
<!-- *author* -->
	<div class="constrain-more">
		<h1><?php echo $author->nickname ?></h1>

		<div class="simple-grid">
			<?php
		
			$user_email = $author->user_email;
			$user_name = get_author_name();
			$user_link = get_author_posts_url( $author->id );
			?>
			<div>
				<?php echo $author->user_description ?>
			</div>
			<div>
				<img src="<?php echo get_avatar_url($author->user_email,  'size = 200'); ?>" class="author" alt="<?php echo $user_name ?>">
			</div>
		</div>
		
	</div>
	<main class="article-grid">
		<?php get_template_part('article', 'index'); ?>
	</main>
<?php get_footer(); ?>