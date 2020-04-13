<?php
/**
 * Functions and definitions
 *
 * Requires necessary files and other definitions.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

require_once 'class/class-minimal-md-theme.php';
MinimalMDTheme\Minimal_MD_Theme::get_instance();
