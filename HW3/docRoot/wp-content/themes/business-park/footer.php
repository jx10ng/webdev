<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Park
 */

/**
* business_park_content_end hook
*
* @hooked business_park_content_end -  100
*
*/
do_action( 'business_park_content_end' );


/**
* business_park_scroll_top hook
*
* @hooked business_park_scroll_top -  10
*
*/
do_action( 'business_park_scroll_top' );


/**
* business_park_footer hook
*
* @hooked business_park_footer_start -  10
* @hooked business_park_footer_logo -  20
* @hooked business_park_footer -  30
* @hooked business_park_copyright -  90
* @hooked business_park_footer_end -  100
*
*/
do_action( 'business_park_footer' );


/**
* business_park_page_end hook
*
* @hooked business_park_page_end -  100
*
*/
do_action( 'business_park_page_end' );
?>

<?php wp_footer(); ?>

</body>
</html>
