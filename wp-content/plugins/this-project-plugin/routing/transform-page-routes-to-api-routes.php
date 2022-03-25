<?php
/**
 |
 | Augment the default template routing logic
 | 	to return structured content (in JSON),
 | 	as opposed to the default rendered HTML.
 |
 | This is only in effect when the requests are from the proxy server.
 | 	In this scenario, WordPress is solely playing the role of a headless CMS.
 |
 | References:
 | wp-includes/template-loader.php
 | wp-includes/template.php
 |
 */

if ( get_stylesheet() !== 'thisproject' )
	return;

if ( ( $_SERVER[ 'HTTP_X_USER_AGENT' ] ?? '' ) !== 'the proxy' )
	return;

add_action( 'template_redirect', function () {
	locate_template( 'api-response.php', true );
	exit;
} );
