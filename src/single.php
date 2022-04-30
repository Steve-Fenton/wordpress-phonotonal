<?php
/**
 * The template for displaying any single post.
 */
get_header(); ?>
<!-- *single* -->
	<?php
		$thumbnail_id = get_post_thumbnail_id( $post->ID );
		$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
		$image = wp_get_attachment_image_url( $thumbnail_id, 'large' );
	?>
	<div class="bgfonk" style="background-image: url('<?php echo $image ?>');">
		<main class="single-item">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<img class="lead-img" src="<?php echo $image ?>" alt="<?php echo $alt; ?>" />
						<h1><?php the_title(); ?></h1>
						
						<?php the_content(); ?>

						<div class="boxed">
							<div class="simple-grid">
								<?php
								$user_email = get_the_author_meta( 'user_email' );
								$user_description = get_the_author_meta( 'user_description', $post->post_author );
								$user_name = get_author_name();
								?>
								<div>
									<p>Written by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
									on <time><?php the_time(get_option('date_format')); ?></time></p>
									<div>
										<?php echo $user_description ?>
									</div>
								</div>
								<div>
									<img src="<?php echo get_avatar_url($user_email,  'size = 200'); ?>" class="author" alt="<?php echo $user_name; ?>">
								</div>
							</div>
							
							<div>
								<?php echo get_the_category_list(); ?>
								<div class="tags">
									<?php echo get_the_tag_list( '&nbsp;', ' ' ); // Display the tags this post has, as links separated by spaces and pipes ?>
								</div>
							</div>
							<?php if(comments_open()) : ?>
								<span class="comments-link">
									<?php comments_popup_link( __( 'Comment', 'break' ), __( '1 Comment', 'break' ), __( '% Comments', 'break' ) ); ?>
								</span>
							<?php endif; ?>
						</div>

						<div class="simple-grid">
							<div class="prev"><?php previous_post_link(); ?></div>
							<div class="next"><?php next_post_link(); ?></div>
						</div>
					</article>

				<?php endwhile; ?>
				<?php if (comments_open() || '0' != get_comments_number()) comments_template( '', true ); ?>
				


			<?php else : ?>
			<article class="post error">
				<h2>Error 404-Page NOT Found</h2>
				<p>It seems we can't find what you're looking for.</p>
				<p>This might be because you have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.</p>
			</article>
			<?php endif; ?>

		</main>
	</div>
<?php get_footer(); ?>
