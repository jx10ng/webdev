<?php
/**
 * Business Park basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


if ( ! function_exists( 'business_park_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since 1.0.0
	 */
	function business_park_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>><?php
	}
endif;

add_action( 'business_park_doctype', 'business_park_doctype', 10 );


if ( ! function_exists( 'business_park_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<?php
	}
endif;
add_action( 'business_park_before_wp_head', 'business_park_head', 10 );


if ( ! function_exists( 'business_park_page_start' ) ) :
	/**
	 * Start div id #page and screen reader link
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_page_start() {
		?>
		<div id="page" class="hfeed site">
			<div class="site-inner">
				<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'business-park' ); ?></a>
		<?php
	}
endif;
add_action( 'business_park_page_start', 'business_park_page_start', 10 );


if ( ! function_exists( 'business_park_social_bar' ) ) :
	/**
	 * Start div class .top-bar
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_social_bar() {
	?>
		<!-- Top bar -->
		<?php if ( has_nav_menu( 'jetpack-social-menu' ) ) { ?>
     	<div class="top-bar">
     		<?php
     		/**
			* Displays social navigation menu
			* @param array $args Arguments
			*/
			$args = array(
				'theme_location'  => 'jetpack-social-menu',
				'container'       => 'div',
				'container_class' => 'social-icons',
				'menu_class'      => 'list-inline color-grey',
				'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
				'depth'           => 1,
			);

			wp_nav_menu( $args );
			?>
     	</div> <!-- /top-bar -->
		<?php
		}
	}
endif;
add_action( 'business_park_before_header', 'business_park_social_bar', 20 );


if ( ! function_exists( 'business_park_header_start' ) ) :
	/**
	 * Start div id #masthead
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_header_start() {
		?>
		<header id="masthead" class="site-header" role="banner">
			<div class="container">
		<?php
	}
endif;
add_action( 'business_park_header', 'business_park_header_start', 10 );


if ( ! function_exists( 'business_park_site_branding' ) ) :
	/**
	 * Start .site-branding
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_site_branding() {
		get_template_part( 'components/header/site', 'branding' );
	}
endif;
add_action( 'business_park_header', 'business_park_site_branding', 20 );


if ( ! function_exists( 'business_park_site_nav' ) ) :
	/**
	 * Site navigation
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_site_nav() {
		get_template_part( 'components/navigation/navigation', 'top' );
	}
endif;
add_action( 'business_park_header', 'business_park_site_nav', 30 );


if ( ! function_exists( 'business_park_header_end' ) ) :
	/**
	 * Header ends
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_header_end() { ?>
			</div><!-- .header-wrap -->
		</header>
	<?php
	}
endif;
add_action( 'business_park_header', 'business_park_header_end', 100 );


if ( ! function_exists( 'business_park_content_start' ) ) :
	/**
	 * Start div id #content
	 *
	 * Site content starts
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_content_start() { ?>
		<div id="content" class="site-content">
	<?php
	}
endif;
add_action( 'business_park_content_start', 'business_park_content_start', 10 );


if ( ! function_exists( 'business_park_content_end' ) ) :
	/**
	 * End div id #content
	 *
	 * Site content ends
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_content_end() { ?>
		</div><!-- end #content-->
	<?php
	}
endif;
add_action( 'business_park_content_end', 'business_park_content_end', 100 );


if ( ! function_exists( 'business_park_scroll_top' ) ) :
	/**
	 * Start div class .backtotop
	 *
	 * Scroll to top
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_scroll_top() { ?>
		<div class="backtotop fa fa-angle-up"></div>
	<?php
	}
endif;
add_action( 'business_park_scroll_top', 'business_park_scroll_top', 10 );


if ( ! function_exists( 'business_park_footer_start' ) ) :
	/**
	 * Start footer id .colophon
	 *
	 * Footer start
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_footer_start() {
		?>
		<footer id="colophon" class="bg-green site-footer">
		    <div class="container">
		<?php
	}
endif;
add_action( 'business_park_footer', 'business_park_footer_start', 10 );


if ( ! function_exists( 'business_park_footer_logo' ) ) :
	/**
	 * Start div class .footer-logo
	 *
	 * Footer start
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_footer_logo() {
		$options = business_park_get_theme_options();
		if ( $options['footer_logo_enable'] && ! empty( $options['footer_logo'] ) ) { ?>
			<div class="footer-logo os-animation" data-os-animation="zoomIn" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
			<a href="<?php esc_url( home_url( '/' ) );?>">
	         <img src="<?php echo esc_url( $options['footer_logo'] );?>" alt="<?php _e( 'Footer Logo', 'business-park' );?>">
	      </a>
	      </div>
		<?php }
	}
endif;
add_action( 'business_park_footer', 'business_park_footer_logo', 20 );


if ( ! function_exists( 'business_park_footer' ) ) :
	/**
	 * Footer
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_footer() {
		$footer_sidebar_data = business_park_footer_sidebar_class();
		$active_id           = $footer_sidebar_data['active_id'];
		$class               = $footer_sidebar_data['class'];

		if ( empty( $active_id ) ) {
			return;
		} ?>

      <div class="footer-layout">
      	<?php
      	for ( $i=0; $i < count( $active_id ); $i++ ) { ?>
          <div class="<?php echo esc_attr( $class );?>-col os-animation" data-os-animation="pulse" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
      			<?php
      			if ( is_active_sidebar( 'footer-'.absint( $active_id[ $i ] ).'' ) ){
      				dynamic_sidebar( 'footer-'.absint( $active_id[ $i ] ).'' );
      			}
      			?>
          </div><!--end col-->
      	<?php }?>
          <div class="clear"></div>
      </div><!--end footer-layout -->
		<?php
	}
endif;
add_action( 'business_park_footer', 'business_park_footer', 30 );


if ( ! function_exists( 'business_park_copyright' ) ) :
	/**
	 * Start div class .site-info
	 *
	 * Footer site info
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_copyright() {
		get_template_part( 'components/footer/site', 'info' );
	}
endif;
add_action( 'business_park_footer', 'business_park_copyright', 90 );


if ( ! function_exists( 'business_park_footer_end' ) ) :
	/**
	 * End div .site-info
	 *
	 * Footer end
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_footer_end() {
		?>
		    </div><!--end .container-->
		</footer>
		<?php
	}
endif;
add_action( 'business_park_footer', 'business_park_footer_end', 100 );


if ( ! function_exists( 'business_park_page_end' ) ) :
	/**
	 * End div id #content
	 *
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_page_end() {
		?>
				</div><!--end site-inner -->
		</div><!-- end site-->
		<?php
	}
endif;
add_action( 'business_park_page_end', 'business_park_page_end', 100 );