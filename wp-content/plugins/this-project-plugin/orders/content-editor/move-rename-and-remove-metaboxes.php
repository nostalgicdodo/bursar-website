<?php
/*
 |
 | Move the following metaboxes on the Product edit screen
 |   - Author
 |
 | Rename the following metaboxes on the Product edit screen
 |   - Author
 |
 | Remove the following metaboxes on the Product edit screen
 |   - Author (for Vendor users only)
 |
 |
 */

use ThisProject\CMS\WordPress\Utils;

add_action( 'add_meta_boxes', function () use ( $contentTypeSlug ) {
	if ( in_array( 'vendor', wp_get_current_user()->roles ) )
		return;

	Utils\moveMetabox( 'authordiv', $contentTypeSlug, [
		'currentContext' => 'normal',
		'context' => 'side',
		'priority' => 'low',
		'title' => '<div>Managed by <small>(vendor)</small></div>'
	] );
}, 40 );

add_action( 'add_meta_boxes', function () use ( $contentTypeSlug ) {
	if ( !in_array( 'vendor', wp_get_current_user()->roles ) )
		return;

	Utils\removeMetabox( 'authordiv', $contentTypeSlug, 'normal' );
}, 40 );
