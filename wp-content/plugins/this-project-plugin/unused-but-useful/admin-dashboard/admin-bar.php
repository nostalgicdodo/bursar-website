<?php
/**
 |
 | Admin Bar Welcome Message
 |
 | Make it so: Hello, {{first name}} {{last name}}
 |
 | Reference:
 | /wp-includes/admin-bar.php
 |
 */

add_action( 'admin_bar_menu', function ( \WP_Admin_Bar $wp_admin_bar ) {
	$userId = get_current_user_id();
	$currentUser = wp_get_current_user();

	if ( ! $userId )
		return;

	$nameOfUser = '';
	if ( ! empty( $currentUser->first_name ) )
		$nameOfUser .= $currentUser->first_name;
	if ( ! empty( $currentUser->last_name ) )
		if ( ! empty( $currentUser->first_name ) )
			$nameOfUser .= ' ' . $currentUser->last_name;
		else
			$nameOfUser .= $currentUser->last_name;
	if ( empty( $currentUser->first_name ) and empty( $currentUser->last_name ) )
		$nameOfUser = $currentUser->display_name;

	/* translators: %s: Current user's display name. */
	$welcomeMessage = sprintf( __( 'Hello, %s' ), '<span class="display-name">' . $nameOfUser . '</span>' );

	$avatar = get_avatar( $userId, 26 );
	$class = empty( $avatar ) ? '' : 'with-avatar';

	// We're adding a node with the same ID; this effectively merges the new values over the existing ones
	$wp_admin_bar->add_node( [
		'id' => 'my-account',
		'title' => $welcomeMessage . $avatar
	] );
}, 10 );
