<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

 /**
 * The Template for displaying all single posts.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
 
get_header(); ?>

<?php
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    $position = sampression_sidebar_position();
?>
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php
    $nav_class = $main_class = array();
    if ($position === 'left') { $nav_class[] = 'offset-by-four'; $main_class[] = 'alignright'; }
    ?>
        <nav id="nav-above" class="post-navigation clearfix <?php sampression_content_class($nav_class) ?>">
            <h3 class="assistive-text hidden"><?php _e( 'Post navigation', 'sampression' ); ?></h3>
            <div class="nav-previous alignleft"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'sampression' ) ); ?></div>
            <div class="nav-next alignright"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'sampression' ) ); ?></div>
        </nav><!-- #nav-above -->
        <section id="content" class="<?php sampression_content_class($main_class) ?>" role="main">

            <article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">

                <?php if (has_post_thumbnail()) { ?>
                    <div class="featured-img">
                        <?php
                        $position = sampression_sidebar_position();
                        if ($position === 'right') {
                            the_post_thumbnail('featured');
                        } else {
                            the_post_thumbnail('featured-full');
                        }
                        ?>
                    </div>  <!-- .featured-img -->
                <?php } ?>

                <header class="post-header">
                    <?php sampression_the_title() ?>
                </header>

                <?php if (( $options['show_meta_date'] === 'yes' ) || ( $options['show_meta_comment_count'] === 'yes' ) || ( $options['show_meta_author'] === 'yes' ) || ( $options['show_meta_categories'] === 'yes' ) || ( $options['show_meta_tags'] === 'yes' )) { ?>
                    <div class="meta clearfix<?php if(get_the_excerpt() != '') { echo ' no-border'; } ?>">

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

                        <?php
                        if ($options['show_meta_categories'] == 'yes') { //show/hide metas categories on single post from theme option (post meta settings)
                            ?>
                            <div class="cats"><?php printf(__('<span class="icon-Folder-Archive"></span> %s', 'sampression'), get_the_category_list(', ')); ?></div>
                        <?php } //endif ?>

                        <?php
                        if (( has_tag()) && ( $options['show_meta_tags'] == 'yes' )) {  //show/hide meta tags on single post from theme option (post meta settings)
                            ?>
                            <div class="tags"><span class="icon-Tag-3"></span><?php the_tags(' ', ', '); ?> </div>
                        <?php } //endif ?>

                        <?php if (is_user_logged_in()) { ?>

                            <div class="edit"><span class="icon-Pen-4"></span> <?php edit_post_link(__('Edit', 'sampression')); ?> </div>

                        <?php } //endif ?>

                    </div> <!-- .meta -->
                <?php } //endif ?>
                <?php
                //if(get_the_excerpt() != '') {
                ?>
                <div class="entry clearfix">
                    <?php the_content(); ?>

                    <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'sampression') . '</span>', 'after' => '</div>')); ?>
                </div> <!-- .entry -->
                <?php
                //}
                ?>
            </article>

            <?php comments_template('', true); ?>

        </section><!-- end content -->
        
    <?php endwhile; endif; ?>
        
    <?php
    if($position == 'left' || $position == 'right') {
        get_sidebar('right');
    }
    ?>

<?php get_footer(); ?>