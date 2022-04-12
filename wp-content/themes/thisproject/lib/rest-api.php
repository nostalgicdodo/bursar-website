<?php

namespace ThisProject\CMS\WordPress\RESTApi;





class Validation {

	public static function isString ( $value, $request = null, $key = null ) {
		return !empty( $value ) and is_string( $value );
	}

	public static function isEmailAddress ( $value, $request = null, $key = null ) {
		return self::isString( $value ) and strpos( $value, '@', 1 ) !== false;
	}

}
