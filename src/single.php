<?php
/**
 * The template for displaying any single post.
 */
get_header(); ?>
<!-- *single* -->
<?php
	$model = new dynamic();
	$model->post_id = get_the_ID();
	$model->post_date = get_the_time('Y-m-d');
	$model->post_url = get_permalink();
	$model->post_headline = get_the_title();
	$model->post_title = fenton_split_title($model->post_headline);
	$model->creator = fenton_creator_name($model->post_headline);

	// Tags
	$model->tags = get_the_tags();
	$model->tags_text = [];

	if ($model->tags) {
		foreach( $model->tags as $tag ) {
			$model->tags_text[] = $tag->name;
		}
	}

	// Image
	$model->thumbnail_id = get_post_thumbnail_id($post->ID);
	$model->thumbnail_alt = get_post_meta($model->thumbnail_id, '_wp_attachment_image_alt', true);
	$model->thumbnail_image = wp_get_attachment_image_url( $model->thumbnail_id, 'medium' );

	$current_cat_id = 0;

	
	$firstCat = '';
	$firstCatLink = '';
	
	$secondCat = '';
	$secondCatLink = '';
	


	function filter_tags($a) {
		global $model;
		
		if ($model->creator) {
			return $a->name == $model->creator;
		}

		return true;
	}
?>
	<div class="bgfonk" style="background-image: url('<?php echo $model->thumbnail_image ?>');">
		<main class="single-item">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<img class="lead-img" src="<?php echo $model->thumbnail_image ?>" alt="<?php echo $model->thumbnail_alt ?>" />
						<h1><?php echo $model->post_title ?></h1>
						
						<?php the_content(); ?>

						<div class="breadcrumb">
							<?php
							$cats = get_the_category();
							if ($cats) {
								echo '<a href="/">Phonotonal</a>';
								uasort($cats, 'fenton_cat_sort');
								foreach($cats as $cat) {
									if ($firstCat == '') {
										$current_cat_id = $cat->term_id;
										$firstCat = $cat->cat_name;
										$firstCatLink = get_category_link($cat);
									} else if ($secondCat == '') {
										$secondCat = $cat->cat_name;
										$secondCatLink = get_category_link($cat);
									}
									$model->tags_text[] = $cat->cat_name;
									echo '<a href="' . get_category_link($cat) . '">' . $cat->cat_name . '</a>';
								}
							}
							?>
							<span><?php echo $model->post_headline ?></span>
						</div>

						<?php
							// Grab all the user info before we mess with other queries
							$user_email = get_the_author_meta( 'user_email' );
							$user_description = get_the_author_meta( 'user_description', $post->post_author );
							$user_name = get_author_name();
							$user_link = get_author_posts_url( get_the_author_meta( 'ID' ) );
							$user_avatar = get_field('avatar', 'user_' . $post->post_author);
							$article_computer_time = get_the_time('Y-m-d\TH:i:sP');
							$article_human_time = get_the_time(get_option('date_format'));
						?>

						<div class="tags">
							<?php echo get_the_tag_list( '&nbsp;', ' ' ); ?>
						</div>

						<?php
							$tag_ids = array_filter(wp_get_post_tags($post->ID), 'filter_tags');
							$selected_tag = NULL;

							foreach ($tag_ids as $x) {
								$selected_tag = $x;
								break;
							}

							if ($selected_tag) {
								$current_tag = $selected_tag->slug;
								$current_tagname = $selected_tag->name;
								$current_tagtitle = $selected_tag->name . ' - ';

								$tag_posts = get_posts(array(
									'numberposts' => 4,
									'tag' => $current_tag,
									'exclude' => array($model->post_id)
								));
								
								if ($tag_posts) {
						?>
						<div class="boxed compact-heading">
							<h2><?php echo $current_tagname ?> Articles</h2>
							<ul>
								<?php foreach ($tag_posts as $post) : ?>
								<li>
									<a href="<?php echo get_permalink($post) ?>">
										<?php echo $post->post_title ?>
									</a>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<?php
								}
							}
						?>

						<div class="boxed">
							<div class="asym-grid">
								<div>
									<p>Written by <a href="<?php echo $user_link ?>"><?php echo $user_name ?></a>
									on <time datetime="<?php echo $article_computer_time ?>"><?php echo $article_human_time ?></time></p>
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

						<?php
						// Related posts						
						$postslist = array_merge(
							// Part one - these will be the same forever - adjascent posts in the same cat
							get_posts(array(
								'numberposts' => 2,
								'category' => $current_cat_id,
								'exclude' => array($model->post_id),
								'date_query' => array('before' => $model->post_date)
							)),
							// Part two - these will change - most recent posts in the same cat
							get_posts(array(
								'numberposts' => 2,
								'category' => $current_cat_id,
								'exclude' => array($model->post_id),
								'date_query' => array('after' => $model->post_date)
							))
						);
						?>

						<h2>Discover More <?php echo $firstCat ?></h2>
						<div class="simple-grid mini">
							<?php foreach ($postslist as $post) : ?>
							<div>
								<a href="<?php echo get_permalink($post) ?>">
									<h3><?php echo $post->post_title; ?></h3>
									<?php echo get_the_post_thumbnail($post, 'thumbnail') ?>
								</a>
							</div>
							<?php endforeach; ?>
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
        "@id": "<?php echo $model->post_url ?>"
      },
      "headline": "<?php echo $model->post_headline ?>",
	  "keywords": "<?php echo implode(',', $model->tags_text) ?>",
      "image": [
        "<?php echo $model->thumbnail_image ?>"
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
        "name": "<?php echo $model->post_headline ?>",
        "item": "<?php echo $model->post_url ?>"
      }]
    }
    </script>
<?php get_footer(); ?>
