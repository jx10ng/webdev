<?php
/**
 * Business Park core file.
 *
 * This is the template that includes all the other files for core featured of Business park
 *
 * @package Theme Palace
 * @subpackage Business_Park
 * @since Business Park 1.0.0
 */


/**
 * Include options function.
 */
require get_template_directory() . '/inc/options.php';



/**
  * Write message for featured image upload
  *
  * @return array Values returned from customizer
  * @since Business Park 1.0.0
*/
function business_park_slider_image_instruction( $content, $post_id ) {
  $allowed = array( 'page' );
  if ( in_array( get_post_type( $post_id ), $allowed ) ) {
    return $content .= '<p><b>' . __( 'Note', 'business-park' ) . ':</b>' . __( ' The recommended size for image is 1920px by 1080px while using it for slider', 'business-park' ) . '</p>';
   }
   return $content;
}
add_filter( 'admin_post_thumbnail_html', 'business_park_slider_image_instruction', 10, 2);


if ( ! function_exists( 'business_park_alter_comment_form_fields' ) ) {
  /**
   * Alter the comment form fields
   * @param  array Array of fields to be customized
   * @return array Array of customized fields
   */
  function business_park_alter_comment_form_fields($fields){
      $fields['url'] = '';  //removes website field
      $fields['author'] = '<input id="author" class="form-control" type="text" placeholder="'.__( 'NAME', 'business-park' ). '" name="author"><div class="contact-icon bg-green"><i class="fa fa-user"></i></div>';
      $fields['email'] = '<input id="email" class="form-control" type="text" placeholder="'.__( 'EMAIL ADDRESS', 'business-park' ).'" name="email"><div class="contact-icon bg-light-grey"><i class="fa fa-envelope"></i></div>';

      return $fields;
  }
  add_filter('comment_form_default_fields','business_park_alter_comment_form_fields');
}


/**
 * Add helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Add structural hooks.
 */
require get_template_directory() . '/inc/structure.php';


/**
 * Add metabox
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/sections/sections.php';

/**
 * Custom widget additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
* TGM plugin additions.
*/
require get_template_directory() . '/inc/tgm-plugin/tgm-hook.php';

/**
 * Load woocommerce compatibility file.
 */
require get_template_directory() . '/inc/woocommerce.php';
