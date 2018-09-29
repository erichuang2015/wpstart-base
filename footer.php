<?php 

global $state;

$state['footer_logo'] = get_field( 'footer_logo', 'option' );

$state['apps'] = get_field( 'apps', 'option' );

$state['features'] = get_field( 'feature_list', 'option' );

render_view( 'site-footer' );