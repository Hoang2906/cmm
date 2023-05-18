<?php

/**
 * Main functions
 *
 * @link       https://hoang-project
 * @since      1.0.0
 * @package    GeneratePress
 * @author    hoang2906
 */

if (!defined('ABSPATH')) exit;

define('LUCKY_THEME_STYLESHEET_URI', get_stylesheet_directory_uri());
define('LUCKY_THEME_INCLUDES_DIR', get_stylesheet_directory() . '/inc');
define('LUCKY_THEME_ASSETS_URI', LUCKY_THEME_STYLESHEET_URI . '/assets');
define('LUCKY_THEME_VERSION', wp_get_theme(get_template())->get('Version'));

add_action('after_setup_theme', 'load_dependencies');

/**
 * Load child theme dependencies
 *
 * @return void
 */
function load_dependencies()
{
    require_once LUCKY_THEME_INCLUDES_DIR . '/child-theme-init.php';
    include_once LUCKY_THEME_INCLUDES_DIR . '/global/shortcodes.php';
}
