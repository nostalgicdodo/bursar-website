<?php
/**
 |
 | Patches
 | for TaxoPress
 |
 |
 | Reference:
 | /wp-content/plugins/simple-tags/review-request/review.php
 |
 */

namespace ThisProject\Patches;

require_once __ROOT__ . '/lib/providers/wordpress.php';

// Remove the notice/prompt that requests us to rate the plugin
\BFS\CMS\WordPress::removeHook( 'init', [ 'Taxopress_Modules_Reviews', 'hooks' ] );

// Other potential solutions (these don't work though, they require refinement)
// remove_action( 'admin_notices', [ 'Taxopress_Modules_Reviews', 'admin_notices' ] );
// remove_action( 'network_admin_notices', [ 'Taxopress_Modules_Reviews', 'admin_notices' ] );
// remove_action( 'user_admin_notices', [ 'Taxopress_Modules_Reviews', 'admin_notices' ] );
