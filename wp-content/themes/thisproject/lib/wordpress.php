<?php

namespace ThisProject\CMS;





class WordPress {

	public static $baseFilePath = __ROOT__;

	public static $jsData = [ ];

	public static function setBaseFilePath ( $path ) {
		self::$baseFilePath = $path;
	}

	public static function enqueueScript ( $slug, $relativePath = null, $dependencies = [ ], $baseFilePath = null ) {
		if ( is_null( $relativePath ) and !empty( $slug ) )
			return wp_enqueue_script( $slug );

		$baseFilePath = $baseFilePath ?? self::$baseFilePath;

		$baseURLPath = str_replace( __ROOT__, '', $baseFilePath );

		return wp_enqueue_script(
			CLIENT_SLUG . '-' . $slug,
			home_url() . $baseURLPath . $relativePath,
			$dependencies,
			filemtime( $baseFilePath . $relativePath ),
			true
		);
	}

	public static function enqueueStylesheet ( $slug, $relativePath, $dependencies = [ ], $baseFilePath = null ) {
		$baseFilePath = $baseFilePath ?? self::$baseFilePath;

		$baseURLPath = str_replace( __ROOT__, '', $baseFilePath );

		return wp_enqueue_style(
			CLIENT_SLUG . '-' . $slug,
			home_url() . $baseURLPath . $relativePath,
			$dependencies,
			filemtime( $baseFilePath . $relativePath )
		);
	}

	public static function enqueueInlineStylesheet ( $code ) {
		wp_register_style( 'stub-stylesheet-handle', false );
		wp_enqueue_style( 'stub-stylesheet-handle' );
		wp_add_inline_style( 'stub-stylesheet-handle', $code );
	}

	public static function getJavascriptData () {
		return self::$jsData;
	}

	public static function setJavascriptContextData ( $key__OR__associativeArray, $value = null ) {
		if ( is_string( $key__OR__associativeArray ) )
			self::$jsData = array_merge_recursive( self::$jsData, [ $key__OR__associativeArray => $value ] );
		else
			self::$jsData = array_merge_recursive( self::$jsData, $key__OR__associativeArray );
	}

}
