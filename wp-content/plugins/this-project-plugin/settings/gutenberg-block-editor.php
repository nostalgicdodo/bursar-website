<?php

use ThisProject as This;

/*
 |
 | General Block settings
 |
 */
add_action( 'enqueue_block_editor_assets', function () {
	wp_enqueue_script(
		PLUGIN_DOMAIN_SLUG . '-' . 'gutenberg-script',
		This\PLUGIN_PATH . '/js/blocks.js',
		[ 'wp-dom-ready', 'wp-blocks', 'wp-edit-post' ],
		filemtime( This\PLUGIN_PATH . '/js/blocks.js' )
	);
} );
