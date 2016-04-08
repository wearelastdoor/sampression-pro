<?php
/**
 * Template part for displaying Audio post format
 *
 * @package Sampression
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h3 class="post-title">
        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title() ?></a>
    </h3>
    <?php
    if( has_post_thumbnail() ) { ?>
        <div class="featured-img">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
        <!-- .featured-img -->
    <?php } ?>
    <div class="entry clearfix">
        <?php
        if( has_shortcode( get_the_content(), 'soundcloud' ) ) {
            $pattern = get_shortcode_regex();
            preg_match('/'.$pattern.'/s', $post->post_content, $matches);
            $shortcode = $matches[0];
            echo apply_filters( 'the_content', $shortcode );
        } else {
            the_content();
            //[soundcloud url="https://api.soundcloud.com/tracks/245048301" params="auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&visual=true" width="100%" height="450" iframe="true" /]
        }
        ?>
        <?php //wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression' ) . '</span>', 'after' => '</div>' ) ); ?>
    </div>
    <!-- .entry -->
    <div class="meta clearfix">
        <?php sampression_entry_date() ?>
    </div>
    <div class="meta clearfix">
        <?php sampression_entry_author() ?>
    </div>
    <div class="meta">
        <?php sampression_entry_category() ?>
    </div>
    <?php sampression_entry_tag() ?>
    <?php sampression_edit_post_link() ?>
</article>
<!--.post-->