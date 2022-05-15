<?php 
	$lazy = '';
	$lazyCount = 0;
	$lazyStart = 5;
?>
<div class="article-grid">
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="listing-item">
			<?php
			// Lazy loading above the fold causes cumulative layout shift (CLS)
			// ... so reserve lazy loading for images definitely below the fold
			$lazyCount++;

			if ($lazyCount > 5) {
				$lazy = ' loading="lazy"';
			}

			// Prepare the title
			$title = get_the_title();
			$alt = str_replace('"', '', $title);

			$parts = explode('&#8211;', $title);
			if (count($parts) == 2) {
			 	$title = $parts[0] . '<em>' . $parts[1] . '</em>';
			}
			?>

			<?php if ( has_post_thumbnail() ) { ?>
			<div class="funky-title">
			    <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="<?php echo $alt ?>"<?php echo $lazy ?> /></a>
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
					<a href="<?php the_permalink(); ?>" class="button">Read <?php echo $title; ?></a>
				</div>
			</div>
			
		</article>

	<?php endwhile; ?>
</div>
	
<div class="simple-grid paging">
	<div class="prev"><?php next_posts_link( '&lt; Older Posts' ); ?></div>
	<div class="next"><?php previous_posts_link( 'Newer Posts &gt;' ); ?></div>
</div>

<?php else : ?>
				
	<article class="post error">
		<h2>Error 404-Page NOT Found</h2>
		<p>It seems we can't find what you're looking for.</p>
		<p>This might be because you have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.</p>
	</article>

<?php endif; ?>