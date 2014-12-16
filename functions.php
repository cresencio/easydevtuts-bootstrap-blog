<?php 

function bootstrap_blog_styles_and_scripts(){

	wp_enqueue_style( 'bootstrap-wordpress', get_template_directory_uri() . '/css/bootstrap-wordpress.css' );
	wp_enqueue_style( 'main', get_stylesheet_uri() );

}

add_action('wp_enqueue_scripts', 'bootstrap_blog_styles_and_scripts' );

register_nav_menu( 'main-menu', 'Main Menu' );

/**
 * Custom template tags for Twenty Fourteen
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! function_exists( 'bootblog_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function bootblog_pagination() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'bootstrap-blog' ),
		'next_text' => __( 'Next &rarr;', 'bootstrap-blog' ),
		'type'		=> 'list'
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		
			<?php echo $links; ?>
			
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

/**
* Creates our widgets areas
* @param string|array  Builds Sidebar based off of 'name' and 'id' values.
*/

function bootstrap_blog_widgets_init(){	

	//Default Sidebar

	register_sidebar( array(
		'name'          => __( 'Default Sidebar', 'bootstrap-blog' ),
		'id'            => 'default-sidebar',
		'description'   => 'This is the default sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-module %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );

	//Footer Widgets

	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'bootstrap-blog' ),
		'id'            => 'footer-widgets',
		'description'   => 'Widgets in this area will appear in the footer.',
		'before_widget' => '<div id="%1$s" class="col-md-4 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );

}

add_action( 'widgets_init', 'bootstrap_blog_widgets_init' );
