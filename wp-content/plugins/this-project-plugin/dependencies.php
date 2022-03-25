<?php
/**
 |
 | JavaScript and CSS files used across the CMS backend
 |
 |
 */

use const ThisProject\PLUGIN_PATH;
use const ThisProject\PLUGIN_DOMAIN_SLUG;

/**
 | Set initial data for use within JavaScript's domain
 |
 */
add_action( 'admin_enqueue_scripts', function () {
	// The `wp_add_inline_script` function (used below) only works when attached to an existing script that has been queued. Hence, a `stub.js` file has been created solely for this purpose.
	\BFS\CMS\WordPress::enqueueScript( 'stub', '/lib/stub.js', PLUGIN_PATH );
	\BFS\CMS\WordPress::setJavascriptContextData( 'ajaxURL', admin_url( 'admin-ajax.php' ) );
	$javascriptCode = ''
		. 'window.__THIS = window.__THIS || { };'
		. 'window.__THIS.context = window.__THIS.context || { };'
		. 'window.__THIS.context = ' . json_encode( \BFS\CMS\WordPress::getJavascriptData() ) . ';'
	;
	wp_add_inline_script(
		CLIENT_SLUG . '-' . 'stub',
		$javascriptCode,
		'before'
	);
}, 91 );

/**
 | Additional scripts and stylesheets that are used in various places on the backend
 |
 */
add_action( 'admin_enqueue_scripts', function () {
	$javascriptFiles = [
		'utils-http' => '/js/modules/http'
	];
	foreach ( $javascriptFiles as $name => $path )
		\BFS\CMS\WordPress::enqueueScript( $name, $path . '.js' );
}, 99 );
