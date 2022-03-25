<?php

/*
 |
 | Register a global settings / options / meta-data page
 |
 */
if ( ! function_exists( 'acf_add_options_page' ) )
	return;

// Only reveal this menu to users with the administrator role
if ( is_user_logged_in() and !in_array( 'administrator', wp_get_current_user()->roles ) )
	return;

acf_add_options_page( [
	'page_title' => 'Metadata',
	'menu_title' => 'Metadata',
	'menu_slug' => 'metadata',
	'capability' => 'edit_posts',
	'parent_slug' => '',
	'position' => '5',
	'icon_url' => 'dashicons-info'
] );
