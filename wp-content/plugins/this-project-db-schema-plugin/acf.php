<?php
/**
 |
 | Advanced Custom Fields (ACF)
 |
 |
 */

use ThisProjectDB as This;

/**
 | Customize the location where field group settings will be stored
 |
 */
add_filter( 'acf/settings/save_json', function ( $path ) {
	// Set custom path
	// $path = This\PLUGIN_PATH . '/generated-files/acf';
	// return $path;
	return This\PLUGIN_PATH . '/generated-files/acf';
} );

add_filter( 'acf/settings/load_json', function ( $paths ) {
	// Remove the default path (i.e. `acf-json`)
	unset( $paths[ 0 ] );
	// Set custom path
	$paths[ ] = This\PLUGIN_PATH . '/generated-files/acf';

	return $paths;
} );



/**
 |
 | Prevent storage of ACF field key-value attributes in the database
 | 	(for performance reasons)
 |
 */
add_filter( 'acfcdt/store_acf_field_key_references_in_core_meta', function ( $null, $field, $objectId, $objectType ) {
	// Bypass if the field belongs to the field group "Enquiry"
	if ( $field[ 'parent' ] === 'group_62427b0b19a03' )
		return false;
	return $null;
}, 10, 4 );
add_filter( 'acfcdt/store_acf_field_values_in_core_meta', function ( $null, $field, $objectId, $objectType ) {
	// Bypass if the field belongs to the field group "Enquiry"
	if ( $field[ 'parent' ] === 'group_62427b0b19a03' )
		return false;
	return $null;
}, 10, 4 );
