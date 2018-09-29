<?php // Search Results

$today = date('F j, Y', strtotime('now'));

$events_query = new WP_Query([
	'post_type' => 'event',
	'posts_per_page' => -1,
	's' => $_GET['s'],
	'meta_key' => 'event_start_date',
	'orderby' => 'meta_value_num',
	// 'meta_query' => [
	// 	'relation' => 'AND',
	// 	[
	// 		'relation' => 'OR',
	// 		[
	// 			'key' => 'display_start',
	// 			'compare' => 'NOT EXISTS'
	// 		],
	// 		[
	// 			'key' => 'display_start',
	// 			'value' => $today,
	// 			'compare' => '>='
	// 		]
	// 	],
	// 	[
	// 		'relation' => 'OR',
	// 		[
	// 			'key' => 'display_end',
	// 			'compare' => 'NOT EXISTS'
	// 		],
	// 		[
	// 			'key' => 'display_end',
	// 			'value' => $today,
	// 			'compare' => '<'
	// 		]
	// 	]
	// ]
]);

$state['events'] = array_map(function ($event) {
	$event = Timber::get_post($event);
	return $event;
}, $events_query->posts);

render_template( 'template-search' );