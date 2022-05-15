<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
get_header(); ?>
<!-- *ix* -->
<main>
	<h1 class="hidden">Phonotonal - Latest Articles</h1>
	<?php get_template_part('article', 'index'); ?>
</main>	
<?php get_footer(); ?>