<?php
/*
Plugin Name: Coral CDN
Plugin URI: http://morganestes.me/coral-cdn
Description: Use the free peer CDN from Coral to speed up your website.
Version: 0.1.0
Author: Morgan Estes
Author URI: http://morganestes.me
License: GPLv3
*/

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

$coral = Coral_CDN::get_instance();

include_once "vendor/autoload.php";
ChromePhp::log( 'Hello console!' );
ChromePhp::log( $coral->file_types );
