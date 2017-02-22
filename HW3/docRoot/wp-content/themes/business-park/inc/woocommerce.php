<?php
/**
 * Business Park woocommerce compatibility.
 *
 * This is the template that includes all hooks related to woocommerce
 * 
 * @package Theme Palace
 * @since Business Park 1.0.9
 */


/**
 * Make theme WooCommerce ready
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'business_park_page_section', 10);
add_action('woocommerce_before_main_content', 'business_park_primary_content_start', 20);

function business_park_page_section() {
  echo '<div class="container blog-contents">';
}

function business_park_primary_content_start() {
  echo '<div id="primary" class="content-area">
    		<main id="main" class="site-main" role="main">';
}

add_action('woocommerce_after_main_content', 'business_park_primary_content_end', 10);
add_action('woocommerce_sidebar', 'business_park_page_section_end', 20);

function business_park_primary_content_end() {
  echo '</main>
  </div>';
}

function business_park_page_section_end() {
  echo '</div>';
}
