<?php

namespace ThisProject\CMS\WordPress;

class Tenant {

	public static function getTablePrefix ( $tenant = DEFAULT_TENANT ) {
		if ( !is_string( $tenant ) or strlen( $tenant ) === 0 )
			$tenant = DEFAULT_TENANT;

		return CMS_WP_DB_TABLE_PREFIX . '_' . $tenant . '_';
	}

}
