<?php
/**
 * Contact section
 *
 * This is the template for the content of contact section
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


if ( ! function_exists( 'business_park_add_contact_section' ) ) :
    /**
     * Add about section
     *
     * @since 1.0.0
     */
    function business_park_add_contact_section() {
        // Check if about is enabled on frontpage
        $contact_enable = apply_filters( 'business_park_section_status', true, 'contact_enable' );
        if ( true !== $contact_enable ) {
            return false;
        }

        // Get about section details
        $section_details = array();
        $section_details = apply_filters( 'business_park_filter_contact_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render about section now.
        business_park_render_contact_section( $section_details );
    }
endif;
add_action( 'business_park_primary_content', 'business_park_add_contact_section', 90 );


if ( ! function_exists( 'business_park_get_contact_section_details' ) ) :
    /**
     * About section details.
     *
     * @since 1.0.0
     *
     * @param array $input About section details.
     */
    function business_park_get_contact_section_details( $input ) {
        $options = business_park_get_theme_options();

        $content = array();

        $content['title']          = $options['contact_section_title'];
        if ( isset( $options['contact_form_shortcode'] ) ) {
          $content['form_shortcode'] = $options['contact_form_shortcode'];
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// ABout section content details.
add_filter( 'business_park_filter_contact_section_details', 'business_park_get_contact_section_details' );

if ( ! function_exists( 'business_park_render_contact_section' ) ) :
    /**
     * Start section id .about
     *
     * @return string about content
     * @since Business Park 1.0.0
     *
     */
    function business_park_render_contact_section( $content_details = array() ) {
        $options = business_park_get_theme_options();

         $allowed_tags =  array(
              'span' => array(
                'class' => array(),
                'id'    => array(),
                'style' => array()
              ) );

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <?php if ( ! empty( $content_details['form_shortcode'] ) ) : ?>
            <section id="contact-section" class="bg-white page-section noPaddingTop">
                <div class="container">
                    <?php if ( ! empty( $content_details['title'] ) ) : ?>
                        <header class="entry-header">
                            <h2 class="entry-title"><?php echo wp_kses( $content_details['title'], $allowed_tags );?></h2>
                        </header>
                    <?php endif; ?>
                    <div class="entry-content">
                        <?php
                        if ( ! empty( $content_details['form_shortcode'] ) ) {
                          echo do_shortcode( wp_kses_post( $content_details['form_shortcode'] ) );
                         }
                        ?>
                    </div><!--end entry-content -->
                </div><!--end container-->
            </section>
        <?php endif; ?>

<?php
    }
endif;