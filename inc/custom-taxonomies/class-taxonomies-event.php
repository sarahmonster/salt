<?php

/**
 * Shared Taxonomies
 *
 * @package phoenix
 */
class Phoenix_Taxonomies_Shared extends Phoenix_Taxonomies {
	/**
	 * Name of the post type(s) the taxonomy group is attached to
	 *
	 * @var array
	 */
	protected $post_types = array( 'event' );

	/**
	 * Create and register Taxonomies
	 *
	 * @action init
	 * @return null
	 */
	public function create_taxonomies() {
		// Talks
		$talk_labels = array(
			'name'                       => esc_html_x( 'Talk', 'Taxonomy General Name', 'phoenix' ),
			'singular_name'              => esc_html_x( 'Talk', 'Taxonomy Singular Name', 'phoenix' ),
			'menu_name'                  => esc_html__( 'Talks', 'phoenix' ),
			'all_items'                  => esc_html__( 'All Talks', 'phoenix' ),
			'new_item_name'              => esc_html__( 'New Talk', 'phoenix' ),
			'add_new_item'               => esc_html__( 'Add New Talk', 'phoenix' ),
			'edit_item'                  => esc_html__( 'Edit Talk', 'phoenix' ),
			'update_item'                => esc_html__( 'Update Talk', 'phoenix' ),
			'view_item'                  => esc_html__( 'View Talk', 'phoenix' ),
			'separate_items_with_commas' => esc_html__( '', 'phoenix' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'phoenix' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'phoenix' ),
			'popular_items'              => esc_html__( 'Popular Talks', 'phoenix' ),
			'search_items'               => esc_html__( 'Search Talks', 'phoenix' ),
			'not_found'                  => esc_html__( 'Not Found', 'phoenix' ),
			'no_terms'                   => esc_html__( 'No items', 'phoenix' ),
			'items_list'                 => esc_html__( 'Talks list', 'phoenix' ),
			'items_list_navigation'      => esc_html__( 'Talks list navigation', 'phoenix' ),
		);
		$talk_args   = array(
			'labels'            => $talk_labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_in_rest'      => true,
			'show_tagcloud'     => false,
		);
		register_taxonomy( 'talks', $this->post_types, $talk_args );
	}
}

Phoenix_Taxonomies_Shared::get_instance();
