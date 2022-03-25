<?php
/*
 |
 | Products
 |
 |
 */




// This script depends on WooCommerce
// if ( ! class_exists( 'WooCommerce', false ) )
// 	return;

// add_action( 'woocommerce_loaded', function () {
add_action( 'woocommerce_init', function () {





$contentTypeSlug = 'product';



/*
 |
 | Fields / Attributes
 |
 |
 */
require_once __DIR__ . '/fields/add-support-for-authorship.php';



/*
 |
 | Content Editing
 |
 |
 */
require_once __DIR__ . '/content-editor/add-heading-for-the-product-description-field.php';
require_once __DIR__ . '/content-editor/move-and-rename-metaboxes.php';
// require_once __DIR__ . '/content-editor/product-brand-taxonomy-metabox.php';





} );
