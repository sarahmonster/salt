<?php
/**
 * Init/require Custom Fields
 *
 * @action after_theme_setup
 * @returns null
 */
function phoenix_fields_init() {
	// General class
	require_once( get_template_directory() . '/inc/custom-fields/class-fields.php' );
	// Classes for individual Taxonomies
	require_once( get_template_directory() . '/inc/custom-fields/class-fields-event.php' );
}

add_action( 'after_setup_theme', 'phoenix_fields_init' );
