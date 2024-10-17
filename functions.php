<?php
/**
 * wptheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wptheme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wptheme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wptheme, use a find and replace
		* to change 'wptheme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wptheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wptheme' ),
		)
	);

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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wptheme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
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
add_action( 'after_setup_theme', 'wptheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wptheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wptheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'wptheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wptheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wptheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wptheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wptheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wptheme_scripts() {
	wp_enqueue_style( 'wptheme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wptheme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wptheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'remont-navigationmain', get_template_directory_uri() . '/js/swiper.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'remont-navigationswiper', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );
	wp_enqueue_style( 'remont-navigations', get_template_directory_uri() . '/css/normalise.css' );
	wp_enqueue_style( 'remont-navigationswipercss', get_template_directory_uri() . '/css/swiper.css' );
	wp_enqueue_style( 'remont-navigation', get_template_directory_uri() . '/css/style.css' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wptheme_scripts' );

/**
 * Svg support
 */

function allow_svg_uploads( $mime_types ) {
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter( 'upload_mimes', 'allow_svg_uploads' );


function sanitize_svg_file( $file ) {
    if ( 'image/svg+xml' === $file['type'] ) {
        // Get SVG content
        $svg_content = file_get_contents( $file['tmp_name'] );

        // Use SVG Sanitizer
        require_once ABSPATH . 'vendor/autoload.php';
        $sanitizer = new \enshrined\svgSanitize\Sanitizer();
        $clean_svg = $sanitizer->sanitize( $svg_content );

        if ( $clean_svg ) {
            // Write sanitized content back to file
            file_put_contents( $file['tmp_name'], $clean_svg );
        } else {
            // If sanitization fails, return an error
            $file['error'] = __( 'Sorry, the SVG file could not be sanitized.' );
        }
    }
    return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'sanitize_svg_file' );

function restrict_svg_uploads_to_admins( $mime_types ) {
    if ( ! current_user_can( 'administrator' ) ) {
        unset( $mime_types['svg'] );
    }
    return $mime_types;
}
add_filter( 'upload_mimes', 'restrict_svg_uploads_to_admins' );