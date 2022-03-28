<?php

add_action( 'do_feed', 'redirectToHome', 1 );
add_action( 'do_feed_rdf', 'redirectToHome', 1 );
add_action( 'do_feed_rss', 'redirectToHome', 1 );
add_action( 'do_feed_rss2', 'redirectToHome', 1 );
add_action( 'do_feed_atom', 'redirectToHome', 1 );
add_action( 'do_feed_rss2_comments', 'redirectToHome', 1 );
add_action( 'do_feed_atom_comments', 'redirectToHome', 1 );

function redirectToHome () {
	wp_redirect( home_url( '/' ), 302, '' );
}
