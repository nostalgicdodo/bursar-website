<?php
/**
 |
 | Custom hooks
 |
 |
 */

use const ThisProject\PLUGIN_DOMAIN_SLUG;





add_action( 'init', function () {

	if ( is_admin() or is_customize_preview() )
		do_action( PLUGIN_DOMAIN_SLUG . '/init/backend' );
	else
		do_action( PLUGIN_DOMAIN_SLUG . '/init/frontend' );

} );

add_action( 'admin_enqueue_scripts', function () {
	$screen = get_current_screen();
	if ( empty( $screen ) )
		return;

	$screenId = $screen->id;
	$screenSlug = $screen->base ?? null;
	$screenPostType = $screen->post_type ?? null;

	/*
	 | This hook will return the current screen on the WordPress backend
	 | Some examples,
	 | - `dashboard`
	 | - `page` (when editing a "page" post)
	 | - `edit-page` (when viewing the "page" listing)
	 */
	do_action( PLUGIN_DOMAIN_SLUG . '/backend/on-screen', $screenId, $screenSlug, $screenPostType );
} );
