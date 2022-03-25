<?php

namespace ThisProject\CMS\WordPress;

require_once __DIR__ . '/tenant.php';

use ThisProject\CMS\WordPress\Tenant;
use WP_User;

class User {

	public static function getBy ( $attribute, $value ) {
		return get_user_by( $attribute, $value );
	}

	public static function getTenantOfOrigin ( WP_User $user ) {
		return self::getExtendedAttribute( $user, 'tenant_of_origin', true );
	}

	public static function setTenantOfOrigin ( WP_User $user ) {
		return self::addExtendedAttribute( $user, 'tenant_of_origin', CURRENT_TENANT );
	}

	public static function getExtendedAttribute ( WP_User $user, $key, $oneInstance = false ) {
		return get_user_meta( $user->ID, $key, $oneInstance );
	}

	public static function addExtendedAttribute ( WP_User $user, $key, $value ) {
		return add_user_meta( $user->ID, $key, $value );
	}

	public static function getRoles ( WP_User $user ) {
		return $user->roles;
	}

	public static function getRolesFromTenant ( WP_User $user, $tenantId = null ) {
		return array_keys( get_user_meta(
			$user->ID,
			Tenant::getTablePrefix( $tenantId ) . 'capabilities',
			true
		) );
	}

	public static function addRoles ( WP_User $user, $roles ) {
		if ( is_string( $roles ) )
			$roles = [ $roles ];
		foreach ( $roles as $role )
			$user->add_role( $role );
	}

	/*
	 |
	 | Determine if the given user does not have any access whatsoever on the current tenant
	 |
	 |
	 */
	public static function isAnOrphan ( WP_User $user ) {
		return !user_can( $user->ID, 'read' );
	}

}
