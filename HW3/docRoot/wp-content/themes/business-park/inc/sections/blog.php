<?php
/**
 * Blog section
 *
 * This is the template for the content of Blog section in front page
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */
if ( ! function_exists( 'business_park_add_blog_section' ) ) :
    /**
     * Add Blog section
     *
     * @since 1.0.0
     */
    function business_park_add_blog_section() {

        // Check if Blog is enabled on frontpage
        $blog_enable = apply_filters( 'business_park_section_status', true, 'blog_enable' );
        if ( true !== $blog_enable ) {
            return false;
        }

        // Get Blog section details
        $section_details = array();
        $section_details = apply_filters( 'business_park_filter_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render Blog section now.
        business_park_render_blog_section( $section_details );
    }
endif;
add_action( 'business_park_primary_content', 'business_park_add_blog_section', 80 );


if ( ! function_exists( 'business_park_get_blog_section_details' ) ) :
    /**
     * Blog section details.
     *
     * @since 1.0.0
     *
     * @param array $input Blog section details.
     */
    function business_park_get_blog_section_details( $input ) {
        $content = array();
        $i = 1;

        $args = array(
            'posts_per_page'      => 3,
            'ignore_sticky_posts' => true,
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                $img_array = null;

                if ( has_post_thumbnail() ) {
                    $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' );
                } else {
                    $img_array = business_park_dummy_image( 600, 300 );
                }

                if ( isset( $img_array ) ) {
                    $content[$i]['img_array'] = $img_array;
                }

                $content[$i]['url']     = get_permalink();
                $content[$i]['title']   = get_the_title();
                $content[$i]['excerpt'] = get_the_excerpt();
                $content[$i]['date']    = get_the_date();

                $i++;
            }
            wp_reset_postdata();
        }

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// Blog section content details.
add_filter( 'business_park_filter_blog_section_details', 'business_park_get_blog_section_details' );

if ( ! function_exists( 'business_park_render_blog_section' ) ) :
    /**
     * Start section id .Blog
     *
     * @return string Blog content
     * @since Business Park 1.0.0
     *
     */
    function business_park_render_blog_section( $content_details = array() ) {
        $options = business_park_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <section id="blog-section" class="bg-white">
            <div class="container">
                <?php if ( ! empty( $options['blog_title'] ) ) : ?>
                    <header class="entry-header">
                        <h2 class="entry-title"><?php echo esc_html( $options['blog_title'] );?></h2>
                    </header>
                <?php endif; ?>
                <div class="entry-content">
                    <div class="blog-wrapper clear">
                        <?php foreach ($content_details as $content ) { ?>
                            <div class="blog-post-section os-animation" data-os-animation="zoomIn" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
                                <div class="posted-date">
                                    <span><?php echo esc_attr( date_i18n( get_option( 'date_format' ), strtotime( $content['date'] ) ) ); ?></span>
                                </div>
                                <div class="blog-box">
                                    <div class="blog-image">
                                        <div class="ImageWrapper">
                                            <a href="<?php echo esc_url( $content['url'] ); ?>"><img width="<?php echo esc_attr( $content['img_array'][1] );?>" height="<?php echo esc_attr( $content['img_array'][2] );?>" src="<?php echo esc_url( $content['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>"></a>
                                        </div>
                                    </div>
                                    <div class="blog-title">
                                        <h5><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h5>
                                    </div>
                                    <div class="blog-desc">
                                        <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                                    </div>
                                    <div class="share-blog"></div>
                                </div><!--end .blog-box-->
                            </div><!--end .blog-post-->
                        <?php } ?>
                    </div><!--end .blog-wrapper-->
                    <?php
                    $page_for_posts_id = get_option( 'page_for_posts' );
                    if ( $page_for_posts_id != 0 ) { ?>
                        <div class="blog-archive">
                            <a href="<?php echo esc_url( get_permalink( $page_for_posts_id ) ); ?>" class="more-link"><?php _e( 'VISIT OUR BLOG ARCHIVE HERE', 'business-park' );?><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="green-separator"></div>
                    <?php } ?>
                </div><!--end .entry-content-->
            </div><!--end .container-->
        </section>

<?php
    }
endif;