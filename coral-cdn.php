<?php
include_once 'vendor/autoload.php';
/*
Plugin Name: Coral CDN
Plugin URI: http://wordpress.org/plugins/coralcdn/
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
	private $cdn = '.nyud.net';
	public $file_types;
	private $theme;
	private $theme_type;
	private $home_url;
	private $cdn_url;

	private function __construct() {
		$this->set_file_types(
			array(
				'images' => array( 'jpg', 'jpeg', 'gif', 'png', ),
				'text'   => array( 'css', 'js', ),
			)
		);
		add_action( 'after_setup_theme', array( $this, 'set_theme_type' ) );
		add_action( 'in_admin_footer', array( $this, 'admin_footer' ) );
		$this->theme    = wp_get_theme();
		$this->home_url = get_home_url();
		$this->set_cdn_url( $this->home_url . $this->cdn );
		$this->filterize();
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

	/**
	 * @return mixed
	 */
	public function get_theme() {
		return $this->theme->Name;
	}

	/**
	 * @return mixed
	 */
	public function get_theme_type() {
		return $this->theme_type;
	}

	/**
	 * @internal param mixed $theme_type
	 */
	public function set_theme_type() {
		$theme_type = 'parent';

		if ( is_child_theme() )
			$theme_type = 'child';

		$this->theme_type = $theme_type;
	}

	/**
	 * @return string
	 */
	public function get_cdn_url() {
		return $this->cdn_url;
	}

	/**
	 * @param string $cdn_url
	 */
	public function set_cdn_url( $cdn_url ) {
		$this->cdn_url = $cdn_url;
	}

	/**
	 * @param $content
	 *
	 * @return mixed
	 */
	function cdnize_content( $content ) {
		$content = str_ireplace( 'src="' . $this->home_url, 'src="' . $this->cdn_url, $content );
		$content = str_ireplace( "src='{$this->home_url}", "src='{$this->cdn_url}", $content );

		return $content;
	}

	/**
	 * @param $url
	 *
	 * @return mixed
	 */
	function cdnize_attachments( $url ) {
		$url = str_ireplace( $this->home_url, $this->cdn_url, $url );

		return $url;
	}

	private function filterize() {
		// String replacement for any images inside the authored content.
		add_filter( 'the_content', array( $this, 'cdnize_content' ) );

		// String replacement for uploaded images.
		add_filter( 'wp_get_attachment_url', array( $this, 'cdnize_attachments' ) );

		// Change the URL requested by bloginfo('url').
		//add_filter( 'bloginfo_url', array( $this, 'get_cdn_url' ) );

		// Change the URL throughout the site, e.g. links, meta, pages, etc.
		//add_filter( 'option_home', array( $this, 'get_cdn_url' ) );
	}

	function admin_footer() {
		$plugin_data = get_plugin_data( __FILE__ );
		printf( 'This site is faster when using %1$s Plugin | Version %2$s by %3$s<br />', $plugin_data['Title'], $plugin_data['Version'], $plugin_data['Author'] );
	}
}

$coral = Coral_CDN::get_instance();

ChromePhp::log( get_bloginfo( 'url' ) );
ChromePhp::info( get_home_url() );
ChromePhp::info( $coral->get_cdn_url() );