<?php
/*
 |
 | Products
 |
 |
 */

// This script depends on WooCommerce
if ( ! class_exists( 'WooCommerce', false ) )
	return;


( function () {





/*
 |
 | Content Editing
 |
 |
 */
// Shipping / Billing fields: Hide these for users that are not customers
add_filter( 'woocommerce_customer_meta_fields', function ( $fields ) {
	// Technically, WooCommerce treats all users as "customers"
	// However, for our purposes, only users with the role of "subscriber" are allowed to be customers
		// UPDATE: 18/02/2022: Why are we checking for the `subscriber` role?
	if ( in_array( 'subscriber', wp_get_current_user()->roles ) )
		return $fields;

	unset( $fields[ 'billing' ] );
	unset( $fields[ 'shipping' ] );

	return $fields;
} );





} )();
