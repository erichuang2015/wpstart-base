<?php

# # # # # # # # # # # # # # # # # # # #
# GLOBALS ~ * ~ * ~ * ~ * ~ * ~ * ~ * ~
# # # # # # # # # # # # # # # # # # # #

define( 'DIR', get_stylesheet_directory() );
define( 'DIR_URI', get_stylesheet_directory_uri() );
define( 'ENV', 'development' );
$state = []; // global template variables

# # # # # # # # # # # # # # # # # # # #
# INCLUDES ~ * ~ * ~ * ~ * ~ * ~ * ~ * 
# # # # # # # # # # # # # # # # # # # #
require_once( DIR . '/_utilities.php' );

# # # # # # # # # # # # # # # # # # # #
# THEME SETUP ~ * ~ * ~ * ~ * ~ * ~ * ~
# # # # # # # # # # # # # # # # # # # #

// Support Custom Logo
add_theme_support( 'custom-logo' );

// Support Featured Image
add_theme_support( 'post-thumbnails' ); 

// Footer Options Page
acf_add_options_page([
	'page_title' => 'Site Footer',
	'position' => 30
]);

// CSS
function cb_styles () {
	wp_enqueue_style( 'cb-raleway', 'https://fonts.googleapis.com/css?family=Raleway:800' );
	wp_enqueue_style( 'cb-fontawesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css' );
	wp_enqueue_style( 'caa-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
	wp_enqueue_style( 'caa-slick-theme', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css' );
    wp_enqueue_style( 'style', DIR_URI . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'cb_styles' );

// Match TinyMCE editor to front end style
add_editor_style( DIR_URI . '/admin-style.css' );

// Javascript
function cb_scripts () {
	wp_enqueue_script( 'caa-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', [], '1.8.1', true);
	wp_enqueue_script( 'cb-parallax', 'https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js', ['jquery'], '1.5.0', true );
	wp_enqueue_script( 'cb-main', DIR_URI . '/scripts/main-min.js', ['jquery'], '1', true );
}

add_action( 'wp_enqueue_scripts', 'cb_scripts' );

// Remove WordPress emoji because why does it exist in the first place
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Prevent images from being wrapped inside paragraphs
function filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

# # # # # # # # # # # # # # # # # # # #
# PAGE TITLES ~ * ~ * ~ * ~ * ~ * ~ * ~
# # # # # # # # # # # # # # # # # # # #

function custom_page_title () {
    if ( is_front_page() )  return get_bloginfo( 'description' );
    if ( is_home() )        return 'Posts';
    if ( is_archive() )     return 'Archive';
    if ( is_404() )         return 'Error 404 Not Found';
    if ( is_category() )    return 'Category Archive for ' . single_cat_title();
    if ( is_tag() )         return 'Tag Archive for ' . single_tag_title();
    if ( is_search() )      return 'Search Results for ' . esc_html( $_GET['s'] );
    return get_the_title();
}

# # # # # # # # # # # # # # # # # # # #
# MENUS & NAVIGATION ~ * ~ * ~ * ~ * ~
# # # # # # # # # # # # # # # # # # # #

// Create Menus
function cb_register_nav_menus () {
    register_nav_menu( 'primary', 'Site Header');
}

add_action( 'after_setup_theme', 'cb_register_nav_menus' );

# # # # # # # # # # # # # # # # # # # #
# CUSTOM POST TYPES ~ * ~ * ~ * ~ * ~ *
# # # # # # # # # # # # # # # # # # # #

function cb_register_cpt_event() {

	$labels = [
		'name'                  => _x( 'Events', 'Post Type General Name', 'cb' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'cb' ),
		'menu_name'             => __( 'Events', 'cb' ),
		'name_admin_bar'        => __( 'Events', 'cb' ),
		'archives'              => __( 'Event Archives', 'cb' ),
		'attributes'            => __( 'Event Attributes', 'cb' ),
		'parent_item_colon'     => __( 'Parent Event:', 'cb' ),
		'all_items'             => __( 'All Events', 'cb' ),
		'add_new_item'          => __( 'Add New Event', 'cb' ),
		'add_new'               => __( 'Add New', 'cb' ),
		'new_item'              => __( 'New Event', 'cb' ),
		'edit_item'             => __( 'Edit Event', 'cb' ),
		'update_item'           => __( 'Update Event', 'cb' ),
		'view_item'             => __( 'View Event', 'cb' ),
		'view_items'            => __( 'View Events', 'cb' ),
		'search_items'          => __( 'Search Event', 'cb' ),
		'not_found'             => __( 'Not found', 'cb' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'cb' ),
		'featured_image'        => __( 'Featured Image', 'cb' ),
		'set_featured_image'    => __( 'Set featured image', 'cb' ),
		'remove_featured_image' => __( 'Remove featured image', 'cb' ),
		'use_featured_image'    => __( 'Use as featured image', 'cb' ),
		'insert_into_item'      => __( 'Insert into event', 'cb' ),
		'uploaded_to_this_item' => __( 'Uploaded to this event', 'cb' ),
		'items_list'            => __( 'Events list', 'cb' ),
		'items_list_navigation' => __( 'Events list navigation', 'cb' ),
		'filter_items_list'     => __( 'Filter events list', 'cb' ),
	];
	$args = [
		'label'                 => __( 'Event', 'cb' ),
		'labels'                => $labels,
		'supports'              => [ 'title', 'editor' ],
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	];
	register_post_type( 'event', $args );

}

add_action( 'init', 'cb_register_cpt_event', 0 );

# # # # # # # # # # # # # # # # # # # #
# ADMIN AREA ~ * ~ * ~ * ~ * ~ * ~ * ~
# # # # # # # # # # # # # # # # # # # #

function cb_remove_admin_menu_items () {
	remove_menu_page( 'edit.php' );
    remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'cb_remove_admin_menu_items' );

function cb_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'theme_widget',
		'Crowdblink Theme',
		'cb_theme_widget'
	);
}

add_action( 'wp_dashboard_setup', 'cb_add_dashboard_widgets' );

function cb_theme_widget() {
	$theme = wp_get_theme();
	echo "
		<div style='text-align: center;'>
			<img src='".DIR_URI."/images/crowdblink-logo.png' alt='Crowdblink' style='width: 200px; display: block; margin: 0 auto;' />
			<p>v {$theme->get( 'Version' )}</p>
			<h5 style='margin: 0;'><a href='/wp-admin/edit.php?post_type=page'>Edit Pages</a></h5>
			<h5 style='margin: 0;'><a href='/wp-admin/edit.php?post_type=event'>Edit Events</a></h5>
			<h5 style='margin: 0;'><a href='/wp-admin/customize.php?return=%2Fwp-admin%2Findex.php'>Edit Site Header</a></h5>
			<h5 style='margin: 0;'><a href='/wp-admin/admin.php?page=acf-options-site-footer'>Edit Site Footer</a></h5>
		</div>
	";
}