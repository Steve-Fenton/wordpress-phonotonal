<?php get_header(); ?>
<!-- *single* -->
<?php
	$model = new dynamic();
	$model->post_id = get_the_ID();
	$model->post_date = get_the_time('Y-m-d');
	$model->post_computer_time = get_the_time('Y-m-d\TH:i:sP');
	$model->post_human_time = get_the_time(get_option('date_format'));
	$model->post_class = implode(' ', get_post_class());
	$model->post_url = get_permalink();
	$model->post_headline = get_the_title();
	$model->post_title = fenton_split_title($model->post_headline);
	$model->creator = fenton_creator_name($model->post_headline);
	$model->content = apply_filters('the_content', get_the_content());
	
	// Image
	$model->thumbnail_id = get_post_thumbnail_id($model->post_id);
	$model->thumbnail_alt = get_post_meta($model->thumbnail_id, '_wp_attachment_image_alt', true);
	$model->thumbnail_image = wp_get_attachment_image_url( $model->thumbnail_id, 'medium' );

	// Post metadata
	$model->user_description = get_the_author_meta('user_description', $post->post_author);
	$model->user_name = get_author_name();
	$model->user_link = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$model->user_avatar = get_field('avatar', 'user_' . $post->post_author);

	// Tags
	$model->tags = get_the_tags();
	$model->tags_text = fenton_get_text_tags($model->tags);

	// Categories
	$model->categories = get_the_category();
	uasort($model->categories, 'fenton_cat_sort');
	$model->category_id = 0;
	$model->first_category = '';
	$model->first_category_link = '';
	$model->second_category = '';
	$model->second_category_link = '';
	
	if ($model->categories) {
		foreach($model->categories as $cat) {
			if ($model->first_category == '') {
				$model->category_id = $cat->term_id;
				$model->first_category = $cat->cat_name;
				$model->first_category_link = get_category_link($cat);
			} else if ($model->second_category == '') {
				$model->second_category = $cat->cat_name;
				$model->second_category_link = get_category_link($cat);
			}
			$model->tags_text[] = $cat->cat_name;
		}
	}

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
					<article id="post-<?php echo $model->post_id ?>" class="<?php echo $model->post_class ?>">

						<img class="lead-img" src="<?php echo $model->thumbnail_image ?>" alt="<?php echo $model->thumbnail_alt ?>" />
						<h1><?php echo $model->post_title ?></h1>
						
						<?php echo $model->content ?>

						<div class="breadcrumb">
							<?php
							if ($model->categories) {
								echo '<a href="/">Phonotonal</a>';
								foreach($model->categories as $cat) {
									echo '<a href="' . get_category_link($cat) . '">' . $cat->cat_name . '</a>';
								}
							}
							?>
							<span><?php echo $model->post_headline ?></span>
						</div>

						<div class="tags">
							<?php echo get_the_tag_list('', ' ', '', $model->post_id); ?>
						</div>

						<?php
							$tag_ids = array_filter(wp_get_post_tags($model->post_id), 'filter_tags');
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
									<p>Written by <a href="<?php echo $model->user_link ?>"><?php echo $model->user_name ?></a>
									on <time datetime="<?php echo $model->post_computer_time ?>"><?php echo $model->post_human_time ?></time></p>
									<div>
										<?php echo $model->user_description ?>
									</div>
								</div>
								<div class="author-img">
									<a href="<?php echo $model->user_link ?>"><?php echo wp_get_attachment_image($model->user_avatar, 'thumbnail'); ?></a>
								</div>
							</div>
						</div>

						<?php
						// Related posts						
						$postslist = array_merge(
							// Part one - these will be the same forever - adjascent posts in the same cat
							get_posts(array(
								'numberposts' => 2,
								'category' => $model->category_id,
								'exclude' => array($model->post_id),
								'date_query' => array('before' => $model->post_date)
							)),
							// Part two - these will change - most recent posts in the same cat
							get_posts(array(
								'numberposts' => 2,
								'category' => $model->category_id,
								'exclude' => array($model->post_id),
								'date_query' => array('after' => $model->post_date)
							))
						);
						?>

						<h2>Discover More <?php echo $model->first_category ?></h2>
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
        "name": "<?php echo $model->user_name ?>",
        "url": "<?php echo $model->user_link ?>"
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
		// The bread crumb position tracker
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
        "name": "<?php echo $model->first_category ?>",
        "item": "<?php echo $model->first_category_link ?>"
      },<?php if ($model->second_category != '') : ?>{
        "@type": "ListItem",
        "position": <?php echo ++$position ?>,
        "name": "<?php echo $model->second_category ?>",
        "item": "<?php echo $model->second_category_link ?>"
      },<?php endif; ?>{
        "@type": "ListItem",
        "position": <?php echo ++$position ?>,
        "name": "<?php echo $model->post_headline ?>",
        "item": "<?php echo $model->post_url ?>"
      }]
    }
    </script>
<?php get_footer(); ?>
