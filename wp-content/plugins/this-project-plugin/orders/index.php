<?php
/*
 |
 | Orders
 |
 |
 */




// This script depends on WooCommerce
// if ( ! class_exists( 'WooCommerce', false ) )
// 	return;

add_action( 'woocommerce_init', function () {





$contentTypeSlug = 'shop_order';



/*
 |
 | Fields / Attributes
 |
 |
 */
require_once __DIR__ . '/fields/add-support-for-authorship.php';



/*
 |
 | Listings
 |
 |
 */
require_once __DIR__ . '/listings/add-vendor-attribute-to-order-listing.php';



/*
 |
 | Content Editing
 |
 |
 */
require_once __DIR__ . '/content-editor/move-rename-and-remove-metaboxes.php';





} );
