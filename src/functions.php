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

function fenton_scripts()  { 
	// get the theme directory style.css and link to it in the header
	wp_enqueue_style('fenton-style', get_template_directory_uri() . '/style.css', '10000', null);

	// add theme scripts
	wp_enqueue_script('fenton-script', get_template_directory_uri() . '/scripts/fenton.js', array(), null, true );
}
add_action('wp_enqueue_scripts', 'fenton_scripts'); // Register this fxn and allow Wordpress to call it automatcally in the header

function my_theme_add_editor_styles() {
    add_editor_style('style.css');
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

function remove_image_size_attributes($image) {
    return preg_replace( '/(width|height)="\d*"\s/', '', $image);
}
add_filter('post_thumbnail_html', 'remove_image_size_attributes', 10);
add_filter('image_send_to_editor', 'remove_image_size_attributes', 10);

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles'); 

function deregister_scripts() {
	wp_deregister_script('jquery');
	wp_dequeue_style('wp-block-library-css');
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'deregister_scripts');