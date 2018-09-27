<?php 

global $state;

$state['page_title'] = custom_page_title();

// logo
$logo_ID = get_theme_mod( 'custom_logo' );
$state['logo'] = wp_get_attachment_image_src( $logo_ID, 'full' );

// menu
$locations = get_nav_menu_locations();
$menu_term = get_term( $locations['primary'], 'nav_menu' );
$state['menu'] = wp_get_nav_menu_items( $menu_term->term_id, ['order' => 'DESC'] );

render_view( 'head' );