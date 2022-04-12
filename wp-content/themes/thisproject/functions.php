<?php

namespace ThisProject;

define( 'THEME_PATH', get_stylesheet_directory() );
define( 'THEME_URI', get_stylesheet_directory_uri() );

require_once THEME_PATH . '/lib/frontend-includes.php';
require_once THEME_PATH . '/lib/wordpress.php';


use ThisProject\CMS\WordPress;
use ThisProject\CMS\WordPress\Frontend;

WordPress::setBaseFilePath( THEME_PATH );





require_once THEME_PATH . '/settings/theme-supports.php';
require_once THEME_PATH . '/settings/routing.php';
require_once THEME_PATH . '/settings/frontend/index.php';
