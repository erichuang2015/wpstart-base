<?php // Home Page

$today = date('Y-m-d H:i:s', strtotime('now'));

$events_query = new WP_Query([
	'post_type' => 'event',
	'posts_per_page' => 6,
	'meta_key' => 'event_start_date',
	'orderby' => 'meta_value_num',
	'order' => 'ASC'
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

render_template('page-home');