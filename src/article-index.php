<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="listing-item">
			<?php
			$title = get_the_title();
			$alt = str_replace('"', '', $title);
			$title = str_replace( ' - ', '<br />',  $title );
			?>

			<?php if ( has_post_thumbnail() ) { ?>
			<div class="funky-title">
			    <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php echo $alt ?>" loading="lazy"/></a>
				<h2>
					<a href="<?php the_permalink(); ?>">
						<?php echo $title; ?>
					</a>
				</h2>
			</div>

			<?php } else { ?>
				<h2>
					<a href="<?php the_permalink(); ?>">
						<?php echo $title; ?>
					</a>
				</h2>
			<?php } ?>

			<div>
				<?php the_excerpt(); ?>
				<div>
					<a href="<?php the_permalink(); ?>">Read "<?php the_title(); ?>"</a>
				</div>
			</div>
			
		</article>

	<?php endwhile; ?>
	
	<div class="simple-grid">
		<div><?php next_posts_link( '&lt; Older Posts' ); ?></div>
		<div><?php previous_posts_link( 'Newer Posts &gt;' ); ?></div>
	</div>

<?php else : ?>
				
	<article class="post error">
		<h2>Error 404-Page NOT Found</h2>
		<p>It seems we can't find what you're looking for.</p>
		<p>This might be because you have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.</p>
	</article>

<?php endif; ?>