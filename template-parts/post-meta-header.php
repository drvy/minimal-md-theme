<?php
/**
 * Post meta (date, author, etc) template.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
use MinimalMDTheme\Minimal_MD_Theme as Theme;

//$metas = Main::get( 'Post' )->listing_meta();
$metas = array( 'lecture-time', 'date' );

foreach ( $metas as $meta ) {
	echo '<span class="post-meta__' . esc_attr( $meta ) . '">';
	switch ( $meta ) {
		case 'lecture-time':
			break;

		case 'date':
			Theme::get( 'Icons' )->e( 'date' );
			the_date();
			break;
	}
	echo '</span>';
}
