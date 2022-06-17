<?php
/**
 * The template for displaying category index pages.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header(); 

$cat = get_queried_object();
$args = array('orderby' => 'name', 'parent' => $cat->term_id);
$categories = get_categories( $args );
?>
<!-- *cat* -->
	<div class="constrain-more">
		<h1><?php single_cat_title(); ?></h1>
		<?php if (count($categories) > 0) : ?>
		<ul class="sub-cat">
			<?php
				foreach ( $categories as $category ) {
					echo '<li><a href="' . get_category_link( $category->term_id ) . '" class="button">' . $category->name . '</a></li>';
				}
			?>
		</ul>
		<?php endif; ?>
		<p>You can subscribe to the <a href="/section/<?php echo $cat->slug ?>/feed"><?php echo $cat->name ?> category micro-feed</a>.</p>
		<div>
			<?php echo str_replace('<br />', '<br /><br />', category_description($cat)) ?>
		</div>
	</div>
	<main>
		<?php get_template_part('article', 'index'); ?>
	</main>
<?php get_footer(); ?>