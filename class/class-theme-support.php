<?php
/**
 * Theme support setup Class.
 *
 * Indicates to WordPress what features does this theme support and registers
 * other utilities such as menus.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since Minimal MD Theme 1.0
 */

namespace MinimalMDTheme;

class Theme_Support {
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
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo' );
		add_theme_support(
			'html5',
			array(
				'comment-list',
				'comment-form',
				'search-form',
				'gallery',
				'caption',
			)
		);
	}
}
