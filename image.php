<?php
/**
 * The template for displaying image
 * @package Sampression
 */

get_header(); ?>
<div id="content-wrapper">
    <div class="container">
        <section id="content" class="columns nine" role="main">
        	<?php while ( have_posts() ) : the_post(); ?>
	            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	            	<header class="post-header">
	                    <h2 class="post-title"><?php the_title() ?></h2>
	                </header>
	                <div class="featured-img">
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
	             	</div>
		                <!-- .featured-img -->
	                <nav id="nav-below" class="post-navigation clearfix">
                        <div class="nav-previous alignleft"><?php previous_image_link(false, __('<span class="meta-nav">&larr;</span> Previous Image', 'sampression')); ?></div>
                        <div class="nav-next alignright"><?php next_image_link(false, __('Next Image <span class="meta-nav">&rarr;</span>', 'sampression')); ?></div>
                    </nav><!-- #nav-above -->
	                <div class="meta clearfix">
	                	<?php
	                	sampression_entry_date();
	                	sampression_entry_author();
	                	sampression_entry_category();
	                	sampression_entry_tag();
	                	?>
	                </div>
	                <!-- .meta -->
	                <div class="entry clearfix">
	                	<?php
	            		the_content();
	            		wp_link_pages(
	            			array(
	            				'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression' ) . '</span>',
	            				'after' => '</div>'
	        				)
	    				);
	                	sampression_edit_post_link();
	                	?>
	                </div>

	            </article>
            <?php
            comments_template();
            endwhile;
            ?>
        </section>
        <!-- #content -->

        <?php get_sidebar(); ?>
    </div>
</div>
<!-- #content-wrapper -->
<?php get_footer(); ?>