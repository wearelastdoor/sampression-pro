<?php
/**
 * Template part for displaying Aside posts format
 *
 * @package Sampression
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if(get_the_excerpt() != '') {
        ?>
        <div class="entry clearfix">
            <?php the_excerpt(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression' ) . '</span>', 'after' => '</div>' ) ); ?>
        </div>
        <!-- .entry -->
    <?php
    }
    ?>
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