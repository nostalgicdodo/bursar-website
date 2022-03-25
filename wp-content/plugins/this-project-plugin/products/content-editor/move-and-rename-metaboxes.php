<?php
/*
 |
 | Move the following metaboxes on the Product edit screen
 |   - Product featured image
 |   - Product images
 |
 |
 */

use ThisProject\CMS\WordPress\Utils;



add_action( 'add_meta_boxes', function () use ( $contentTypeSlug ) {

	Utils\moveMetabox( 'postimagediv', $contentTypeSlug, [
		'currentContext' => 'side',
		'context' => 'normal',
		'priority' => 'high',
		'title' => 'Featured image'
	] );

	Utils\moveMetabox( 'woocommerce-product-images', $contentTypeSlug, [
		'currentContext' => 'side',
		'context' => 'normal',
		'priority' => 'high'
	] );

}, 40 );
