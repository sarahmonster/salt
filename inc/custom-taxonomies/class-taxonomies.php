<?php

/**
 * Abstract Singleton class for Custom Taxonomy inheritance
 *
 * This class creates the structure used by it's child (custom taxonomies) classes
 */
abstract class Phoenix_Taxonomies {
	/**
	 * Instances of this class
	 *
	 * Used by sub-classes to track instances
	 *
	 * @var array
	 */
	private static $__instances = array();
	/**
	 * Name of the post type(s) the taxonomy is attached to
	 *
	 * Set to null but overridden by sub-classes to generate field groups
	 *
	 * @var array
	 */
	protected $post_types = null;

	/**
	 * Creates an instance of this class
	 *
	 * @return Phoenix_Taxonomies (or sub-class instance, in this case)
	 */
	public static function get_instance() {
		$class = get_called_class();
		if ( ! array_key_exists( $class, self::$__instances ) ) {
			self::$__instances[ $class ] = new $class();
		}

		return self::$__instances[ $class ];
	}

	/**
	 * Initializes the taxonomy group by running the create_fields function from the
	 * sub-classes in the init hook.
	 *
	 * Note that the constructor for this class (and sub-classes) relies on
	 * the Singleton Pattern - https://code.tutsplus.com/articles/design-patterns-in-wordpress-the-singleton-pattern--wp-31621
	 */
	private function __construct() {
		// Create the post type
		add_action( 'init', array( $this, 'create_taxonomies' ) );
	}

	/**
	 * Creates/defines taxonomy group labels and arguments
	 *
	 * Note: Because this is an Abstract parent class, this method must be defined in all child classes.
	 */
	abstract public function create_taxonomies();
}
