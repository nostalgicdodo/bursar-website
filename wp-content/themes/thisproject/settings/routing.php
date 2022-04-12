<?php

/**
 |
 | API endpoints
 | 	Any file in the `/api` directory is registered as a route
 |
 |
 */
add_action( 'rest_api_init', function () {
	require_once ABSPATH . '/wp-admin/includes/file.php';
	foreach ( list_files( THEME_PATH . '/api' ) as $file ) {
		if ( strpos( basename( $file ), '_' ) === 0 )
			continue;
		require_once $file;
	}
} );
