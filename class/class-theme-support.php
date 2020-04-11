<?php
/**
 * Theme support setup Class.
 *
 * Indicates to WordPress what features does this theme support.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since Minimal MD Theme 1.0
 */

namespace MinimalMDTheme;

class Theme_Support {
	private $supports = array(
		'post-thumbnails',
		'custom-logo',
		'html5' => array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
		),
	);

	/**
	 * Load theme support on instance
	 *
	 * @return void
	 */
	public function construct() {
		add_action( 'after_setup_theme', array( $this, 'setup_support' ) );
	}


	/**
	 * Get theme support and indicate it to WordPress.
	 *
	 * @return void
	 */
	public function setup_support() {
		foreach ( $this->supports as $key => $value ) {
			add_theme_support( $key, $value );
		}
	}
}
