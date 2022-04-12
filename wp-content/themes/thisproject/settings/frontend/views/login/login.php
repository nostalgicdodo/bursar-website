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

use ThisProject\CMS\WordPress;

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
	WordPress::enqueueStylesheet(
		'login',
		'/settings/frontend/views/login/login.css',
	);
	WordPress::enqueueInlineStylesheet( ':root { --image-logo: url( "' . THEME_URI . '/media/logos/logo-bursar-dark.svg" ); }' );
	WordPress::enqueueInlineStylesheet( ':root { --bg-image-small-breakpoint: url( "' . THEME_URI . '/media/backgrounds/layered-waves-vertically-stacked.svg" ); }' );
	WordPress::enqueueInlineStylesheet( ':root { --bg-image-large-breakpoint: url( "' . THEME_URI . '/media/backgrounds/layered-waves-horizontally-stacked.svg" ); }' );
} );
// Style overrides for when the login dialog is loaded as a modal on the backend
add_action( 'admin_enqueue_scripts', function ( $hook ) {
	WordPress::enqueueStylesheet(
		'login-screen-within-iframe-context',
		'/settings/frontend/views/login/login-screen-within-iframe-context.css',
		[ 'wp-auth-check' ]
	);
} );
