<?php
/*
 |
 | Capture the "brand" value as a taxonomy term on the post, and *not* as an ACF post meta value,
 | 	and record the time of creation
 |
 |
 */

use const ThisProject\PLUGIN_DOMAIN_SLUG;

// Capture the "brand" value as a taxonomy term on the post, but *not* as an ACF post meta value
add_action( PLUGIN_DOMAIN_SLUG . '/backend/on-screen', function ( $screenId, $screenSlug, $screenPostType ) {
	if ( $screenId !== 'product' )
		return;

	add_filter( 'acf/pre_update_value', function ( $null, $value, $postId, $field ) {
		if ( $field[ 'name' ] === 'brand' ) {
			// Set the term to the post
			wp_set_object_terms( $postId, intval( $value ), $field[ 'taxonomy' ], false );
			// Short-circuit the persisting of the value to as an ACF post meta entry
			return true;
		}
		// For all other ACF fields, permit their values to be updated
		return null;
	}, 10, 4 );
}, 10, 3 );

// Set the creation timestamp for a Product Brand term as it is created
add_action( 'create_product_brand', function ( $termId ) {
	update_field(
		'created_on_utc',
		time(),
		'product_brand' . '_' . $termId
	);
} );
// If the "Product Brand" term creation timestamp is set manually, format it as a number
add_filter( 'acf/update_value/name=created_on_utc', function ( $value, $postId, $field, $originalValue ) {
	// If the value was auto-generated (through code) on term creation,
	//  	then it already is in the right format,
	//  	simply return it
	if ( is_numeric( $originalValue ) )
		return $originalValue;

	$dateTime = \DateTime::createFromFormat( 'Y-m-d H:i:s', $originalValue, wp_timezone() );
	$unixTimestamp = $dateTime !== false
				? $dateTime->setTimezone( new \DateTimeZone( 'UTC' ) )->format( 'U' )
				: '';

	return $unixTimestamp;
}, 10, 4 );
// When loading the value, re-format it to be human-readable
add_filter( 'acf/load_value/name=created_on_utc', function ( $value, $postId, $field ) {
	$dateTime_FormattedToTimezone = wp_date( 'Y-m-d H:i:s', $value );
	return $dateTime_FormattedToTimezone ?: '';
}, 10, 3 );
add_filter( 'acf/load_field/name=created_on_utc', function ( $field ) {
	$field[ 'disabled' ] = true;
	return $field;
}, 10, 1 );
// add_filter( 'acf/format_value/name=created_on_utc', function ( $value, $postId, $field ) {
// 	if ( ! is_numeric( $value ) )
// 		return $value;
// 	$dateTime_FormattedToTimezone = wp_date( 'Y-m-d H:i:s', $value );
// 	return $dateTime_FormattedToTimezone ?: '';
// }, 10, 3 );
