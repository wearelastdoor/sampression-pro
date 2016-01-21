<?php
/**
 * Generating metabox on pages and posts
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
add_action('add_meta_boxes', 'sam_meta_box_add');

function sam_meta_box_add() {
    add_meta_box('sampression-options', 'Sampression Options', 'sampression_options_metabox', 'post', 'advanced', 'default');
    add_meta_box('sampression-options', 'Sampression Options', 'sampression_options_metabox', 'page', 'advanced', 'default');
}

function sampression_options_metabox($post) {
    $values = get_post_custom($post->ID);
    $sidebar_options = sampression_sidebar_options();
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    ?>
    <section class="row" id="sidebar-section">
        <h3 class="sec-title"><?php _e('Sidebar', 'sampression') ?></h3>
        <div class="box">
            <ul id="sidebar-selector" class="style-selector-list clearfix">
                <?php
                $sidebar_active = isset($values['sam_sidebar_by_post']) ? esc_attr($values['sam_sidebar_by_post'][0]) : 'default';
                ?>
                <li class="first style-selector<?php if ($sidebar_active == 'default') {
                echo ' active';
                } ?>">
                    <a href="javascript:void(0);" data-sidebar="default" class="sam-style">
                        <img src="<?php echo SAM_PRO_ADMIN_IMAGES_URL; ?>/default-layout.jpg" alt="">
                        Default
                    </a>
                </li>
                <?php
                for ($i = 0; $i < count($sidebar_options); $i++) {
                    ?>
                    <li class="<?php
                    if ($sidebar_active == $sidebar_options[$i]) {
                        echo 'active ';
                    }
                    ?>style-selector">
                        <a href="javascript:void(0);" data-sidebar="<?php echo $sidebar_options[$i]; ?>" class="sam-style">
                            <img src="<?php echo SAM_PRO_ADMIN_IMAGES_URL; ?>/<?php echo $sidebar_options[$i]; ?>-layout.jpg" alt=""/>
                            <?php echo ucwords($sidebar_options[$i]); ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <input type="hidden" name="sam_sidebar_by_post" id="sidebar" value="<?php echo $sidebar_active; ?>" />
            <?php wp_nonce_field( 'sam_meta_box_nonce', 'meta_box_nonce' ); ?>
        </div>
    </section>
    <?php
}

add_action('save_post', 'sam_meta_box_save');

function sam_meta_box_save($post_id) {
    // Bail if we're doing an auto save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // if our nonce isn't there, or we can't verify it, bail
    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'sam_meta_box_nonce'))
        return;

    // if our current user can't edit this post, bail
    if (!current_user_can('edit_posts'))
        return;

    // now we can actually save the data

    if (isset($_POST['sam_sidebar_by_post'])) {
        update_post_meta($post_id, 'sam_sidebar_by_post', esc_attr($_POST['sam_sidebar_by_post']));
    }
}