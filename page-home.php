<?php // Home Page

$today = date('F j, Y', strtotime('now'));

$events_query = new WP_Query([
	'post_type' => 'event',
	'posts_per_page' => 6,
	'meta_query' => [
		'relation' => 'AND',
		[
			'relation' => 'OR',
			[
				'key' => 'display_start',
				'compare' => 'NOT EXISTS'
			],
			[
				'key' => 'display_start',
				'value' => $today,
				'compare' => '>='
			]
		],
		[
			'relation' => 'OR',
			[
				'key' => 'display_end',
				'compare' => 'NOT EXISTS'
			],
			[
				'key' => 'display_end',
				'value' => $today,
				'compare' => '<'
			]
		]
	]
]);

$state['events'] = $events_query->posts;

render_template('page-home');