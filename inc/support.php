<?php

defined('ABSPATH') || exit;


/**
 * Indicate what the theme supports
 */
add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', [
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption'
    ]);
});


/**
 * Register Supported Menus
 */
add_action('init', function () {
    register_nav_menus([
        'header-menu' => __('Header Menu', 'minimal-md-theme'),
        'footer-menu' => __('Footer Menu', 'minimal-md-theme')
    ]);
});
