<?php
/**
 |
 | Notices
 |
 |
 */

/**
 | For users who cannot update WordPress,
 | 	remove the WordPress core update notice that shows up whenever a newer version is available
 |
 | References:
 | /wp-admin/includes/admin-filters.php
 | /wp-admin/includes/update.php
 |
 */
add_action( 'admin_head', function () {
	if ( ! current_user_can( 'do_devops' ) )
		return;

	remove_action( 'admin_notices', 'update_nag', 3 );
	remove_action( 'admin_notices', 'maintenance_nag', 10 );
} );
