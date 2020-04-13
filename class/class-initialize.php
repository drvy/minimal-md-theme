<?php
/**
 * Class to initialize the theme.
 *
 * Indicates to WordPress what features does this theme support, registers
 * other utilities such as menus, enqueues styles and scripts.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since Minimal MD Theme 1.0
 */

namespace MinimalMDTheme;

class Initialize {
	private $parent;

	/**
	 * Load theme support on instance
	 *
	 * @return void
	 */
	public function __construct( Minimal_MD_Theme &$parent ) {
		$this->parent = &$parent;
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
	}


	/**
	 * Execute after_setup_theme related hooks
	 *
	 * @return void
	 */
	public function after_setup_theme(): void {
		$this->setup_support();
		$this->setup_menus();
	}


	/**
	 * Register theme support.
	 *
	 * @return void
	 */
	public function setup_support(): void {
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
	public function setup_menus(): void {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu', 'minimal-md-theme' ),
				'footer-menu' => __( 'Footer Menu', 'minimal-md-theme' ),
			)
		);
	}
}
