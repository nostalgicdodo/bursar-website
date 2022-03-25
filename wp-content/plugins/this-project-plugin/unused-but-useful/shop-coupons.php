<?php
/*
 |
 | Shop Coupons
 |
 |
 */

// This script depends on WooCommerce
if ( ! class_exists( 'WooCommerce', false ) )
	return;


( function () {





$contentTypeSlug = 'shop_coupon';

/*
 |
 | Fields / Attributes
 |
 |
 */
// Author: Add support for this attribute
add_action( 'init', function () use ( $contentTypeSlug ) {
	add_post_type_support( $contentTypeSlug, 'author' );
} );

/*
 |
 | Listing
 |
 |
 */
// Vendor: Add a column that displays this field
//   (this field is simply an alias to the `author` attribute)
add_filter( 'manage_edit-' . $contentTypeSlug . '_columns', function ( $columns ) {
	$columns[ 'vendor' ] = __( 'Vendor' );
	return $columns;
} );
add_action( 'manage_' . $contentTypeSlug . '_posts_custom_column', function ( $columnName, $postId ) {
	if ( $columnName === 'vendor' )
		echo get_the_author_meta( 'display_name', get_post_field( 'post_author', $postId ) );
}, 10, 2 );

/*
 |
 | Content Editing
 |
 |
 */
// Author metabox: Hide this for certain user roles
add_action( 'do_meta_boxes', function () use ( $contentTypeSlug ) {
	if ( !in_array( 'vendor', wp_get_current_user()->roles ) )
		return;

	remove_meta_box( 'authordiv', $contentTypeSlug, 'normal' );
} );





} )();
