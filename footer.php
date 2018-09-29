<?php 

global $state;

// debugger
if ( ENV === 'development' ) { 
    ob_start(); debugger(); 
    $state['debugger'] = ob_get_clean();
}

$state['footer_logo'] = get_field( 'footer_logo', 'option' );

$state['apps'] = get_field( 'apps', 'option' );

$state['features'] = get_field( 'feature_list', 'option' );

render_view( 'site-footer' );