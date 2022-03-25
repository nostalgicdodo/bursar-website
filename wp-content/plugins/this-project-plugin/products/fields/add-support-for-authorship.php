<?php
/*
 |
 | Add support for the `Author` attribute,
 |   thereby, introducing the notion of a product being "authored"
 |
 |
 */

add_action( 'init', function () use ( $contentTypeSlug ) {
	add_post_type_support( $contentTypeSlug, 'author' );
} );
