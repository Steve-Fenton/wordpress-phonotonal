<?php 
/**
 * 	Template Name: Sidebar/Home Page
 *
 *	This page template has a sidebar built into it, 
 * 	and can be used as a home page, in which case the title will not show up.
*/
get_header(); ?>
<!-- *ph* -->
	<main>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="post">
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
		<article class="post error">
			<h2>Error 404-Page NOT Found</h2>
			<p>It seems we can't find what you're looking for.</p>
			<p>This might be because you have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.</p>
		</article>
		<?php endif; ?>
	</main>
<?php get_footer(); ?>