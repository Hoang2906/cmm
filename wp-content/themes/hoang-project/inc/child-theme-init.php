<?php

/**
 * Child Theme Initialize
 *
 * @link       https://LUCKY.com
 * @since      1.0.0
 * @package    LUCKY_Theme
 * @author     LUCKY's Home
 */

// Prevent direct access.
if (!defined('ABSPATH')) exit;

/**
 * Class LUCKY_Theme
 */
class LUCKY_Theme
{
	/**
	 * Main instance
	 *
	 * @var LUCKY_Theme
	 */
	private static $instance;

	/**
	 * Theme environment
	 *
	 * @var string
	 */
	private $theme_environment;

	/**
	 * Get singleton instance
	 *
	 * @return LUCKY_Theme
	 */
	public final static function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Construct
	 */
	public function __construct()
	{
		$this->theme_environment = $this->is_localhost() ? '' : '.min';
		add_action('init', [$this, 'register_product_post_type'], 0);
		add_action('init', [$this, 'register_product_cat_taxonomy'], 0);
		add_action('wp_head', [$this, 'output_inline_styles'], 100);
		add_action('after_setup_theme', array($this, 'load_child_theme_language'), 99);
		add_action('wp_enqueue_scripts', array($this, 'load_assets'), 30);
		add_action('acf/init', [$this, 'my_acf_op_init']);
		add_action('generate_after_header', [$this, 'generate_section_header'], 10);
		add_action('generate_before_header_content', array($this, 'header_search_product'));
		add_action('acf/load_field/name=footer', array($this, 'footer_acf_load_field'));
		add_action('generate_before_footer_content', array($this, 'footer_content'));
		remove_action('generate_credits', 'generate_add_footer_info');
		add_action('admin_menu', [$this, 'add_usable_menu_page']);
	}

	/**
	 * Load child theme language
	 *
	 * @return void
	 */
	public function load_child_theme_language()
	{
		load_child_theme_textdomain('LUCKY-theme', get_stylesheet_directory() . '/languages');
	}

	/**
	 * Enqueue assets
	 *
	 * @return void
	 */
	public function load_assets()
	{
		if (!$this->is_localhost()) :
			wp_enqueue_style('child-theme-frontend-css', LUCKY_THEME_STYLESHEET_URI . '/css/frontend' . $this->theme_environment . '.css', array(), LUCKY_THEME_STYLESHEET_URI);
		endif;

		wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', [], '8.4.7');
		wp_enqueue_script('LUCKY-lazysizes', esc_url_raw(LUCKY_THEME_STYLESHEET_URI . '/vendor-assets/lazysizes.min.js'), [], '5.3.2', false);
		wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper.min.css', [], '9.1.0');
		wp_enqueue_script('child-theme-frontend-js', LUCKY_THEME_STYLESHEET_URI . '/js/frontend' . $this->theme_environment . '.js', array(), LUCKY_THEME_STYLESHEET_URI, true);
	}

	/**
	 * Check local environment
	 *
	 * @return bool
	 */
	public function is_localhost()
	{
		return !empty($_SERVER['HTTP_X_LUCKY_THEME_HEADER']) && $_SERVER['HTTP_X_LUCKY_THEME_HEADER'] === 'development';
	}
}

LUCKY_Theme::instance();
