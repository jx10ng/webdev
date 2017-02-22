<?php
/**
 * Services section
 *
 * This is the template for the content of services section
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.1.0
 */

if ( ! function_exists( 'business_park_add_service_section' ) ) :
  /**
   * Add service section
   *
   * @since Business Park 1.1.0
   */
  function business_park_add_service_section() {

    // Check if service is enabled on frontpage
    $service_enable = apply_filters( 'business_park_section_status', true, 'service_enable' );
    if ( true !== $service_enable ) {
      return false;
    }

    // Get service section details
    $section_details = array();
    $section_details = apply_filters( 'business_park_filter_service_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render service section now.
    business_park_render_service_section( $section_details );
  }
endif;
add_action( 'business_park_primary_content', 'business_park_add_service_section', 50 );


if ( ! function_exists( 'business_park_get_service_section_details' ) ) :
  /**
   * service section details.
   *
   * @since Business Park 1.1.0
   *
   * @param array $input service section details.
   */
  function business_park_get_service_section_details( $input ) {
    $options = business_park_get_theme_options();

    // service type
    $service_content_type  = $options['service_content_type'];

    $content = array();
    switch ( $service_content_type ) {
      case 'post':
        $ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            $id = null;
            if ( isset( $options[ 'service_content_post_'.$i ] ) ) {
                $id = $options[ 'service_content_post_'.$i ];
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
            'post_type'      => 'post',
            'post__in'       => $ids,
        );

        // Fetch posts.
        $posts = get_posts( $args );

        if ( ! empty( $posts ) ) {
          $i = 1;
          foreach ( $posts as $key => $post ) {
            $page_id = $post->ID;

            $content[$i]['excerpt'] = business_park_trim_content( $post, 15 );
            $content[$i]['title']   = get_the_title( $page_id );
            $content[$i]['url']     = get_permalink( $page_id );

            if ( ! empty( $options[ 'service_icon_'.$i ] ) ) {
              $content[$i]['icon']     = $options[ 'service_icon_'.$i ];
            }

            if ( ! empty( $options[ 'service_icon_color_'.$i ] ) ) {
              $content[$i]['icon_color']     = $options[ 'service_icon_color_'.$i ];
            }
          $i++;
          }
        }
      break;

      default:
      break;
    }

    if ( ! empty( $content ) ) {
      $input = $content;
    }
    return $input;

  }
endif;
// service section content details.
add_filter( 'business_park_filter_service_section_details', 'business_park_get_service_section_details' );


if ( ! function_exists( 'business_park_render_service_section' ) ) :
	/**
	 * Header ends
	 *
	 * @since Business Park 1.1.0
	 *
	 */
	function business_park_render_service_section( $content_details ) {
    $options = business_park_get_theme_options();

    if ( empty( $content_details ) ) {
      return;
    }
    ?>
  		<section id="services" class="bg-white">
          <div class="container">
              <?php if ( ! empty( $options['service_section_title'] ) ) : ?>
              <header class="entry-header">
                  <h2 class="entry-title"><?php echo esc_html( $options['service_section_title'] );?></h2>
              </header>
              <?php endif; ?>
              <div class="entry-content">
                <?php
                $i = 1;
                foreach ( $content_details as $content ): ?>
                  <div class="three-col os-animation" data-os-animation="fadeInUp" data-os-animation-delay="0.3s" data-os-animation-duration="0.3s">
                      <div class="services-wrapper text-center">
                          <?php if ( ! empty( $content['icon'] ) ) { ?>
                            <div class="icon-container">
                                <i id="features-icon-<?php echo $i;?>" class="fa <?php echo esc_attr( $content['icon'] );?>"></i>
                            </div>
                          <?php } ?>
                          <h4><?php echo esc_html( $content['title'] );?></h4>
                          <p><?php echo esc_html( $content['excerpt'] );?></p>
                          <a href="<?php echo esc_url( $content['url'] );?>" class="more-link"><?php _e( 'READ MORE', 'business-park' );?></a>
                      </div><!--end services-wrapper-->
                  </div><!-- end three-col-->
                  <style>
                    #features-icon-<?php echo $i;?>.fa {
                       background-color:#099;
                    }
                    #features-icon-<?php echo $i;?>.fa:hover {
                       background: #099;
                    }
                    #features-icon-<?php echo $i;?>.fa:after {
                       box-shadow: 0 0 0 4px #099;
                    }
                  </style>
                <?php
                $i++;
                endforeach;?>
              </div><!--end entry-content -->
              <div class="green-separator"></div>
          </div><!--end container-->
      </section>
	<?php
	}
endif;