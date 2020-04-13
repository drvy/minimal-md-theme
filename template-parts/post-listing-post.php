<?php
/**
 * Post listing template.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<article>
	<header>
		<h2 class="md-h">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<?php get_template_part( 'template-parts/post-meta', 'header' ); ?>
	</header>
</article>
