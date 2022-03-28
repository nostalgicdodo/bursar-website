<?php

namespace ThisProject;

define( 'THEME_PATH', get_stylesheet_directory() );
define( 'THEME_URI', get_stylesheet_directory_uri() );



add_action( 'after_setup_theme', function () {
	add_theme_support( 'block-templates' );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'thisproject-style',
		get_stylesheet_uri(),
		[ 'twentytwentytwo-style' ],
		filemtime( THEME_PATH . '/style.css' )
	);
} );

require_once THEME_PATH . '/settings/login-screens.php';
