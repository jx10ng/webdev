<?php
/**
 * Testimonial section
 *
 * This is the template for the content of testimonial section
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */

if ( ! function_exists( 'business_park_add_testimonial_section' ) ) :
    /**
     * Add testimonial section
     *
     * @since 1.0.0
     */
    function business_park_add_testimonial_section() {

        // Check if testimonial is enabled on frontpage
        $testimonial_enable = apply_filters( 'business_park_section_status', true, 'testimonial_enable' );
        if ( true !== $testimonial_enable ) {
            return false;
        }

        // Get testimonial section details
        $section_details = array();
        $section_details = apply_filters( 'business_park_filter_testimonial_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render testimonial section now.
        business_park_render_testimonial_section( $section_details );
    }
endif;
add_action( 'business_park_primary_content', 'business_park_add_testimonial_section', 10 );


if ( ! function_exists( 'business_park_get_testimonial_section_details' ) ) :
    /**
     * Testimonial section details.
     *
     * @since 1.0.0
     *
     * @param array $input Testimonial section details.
     */
    function business_park_get_testimonial_section_details( $input ) {
        $options = business_park_get_theme_options();

        // Testimonial type
        $testimonial_content_type    = $options['testimonial_content_type'];

        $content = array();
        switch ( $testimonial_content_type ) {

            case 'testimonial':
                $ids = array();

                for ( $i = 1; $i <= 3 ; $i++ ) {
                    $id = null;
                    if ( isset( $options[ 'testimonial_content_'.$i ] ) ) {
                        $id = $options[ 'testimonial_content_'.$i ];
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
                    'post_type'      => 'jetpack-testimonial',
                    'post__in'       => $ids,
                );

                // Fetch posts.
                $posts = get_posts( $args );

                if ( ! empty( $posts ) ) {

                    $i = 1;
                    foreach ( $posts as $key => $post ) {
                        $page_id = $post->ID;
                        if ( has_post_thumbnail( $page_id ) ) {
                            $img_html = get_the_post_thumbnail( $page_id, '', array( 'alt' => the_title_attribute( 'echo=0&post='.$page_id.'' ) ) );

                            $content[$i]['img_html'] = $img_html;
                        }

                        $content[$i]['url']      = get_permalink( $page_id );
                        $content[$i]['title']    = get_the_title( $page_id );
                        $content[$i]['content']  = business_park_trim_content( $post );

                        if ( isset( $options[ 'testimonial_facebook_'.$i ] ) ) {
                            $content[$i]['facebook']  = $options[ 'testimonial_facebook_'.$i];
                        }
                        if ( isset( $options[ 'testimonial_twitter_'.$i ] ) ) {
                            $content[$i]['twitter']  = $options[ 'testimonial_twitter_'.$i];
                        }
                        if ( isset( $options[ 'testimonial_pinterest_'.$i ] ) ) {
                            $content[$i]['pinterest']  = $options[ 'testimonial_pinterest_'.$i];
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
// Testimonial section content details.
add_filter( 'business_park_filter_testimonial_section_details', 'business_park_get_testimonial_section_details' );


if ( ! function_exists( 'business_park_render_testimonial_section' ) ) :
    /**
     * Start section id .client-carousel
     *
     * @return string testimonial content
     * @since Business Park 1.0.0
     *
     */
    function business_park_render_testimonial_section( $content_details = array() ) {
        $options = business_park_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <section id="client-carousel">
            <div class="overlay"></div><!-- end overlay -->
            <div class="container">
                <header class="entry-header">
                    <h2 class="entry-title"><?php echo esc_html( $options['testimonial_title'] );?></h2>
                </header>
                <div class="entry-content">
                    <div id="client-testimonial" class="cycle-slideshow os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.3s" data-os-animation-duration="2s" data-cycle-timeout="2500" data-cycle-slides="> figure" data-cycle-fx="scrollHorz" data-cycle-speed="1200" data-cycle-pager=".cycle-pager">
                        <?php foreach ( $content_details as $content ): ?>
                            <?php
                            $class = '';
                            if ( empty( $content['img_html'] ) ) {
                                $class = 'no-client-image';
                            } ?>
                            <figure>

                                <div class="client-content <?php echo $class;?>">
                                    <div class="client-detail-wrap clear">
                                        <p><?php echo esc_html( $content['content'] );?></p>
                                        <?php if ( ! empty( $content['img_html'] ) ) { ?>
                                            <div class="client-image">
                                                <a href="<?php echo esc_url( $content['url'] );?>"><?php echo $content['img_html'];?></a>
                                            </div><!-- end client image-->
                                        <?php } ?>

                                    </div><!-- end .client-detail-wrap -->

                                    <div class="client-name">
                                        <a href="<?php echo esc_url( $content['url'] );?>"><span><?php echo esc_html( $content['title'] );?></span></a>
                                    </div><!-- end client-name -->
                                    <ul class="list-inline social-icons">
                                        <?php if ( ! empty( $content['facebook'] ) ) { ?>
                                            <li class="icon-animation icon-hover-effect"><a href="<?php echo esc_url( $content['facebook'] );?>" class="icon-hover"></a></li>
                                        <?php } ?>
                                        <?php if ( ! empty( $content['twitter'] ) ) { ?>
                                            <li class="icon-animation icon-hover-effect"><a href="<?php echo esc_url( $content['twitter'] );?>" class="icon-hover"></a></li>
                                        <?php } ?>
                                        <?php if ( ! empty( $content['pinterest'] ) ) { ?>
                                            <li class="icon-animation icon-hover-effect"><a href="<?php echo esc_url( $content['pinterest'] );?>" class="icon-hover"></a></li>
                                        <?php } ?>
                                    </ul><!--end social-icons -->
                                </div><!--end client-content -->
                                
                                <div class="clear"></div>
                            </figure>
                            <div class="clear"></div>
                        <?php endforeach;?>
                    </div><!-- end cycle-slideshow -->
                    <div class="cycle-pager"></div><!-- end cycle-pager -->
                </div><!-- end entry-content -->
            </div><!-- end container -->
        </section>

<?php
    }
endif;