<?php

if ( ! have_posts() )
	die( json_encode( [ ] ) );

$thePosts = &$GLOBALS[ 'wp_the_query' ]->posts;
foreach ( $thePosts as &$object ) {
	// Refer to these documentation pages for the full picture on how to process a post's content
	// https://developer.wordpress.org/reference/functions/the_content/
	// https://developer.wordpress.org/reference/functions/get_the_content/
	$object->post_content = apply_filters( 'the_content', $object->post_content );
}
echo json_encode( $thePosts );
