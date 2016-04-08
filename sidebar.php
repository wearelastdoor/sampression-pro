<?php
$sidebar_position = 'sidebar-right';
if( is_archive() ) {
	$sidebar_position = 'sidebar-left';
}
if( get_theme_mod( 'home_sidebar' ) == 'left' ) {
	$sidebar_position = 'sidebar-left';
}
//columns three sidebar sidebar-left
?>
<aside class="columns three sidebar <?php echo $sidebar_position ?>">

    <?php dynamic_sidebar( 'primary-sidebar' ); ?>

</aside><!--#sidebar-->