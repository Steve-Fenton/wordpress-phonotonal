<?php
/**
 * The template for displaying any single page.
 */
get_header(); ?>
<!-- *pg* -->
	<main class="single-item">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="post">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
		<article class="post error">
			<h1>Error 404-Page NOT Found</h1>
			<p>It seems we can't find what you're looking for.</p>
			<p>This might be because you have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.</p>
		</article>
		<?php endif; ?>
	</main>
<?php get_footer(); ?>