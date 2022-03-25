<?php
/**
 |
 | On registration, capture a user's tenant of origin
 | 	( in a `tenant_of_origin` meta field )
 |
 |
 */

namespace ThisProject\CMS\WordPress;

use const ThisProject\PLUGIN_PATH;

require_once PLUGIN_PATH . '/lib/user.php';

use ThisProject\CMS\WordPress\User;





add_action( 'user_register', function ( $userId, $userData ) {
	User::setTenantOfOrigin( User::getBy( 'id', $userId ) );
}, 10, 2 );
