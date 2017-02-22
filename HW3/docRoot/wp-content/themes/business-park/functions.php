<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business_Park
 */


if ( ! function_exists( 'business_park_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function business_park_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'business-park' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'business-park', get_template_directory() . '/languages' );

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
	set_post_thumbnail_size( 600, 300, true );

	add_image_size( 'business-park-portfolio', 1000, 750, true );
	add_image_size( 'business-park-about', 500, 250, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top'    => esc_html__( 'Top', 'business-park' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'business_park_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.min.css' ) );

	add_theme_support( 'custom-logo', array(
		'height'      => 70,
		'width'       => 120,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	// Declare woocommerce support
	add_theme_support( 'woocommerce' );
}
endif;
add_action( 'after_setup_theme', 'business_park_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_park_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'business_park_content_width', 640 );
}
add_action( 'after_setup_theme', 'business_park_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_park_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'business-park' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	for ($i=1; $i <= 3 ; $i++) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer %s', 'business-park' ), $i ),
			'id'            => 'footer-'.$i,
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget-wrap %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'business_park_widgets_init' );


if ( ! function_exists( 'business_park_fonts_url' ) ) :
/**
 * Register Google fonts for Business Park
 *
 * Create your own business_park_fonts_url() function to override in a child theme.
 *
 * @since Business Park 1.0.0
 *
 * @return string Google fonts URL for the theme.
 */
function business_park_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Alegreya Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Alegreya font: on or off', 'business-park' ) ) {
		$fonts[] = 'Alegreya+Sans:400,500,700';
	}

	/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'business-park' ) ) {
		$fonts[] = 'Raleway:400,600';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => rawurlencode( implode( '|', $fonts ) ),
			'subset' => rawurlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;


/**
 * Enqueue scripts and styles.
 */
function business_park_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'business-park-fonts', business_park_fonts_url(), array(), null );

	// Add fontawesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/plugins/fontawesome/css/font-awesome.min.css', '', '4.6.3' );

	//Add lightbox style
	wp_enqueue_style( 'lightbox', get_template_directory_uri() . '/assets/css/lightbox.min.css', '', '2.8.2' );

	// Theme stylesheet.
	wp_enqueue_style( 'business-park-style', get_stylesheet_uri() );

	wp_enqueue_script( 'business-park-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20151215', true );

	wp_enqueue_script( 'business-park-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Add cycle2 js
	wp_enqueue_script( 'cycle2', get_template_directory_uri() . '/assets/plugins/cycle2/jquery.cycle2.min.js', array( 'jquery' ), '2.1.6', true );

	// Add cycle2 carousel
	wp_enqueue_script( 'cycle2-carousel', get_template_directory_uri() . '/assets/plugins/cycle2/jquery.cycle2.carousel.min.js', array( 'jquery' ), '20141007', true );

	// Add lightbox js
	wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/assets/js/lightbox.min.js', array( 'jquery' ), '2.8.2', true );

	// Add isotope js
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.min.js', array( 'jquery' ), '3.0.0', true );

	// Add custom js
	wp_enqueue_script( 'business-park-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), '', true );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/assets/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'business_park_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Business Park core file
 */
require get_template_directory() . '/inc/core.php';