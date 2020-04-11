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
	protected $parent;

	/**
	 * Load theme support on instance
	 *
	 * @return void
	 */
	public function construct( &$parent ) {
		$this->parent = &$parent;

		add_action( 'after_setup_theme', array( $this, 'setup_support' ) );
		add_action( 'after_setup_theme', array( $this, 'setup_menus' ) );
	}


	/**
	 * Register theme support.
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

	/**
	 * Register supported menus
	 *
	 * @return void
	 */
	public function setup_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu', 'minimal-md-theme' ),
				'footer-menu' => __( 'Footer Menu', 'minimal-md-theme' ),
			)
		);
	}
}
