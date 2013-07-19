<?php
/**
 * class-coral-cdn.php
 *
 * @author  morganestes
 * @package WP Dev
 */

namespace Coral;


/**
 * Class Coral_CDN
 *
 * @package WordPress\Coral
 */
class Coral_CDN {

	private static $instance;
	public $cdn = 'nyud.net';
	public $file_types;

	private function __construct() {
		self::set_file_types( array( 'jpg', 'jpeg', 'gif', 'png', 'css', 'js' ) );

	}

	/**
	 * Singleton to instantiate the class just one time.
	 *
	 * @return Coral_CDN
	 */
	public static function get_instance() {
		if ( ! self::$instance )
			self::$instance = new Coral_CDN();

		return self::$instance;
	}

	/**
	 * @return array
	 */
	public function get_file_types() {
		return $this->file_types;
	}

	/**
	 * @param array $file_types
	 */
	public function set_file_types( $file_types ) {
		$this->file_types = $file_types;
	}

}

