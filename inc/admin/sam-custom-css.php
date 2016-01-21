<?php
/**
 * Custom CSS tab of Theme Options.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );
    global $sampression_options_settings;
    $options = $sampression_options_settings;
?>
    <section class="row">
        <h3 class="sec-title"><?php _e( 'Custom CSS', 'sampression' ); ?></h3>
        <textarea id="sam-custom-code" class="large-textarea" name="sampression_theme_options[custom_css_value]"><?php echo esc_attr( $options['custom_css_value'] ); ?></textarea>
        <div id="response"></div>
        <p class="submit">
            <input type="submit" name="sampression-theme-settings" id="submit" class="button1 alignright save-data" value="Save" />
        </p>
    </section> <!-- .row -->