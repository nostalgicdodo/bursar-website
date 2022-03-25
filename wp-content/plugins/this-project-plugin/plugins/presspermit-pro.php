<?php
/**
 |
 | Patches
 | for PublishPress Permissions Pro
 |
 |
 */

namespace ThisProject\Patches;

require_once __ROOT__ . '/lib/providers/wordpress.php';



/**
 | For users who do not have the "DevOps" capability,
 |   hide the message after the table that goes like:
 |        Listed permissions are those assigned for the "<Post type>" type. You can also define universal permissions which apply to all related post types.
 |
 | References:
 | /presspermit-pro/vendor/publishpress/publishpress-permissions/classes/PublishPress/Permissions/UI/Dashboard/TermsListing.php
 | /presspermit-pro/vendor/publishpress/publishpress-permissions/classes/PublishPress/Permissions/UI/Dashboard/DashboardFilters.php
 |
 */
add_action( 'presspermit_admin_ui', function () {
	if ( current_user_can( 'do_devops' ) )
		return;

	$taxonomy = sanitize_key( $_REQUEST[ 'taxonomy' ] ?? '' );
	if ( empty( $taxonomy ) )
		return;

	\BFS\CMS\WordPress::removeHook(
		'after-' . $taxonomy . '-table',
		[
			// 'PublishPress\Permissions\UI\Dashboard\TermsListing',
			\PublishPress\Permissions\UI\Dashboard\TermsListing::class,
			'actShowNotes'
		]
	);
} );



/**
 | When the "Compatibility" module is enabled, errors are thrown when viewing the product archive pages
 | Anyway, the module has since been disabled.
 |
 */
// \BFS\CMS\WordPress::removeHook( 'woocommerce_product_is_visible', [ PublishPress\Permissions\Compat\WooCommerce::class, 'woo_visibility_fix' ] );
// \BFS\CMS\WordPress::removeHook( 'woocommerce_is_purchasable', [ PublishPress\Permissions\Compat\WooCommerce::class, 'woo_visibility_fix' ] );
