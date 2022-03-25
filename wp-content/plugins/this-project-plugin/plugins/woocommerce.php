<?php
/**
 |
 | Patches
 | for WooCommerce
 |
 | Reference:
 | /woocommerce/includes/class-wc-ajax.php
 |
 */

namespace ThisProject\Patches;

/**
 | Change the AJAX endpoint so that it does not get intercepted by our custom routing layer
 |
 */
add_filter( 'woocommerce_ajax_get_endpoint', function ( $ajaxEndpoint, $action ) {
	return site_url( '/api/ajax?wc-ajax=', 'relative' ) . $action;
}, 10, 2 );
