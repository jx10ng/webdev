<?php
/**
 * About section
 *
 * This is the template for the content of about section
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */
if ( ! function_exists( 'business_park_add_about_section' ) ) :
    /**
     * Add about section
     *
     * @since 1.0.0
     */
    function business_park_add_about_section() {

        // Check if about is enabled on frontpage
        $about_enable = apply_filters( 'business_park_section_status', true, 'about_enable' );
        if ( true !== $about_enable ) {
            return false;
        }

        // Get about section details
        $section_details = array();
        $section_details = apply_filters( 'business_park_filter_about_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render about section now.
        business_park_render_about_section( $section_details );
    }
endif;
add_action( 'business_park_primary_content', 'business_park_add_about_section', 10 );


if ( ! function_exists( 'business_park_get_about_section_details' ) ) :
    /**
     * About section details.
     *
     * @since 1.0.0
     *
     * @param array $input About section details.
     */
    function business_park_get_about_section_details( $input ) {
        $options = business_park_get_theme_options();

        // About type
        $about_content_type    = $options['about_content_type'];

        $content = array();
        switch ( $about_content_type ) {

            case 'page':
                $page_id = null;
                if ( isset( $options[ 'about_content_page'] ) ) {
                    $page_id = absint( $options[ 'about_content_page'] );
                }

                if ( ! empty( $page_id ) ) {

                    if ( has_post_thumbnail( $page_id ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'business-park-about' );

                        $content['img_array'] = $img_array;
                    }

                    $content['url']      = get_permalink( $page_id );
                    $content['title']    = get_the_title( $page_id );
                    $content['excerpt']  = business_park_trim_content( get_post( $page_id ), 80 );
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
// ABout section content details.
add_filter( 'business_park_filter_about_section_details', 'business_park_get_about_section_details' );




if ( ! function_exists( 'business_park_about_section_layout' ) ) :
    /**
     * About section layout.
     *
     * @since 1.0.0
     *
     * @param array $input About section details.
     */
    function business_park_about_section_layout( $classes = array() ) {
        $options = business_park_get_theme_options();

        if ( isset( $options[ 'about_content_page'] ) ) {
                $about_page_id = absint( $options[ 'about_content_page'] );
        }

        if ( ! empty( $about_page_id ) ){
            if ( has_post_thumbnail( $about_page_id ) ) {
                $classes[] = 'half-column';
            } else {
                $classes[] = 'full-column';
            }
            array_unique( $classes );
        }

        return $classes;
    }
endif;
// About section layout
add_filter( 'business_park_filter_about_section_layout', 'business_park_about_section_layout' );


if ( ! function_exists( 'business_park_render_about_section' ) ) :
    /**
     * Start section id .about
     *
     * @return string about content
     * @since Business Park 1.0.0
     *
     */
    function business_park_render_about_section( $content_details = array() ) {
        $options = business_park_get_theme_options();

        $classes = apply_filters( 'business_park_filter_about_section_layout', array() );
        $classes = implode( '', $classes );

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <section id="about" class="bg-white">
            <div class="container">
                <header class="entry-header">
                    <h2 class="entry-title"><?php echo esc_html( $content_details['title'] );?></h2>
                </header>
                <div class="entry-content">
                    <div class="about-wrapper">
                        <?php if (  $content_details['excerpt'] ) { ?>
                        <div class="<?php echo esc_attr( $classes );?> os-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
                            <p class="description"><?php echo esc_html( $content_details['excerpt'] );?></p>
                            <a href="<?php echo esc_url( $content_details['url'] );?>" class="more-link"><?php _e( 'Learn More', 'business-park' ); ?><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <?php } ?>
                        <?php if ( ! empty( $content_details['img_array'] ) ) { ?>
                            <div class="half-column os-animation" data-os-animation="zoomIn" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
                                <div class="ImageWrapper">
                                    <a href="<?php echo esc_url( $content_details['url'] );?>">
                                        <img width="<?php echo esc_attr( $content_details['img_array'][1] );?>" height="<?php echo esc_attr( $content_details['img_array'][2] );?>" src="<?php echo esc_url( $content_details['img_array'][0] );?>" /></a>
                                    <a href="<?php echo esc_url( $content_details['url'] );?>"><i class="fa fa-link"></i></a>
                                    <div class="ImageOverlayLi"></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div><!--end about-wrapper-->
                </div><!--end entry-content-->
            </div><!--end container-->
        </section>

<?php
    }
endif;