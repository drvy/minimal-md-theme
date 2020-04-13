<?php
/**
 * Enqueues Class.
 *
 * Gives the ability to enqueue scripts and styles in an array friendly way.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since Minimal MD Theme 1.0
 */

namespace MinimalMDTheme;

class Enqueues {

	public function construct( &$parent ) {
	}

	/**
	 * Enqueue scripts to WP.
	 *
	 * Arguments are supplied as an array. Check enqueue_file for overview.
	 *
	 * @param array $scripts
	 * @return void
	 */
	public static function enqueue_js( array $scripts ): void {
		foreach ( $scripts as $handle => $script ) {
			self::enqueue_file( $handle, $script, 'script' );
		}
	}


	/**
	 * Enqueue styles to WP.
	 *
	 * Arguments are supplied as an array. Check enqueue_file for overview.
	 *
	 * @param array $styles
	 * @return void
	 */
	public static function enqueue_css( array $styles ): void {
		foreach ( $styles as $handle => $style ) {
			self::enqueue_file( $handle, $style, 'style' );
		}
	}


	/**
	 * Check if a given file source is remote.
	 *
	 * @param string $source
	 * @return boolean
	 */
	protected static function is_remote( string $source ): bool {
		$remote = apply_filters(
			__NAMESPACE__ . 'remote_protocols',
			array( 'https://', 'http://', '//' )
		);

		foreach ( $remote as $protocol ) {
			if ( substr( $source, 0, strlen( $protocol ) ) === $protocol ) {
				return true;
			}
		}

		return false;
	}


	/**
	 * Enqueue WordPress scripts and styles.
	 *
	 * @param string $handle
	 * @param string $file
	 * @param string $type
	 * @return void
	 */
	private static function enqueue_file( string $handle, string $file, string $type ): void {
		if ( empty( $file['src'] ) ) {
			throw new \Exception( 'Attempting to enqueue empty file!' );
		}

		$src = $file['src'];

		if ( ! self::is_remote( $src ) ) {
			$src = untrailingslashit( get_stylesheet_directory_uri() ) . $src;
		}

		$require = ( isset( $file['require'] ) ? $file['require'] : null );
		$version = ( isset( $file['version'] ) ? $file['version'] : null );

		if ( 'script' === $type || 'js' === $type ) {
			$footer = ( isset( $file['footer'] ) ? $file['footer'] : null );
			wp_enqueue_script( $handle, $src, $require, $version, $footer );

			if ( isset( $file['localize'] ) && is_array( $file['localize'] ) ) {
				foreach ( $file['localize'] as $var => $data ) {
					wp_localize_script( $handle, $var, $data );
				}
			}
		} elseif ( 'style' === $type || 'css' === $type ) {
			$media = ( isset( $file['media'] ) ? $file['media'] : null );
			wp_enqueue_style( $handle, $src, $require, $version, $media );
		}
	}
}
