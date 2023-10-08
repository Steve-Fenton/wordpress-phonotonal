<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header();
$args = array(
    'taxonomy'      => array( 'post_tag' ), // taxonomy name
    'orderby'       => 'id', 
    'order'         => 'ASC',
    'hide_empty'    => true,
    'fields'        => 'all',
    'name__like'    => $_GET['s']
); 

$terms = get_terms( $args );
$count = count($terms);
?>
<!-- *ix* -->
<main>
	<h1 class="hidden">Phonotonal - Search Results</h1>
	<div class="tags">
		<?php
		if($count > 0){
			foreach ($terms as $term) {
				echo '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a> ';
			}
		}
		?>
	</div>
	<?php get_template_part('article', 'index'); ?>
</main>	
<?php get_footer(); ?>