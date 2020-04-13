<?php
/**
 * The main template file
 *
 * Most generic file in a WP Theme.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="site-content" role="main">
	<?php

	if ( is_search() ) {
		get_template_part( 'template-parts/basics', 'search' );
	} elseif ( ! is_home() ) {
		get_template_part( 'template-parts/basics', 'archive' );
	} else {
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();

				get_template_part(
					'template-parts/post-listing',
					get_post_type()
				);
			}

			get_template_part( 'template-parts/pagination' );
		}
	}

	?>
</main>

<?php
get_footer();
