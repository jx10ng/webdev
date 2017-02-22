<?php
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */

if ( ! function_exists( 'business_park_add_slider_section' ) ) :
	/**
	 * Add slider section
	 *
	 * @since 1.0.0
	 */
	function business_park_add_slider_section() {

		// Check if slider is enabled on frontpage
		$slider_enable = apply_filters( 'business_park_section_status', true, 'slider_enable' );
		if ( true !== $slider_enable ) {
			return false;
		}

		// Get slider section details
		$section_details = array();
		$section_details = apply_filters( 'business_park_filter_slider_section_details', $section_details );

		if ( empty( $section_details ) ) {
			return;
		}

		// Render slider section now.
		business_park_render_slider_section( $section_details );
	}
endif;
add_action( 'business_park_before_header', 'business_park_add_slider_section', 30 );


if ( ! function_exists( 'business_park_get_slider_section_details' ) ) :
	/**
	 * Slider section details.
	 *
	 * @since 1.0.0
	 *
	 * @param array $input Slider section details.
	 */
	function business_park_get_slider_section_details( $input ) {
		$options = business_park_get_theme_options();

		// Slider type
		$slider_content_type 	= $options['slider_content_type'];

		$content = array();
		switch ( $slider_content_type ) {

			case 'page':
				$ids = array();

				for ( $i = 1; $i <= 3 ; $i++ ) {
				    $id = null;
				    if ( isset( $options[ 'slider_content_page_'.$i ] ) ) {
				        $id = $options[ 'slider_content_page_'.$i ];
				    }
				    if ( ! empty( $id ) ) {
				        $ids[] = absint( $id );
				    }
				}

				// Bail if no valid pages are selected.
				if ( empty( $ids ) ) {
				    return $input;
				}

				$args = array(
				    'no_found_rows'  => true,
				    'orderby'        => 'post__in',
				    'post_type'      => 'page',
				    'post__in'       => $ids,
				);

				// Fetch posts.
				$posts = get_posts( $args );

				if ( ! empty( $posts ) ) {

				    $i = 1;
				    foreach ( $posts as $key => $post ) {
				        $page_id = $post->ID;
				        $img_array = null;

				        if ( has_post_thumbnail( $page_id ) ) {
								$img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
							} else {
								$img_array = business_park_dummy_image( 1920, 1080 );
							}

							if ( isset( $img_array ) ) {
								$content[$i]['img_array'] = $img_array;
							}

							$content[$i]['url']      = get_permalink( $page_id );
							$content[$i]['title']    = get_the_title( $page_id );

							if ( isset( $options[ 'slider_content_page_icon_'.$i ] ) ) {
								$content[$i]['icon']     = $options[ 'slider_content_page_icon_'.$i ];
							}

				        $i++;
				    }
				}
				if ( ! empty( $content ) ) {
					$input = $content;
				}
			break;

			default:
			break;
		}
		return $input;

	}
endif;
// Slider section content details.
add_filter( 'business_park_filter_slider_section_details', 'business_park_get_slider_section_details' );


if ( ! function_exists( 'business_park_render_slider_section' ) ) :
	/**
	 * Start section class .main-slider
	 *
	 * @return string Slider content
	 * @since Business Park 1.0.0
	 *
	 */
	function business_park_render_slider_section( $content_details = array() ) {
		$options = business_park_get_theme_options();

		if ( empty( $content_details ) ) {
			return;
		} ?>

		<section class="main-slider">
		   <div class="cycle-slideshow"
		    	  data-cycle-timeout="2500"
		    	  data-cycle-pause-on-hover="false"
		    	  data-cycle-slides="> figure"
		    	  data-cycle-fx="<?php echo esc_attr( $options["slider_content_effect"] );?>"
		    	  data-cycle-speed="800"
		    	  data-cycle-next="#next"
		    	  data-cycle-prev="#prev">

		    	<?php foreach ( $content_details as $content ): ?>
		    	  	<figure>
		    	  		<img class="banner" width="<?php echo esc_attr( $content['img_array'][1] );?>" height="<?php echo esc_attr( $content['img_array'][2] );?>" src="<?php echo esc_url( $content['img_array'][0] ); ?>" />
				        <div class="overlay"></div>

		    	  		<?php if ( $options['enable_slider_captions'] ) { ?>
			         <a href="<?php echo esc_url( $content['url'] ); ?>">
				         <div class="slider-text">
				             <div class="os-animation" data-os-animation="zoomIn" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
				             	<?php if ( ! empty( $content['icon'] ) ) { ?>
				                 <img src="<?php echo esc_url( $content['icon'] );?>" class="img-responsve" alt="<?php echo esc_attr( $content['title'] ); ?>">				                 
				             	<?php } ?>
				             </div>
				             <div class="os-animation" data-os-animation="slideInUp" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
				                 <h1 class="color-white"><?php echo esc_html( $content['title'] ); ?><h1>
				             </div>
				         </div> <!-- /slider-text -->
			         </a>
		    	  		<?php } ?>
		     		</figure>
		    	<?php endforeach; ?>

			   <?php if ( $options['enable_arrow_controls'] ) : ?>
		    		<div class="controls">
			         <div class="cycle-prev"><a href="#" id="prev"><i class="fa fa-angle-left"></i></a></div>
			         <div class="cycle-next"><a href="#" id="next"><i class="fa fa-angle-right"></i></a></div>
			      </div><!--end controls-->
			   <?php endif; ?>
		   </div><!--end cycle-slideshow-->
		</section>

<?php }
endif;