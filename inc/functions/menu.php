<?php
/**
 * Generating menus
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
if ( ! defined('ABSPATH')) exit('restricted access');

add_action( 'after_setup_theme', 'sampression_register_nav_menus' );

function sampression_register_nav_menus() {

	if ( ! current_theme_supports( 'sampression-menus' ) )
		return;

	$menus = get_theme_support( 'sampression-menus' );

	/** Register supported menus */
	foreach ( (array) $menus[0] as $id => $name ) {
		register_nav_menu( $id , $name );
	}

}