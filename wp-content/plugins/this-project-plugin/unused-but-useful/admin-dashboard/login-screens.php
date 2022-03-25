<?php
/**
 |
 | Login Screens *Functional* and *Content* Overrides
 |
 |
 | The native WordPress files that deal with login screens are:
 | /wp-login.php
 | /wp-includes/general-template.php
 |
 */

use const ThisProject\PLUGIN_DOMAIN_SLUG;

/**
 | Login page title
 |
 */
add_filter( 'login_title', function ( $loginTitle, $title ) {
	return $title . ' | ' . get_bloginfo( 'name' );
}, 10, 2 );


/**
 | Logo hyperlink
 |
 | The logo is rendered using an anchor tag with an `href` and text.
 | The following filters allow us to change those values.
 |
 */
add_filter( 'login_headerurl', function () {
	return wp_login_url();
} );
add_filter( 'login_headertext', function () {
	return get_bloginfo( 'name' );
} );


/**
 | Restore the default "Lost Password" URL
 |
 | WooCommerce overrides this from `/wp-login.php?action=lostpassword`
 | 	to `/my-account/lost-password/`
 |
 | We want to keep this override within the context of WooCommerce's login screens
 | i.e. `/my-account`
 | However, when on the default WordPress login screens, i.e. `/wp-login.php`,
 | 	we want to have the default URL, `/wp-login.php?action=lostpassword`
 |
 | The `login_form` action has been found to be triggered only within the context of
 | 	the default WordPress screens. Hence, that's the action we hook into.
 |
 | References:
 | https://wordpress.stackexchange.com/questions/12863/check-if-wp-login-is-current-page
 |
 */
add_action( 'login_form', function () {
	remove_all_filters( 'lostpassword_url' );
} );



add_action( 'login_enqueue_scripts', function () {
	wp_enqueue_style(
		PLUGIN_DOMAIN_SLUG . '-' . 'login-screens',
		plugin_dir_url( __FILE__ ) . 'login-screens.css',
		[ ],
		filemtime( __DIR__ . '/login-screens.css' )
	);
} );
