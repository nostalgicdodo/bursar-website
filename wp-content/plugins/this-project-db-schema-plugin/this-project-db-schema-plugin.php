<?php
/**
 *
 * Plugin Name: This Project Database Schema
 * Description: Bespoke database schema for this site
 * Version: 1.0.0
 * Author: perl
 * Text Domain: this-project
 *
 *
 */

namespace ThisProjectDB;




/**
 | Constants and References
 |
 */
require_once ABSPATH . 'conf.php';
if ( !defined( '__ROOT__' ) )
	define( '__ROOT__', $_SERVER[ 'DOCUMENT_ROOT' ] );
const PLUGIN_PATH = __DIR__;

const PLUGIN_NAME = 'This Project Database Schema';
const PLUGIN_DOMAIN_SLUG = 'this-project';





function init__AfterOtherPluginsHaveLoaded () {

	/**
	 | Advanced Custom Fields (ACF)
	 |
	 */
	require_once PLUGIN_PATH . '/acf.php';

}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\' . 'init__AfterOtherPluginsHaveLoaded', 10, 2 );
