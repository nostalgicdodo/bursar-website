<?php

use ThisProject\CMS\WordPress;

add_action( 'wp_enqueue_scripts', function () {
	WordPress::enqueueStylesheet(
		'thisproject-style',
		'/style.css',
		[ 'twentytwentytwo-style' ]
	);
} );
