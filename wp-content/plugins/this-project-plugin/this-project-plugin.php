<?php
/**
 *
 * Plugin Name: This Project
 * Description: Bespoke features and configurations for this site
 * Version: 1.0.0
 * Author: perl
 * Text Domain: this-project
 *
 *
 */

namespace ThisProject;




/**
 | Constants and References
 |
 */
require_once ABSPATH . 'conf.php';
if ( !defined( '__ROOT__' ) )
	define( '__ROOT__', $_SERVER[ 'DOCUMENT_ROOT' ] );
const PLUGIN_PATH = __DIR__;
const SETTINGS_PATH = PLUGIN_PATH . '/settings';

const PLUGIN_NAME = 'This Project';
const PLUGIN_DOMAIN_SLUG = 'this-project';



// require_once __ROOT__ . '/lib/providers/wordpress.php';
// require_once PLUGIN_PATH . '/lib/hooks.php';
// require_once PLUGIN_PATH . '/lib/utils.php';
// require_once PLUGIN_PATH . '/dependencies.php';

// use \BFS\CMS\WordPress;



function init__AfterOtherPluginsHaveLoaded () {

	require_once PLUGIN_PATH . '/lib/hooks.php';



	require_once PLUGIN_PATH . '/routing/robots.txt.php';
	require_once PLUGIN_PATH . '/routing/url-auto-correction.php';


	// Gutenberg Block editor settings
	// require_once SETTINGS_PATH . '/gutenberg-block-editor.php';
	// Admin dashboard settings
	// require_once SETTINGS_PATH . '/admin-dashboard/settings-options-page.php';

}





add_action( 'plugins_loaded', __NAMESPACE__ . '\\' . 'init__AfterOtherPluginsHaveLoaded', 10, 2 );



/**
 | General Internals
 |
 */
require_once PLUGIN_PATH . '/lib/frontend-includes.php';
require_once PLUGIN_PATH . '/routing/transform-page-routes-to-api-routes.php';
require_once PLUGIN_PATH . '/objects/guid.php';
require_once PLUGIN_PATH . '/users/user-url.php';




/**
 | RSS Feeds
 |
 */
require_once PLUGIN_PATH . '/rss/disable-rss-feeds.php';



/**
 | Plugin Overrides / Patches
 |
 */
// require_once PLUGIN_PATH . '/plugins/plugin-slug.php';



/**
 | Admin Dashboard
 |
 */
require_once PLUGIN_PATH . '/admin-dashboard/unhide-reusable-blocks-post-type.php';
