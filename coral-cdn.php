<?php
/*
Plugin Name: Coral CDN
Plugin URI: http://morganestes.me/coral-cdn
Description: Use the free peer CDN from Coral to speed up your website.
Version: 1.0.1
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
	private $cdn = '.nyud.net';
	private $home_url;
	private $cdn_url;

	/**
	 * Constructor to initialize the class and fire off events.
	 */
	private function __construct() {
		$this->home_url = get_home_url();
		$this->set_cdn_url( $this->home_url . $this->cdn );
		$this->filterize();
	}

	protected function __clone() {
		// do nothing
	}

	/**
	 * Singleton to instantiate the class just one time.
	 *
	 * @return Coral_CDN
	 */
	public static function get_instance() {
		if ( !self::$instance )
			self::$instance = new Coral_CDN();

		return self::$instance;
	}

	/**
	 *
	 *
	 * @return string
	 */
	public function get_cdn_url() {
		return $this->cdn_url;
	}

	/**
	 *
	 *
	 * @param string $cdn_url
	 */
	public function set_cdn_url( $cdn_url ) {
		$this->cdn_url = $cdn_url;
	}

	/**
	 *
	 *
	 * @param unknown $content
	 *
	 * @return mixed
	 */
	function cdnize_content( $content ) {
		$content = str_ireplace( 'src="' . $this->home_url, 'src="' . $this->cdn_url, $content );
		$content = str_ireplace( "src='{$this->home_url}", "src='{$this->cdn_url}", $content );

		return $content;
	}

	/**
	 *
	 *
	 * @param string $url
	 *
	 * @return mixed
	 */
	function cdnize_attachments( $url ) {
		$url = str_ireplace( $this->home_url, $this->cdn_url, $url );

		return $url;
	}

	/**
	 * Filter {@link the_content()} for potential replacement on the fly.
	 */
	function filterize() {
		// String replacement for any images inside the authored content.
		add_filter( 'the_content', array( $this, 'cdnize_content' ) );

		// String replacement for uploaded images.
		add_filter( 'wp_get_attachment_url', array( $this, 'cdnize_attachments' ) );
	}

	/**
	 * Sets the value of instance.
	 *
	 * @param mixed $instance the instance
	 */
	public function set_instance( $instance ) {
		$this->instance = $instance;
	}

	/**
	 * Gets the value of home_url.
	 *
	 * @return mixed
	 */
	public function get_home_url() {
		return $this->home_url;
	}

	/**
	 * Sets the value of home_url.
	 *
	 * @param mixed $home_url the home_url
	 */
	public function set_home_url( $home_url ) {
		$this->home_url = $home_url;
	}
}

$coral = Coral_CDN::get_instance();
