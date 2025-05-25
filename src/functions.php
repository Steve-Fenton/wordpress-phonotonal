<?php
	/*-----------------------------------------------------------------------------------*/
	/* This file will be referenced every time a template/page loads on your Wordpress site
	/* This is the place to define custom fxns and specialty code
	/*-----------------------------------------------------------------------------------*/

// Define the version so we can easily replace it throughout the theme
define('FENTON_VERSION', 2.0);
header_remove("x-powered-by");

/*-----------------------------------------------------------------------------------*/
/* Add Rss feed support to Head section
/*-----------------------------------------------------------------------------------*/
add_theme_support('automatic-feed-links');

/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
function register_navigation_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' )
		)
	);
}
add_action( 'init', 'register_navigation_menus' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function fenton_remove_type_attribute($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}

add_filter('style_loader_tag', 'fenton_remove_type_attribute', 10, 2);
add_filter('script_loader_tag', 'fenton_remove_type_attribute', 10, 2);

function deregister_scripts() {
    global $wp_scripts, $wp_styles;

    foreach($wp_scripts->registered as $registered)
        if(strpos($registered->src,'/wp-admin/')===FALSE)
            wp_deregister_script($registered->handle);

    foreach($wp_styles->registered as $registered)
        if(strpos($registered->src,'/wp-admin/')===FALSE)
            wp_deregister_style($registered->handle);

	// get the theme directory style.css and link to it in the header
	wp_enqueue_style('fenton-style', get_template_directory_uri() . '/style.css', '10000', null);

	// add theme scripts
	wp_enqueue_script('fenton-script', get_template_directory_uri() . '/scripts/fenton.js', array(), null, true );
}
add_action('wp_enqueue_scripts', 'deregister_scripts');

function my_theme_add_editor_styles() {
    add_editor_style(get_template_directory_uri() . 'style.css');
}
add_action('admin_init', 'my_theme_add_editor_styles');

function fenton_remove_toolbar_nodes($wp_admin_bar) {
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('comments');
	$wp_admin_bar->remove_node('customize');
    $wp_admin_bar->remove_node('customize-background');
    $wp_admin_bar->remove_node('customize-header');
}
add_action('admin_bar_menu', 'fenton_remove_toolbar_nodes', 999);

function custom_theme_setup() {
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'custom_theme_setup');

function fenton_change_author_role(){
    global $wp_roles;
    $wp_roles->remove_cap( 'author', 'delete_posts' );
    $wp_roles->remove_cap( 'author', 'delete_published_posts' );
 
}
add_action('init', 'fenton_change_author_role');

// Remove block class from headings
function remove_wp_block_heading_class_from_headings($content) {
    // Use regular expression to find and remove the class="wp-block-heading" from h1 to h6 tags
    $pattern = '/<(h[1-6])\s+class="wp-block-heading"(.*?)>/i';
    $replacement = '<$1$2>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

// Add the filter to 'the_content' hook
add_filter('the_content', 'remove_wp_block_heading_class_from_headings');

// Adds IDs to headings
function auto_id_headings( $content ) {

	$content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) {
		if ( ! stripos( $matches[0], 'id=' ) ) :
			$matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );

    return $content;

}
add_filter('the_content', 'auto_id_headings');

// Add Image to RSS
function fenton_rss_post_thumbnail( $content ) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ) {
		$content = '<p>' . get_the_post_thumbnail($post->ID, 'thumbnail') . '</p>' . $content;
	}

	return $content;
}

function fenton_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'fenton_custom_excerpt_length', 22 );

add_filter( 'the_excerpt_rss', 'fenton_rss_post_thumbnail' );
add_filter( 'the_content_feed', 'fenton_rss_post_thumbnail' );

// Utility Functions (Used in Templates)

function fenton_split_title($title) {
	// This lets us split the title by the dash
	// so we can display the first part differently to the second part
	$parts = explode('&#8211;', $title);

	if (count($parts) == 2) {
		$expected_name = trim($parts[0]);
		$title = $parts[0] . '<br /><em>' . $parts[1] . '</em>';
	}

	return $title;
}

function fenton_creator_name($title) {
	// Get's the creator name from the title, this lets us
	// filter the tags when we want to show articles related to
	// the same creator (i.e. band or writer)
	$expected_name = '';
	$parts = explode('&#8211;', $title);

	if (count($parts) == 2) {
		$expected_name = trim($parts[0]);
	}

	return $expected_name;
}

function fenton_cat_sort($a, $b) {
	if ($a->parent == $b->parent) {
		return 0;
	}
	return ($a->parent < $b->parent) ? -1 : 1;
}

function fenton_get_text_tags($tags) {
	// Gets simple text tags for use in structured data
	$text_tags = [];
	if ($tags) {
		foreach ($tags as $tag) {
			$text_tags[] = $tag->name;
		}
	}
	return $text_tags;
}

// Dynamic Object

class dynamic {
    public function __construct(array $args = array()) {
        if (!empty($args)) {
            foreach ($args as $property => $argument) {
                $this->{$property} = $argument;
            }
        }
    }

    public function __call($method, $args) {
		// Note: method argument 0 will always referred to the main class ($this).
        $args = array_merge(array("dynamic" => $this), $args);
        if (isset($this->{$method}) && is_callable($this->{$method})) {
            return call_user_func_array($this->{$method}, $args);
        } else {
            throw new Exception("Fatal error: Call to undefined method dynamic::{$method}()");
        }
    }
}
