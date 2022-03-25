<?php
/**
 |
 | Admin UI Restrictions
 |
 | Hide menu items, widgets, etc. that do not concern folks who are not developers
 |
 */


add_action( 'admin_init', function () {
	if ( current_user_can( 'do_devops' ) )
		return;

	remove_menu_page( 'themes.php' );
	remove_menu_page( 'plugins.php' );
	remove_menu_page( 'edit.php?post_type=acf-field-group' );
	remove_menu_page( 'cptui_main_menu' );
	remove_menu_page( 'wp_stream' );
	remove_menu_page( 'pp-capabilities' );
	remove_menu_page( 'presspermit-groups' );
	remove_menu_page( 'wp-mail-smtp' );
} );
