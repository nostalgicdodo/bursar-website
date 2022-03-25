<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 * * and other things.
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

/**
 |
 | Project configuration
 |
 | Pull the configuration file from the project root
 |
 */
if ( ! defined( '__ROOT__' ) )
	define( '__ROOT__', $_SERVER[ 'DOCUMENT_ROOT' ] );

require_once __ROOT__ . '/conf.php';



if ( HTTPS_SUPPORT )
	$httpProtocol = 'https';
else
	$httpProtocol = 'http';

$hostName = SERVER_NAME;
$requestURI = php_sapi_name() !== 'cli' ? $_SERVER[ 'REQUEST_URI' ] : ( $_ENV[ 'WP_CLI_REQUEST_URI' ] ?? '/' );



/**
 |
 | Routing
 |
 */
// Fetch media files from the WIP server
if ( CMS_FETCH_MEDIA_REMOTELY )
	if ( $hostName !== CMS_REMOTE_ADDRESS )
		if ( strpos( $requestURI, '/content/cms/' ) !== false )
			return header( 'Location: ' . $httpProtocol . '://' . CMS_REMOTE_ADDRESS . $requestURI, true, 302 );

// If accessing the CMS backend, ensure that only the canonical version / instance is accessed
if ( RESTRICT_ACCESS_TO_CANONICAL_CMS_ONLY )
	if ( $hostName !== CMS_CANONICAL_ADDRESS )
		if ( strpos( $requestURI, CMS_BACKEND_URL ) === 0 )
			return header( 'Location: ' . $httpProtocol . '://' . CMS_CANONICAL_ADDRESS . $requestURI, true, 302 );



/**
 |
 | WordPress Website Roots
 |
 | Set it such that it is contextual to the domain that the site is hosted behind
 |
 */
define( 'WP_HOME', $httpProtocol . '://' . $hostName );
if ( ! defined( 'WP_SITEURL' ) )
	define( 'WP_SITEURL', $httpProtocol . '://' . $hostName );



/**
 |
 | Cron
 |
 */
define( 'DISABLE_WP_CRON', ( ! CMS_CRON ) );



/**
 |
 | Database
 |
 */
// define( 'WP_ALLOW_REPAIR', true );

// MySQL
	// the name of the database for WordPress
define( 'DB_NAME', CMS_DB_NAME );
	// Database username
define( 'DB_USER', CMS_DB_USER );
	// Database password
define( 'DB_PASSWORD', CMS_DB_PASSWORD );
	// Database hostname
define( 'DB_HOST', CMS_DB_HOST );
	// Database charset (to use in creating database tables)
define( 'DB_CHARSET', 'utf8' );
	// the database collate type
define( 'DB_COLLATE', '' );
	// Use an SSL connection when connecting to the database
if ( CMS_DB_SSL )
	define( 'MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', CMS_WP_AUTH_KEY );
define( 'SECURE_AUTH_KEY', CMS_WP_SECURE_AUTH_KEY );
define( 'LOGGED_IN_KEY', CMS_WP_LOGGED_IN_KEY );
define( 'NONCE_KEY', CMS_WP_NONCE_KEY );
define( 'AUTH_SALT', CMS_WP_AUTH_SALT );
define( 'SECURE_AUTH_SALT', CMS_WP_SECURE_AUTH_SALT );
define( 'LOGGED_IN_SALT', CMS_WP_LOGGED_IN_SALT );
define( 'NONCE_SALT', CMS_WP_NONCE_SALT );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = CMS_WP_DB_TABLE_PREFIX . '_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', CMS_DEBUG_MODE );
define( 'WP_DEBUG_LOG', CMS_DEBUG_LOG_TO_FILE );
define( 'WP_DEBUG_DISPLAY', CMS_DEBUG_LOG_TO_FRONTEND );
@ini_set( 'display_errors', CMS_DEBUG_LOG_TO_FRONTEND ? '1' : '0' );

/* Add any custom values between this line and the "stop editing" line. */


/**
 | File System
 |
 */
define( 'FS_METHOD', 'direct' );


/**
 |
 | Media and Uploads
 |
 */
if ( ! defined( 'UPLOADS' ) )
	define( 'UPLOADS', '../content/cms/' );  # this one is relative to `ABSPATH`


/**
 |
 | Automatice Updates
 |
 |
 */
define( 'AUTOMATIC_UPDATER_DISABLED', false );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );


/**
 |
 | Miscellaneous
 |
 |
 */
define( 'WP_MAX_MEMORY_LIMIT', WORDPRESS_ADMIN_MEMORY_LIMIT );





/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
