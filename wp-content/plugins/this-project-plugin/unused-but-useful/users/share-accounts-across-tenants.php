<?php
/**
 |
 | When a user logs in to a tenant for *the first time*,
 | 	but is already registered on another tenant,
 | 	then adopt them (i.e. assign them a role of "Customer").
 |
 | This is so that the user can use the website as usual,
 | 	which otherwise wouldn't be the case.
 |
 */

namespace ThisProject\CMS\WordPress;

use const ThisProject\PLUGIN_PATH;

require_once PLUGIN_PATH . '/lib/user.php';

use ThisProject\CMS\WordPress\User;





add_action( 'wp_login', function ( $login ) {

	$user = User::getBy( 'login', $login );
	if ( !User::isAnOrphan( $user ) )
		return;

	User::addRoles( $user, 'customer' );

	// NOTE: The following code is when you want to selectively adopt users, and perform some level of role synchronization
		// Move these declarations outside the function
		// const ROLES_PERMITTED_FOR_ADOPTION = [ 'customer', 'subscriber', 'contributor' ];
		// const ROLES_TO_ASSIGN = [
		// 	'customer' => 'customer',
		// 	'subscriber' => 'subscriber',
		// 	'contributor' => 'contributor'
		// ];
	// $userTenantOfOrigin = User::getTenantOfOrigin( $user );
	// $userRoles = User::getRolesFromTenant( $user, $userTenantOfOrigin );
	// if ( empty( array_intersect( ROLES_PERMITTED_FOR_ADOPTION, $userRoles ) ) )
	// 	return;
	// foreach ( ROLES_PERMITTED_FOR_ADOPTION as $role ) {
	// 	if ( in_array( $role, $userRoles ) )
	// 		User::addRoles( $user, ROLES_TO_ASSIGN[ $role ] );
	// }

} );
