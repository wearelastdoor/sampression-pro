<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template for post format image.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
?>
<?php
global $sampression_options_settings;
$options = $sampression_options_settings;
$sticky = sampression_latest_one_sticky_post();
?>

<article id="post-<?php the_ID(); ?>" class="post <?php echo sampression_column_class() . ' format-' . get_post_format(); ?> <?php echo sampression_cat_slug(); ?> <?php if ( get_the_ID() == $sticky && is_home() ) { echo 'sticky corner-stamp'; } else { echo 'item'; } ?> ">

    <?php sampression_the_title() ?>

    <?php if ( has_post_thumbnail() ) { ?>
        <div class="featured-img">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" >
                <?php the_post_thumbnail( 'featured-full','',true ); ?></a>
        </div>
        <!-- .featured-img -->
    <?php } //endif ?>

        <div class="entry clearfix">
            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression' ) . '</span>', 'after' => '</div>' ) ); ?>
        </div>
        <!-- .entry -->

    <?php if( ( $options['show_meta_author'] == 'yes' ) || ( $options['show_meta_date'] == 'yes' ) ) { ?>
        <div class="meta clearfix">

            <?php if( $options['show_meta_author'] == 'yes' ) { //show/hide author meta on single post from theme option (post meta settings) ?>
                <div class="post-author col">
                    <span class="icon-Administrator"></span> <a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php printf( __( 'View all posts by %s', 'sampression' ), get_the_author() ); ?>"> <?php echo get_the_author(); ?> </a>
                </div> <!-- .post-author -->
            <?php } //endif ?>

            <?php if( $options['show_meta_date'] == 'yes' ) { //show/hide metas date on single post from theme option (post meta settings) ?>
                <time class="col" datetime="2011-09-28"> <span class="icon-Calendar-4"></span> <a href="<?php echo get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ); ?>" title="<?php echo get_the_time(); ?>" rel="bookmark"> <?php echo get_the_date(); ?></a></time>
            <?php } //endif ?>

        </div> <!-- meta -->
    <?php } //endif; ?>
    <?php
    if ( ( ! post_password_required() ) && ( $options['show_meta_comment_count'] == 'yes' ) ) {  //show/hide comment count on single post from theme option (post meta settings)
        $comments_count = wp_count_comments(get_the_ID());
        if ( comments_open() && ($comments_count->approved > 0) ) :
            ?>
            <div class="meta clearfix">
            <span class="col count-comment">
                <span class="icon-Speach-Bubble"></span>
                <?php comments_popup_link(__('0', 'sampression'), __('1 comment', 'sampression'), __('% comments', 'sampression')); ?>

                </span>
            </div> <!-- meta -->
        <?php
        endif;

    }  //endif
    ?>
    <?php if( $options['show_meta_categories'] == 'yes' ) { //show/hide meta categories on single post from theme option (post meta settings)?>
        <div class="meta">
            <div class="cats"><?php printf(__('<span class="icon-Folder-Archive"></span><div class="overflow-hidden cat-listing">%s</div>', 'sampression'), get_the_category_list(', ')); ?></div>
        </div>
    <?php } //endif ?>

    <?php
    if( ( has_tag()) && ( $options['show_meta_tags'] == 'yes' ) ) {  //show/hide meta tags on single post from theme option (post meta settings)
        ?>
        <div class="meta">
            <div class="tags"><span class="icon-Tag-3"></span><div class="overflow-hidden tag-listing"><?php the_tags(' ', ', ', '<br />'); ?></div> </div>
        </div>
    <?php } //endif ?>

    <?php if(is_user_logged_in()){ ?>
        <div class="meta">
            <div class="edit"><span class="icon-Pen-4"></span> <?php edit_post_link( __( 'Edit this post', 'sampression' ) ); ?> </div>
        </div>
    <?php } //endif ?>

</article>