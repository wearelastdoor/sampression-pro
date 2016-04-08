<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

?>
<form method="get" class="search-form clearfix" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="hidden"><?php _e( 'Search for:', 'sampression' ); ?></label>
    <input type="text" value="<?php the_search_query(); ?>" name="s" class="search-field text-field"
           placeholder="<?php _e( 'Search by Keyword', 'sampression' ); ?>">
    <button type="submit" class="search-submit">
    	<span class="screen-reader-text">
    		<?php echo _x( 'Search', 'submit button', 'sampression' ); ?>
		</span>
	</button>
</form>