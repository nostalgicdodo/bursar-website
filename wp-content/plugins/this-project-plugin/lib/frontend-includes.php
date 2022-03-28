<?php
/*
 |
 | Various fragments of HTML, CSS and JS that peppered throughout the markup code
 |
 | References:
 | wp-includes/default-filters.php
 |
 */

namespace ThisProject\CMS\WordPress\Frontend;





$dependencies = [
	'dnsPrefetches' => 'DNSPrefetches',
	'wlwManifest' => 'WLWManifest',
	'rsd' => 'RSD',
	'xhtmlGenerator' => 'XHTMLGenerator',
	'restAPIDiscovery' => 'RESTApiDiscovery',
	'globalStyles' => 'GlobalStyles',
	'blockStyles' => 'BlockStyles',
	'emojis' => 'Emojis',
	'rss' => 'RSS',
];

function removeDefaults ( $exclude = [ ] ) {

	global $dependencies;

	$dependenciesToRemove = array_diff_key(
		$dependencies,
		empty( $exclude ) ? [ ] : array_combine( $exclude, range( 1, count( $exclude ) ) )
	);
	foreach ( $dependenciesToRemove as $dependency ) {
		call_user_func( [
			__NAMESPACE__ . '\\' . $dependency,
			'remove'
		] );
	}
}

class DNSPrefetches {
	public static function remove () {
		remove_action( 'wp_head', 'wp_resource_hints', 2 );
	}
}

/**
 | Windows Live Writer manifest file
 |
 */
class WLWManifest {
	public static function remove () {
		remove_action( 'wp_head', 'wlwmanifest_link' );
	}
}

/**
 | Really Simple Discovery service endpoint
 |
 */
class RSD {
	public static function remove () {
		remove_action( 'wp_head', 'rsd_link' );
	}
}

/**
 | XHTML Generator
 |
 */
class XHTMLGenerator {
	public static function remove () {
		remove_action( 'wp_head', 'wp_generator' );
	}
}

/**
 | REST API Discovery
 |
 */
class RESTApiDiscovery {
	public static function remove () {
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	}
}

class GlobalStyles {
	/**
	 | Reference: wp-includes/script-loader.php
	 |
	 */
	public static function remove () {

		remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );

		// >= 5.9.1
		remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
		// <= 5.9.0
		remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
		wp_dequeue_style( 'global-styles' );

	}
}

class BlockStyles {
	/**
	 | Reference: wp-includes/script-loader.php
	 |
	 */
	public static function remove () {
		add_action( 'wp_enqueue_scripts', function () {
			wp_dequeue_style( 'wp-block-library' );
		} );
	}

	/**
	 | Reference: wp-includes/script-loader.php: wp_default_styles
	 | NOTE: Does not work
	 */
	public static function add () {
		add_action( 'wp_enqueue_scripts', function () {
			wp_enqueue_style(
				'wp-block-library',
				'/wp-includes/css/dist/block-library/style' . ( SCRIPT_DEBUG ? '' : '.min' ) . '.css'
			);
		} );
	}
}

class Emojis {
	/**
	 | References:
	 | https://kinsta.com/knowledgebase/disable-emojis-wordpress/
	 | https://wordpress.org/plugins/disable-emojis
	 |
	 */
	public static function remove () {
		// add_action( 'init', function () {

			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

			// Remove the tinymce emoji plugin.
			add_filter( 'tiny_mce_plugins', function ( $plugins ) {
				if ( ! is_array( $plugins ) )
					return [ ];
				return array_diff( $plugins, [ 'wpemoji' ] );
			} );

			// Remove emoji CDN hostname from DNS prefetching hints
			add_filter( 'wp_resource_hints', function ( $urls, $relationType ) {
				if ( $relationType === 'dns-prefetch' ) {
					// Strip out any URLs referencing the WordPress.org emoji location
					$emojiSVGUrlBit = 'https://s.w.org/images/core/emoji/';
					foreach ( $urls as $key => $url ) {
						if ( strpos( $url, $emojiSVGUrlBit ) !== false )
							unset( $urls[ $key ] );
					}
				}
				return $urls;
			}, 10, 2 );
		// } );
	}
}

class RSS {
	/**
	 * References:
	 * https://kinsta.com/knowledgebase/wordpress-disable-rss-feed/
	 *
	 */
	public static function remove () {
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
	}
}
