<?php
if ( ! defined('ABSPATH')) exit('restricted access');

class SampressionAdminbarMenu {

  function SampressionAdminbarMenu()
  {
      add_action( 'admin_bar_menu', array( $this, "sampression_links" ), 66 );
  }

  function add_root_menu($name, $id, $href = FALSE)
  {
    global $wp_admin_bar;
    if ( !is_super_admin() || !is_admin_bar_showing() )
        return;

    $wp_admin_bar->add_menu( array(
        'id'   => $id,
        'meta' => array(),
        'title' => $name,
        'href' => $href ) );
  }

  function add_sub_menu($name, $link, $root_menu, $id, $meta = FALSE)
  {
      global $wp_admin_bar;
      if ( ! is_super_admin() || ! is_admin_bar_showing() )
          return;

      $wp_admin_bar->add_menu( array(
          'parent' => $root_menu,
          'id' => $id,
          'title' => $name,
          'href' => $link,
          'meta' => $meta
      ) );
  }

    function sampression_links() {
        $this->add_root_menu( __( 'Sampression', 'sampression' ), "sam-style" );
            $this->add_sub_menu( __( 'Logos &amp; Icons', 'sampression' ), SAM_PRO_SITE_WPADMIN_URL . "/themes.php?page=sampression-options", "sam-style", "logos-icons" );
            $this->add_sub_menu( __( 'Social Media', 'sampression' ), SAM_PRO_SITE_WPADMIN_URL . "/themes.php?page=sampression-options&sam-page=social-media", "sam-style", "social-media" );
            $this->add_sub_menu( __( 'Hooks', 'sampression' ), SAM_PRO_SITE_WPADMIN_URL . "/themes.php?page=sampression-options&sam-page=hooks", "sam-style", "hooks" );
    }
}

add_action( "init", "SampressionAdminbarMenuInit" );
function SampressionAdminbarMenuInit() {
    global $SampressionAdminbarMenu;
    $SampressionAdminbarMenu = new SampressionAdminbarMenu();
}