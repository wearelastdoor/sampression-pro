<?php
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );

/**
 * The class for loading other files
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

class Sampression_Admin {
 
    /**
     * construct
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'sampression_theme_menu' ), 5 );
        add_action( 'admin_init', array( $this, 'register_sampression_setting' ), 5 );
        add_action( 'admin_init', array( $this, 'add_theme_options' ), 5 );
        add_action( 'admin_enqueue_scripts', array( $this, 'sampression_admin_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'sampression_admin_styles' ) );
        add_action( 'admin_head', array( $this, 'admin_ie_js_css' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'sampression_stylesheets_scripts' ) );
    }

    /**
     * desctruct
     */
    public function __destruct() {}

    /**
     * add admin menu
     */
    
    public function sampression_theme_menu() {
    add_theme_page( 
        'Theme Options', // Name of page
        'Theme Options', // Label in menu
        'edit_theme_options', // Capability required
        'sampression-options', // Menu slug, used to uniquely identify the page
        'sampression_theme_settings' // Function that renders the options page
    );
}
 
    function sampression_load_page() {
        $pages = array( 'styling', 'typography', 'social-media', 'custom-css', 'blog' );
        if( isset( $_GET['sam-page'] ) && in_array( $_GET['sam-page'], $pages ) ) {
            $page_slug = str_replace( '-', '_', $_GET['sam-page'] );
            $this->layout( $page_slug );
        } else {
            $this->layout( 'logos_icons' );
        }
    }

    /**
     * load layout
     * @param $page pagename
     */
    public function layout($page) {
        require_once SAM_PRO_ADMIN_DIR . '/header.php';
        require_once SAM_PRO_ADMIN_DIR . '/sidebar.php';
        require_once SAM_PRO_ADMIN_DIR . '/sam-' . $page . '.php';
        require_once SAM_PRO_ADMIN_DIR . '/footer.php';
        
    }
    
     public function add_theme_options() {
         require_once get_template_directory().'/inc/admin/theme-options.php';
    }

    public function register_sampression_setting() {
        register_setting( 'sampression_options', 'sampression_theme_options', 'sampression_theme_validate' ); 
    }

    /**
     * load admin scripts
     */
    public function sampression_stylesheets_scripts() {
        $this->sampression_enqueue_skeleton();

        wp_enqueue_style( 'gfont-kreon', '//fonts.googleapis.com/css?family=Kreon:400,700' );
        wp_enqueue_style( 'gfont-droid', '//fonts.googleapis.com/css?family=Droid+Serif:400,700' );

    }

    /**
     * load css
     */
    public function sampression_enqueue_skeleton() {
        wp_enqueue_style( 'fonts', SAM_PRO_CSS_URL . '/fonts-sampression.css' );
    }

    /**
     * load admin scripts
     */
    public function sampression_admin_scripts() {
        wp_enqueue_media();
        wp_enqueue_script( 'jquery-ui-tooltip' );
        wp_enqueue_script( 'modernizr', SAM_PRO_ADMIN_JS_URL . '/modernizr.js', array(), '2.6.2', false );
        wp_enqueue_script( 'selectivizr', SAM_PRO_ADMIN_JS_URL . '/selectivizr.js', array( 'jquery' ), '1.0.2', true );
        wp_enqueue_script( 'SelectBox', SAM_PRO_ADMIN_JS_URL . '/SelectBox.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_script( 'jScrollPane', SAM_PRO_ADMIN_JS_URL . '/jScrollPane.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_script( 'jquerymousewheel', SAM_PRO_ADMIN_JS_URL . '/jquery.mousewheel.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_script( 'jquery-cookies', SAM_PRO_ADMIN_JS_URL . '/jquery.cookies.js', array( 'jquery' ), '1.0' );
        wp_enqueue_script( 'admin-script', SAM_PRO_ADMIN_JS_URL . '/admin-script.js', array( 'jquery', 'wp-color-picker','jquery-ui-tooltip' ), '1.0', true );
    }

    /**
     * load admin styles
     */
    public function sampression_admin_styles() {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'admin-style', SAM_PRO_ADMIN_CSS_URL . '/admin-style.css', false, false, 'screen' );
        wp_enqueue_style( 'font-style-kreon', '//fonts.googleapis.com/css?family=Kreon:400,700', false, false, 'screen' );
        wp_enqueue_style( 'font-style-droid-serif', '//fonts.googleapis.com/css?family=Droid+Serif:400,700', false, false, 'screen' );
    }

    /**
     * check for ie
     */
    public function admin_ie_js_css() {
        echo '<!--[if lt IE 8]><!-->
          <link rel="stylesheet" href="' . SAM_PRO_ADMIN_CSS_URL . '/fontsie7.css' . '">
          <script type="text/javascript" src="' . SAM_PRO_ADMIN_JS_URL . '/fontsie7.js' . '"></script>
          <!--<![endif]-->';
    }

    /**
     * Load logo and icon layout
     */
    public function logos_icons() {
        $this->layout( 'logos_icons' );
    }

    /**
     * Load styling layout
     */
    public function styling() {
        $this->layout( 'styling' );
    }

    /**
     * Load typography layout
     */
    public function typography() {
        $this->layout( 'typography' );
    }

    /**
     * Load social media layout
     */
    public function social_media() {
        $this->layout( 'social_media' );
    }

    /**
     * Load custom css layout
     */
    public function custom_css() {
        $this->layout( 'custom_css' );
    }

    /**
     * Load blog layout
     */
    public function blog() {
        $this->layout( 'blog' );
    }
}