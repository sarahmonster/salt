<?php

/**
 * Project CPT Custom Fields
 *
 * @package phoenix
 */
class Phoenix_Project_Fields extends Phoenix_Fields {
	/**
	 * Name of the post type(s) for fields to be applied
	 *
	 * @var array
	 */
	protected $post_type = 'event';

	/**
	 * Create and register custom fields
	 *
	 * @action init
	 * @return null
	 */
	public function create_fields() {
		$event_fields = new Fieldmanager_Group( array(
			'name'           => 'event_details',
			'serialize_data' => 'false',
			'children'       => array(
				'date' => new Fieldmanager_Datepicker( array(
					'name'  => 'date',
					'label' => esc_html__( 'Date', 'phoenix' ),
				) ),
				'location' => new Fieldmanager_TextField( array(
					'name'  => 'location',
					'label' => esc_html__( 'Location', 'phoenix' ),
				) ),
				'link' => new Fieldmanager_Link( array(
					'name'  => 'link',
					'label' => esc_html__( 'Link to information', 'phoenix' ),
				) ),
				'slides' => new Fieldmanager_Link( array(
					'name'  => 'slides',
					'label' => esc_html__( 'Link to slides', 'phoenix' ),
				) ),
				'video' => new Fieldmanager_Link( array(
					'name' => 'video',
					'label' => esc_html__( 'Link to video', 'phoenix' ),
				) ),
			),
		) );
		$event_fields->add_meta_box( esc_html__( 'Event Details', 'phoenix' ), $this->post_type );
	}
}

Phoenix_Project_Fields::get_instance();
