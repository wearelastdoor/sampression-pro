<?php
/**
 * Sampression function init
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

add_action( 'sampression_init', 'sampression_constants' );

/**
 * Define Sampression Constants
 */
function sampression_constants() {

	define( 'SAM_PRO_VERSION', '1.0');

	/** Define Directory Location Constants */
	define( 'SAM_PRO_THEME_DIR', get_template_directory() );
	define( 'SAM_PRO_IMAGES_DIR', SAM_PRO_THEME_DIR . '/images' );
    define( 'SAM_PRO_TIMTHUMB_DIR', SAM_PRO_THEME_DIR . '/timthumb' );
	define( 'SAM_PRO_LIB_DIR', SAM_PRO_THEME_DIR . '/lib' );
	define( 'SAM_PRO_INC_DIR', SAM_PRO_THEME_DIR . '/inc' );
	define( 'SAM_PRO_TEMPLATE_DIR', SAM_PRO_THEME_DIR . '/inc/templates' );
	define( 'SAM_PRO_ADMIN_DIR', SAM_PRO_INC_DIR . '/admin' );
	define( 'SAM_PRO_ADMIN_CSS_DIR', SAM_PRO_ADMIN_DIR . '/css' );
	define( 'SAM_PRO_ADMIN_JS_DIR', SAM_PRO_ADMIN_DIR . '/js' );
	define( 'SAM_PRO_ADMIN_IMAGES_DIR', SAM_PRO_ADMIN_DIR . '/images' );
	define( 'SAM_PRO_JS_DIR', SAM_PRO_LIB_DIR . '/js' );
	define( 'SAM_PRO_CSS_DIR', SAM_PRO_LIB_DIR . '/css' );
	define( 'SAM_PRO_CLASSES_DIR', SAM_PRO_INC_DIR . '/classes' );
	define( 'SAM_PRO_FUNCTIONS_DIR', SAM_PRO_INC_DIR . '/functions' );
	define( 'SAM_PRO_WIDGETS_DIR', SAM_PRO_INC_DIR . '/widgets' );
	define( 'SAM_PRO_LANGUAGES_DIR', SAM_PRO_THEME_DIR . '/languages' );
        
    /** Define Template Part Constants **/
    define( 'SAM_PRO_CLS_TPL_PART_DIR', 'inc/classes/' );
    define( 'SAM_PRO_FUNC_TPL_PART_DIR', 'inc/functions/' );
    define( 'SAM_PRO_WIDGET_TPL_PART_DIR', 'inc/widgets/' );
    define( 'SAM_PRO_ADMIN_TPL_PART_DIR', 'inc/admin/' );

	/** Define URL Location Constants */
	define( 'SAM_PRO_SITE_URL', site_url() );
    define( 'SAM_PRO_SITE_WPADMIN_URL', admin_url() );
	define( 'SAM_PRO_THEME_URL', get_template_directory_uri() );
	define( 'SAM_PRO_IMAGES_URL', SAM_PRO_THEME_URL . '/images' );
    define( 'SAM_PRO_TIMTHUMB_URL', SAM_PRO_THEME_URL . '/timthumb' );
	define( 'SAM_PRO_LIB_URL', SAM_PRO_THEME_URL . '/lib' );
	define( 'SAM_PRO_INC_URL', SAM_PRO_THEME_URL . '/inc' );
	define( 'SAM_PRO_ADMIN_URL', SAM_PRO_INC_URL . '/admin' );
	define( 'SAM_PRO_ADMIN_CSS_URL', SAM_PRO_ADMIN_URL . '/css' );
	define( 'SAM_PRO_ADMIN_JS_URL', SAM_PRO_ADMIN_URL . '/js' );
	define( 'SAM_PRO_ADMIN_IMAGES_URL', SAM_PRO_ADMIN_URL . '/images' );
	define( 'SAM_PRO_JS_URL', SAM_PRO_LIB_URL . '/js' );
	define( 'SAM_PRO_CSS_URL', SAM_PRO_LIB_URL . '/css' );
	define( 'SAM_PRO_CLASSES_URL', SAM_PRO_INC_URL . '/classes' );
	define( 'SAM_PRO_FUNCTIONS_URL', SAM_PRO_INC_URL . '/functions' );
	define( 'SAM_PRO_WIDGETS_URL', SAM_PRO_INC_URL . '/widgets' );
	define( 'SAM_PRO_LANGUAGES_URL', SAM_PRO_THEME_URL . '/languages' );

}

add_action( 'sampression_init', 'sampression_load_framework' );

/**
 * load sampression framework
 */
function sampression_load_framework() {

    /*
     * Load Default Value
     */
    get_template_part( SAM_PRO_FUNC_TPL_PART_DIR . 'defaults' );

	/** Load Classes */
	get_template_part( SAM_PRO_CLS_TPL_PART_DIR . 'admin' );

	/** Load Functions */
	get_template_part( SAM_PRO_FUNC_TPL_PART_DIR . 'functions' );
	if ( is_admin() ) :
    	get_template_part( SAM_PRO_FUNC_TPL_PART_DIR . 'update-notifier' );
	endif;
	get_template_part( SAM_PRO_FUNC_TPL_PART_DIR . 'menu' );
	get_template_part( SAM_PRO_FUNC_TPL_PART_DIR . 'sidebar' );
    get_template_part( SAM_PRO_FUNC_TPL_PART_DIR . 'metabox' );

	/** Load Admin */
	if ( is_admin() ) :
            get_template_part( SAM_PRO_ADMIN_TPL_PART_DIR . 'theme-options' );
	endif;

}

do_action( 'sampression_init' );

new Sampression_Admin;