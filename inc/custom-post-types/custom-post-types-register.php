<?php
/**
 * Init/require CPTs
 *
 * @action after_theme_setup
 * @returns null
 */
function phoenix_post_types_init() {
	// General class
	require_once( get_template_directory() . '/inc/custom-post-types/class-post-type.php' );
	// Classes for individual CPTs
	require_once( get_template_directory() . '/inc/custom-post-types/class-post-type-event.php' );
}

add_action( 'after_setup_theme', 'phoenix_post_types_init' );
