<?php
/**
 * The template for notify users for theme update.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
if ( ! defined('ABSPATH')) exit('restricted access');

function update_notifier_menu() {
	$xml = get_latest_theme_version(5); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want)

	if(version_compare($theme_data['Version'], $xml->latest, '<')) {
            add_dashboard_page($theme_data['Name'] . ' - Theme Updates', $theme_data['Name'] . '<span class="update-plugins count-1 sampression-updates"><span class="update-count">'.$xml->latest.'</span></span>', 'read', sanitize_title($theme_data['Name']) . '-updates', 'update_notifier');
	}
}

add_action('admin_menu', 'update_notifier_menu');

function update_notifier() {
	$xml = get_latest_theme_version(5); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want) ?>

	<style>
		.update-nag {display: none;}
		#instructions {max-width: 800px;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}

        p{
            font-weight:normal;
        }

        ol {
            margin: 1.1em 0 1.1em 2em;
        }
	</style>

	<div class="wrap">

		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo $theme_data['Name']; ?> Theme Updates</h2>
	    <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo $theme_data['Name']; ?> theme available. You have version <?php echo $theme_data['Version']; ?> installed. Please update to version <?php echo $xml->latest; ?>.</strong></p></div>

        <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd; width:45%;" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />

        <div id="instructions" style="max-width: 800px;">
            <h3>Update Instructions</h3>
            <p style="font-size:14px;">
                A new version of Sampression Pro theme is available for download. View <a href="http://www.sampression.com/themes/sampression-pro/#change-log">version <?php echo $xml->latest; ?> details</a> or <a href="http://www.sampression.com/themes/sampression-pro/">update now</a>. Follow these <a href="http://www.docs.sampression.com/category/sampression-pro/#category-title-1">instructions</a> to update your theme.
            </p>
        </div>

            <div class="clear"></div>

	    <h3 class="title">Changelog</h3>
	    <?php echo $xml->changelog; ?>

	</div>

<?php }

// This function retrieves a remote xml file on my server to see if there's a new update
// For performance reasons this function caches the xml content in the database for XX seconds ($interval variable)
function get_latest_theme_version($interval) {
	// remote xml file location
	$notifier_file_url = 'http://www.update.sampression.com/sampression-pro-notifier.xml';

	$db_cache_field = 'sampression-pro-notifier-cache';
	$db_cache_field_last_updated = 'sampression-pro-notifier-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
            WP_Filesystem();
            global $wp_filesystem;
            $cache = $wp_filesystem->get_contents($notifier_file_url);               

		if ($cache) {
			// we got good results
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
		}
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}

	$xml = simplexml_load_string($notifier_data);

	return $xml;
}
?>