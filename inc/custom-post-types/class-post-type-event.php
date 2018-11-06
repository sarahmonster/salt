<?php

/**
 * Event CPT
 *
 * @package phoenix
 */
class Phoenix_Post_Type_Event extends Phoenix_Post_Type {
	/**
	 * Name of the post type
	 *
	 * @var string
	 */
	protected $cpt_name = 'event';

	/**
	 * Create and register CPT
	 *
	 * @action init
	 * @return null
	 */
	public function create_post_type() {
		$cpt_args = array(
			'labels'              => array(
				'name'               => esc_html__( 'Events', 'phoenix' ),
				'singular_name'      => esc_html__( 'Event', 'phoenix' ),
				'add_new'            => esc_html_x( 'Add New Event', 'phoenix', 'phoenix' ),
				'add_new_item'       => esc_html__( 'Add New Event', 'phoenix' ),
				'edit_item'          => esc_html__( 'Edit Event', 'phoenix' ),
				'new_item'           => esc_html__( 'New Event', 'phoenix' ),
				'view_item'          => esc_html__( 'View Event', 'phoenix' ),
				'search_items'       => esc_html__( 'Search Events', 'phoenix' ),
				'not_found'          => esc_html__( 'No events found', 'phoenix' ),
				'not_found_in_trash' => esc_html__( 'No events found in Trash', 'phoenix' ),
				'parent_item_colon'  => esc_html__( 'Event:', 'phoenix' ),
				'menu_name'          => esc_html__( 'Events', 'phoenix' ),
			),
			'menu_icon'           => 'dashicons-calendar',
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'show_in_rest'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => 'talks',
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array(
				'with_front' => false,
				'slug'       => 'events',
			),
			'capability_type'     => 'post',
			'supports'            => array(
				'title',
				'thumbnail',
			),
		);
		register_post_type( $this->cpt_name, $cpt_args );
	}
}

Phoenix_Post_Type_Event::get_instance();
