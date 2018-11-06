<?php
/**
 * Init Custom Taxonomies
 *
 * @action after_theme_setup
 * @returns null
 */
function phoenix_taxonomies_init() {
	// General class
	require_once( get_template_directory() . '/inc/custom-taxonomies/class-taxonomies.php' );
	// Classes for individual Taxonomies
	require_once( get_template_directory() . '/inc/custom-taxonomies/class-taxonomies-event.php' );
}

add_action( 'after_setup_theme', 'phoenix_taxonomies_init' );
