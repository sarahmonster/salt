<?php
/**
 * SVG icon functionality.
 *
 * This makes it easier for us to get up and running with SVG icons, without
 * doing a lot of extra work or adjusting our templates.
 *
 * Currently using the <symbol> method of insertion, YMMV.
 */
$salt_sprite_external = true;
/*
 * Inject our SVG sprite at the bottom of the page.
 *
 * There is a possibility that this will cause issues with
 * older versions of Chrome. In which case, it may be
 * necessary to inject just after the </head> tag.
 * See: https://code.google.com/p/chromium/issues/detail?id=349175
 *
 * This function currently is only used when we're not using the external method of insertion.
 */
function salt_inject_sprite() {
	global $salt_sprite_external;
	if ( ! $salt_sprite_external ) :
		include_once( get_template_directory() .'/assets/svg/icons.svg' );
	endif;
}
add_filter( 'wp_footer' , 'salt_inject_sprite' );

/*
 * Implement svg4everybody in order to better support external sprite references
 * on IE8-10. For lower versions, we need an older copy of the script.
 * https://github.com/jonathantneal/svg4everybody
 */
function salt_svg_scripts() {
	global $salt_sprite_external;

	/*
	 * Implement svg4everybody in order to better support external sprite references
	 * on IE8-10. For lower versions, we need an older copy of the script.
	 * https://github.com/jonathantneal/svg4everybody
	 */
	if ( $salt_sprite_external ) :
		wp_enqueue_script( 'salt-svg4everybody', get_template_directory_uri() . '/assets/js/svg4everybody.js', array(), '20160222', false );
	endif;

	/*
	 * Enqueue a script to dynamically insert SVG references in front of Sharedaddy links.
	 * We need to do this unless there's a good way to filter the Sharedaddy output via PHP.
	 * @todo: Pass the SVG code, with variable placeholders, to Javascript directly.
	 */
	if ( function_exists( 'wpcom_is_vip' ) ) :
 		$svg_options = array( 'path' => esc_url( wpcom_vip_noncdn_uri( get_template_directory() ) ) );
 	else :
 		$svg_options = array( 'path' => esc_url( get_template_directory_uri() ) );
 	endif;

	// Register, localise, and enqueue the script.
	wp_register_script( 'salt-svg', get_template_directory_uri() . '/assets/js/sharedaddy-svg.js', array( 'jquery' ), '20160316', true );
	wp_localize_script( 'salt-svg', 'svg_options', $svg_options );
	wp_enqueue_script( 'salt-svg' );
}
add_action( 'wp_enqueue_scripts', 'salt_svg_scripts' );

/*
 * Inject some header code to make IE play nice.
 *
 * This seems to do the trick, but may require more testing.
 * See: https://github.com/jonathantneal/svg4everybody
 */
function salt_svg4everybody() {
	global $salt_sprite_external;
	if ( $salt_sprite_external ) :
		echo '<meta http-equiv="x-ua-compatible" content="ie=edge">';
		echo '<script type="text/javascript">svg4everybody();</script>';
	endif;
}
add_action( 'wp_head', 'salt_svg4everybody', 20 );

/**
 * This allows us to get the SVG code and return as a variable
 * Usage: salt_get_icon( 'name-of-icon' );
 */
function salt_get_icon( $name, $id = null ) {
	global $salt_sprite_external;
	$attr = 'class="salt-icon salt-icon-' . $name . '"';
	if ( $id ) :
		$attr .= 'id="' . $id . '"';
	endif;
	$return = '<svg '. $attr.'>';
	if ( $salt_sprite_external ) :
		if ( function_exists( 'wpcom_is_vip' ) ) :
			$path = wpcom_vip_noncdn_uri( get_template_directory() );
		else :
			$path = get_template_directory_uri();
		endif;
		$return .= '<use xlink:href="' . esc_url( $path ) . '/assets/svg/icons.svg#' . $name . '" />';
	else :
		$return .= '<use xlink:href="#' . $name . '" />';
	endif;
	$return .= '</svg>';
 return $return;
}
/*
 * This allows for easy injection of SVG references inline.
 * Usage: salt_icon( 'name-of-icon' );
 */
function salt_icon( $name, $id = null ) {
	echo salt_get_icon( $name, $id );
}
/*
 * Filter our navigation menus to look for social media links.
 * When we find a match, we'll hide the text and instead show an SVG icon.
 */
function salt_social_menu( $items ) {
	foreach ( $items as $item ) :
		$subject = $item->url;
		$feed_pattern = '/\/feed\/?/i';
		$mail_pattern = '/mailto/i';
		$skype_pattern = '/skype/i';
		$google_pattern = '/plus.google.com/i';
		$domain_pattern = '/([a-z]*)(\.com|\.org|\.io|\.tv|\.co)/i';
		$domains = array( 'codepen', 'digg', 'dribbble', 'dropbox', 'facebook', 'flickr', 'foursquare', 'github', 'instagram', 'linkedin', 'path', 'pinterest', 'getpocket', 'polldaddy', 'reddit', 'spotify', 'stumbleupon', 'tumblr', 'twitch', 'twitter', 'vimeo', 'vine', 'youtube' );

		// Match feed URLs
		if ( preg_match( $feed_pattern, $subject, $matches ) ) :
			$icon = salt_get_icon( 'feed' );
		// Match a mailto link
		elseif ( preg_match( $mail_pattern, $subject, $matches ) ) :
			$icon = salt_get_icon( 'mail' );
		// Match a Skype link
		elseif ( preg_match( $skype_pattern, $subject, $matches ) ) :
			$icon = salt_get_icon( 'skype' );
		// Match a Google+ link
		elseif ( preg_match( $google_pattern, $subject, $matches ) ) :
			$icon = salt_get_icon( 'google-plus' );
		// Match various domains
		elseif ( preg_match( $domain_pattern, $subject, $matches ) && in_array( $matches[1], $domains ) ) :
			$icon = salt_get_icon( $matches[1] );
		endif;
		// If we've found an icon, hide the text and inject an SVG
		if ( isset( $icon ) ) {
			$item->title = $icon . '<span class="screen-reader-text">' . $item->title . '</span>';
		}
	endforeach;
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'salt_social_menu' );

/*
 * Register a custom shortcode to allow users to insert SVGs.
 * This is used to insert a regular inline SVG.
 * Usage: [svg file="filename"]
 */
function salt_svg_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
    'file' => '',
	), $atts );
	$file = get_template_directory_uri() . '/assets/svg/'.$a['file'].'.svg';
	if ( function_exists( 'wpcom_is_vip' ) ) :
		return wpcom_vip_file_get_contents( esc_url( $file ) );
	else :
		return file_get_contents( esc_url( $file ) );
	endif;
}
add_shortcode( 'salt-svg', 'salt_svg_shortcode' );

/*
 * Register a custom shortcode to allow users to insert SVG icons.
 * This is used to insert SVG icons using the salt_get_icon function.
 * Usage: [svg-icon name="name" id="id"]
 */
function salt_svg_icon_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
    'name' => '',
	 'id'   => '',
	), $atts );
	return salt_get_icon( $a['name'], $a['id'] );
}
add_shortcode( 'salt-icon', 'salt_svg_icon_shortcode' );
