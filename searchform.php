<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template for displaying search forms
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
?>
<form method="get" class="searchform clearfix" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" value="<?php the_search_query(); ?>" name="s" class="search-field text-field" placeholder="<?php _e( 'search by keyword', 'sampression' ); ?>" />
    <input type="submit" class="searchsubmit" value="<?php _e( 'Search', 'sampression' ); ?>" />
</form>