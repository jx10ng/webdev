<?php
/**
 * Portfolio section
 *
 * This is the template for the content of portfolio section
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


if ( ! function_exists( 'business_park_add_portfolio_section' ) ) :
    /**
     * Add portfolio section
     *
     * @since 1.0.0
     */
    function business_park_add_portfolio_section() {

        // Check if portfolio is enabled on frontpage
        $portfolio_enable = apply_filters( 'business_park_section_status', true, 'portfolio_enable' );
        if ( true !== $portfolio_enable ) {
            return false;
        }

        // Get portfolio section details
        $section_details = array();
        $section_details = apply_filters( 'business_park_filter_portfolio_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render portfolio section now.
        business_park_render_portfolio_section( $section_details );
    }
endif;
add_action( 'business_park_primary_content', 'business_park_add_portfolio_section', 30 );


if ( ! function_exists( 'business_park_get_portfolio_section_details' ) ) :
    /**
     * Slider section details.
     *
     * @since 1.0.0
     *
     * @param array $input Slider section details.
     */
    function business_park_get_portfolio_section_details( $input ) {
        $options = business_park_get_theme_options();

        // Slider type
        $portfolio_content_type    = $options['portfolio_content_type'];

        $content = array();
        switch ( $portfolio_content_type ) {

            case 'portfolio-category':
                $ids = array();

                if ( isset( $options[ 'portfolio_category' ] ) ) {
                    $ids = $options[ 'portfolio_category' ];
                }

                // Bail if no valid pages are selected.
                if ( empty( $ids ) ) {
                    return $input;
                }

                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy'       => 'category',
                            'field'          => 'id',
                            'terms'          => $ids,
                        )
                    )
                );

                // Fetch posts.
                $posts = get_posts( $args );

                if ( ! empty( $posts ) ) {

                    $i = 1;
                    foreach ( $posts as $key => $post ) {
                        $portfolio_id = $post->ID;
                        if ( has_post_thumbnail( $portfolio_id ) ) {
                            $img_list_array = wp_get_attachment_image_src( get_post_thumbnail_id( $portfolio_id ), 'business-park-portfolio' );
                            $img_pop_up_array = wp_get_attachment_image_src( get_post_thumbnail_id( $portfolio_id ), '' );
                            } else {
                                $img_list_array = array( get_template_directory_uri().'/assets/images/no-featured-image-390x293.jpg');
                                $img_pop_up_array = array( get_template_directory_uri().'/assets/images/no-featured-image-390x293.jpg');
                            }

                            $terms = get_the_terms( $portfolio_id, 'category' );

                            $term_string = null;
                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                $term_slug = array();
                                foreach ( $terms as $term ) {
                                    $term_slug[ $term->slug ] = $term->name;
                                }

                            }

                            $content[$i]['img_list_array'] = $img_list_array;
                            $content[$i]['img_pop_up_array'] = $img_pop_up_array;
                            $content[$i]['url']      = get_permalink( $portfolio_id );
                            $content[$i]['portfolio_title']    = get_the_title( $portfolio_id );
                            $content[$i][ 'filter']  = $term_slug;

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

add_filter( 'business_park_filter_portfolio_section_details', 'business_park_get_portfolio_section_details' );


if ( ! function_exists( 'business_park_render_portfolio_section' ) ) :
    /**
     * Start section class .slider-section
     *
     * @return string Slider content
     * @since Business Park 1.0.0
     *
     */
    function business_park_render_portfolio_section( $content_details = array() ) {
        $options = business_park_get_theme_options();

        $ids = array();
        if ( !empty( $options[ 'portfolio_category' ] ) && $options[ 'portfolio_category' ] > 0 ) {
            $ids = $options[ 'portfolio_category' ];
        }

        $terms = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'include'      => $ids,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $taxonomy_terms[ $term->slug ] = $term->name;
            }
        }else{
            $taxonomy_terms = array();
        }

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <section id="portfolio-gallery" class="bg-white">
            <div class="container">
                <header class="entry-header">
                    <h2 class="entry-title"><?php echo esc_html( $options['portfolio_title'] );?></h2>
                </header>
                <div class="entry-content">
                    <div class="text-center clearfix">
                        <nav class="portfolio-filter">
                            <ul>
                                <li><a href="#" class="active" data-filter="*"><?php _e( 'All', 'business-park' ); ?></a></li>
                                <?php foreach ($taxonomy_terms as $taxonomy_term => $value) : ?>
                                    <li><a href="#" data-filter=".<?php echo esc_attr( $taxonomy_term );?>"><?php echo esc_html( $value );?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    </div><!-- end text-center -->
                    <div id="gallery" class="os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
                        <div id="threecol" class="portfolio">

                        <?php foreach ( $content_details as $content ):
                            $filter_keys_str = '';
                            if ( ! empty( $content['filter'] ) ) {
                                $filter          = $content['filter'];
                                $filter_keys     = array_keys( $filter );
                                $filter_keys_str = implode( ' ', $filter_keys );
                            }
                        ?>
                            <div class="portfolio-item hovereffect item-w1 item-h1 <?php echo esc_attr( $filter_keys_str ); ?>">
                                <div class="zoom-effect">
                                    <img src="<?php echo esc_url( $content['img_list_array'][0] );?>" />
                                </div>
                                <div class="hovercontent">
                                    <div class="hoverbutton inlinebutton">
                                        <a href="<?php echo esc_url( $content['url'] );?>"><i class="fa fa-link"></i></a>
                                        <p><a href="<?php echo esc_url( $content['url'] );?>"><?php echo esc_html( $content['portfolio_title'] ); ?></a></p>
                                    </div>
                                </div>
                            </div><!-- end box -->
                        <?php endforeach; ?>
                        </div><!-- end portfolio -->
                    </div><!-- /gallery -->
                </div><!-- end entry-content -->
            </div><!-- end container -->
        </section><!-- end section -->

<?php }
endif;