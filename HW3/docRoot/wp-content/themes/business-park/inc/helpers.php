<?php
/**
 * Business Park custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Business park
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


if( ! function_exists( 'business_park_dummy_image' ) ):
	/**
	 * Get the placeholder image URL for the theme.
	 *
	 * @access public
	 * @return string
	 */
	function business_park_dummy_image( $width, $height ) {
		$img_array = array();
		$img_array[0] = get_template_directory_uri() . '/assets/images/no-featured-image-1920x1080.jpg';
		$img_array[1] = $width;
		$img_array[2] = $height;
		return apply_filters( 'business_park_dummy_image', $img_array );
	}
endif;

if( ! function_exists( 'business_park_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since 1.0.0
	 */
  	function business_park_check_enable_status( $input, $content_enable ){
		 $options = business_park_get_theme_options();

		 // Content status.
		 $content_status = $options[ $content_enable ];

		 // Get Page ID outside Loop.
		 $query_obj = get_queried_object();
		 $page_id   = null;
	    if ( is_object( $query_obj ) && 'WP_Post' == get_class( $query_obj ) ) {
	    	$page_id = get_queried_object_id();
	    }

		 // Front page displays in Reading Settings.
		 $page_on_front  = get_option( 'page_on_front' );

		 if ( ( ! is_home() && is_front_page() ) && ( 'static-frontpage' === $content_status ) ) {
			$input = true;
		 }
		 else {
			$input = false;
		 }
		 return $input;
  	}
endif;
add_filter( 'business_park_section_status', 'business_park_check_enable_status', 10, 2 );


if ( ! function_exists( 'business_park_is_jetpack_cpt_module_enable' ) ) :
    /**
     * Check if JetPack module is enabled
     *
     * @since 1.0.0
     *
     * @param string $jetpack_cpt_option 		Jetpack enable checkbox value
     */
    function business_park_is_jetpack_cpt_module_enable( $jetpack_cpt_option ) {
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) &&  get_option( $jetpack_cpt_option ) ) :
			return true;
		endif;

		return false;
    }
endif;
add_action( 'plugins_loaded', 'business_park_is_jetpack_cpt_module_enable' );
add_filter( 'business_park_filter_is_jetpack_cpt_module_enable', 'business_park_is_jetpack_cpt_module_enable' );


if ( ! function_exists( 'business_park_footer_sidebar_class' ) ) :
	/**
	 * Count the number of footer sidebars to enable dynamic classes for the footer
	 *
	 * @since Business Park 1.0.0
	 */
	function business_park_footer_sidebar_class() {
		$data = array();
		$active_id = array();
	   	$count = 0;

	   	if ( is_active_sidebar( 'footer-1' ) ) {
	   	$active_id[] = '1';
	      $count++;
	   	}

	   if ( is_active_sidebar( 'footer-2' ) ){
	   	$active_id[] = '2';
	      $count++;
		}

	   if ( is_active_sidebar( 'footer-3' ) ){
	   	$active_id[] = '3';
	      $count++;
	   }

	   $class = '';

	   switch ( $count ) {
        	case '1':
            $class = 'one';
            break;
        	case '2':
            $class = 'two';
            break;
        	case '3':
            $class = 'three';
            break;
	   }

		$data['active_id'] = $active_id;
		$data['class']     = $class;

	   return $data;
	}
endif;


if ( ! function_exists( 'business_park_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled in meta box first then in customizer
	 *
	 * @since Business Park 1.0.0
	 */
	function business_park_is_sidebar_enable() {
		$options               = business_park_get_theme_options();
		$sidebar_position      = $options['sidebar_position'];

		if ( is_home() ) {
			$post_sidebar_position = get_post_meta( get_option( 'page_for_posts' ), 'business-park-sidebar-position', true );
		} else {
			$post_sidebar_position = get_post_meta( get_the_ID(), 'business-park-sidebar-position', true );
		}

		if ( ( $sidebar_position == 'no-sidebar' && $post_sidebar_position == "" ) || $post_sidebar_position == 'no-sidebar' ) {
			return false;
		} else {
			return true;
		}

	}
endif;


if ( ! function_exists( 'business_park_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function business_park_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = business_park_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'business_park_filter_frontpage_content_enable', 'business_park_is_frontpage_content_enable' );


if ( ! function_exists( 'business_park_layout' ) ) :
	/**
	 * Check home page layout option
	 *
	 * @since Business Park Pro 2.0.1
	 *
	 * @return string Business Park layout value
	 */
	function business_park_layout() {
		$options = business_park_get_theme_options();

		$sidebar_position = $options['sidebar_position'];
		$sidebar_position = apply_filters( 'business_park_sidebar_position', $sidebar_position );
		// Check if single and static blog page
		if ( is_singular() || is_home() ) {
			if ( is_home() ) {
				$post_sidebar_position = get_post_meta( get_option( 'page_for_posts' ), 'business-park-sidebar-position', true );
			} else {
				$post_sidebar_position = get_post_meta( get_the_ID(), 'business-park-sidebar-position', true );
			}
			if ( isset( $post_sidebar_position ) && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			}
		}
		return $sidebar_position;
	}
endif;


if ( ! function_exists( 'business_park_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 2.0.1
	 */
	function business_park_custom_content_width() {

		global $content_width;
		$sidebar_position = business_park_layout();
		switch ( $sidebar_position ) {

		  case 'no-sidebar':
		    $content_width = 1170;
		    break;

		  case 'left-sidebar':
		  case 'right-sidebar':
		    $content_width = 819;
		    break;

		  default:
		    break;
		}
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$content_width = 1170;
		}

	}
endif;
add_action( 'template_redirect', 'business_park_custom_content_width' );