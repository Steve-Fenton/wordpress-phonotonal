<?php
/**
 * The template for displaying any single post.
 */
get_header(); ?>
<!-- *single* -->
<?php
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	$image = wp_get_attachment_image_url( $thumbnail_id, 'medium' );

	$headline = get_the_title();
	$title = $headline;
	$parts = explode('&#8211;', $title);
	if (count($parts) == 2) {
		$title = $parts[0] . '<br /><em>' . $parts[1] . '</em>';
	}

	$textTags = [];

	$firstCat = '';
	$firstCatLink = '';

	$secondCat = '';
	$secondCatLink = '';

	$tags = get_the_tags();
	if ($tags) {
		foreach( $tags as $tag ) {
			$textTags[] = $tag->name;
		}
	}

	function cat_sort($a, $b) {
		if ($a->parent == $b->parent) {
			return 0;
		}
		return ($a->parent < $b->parent) ? -1 : 1;
	}
?>
	<div class="bgfonk" style="background-image: url('<?php echo $image ?>');">
		<main class="single-item">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<img class="lead-img" src="<?php echo $image ?>" alt="<?php echo $alt ?>" />
						<h1><?php echo $title ?></h1>
						
						<?php the_content(); ?>

						<div class="breadcrumb">
							<?php
							$cats = get_the_category();
							if ($cats) {
								echo '<a href="/">Phonotonal</a>';
								uasort($cats, 'cat_sort');
								foreach($cats as $cat) {
									if ($firstCat == '') {
										$firstCat = $cat->cat_name;
										$firstCatLink = get_category_link($cat);
									} else if ($secondCat == '') {
										$secondCat = $cat->cat_name;
										$secondCatLink = get_category_link($cat);
									}
									$textTags[] = $cat->cat_name;
									echo '<a href="' . get_category_link($cat) . '">' . $cat->cat_name . '</a>';
								}
							}
							?>
							<span><?php echo $headline ?></span>
						</div>

						<div class="tags">
							<?php echo get_the_tag_list( '&nbsp;', ' ' ); ?>
						</div>

						<div class="boxed">
							<div class="simple-grid">
								<?php
								$user_email = get_the_author_meta( 'user_email' );
								$user_description = get_the_author_meta( 'user_description', $post->post_author );
								$user_name = get_author_name();
								$user_link = get_author_posts_url( get_the_author_meta( 'ID' ) );
								$user_avatar = get_field('avatar', 'user_' . $post->post_author);
								?>
								<div>
									<p>Written by <a href="<?php echo $user_link ?>"><?php echo $user_name ?></a>
									on <time><?php the_time(get_option('date_format')); ?></time></p>
									<div>
										<?php echo $user_description ?>
									</div>
								</div>
								<div class="author-img">
									<a href="<?php echo $user_link ?>"><?php echo wp_get_attachment_image($user_avatar, 'thumbnail'); ?></a>
								</div>
							</div>
						</div>
						
						<?php if(comments_open()) : ?>
							<span class="comments-link">
								<?php comments_popup_link( __( 'Comment', 'break' ), __( '1 Comment', 'break' ), __( '% Comments', 'break' ) ); ?>
							</span>
						<?php endif; ?>

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
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo get_permalink() ?>"
      },
      "headline": "<?php echo $headline ?>",
	  "keywords": "<?php echo implode(',', $textTags) ?>",
      "image": [
        "<?php echo $image ?>"
      ],
      "datePublished": "<?php the_time('Y-m-d') ?>",
      "dateModified": "<?php the_modified_date('Y-m-d') ?>",
      "author": {
        "@type": "Person",
        "name": "<?php echo $user_name ?>",
        "url": "<?php echo $user_link ?>"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Phonotonal",
        "logo": {
          "@type": "ImageObject",
          "url": "https://www.phonotonal.com/wp-content/themes/phonotonal/lock-up-2000.png"
        }
      }
    }
    </script>
	<?php 
		$position = 0;
	?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": <?php echo ++$position ?>,
        "name": "Home",
        "item": "https://www.phonotonal.com/"
      },{
        "@type": "ListItem",
        "position": <?php echo ++$position ?>,
        "name": "<?php echo $firstCat ?>",
        "item": "<?php echo $firstCatLink ?>"
      },<?php if ($secondCat != '') : ?>{
        "@type": "ListItem",
        "position": <?php echo ++$position ?>,
        "name": "<?php echo $secondCat ?>",
        "item": "<?php echo $secondCatLink ?>"
      },<?php endif; ?>{
        "@type": "ListItem",
        "position": <?php echo ++$position ?>,
        "name": "<?php echo $headline ?>",
        "item": "<?php echo get_permalink() ?>"
      }]
    }
    </script>
<?php get_footer(); ?>
