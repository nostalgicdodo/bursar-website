<?php
/*
 |
 | Add support for the `Author` attribute,
 |   thereby, introducing the notion of an order being "authored"
 |
 |
 */

add_action( 'init', function () use ( $contentTypeSlug ) {
	add_post_type_support( $contentTypeSlug, 'author' );
} );
