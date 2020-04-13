<?php
/**
 * Collection of SVG icons and related functionality.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since Minimal MD Theme 1.0
 */

namespace MinimalMDTheme;

class SVG_Icons {

	public function __construct( &$parent ) {
	}


	/**
	 * Outputs (echo) an SVG icon.
	 *
	 * @param string $name
	 * @return void
	 */
	public function e( string $name ): void {
		echo $this->get( $name ); // phpcs:ignore
	}


	/**
	 * Returns an SVG icon from a hard-coded collection.
	 *
	 * @param string $name
	 * @return string
	 */
	public function get( string $name ): string {
		switch ( $name ) {
			case 'timelapse':
				return '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M6 2h12v6l-4 4l4 4v6H6v-6l4-4l-4-4V2m10 14.5l-4-4l-4 4V20h8v-3.5m-4-5l4-4V4H8v3.5l4 4M10 6h4v.75l-2 2l-2-2V6z" fill="#626262"/><rect x="0" y="0" width="24" height="24" fill="rgba(0, 0, 0, 0)" /></svg>';

			case 'date':
				return '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="vertical-align: -0.125em;-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h5v-2H5V8h14v1h2V5a2 2 0 0 0-2-2m2.7 10.35l-1 1l-2.05-2l1-1c.2-.21.54-.22.77 0l1.28 1.28c.19.2.19.52 0 .72M12 18.94l6.07-6.06l2.05 2L14.06 21H12v-2.06z" fill="#626262"/><rect x="0" y="0" width="24" height="24" fill="rgba(0, 0, 0, 0)" /></svg>';
		}
	}
}
