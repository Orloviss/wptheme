<?php

/**
 * wptheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wptheme
 */

if (! defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function wptheme_setup()
{
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		*/
	add_theme_support('title-tag');

	add_theme_support('post-thumbnails');


	function wptheme_register_menus()
	{
		register_nav_menus(
			array(
				'header-menu' => esc_html__('Header Menu', 'wptheme'),
				'footer-menu' => esc_html__('Footer Menu', 'wptheme'),
			)
		);
	}
	add_action('after_setup_theme', 'wptheme_register_menus');


	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);


	/**
	 * Add support for core custom logo.
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'wptheme_setup');



/**
 * Enqueue scripts and styles.
 */
function wptheme_scripts()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('wptheme-swiper-js', get_template_directory_uri() . '/js/swiper.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('wptheme-main-js', get_template_directory_uri() . '/js/main.js', array('jquery', 'wptheme-swiper-js'), _S_VERSION, true);
	wp_enqueue_script('inputmask-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6-beta.29/jquery.inputmask.min.js', array('jquery'), null, true);
	wp_enqueue_script('lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), null, true);
	wp_enqueue_style('wptheme-normalise', get_template_directory_uri() . '/css/normalise.css', array(), _S_VERSION, 'all');
	wp_enqueue_style('wptheme-swiper', get_template_directory_uri() . '/css/swiper.css', array('wptheme-normalise'), _S_VERSION, 'all');
	wp_enqueue_style('wptheme-main', get_template_directory_uri() . '/css/style.css', array('wptheme-normalise', 'wptheme-swiper'), _S_VERSION, 'all');
	wp_enqueue_style('lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', array(), null, 'all');
}
add_action('wp_enqueue_scripts', 'wptheme_scripts');


// Подключение твиков админки
if (is_admin()) {
	$admin_file = get_stylesheet_directory() . '/inc/admin.php';
	if (file_exists($admin_file)) {
		require_once $admin_file;
	}
}
