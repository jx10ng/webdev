<?php
/**
 * Business park widgets inclusion
 *
 * This is the template that includes all custom widgets of Business Park
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


/**
 * Add social link widget
 */
require get_template_directory() . '/inc/widgets/social-link.php';

/**
 * Register widgets
 */
add_action( 'widgets_init', function() {
   register_widget( 'Business_Park_Social_Link' );
});
