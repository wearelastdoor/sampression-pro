<?php
/**
 * Generating hooks
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
if ( ! defined('ABSPATH')) exit('restricted access');

function sampression_action_hooks($hook = '') {
    if($hook === '')
        return;

    $hooks = (object) sampression_hooks_setting();
    foreach($hooks->hook as $hkey => $hval) {
        if((str_replace('sam_', '', $hkey) === $hook) && $hval['execute'] === 'yes') {
            echo $hval['content'];
        }
    }
}
function sampression_add_before_body_tag(){
    sampression_action_hooks('before_body_close');
}
function sampression_add_before_head_tag(){
    sampression_action_hooks('before_head_close');
}

add_action('sampression_before_head_tag', 'sampression_add_before_head_tag');
add_action('sampression_before_body_tag', 'sampression_add_before_body_tag');