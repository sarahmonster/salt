<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Salt
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function salt_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'salt_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function salt_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'salt_pingback_header' );

/**
 * Check to see if a date is upcoming or not.
 * If the date matches today, we'll
 */
function salt_date_is_upcoming( $event_date ) {
	$today = time();
	if ( $event_date > $today ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Embed a video, using Jetpack shortcodes.
 * https://en.support.wordpress.com/videos/
 */
function salt_embed_video( $url ) {
	if ( strpos( $url, 'videopress' ) ) :
		// Get the video ID.
		$url_pieces = explode( '/', $url );
		$video_id = array_values(array_slice($url_pieces, -1))[0];
		echo do_shortcode( "[wpvideo $video_id]");
	elseif ( strpos( $url, 'youtu.be' ) ) :
		echo do_shortcode( "[youtube $url]");
	elseif ( strpos( $url, 'vimeo' ) ) :
		echo do_shortcode( "[vimeo $url]");
	endif;
}

/**
 * Numeric pagination!
 * Pinched more or less verbatim from https://www.binarymoon.co.uk/2013/10/wordpress-numeric-pagination/
 *
 * @global type $wp_query
 * @param type $pageCount
 * @param type $query
 * @return type
 */
function salt_numeric_pagination( $page_count = 3, $query = null ) {
	if ( null == $query ) {
		global $wp_query;
		$query = $wp_query;
	}
	// Return early if we only have one page.
	if ( 1 >= $query->max_num_pages ) {
		return;
	}
	echo '<div class="phoenix-numeric-pagination">';
	$big = 9999999999; // need an unlikely integer
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $query->max_num_pages,
		'end_size' => 0,
		'mid_size' => $page_count,
		'next_text' => '<span>Next page</span> &raquo;',
		'prev_text' => '&laquo; <span>Prev page</span>',
	) );
	echo '</div>';
}

/**
 * Increase the number of posts shown on talks archive page.
 */
function salt_archive_query( $query ) {
if ( $query->is_post_type_archive() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 100 );
    }
}
add_action( 'pre_get_posts', 'salt_archive_query' );
