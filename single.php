<?php
/**
 * The template for displaying all posts.
 * @package Sampression
 */

get_header(); ?>
<?php
/* wp_list_categories(
    array(
        'title_li' => '',
        'walker' => new Sampression_Categories_Walk
    )
);

class Sampression_Categories_Walk extends Walker_Category {

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
    	$depth++;
        $indent = str_repeat("-", $depth);
        $output .= "";//"$indent";
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$depth++;
        $indent = str_repeat("-", $depth);
		$output .= "";//"$indent";
	}

	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		$cat_name = apply_filters(
			'list_cats',
			esc_attr( $category->name ),
			$category
		);
		if ( ! $cat_name ) {
			return;
		}
		$indent = str_repeat("- ", $depth);
		$output .= "$indent$cat_name\n";
	}

	public function end_el( &$output, $page, $depth = 0, $args = array() ) {
		$output .= "";
	}

}
echo PHP_EOL; */
?>
<div id="content-wrapper">
    <div class="container">
        <section id="content" class="columns nine" role="main">
        	<?php while ( have_posts() ) : the_post(); ?>
	            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                <?php if( has_post_thumbnail() ) { ?>
		                <div class="featured-img">
		                    <?php the_post_thumbnail(); ?>
		             	</div>
		                <!-- .featured-img -->
	                <?php } ?>
	                <header class="post-header">
	                    <h2 class="post-title"><?php the_title() ?></h2>
	                </header>
	                
	                	<?php
	                	sampression_post_entry_meta_single();
	                	// sampression_entry_date();
	                	// sampression_entry_author();
	                	// sampression_entry_category();
	                	// sampression_entry_tag();
	                	?>
	                
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