<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template for displaying image attachments.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
 
get_header(); ?>

<?php if (have_posts()) : ?>

<?php
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    $position = sampression_sidebar_position();
?>
    <?php
    $main_class = array();
    if ($position === 'left') { $main_class[] = 'alignright'; }
    ?>
        <section id="content" class="<?php sampression_content_class($main_class) ?>" role="main">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">

                    <header class="post-header">
<!--                        <h2 class="post-title"><a href="--><?php //echo get_permalink($post->post_parent); ?><!--" title="--><?php //esc_attr(printf(__('Return to %s', 'sampression'), get_the_title($post->post_parent))); ?><!--">--><?php //printf('%s', get_the_title($post->post_parent)); ?><!--</a>: <span class="img-title">--><?php //the_title(); ?><!--</span></h2>-->
                        <?php sampression_the_title() ?>
                    </header>

                    <?php if (( $options['show_meta_comment_count'] == 'yes' ) || ( $options['show_meta_date'] == 'yes' ) || ( $options['show_meta_author' == 'yes'] ) || ( $options['show_meta_categories'] == 'yes' ) || ( $options['show_meta_tags'] == 'yes' )) { ?>                    
                        <div class="meta clearfix">

                            <div class="col count-comment">
                                <?php
                                if ((!post_password_required() ) && ( $options['show_meta_comment_count'] == 'yes' )) {  //show/hide comment count on single post from theme option (post meta settings)
                                    if (comments_open()) :
                                        ?>
                                        <span class="icon-Speach-Bubble"></span>
                                        <?php comments_popup_link(__('0', 'sampression'), __('1 comment', 'sampression'), __('% comments', 'sampression')); ?>
                                    <?php
                                    endif;
                                } //endif
                                ?>
                            </div> <!-- .col -->

                            <?php if ($options['show_meta_author'] == 'yes') { //show/hide author meta on single post from theme option (post meta settings) ?>
                                <div class="post-author">
                                    <span class="icon-Administrator"></span><a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php printf(__('View all posts by %s', 'sampression'), get_the_author()); ?>"><?php echo get_the_author(); ?></a>
                                </div> <!-- .post-author -->
                            <?php } //endif ?>

                            <?php if ($options['show_meta_date'] == 'yes') { //show/hide metas date on single post from theme option (post meta settings) ?>
                                <time class="" datetime="2011-09-28"> <span class="icon-Calendar-4"></span> <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" title="<?php echo get_the_time(); ?>" rel="bookmark"> <?php echo get_the_date(); ?></a></time>
                            <?php } //endif ?>

                            <?php if (is_user_logged_in()) { ?>

                                <div class="edit"><span class="icon-Pen-4"></span> <?php edit_post_link(__('Edit', 'sampression')); ?> </div>

                            <?php } ?>

                        </div>
                        <!-- .meta -->
                    <?php } //endif; ?>

                    <div class="entry clearfix">
                        <?php
                        /**
                         * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
                         * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
                         */
                        $attachments = array_values(get_children(array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID')));
                        foreach ($attachments as $k => $attachment) {
                            if ($attachment->ID == $post->ID)
                                break;
                        }
                        $k++;
                        // If there is more than 1 attachment in a gallery
                        if (count($attachments) > 1) {
                            if (isset($attachments[$k]))
                            // get the URL of the next image attachment
                                $next_attachment_url = get_attachment_link($attachments[$k]->ID);
                            else
                            // or get the URL of the first image attachment
                                $next_attachment_url = get_attachment_link($attachments[0]->ID);
                        } else {
                            // or, if there's only 1 image, get the URL of the image
                            $next_attachment_url = wp_get_attachment_url();
                        }
                        ?>
                        <a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
                            $attachment_size = apply_filters('simplecatch_attachment_size', 848);
                            echo wp_get_attachment_image($post->ID, array($attachment_size, 1024)); // filterable image width with 1024px limit for image height.
                            ?></a>

                        <?php if (!empty($post->post_excerpt)) : ?>
                            <div class="entry-caption">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="image-description">
                            <?php the_content(); ?>
                            <?php
                            wp_link_pages(array(
                                'before' => '<div class="pagination">',
                                'after' => '</div>',
                                'link_before' => '<span>',
                                'link_after' => '</span>',
                                'pagelink' => '%',
                                'echo' => 1
                            ));
                            ?>                            
                        </div> <!-- .image-description -->


                        <nav id="nav-below" class="post-navigation clearfix">
                            <div class="nav-previous alignleft"><?php previous_image_link(false, __('<span class="meta-nav">&larr;</span> Previous Image', 'sampression')); ?></div>
                            <div class="nav-next alignright"><?php next_image_link(false, __('Next Image <span class="meta-nav">&rarr;</span>', 'sampression')); ?></div>
                        </nav><!-- #nav-above -->

                    </div> <!-- .entry -->

                </article> <!-- .post -->

            <?php endwhile; ?>

        <?php comments_template('', true); ?>

        </section> <!-- . content -->
<?php endif; ?>
<?php
if($position == 'left' || $position == 'right') {
    get_sidebar('right');
}
?>
<?php get_footer(); ?>