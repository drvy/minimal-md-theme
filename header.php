<?php
/**
 * Theme Header
 *
 * Declares the HTML5 doc, contains header and main menu.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="wrap site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'minimal-md-theme' ); ?></a>

	<header id="header" class="mainHead">
		<?php
		wp_nav_menu(
			array(
				'container'      => 'nav',
				'theme_location' => 'header-menu',
				'depth'          => 1,
			)
		);
		?>
	</header>
