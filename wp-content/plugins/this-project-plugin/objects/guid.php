<?php

add_action( 'wp_insert_post', function ( $postId, $post, $thisIsAnExistingPost ) {
	if ( $thisIsAnExistingPost )
		return;

	global $wpdb;

	$guid = str_replace(
		home_url(),
		CLIENT_SLUG . ':/',
		get_post_field( 'guid', $post )
	);

	$wpdb->update(
		$wpdb->posts,
		[ 'guid' => $guid ],
		[ 'ID' => $postId ]
	);
}, 1, 3 );
