<?php
/**
 * Template part for displaying Video post format
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
        echo sampression_has_embed();
        ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression' ) . '</span>', 'after' => '</div>' ) ); ?>
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