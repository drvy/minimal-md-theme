<?php
/**
 * Support functions for the theme
 *
 * Adds supported functionality, registers menus and other support related
 * functions.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mmt_after_setup_theme' ) ) {
	/**
	 * Indicate theme support.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function mmt_add_theme_support() {
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

	add_action( 'after_setup_theme', 'mmt_add_theme_support' );
}


if ( ! function_exists( 'mmt_register_menus' ) ) {
	/**
	 * Register theme supported menus
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function mmt_register_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu', 'minimal-md-theme' ),
				'footer-menu' => __( 'Footer Menu', 'minimal-md-theme' ),
			)
		);
	}
}
