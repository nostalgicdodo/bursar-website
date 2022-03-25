<?php
/*
 |
 | Add a column that displays the "Vendor" value for an order
 |   (this field is simply an alias to the `author` attribute)
 |
 |
 */

add_filter( 'manage_edit-' . $contentTypeSlug . '_columns', function ( $columns ) {
	if ( in_array( 'vendor', wp_get_current_user()->roles ) ) {
		unset( $columns[ 'author' ] );
		return $columns;
	}

		// Here, we're just re-naming the `author` column
			// which also implicitly causes the column to be shown
	$columns[ 'author' ] = __( 'Managed by' );
	return $columns;
} );
