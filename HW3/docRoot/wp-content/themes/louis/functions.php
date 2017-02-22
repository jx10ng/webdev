<?php
/**
 * louis functions and definitions
 *
 * @package louis
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

global $content_width;
if ( !isset( $content_width ) ) {
	$content_width = 740; /* pixels */
}

if ( !function_exists( 'louis_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function louis_setup()
	{

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on louis, use a find and replace
		 * to change 'louis' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'louis', get_template_directory() . '/languages' );

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
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );
		
		/**
	Custom Logo
	 */
	add_theme_support( 'custom-logo', array(
	'height'      => 300,
	'width'       => 600,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );

		// enable featured images
		add_theme_support( 'post-thumbnails' );
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'louis' ),
) );


		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'louis_custom_background_args', array(
			'default-color' => 'f6f6f6',
			'default-image' => '',
			'panel'         => 'louis_colors',
		) ) );

		add_image_size( 'louis-full', 740, 415, true );
		add_image_size( 'louis-blog-thumb', 690, 390, true );
	}
endif;
add_action( 'after_setup_theme', 'louis_setup' );


// WooCommerce Support
add_action( 'after_setup_theme', 'louis_woocommerce_support' );
	function louis_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


// Style the Tag Cloud
function louis_tag_cloud_widget( $args )
{
	$args['largest'] = 12; //largest tag
	$args['smallest'] = 12; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['number'] = '8'; //number of tags
	return $args;
}

add_filter( 'widget_tag_cloud_args', 'louis_tag_cloud_widget' );


// add custom class to tags
function louis_add_class_the_tags( $html )
{
	$html = str_replace( '<a', '<a class="button seethrough small"', $html );

	return $html;
}

add_filter( 'the_tags', 'louis_add_class_the_tags' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function louis_widgets_init()
{
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'louis' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div class="sidebarwidget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'louis' ),
		'id'            => 'louis-footer',
		'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Features', 'louis' ),
		'id'            => 'louis-features',
		'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="featurewidget">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<h2 class="featurewidgettitle">',
		'after_title'   => '</h2>',
	) );

}

add_action( 'widgets_init', 'louis_widgets_init' );


/**
 * Register Google Fonts
 */
function louis_fonts_url() {
    $fonts_url = '';

   	/* Translators: If there are characters in your language that are not
	 * supported by Playfair, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$roboto = esc_html_x( 'on', 'Roboto font: on or off', 'louis' );
	
	/* Translators: If there are characters in your language that are not
	 * supported by Montserrat, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$arimo = esc_html_x( 'on', 'Arimo font: on or off', 'louis' );
	

	if ( 'off' !== $roboto && 'off' !== $arimo  ) {
		$font_families = array();

		if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto:300,300italic,400,400italic,700,700italic';
		}
		
		if ( 'off' !== $arimo ) {
			$font_families[] = 'Arimo:400,400italic,700,700italic';
		}
		

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}



/**
 * Enqueue scripts and styles.
 */
function louis_scripts()
{
	wp_enqueue_style( 'louis-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.css' );
	wp_enqueue_style( 'louis-fonts', louis_fonts_url(), array(), null );
	wp_enqueue_script( 'louis-footer-scripts', get_template_directory_uri() . '/inc/js/script.js', array( 'jquery' ), '20161409', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'louis_scripts' );



require get_template_directory() . '/inc/custom-header.php'; 
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/themesetup.php';
require get_template_directory() . '/inc/customizer.php';