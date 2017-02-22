<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Park
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<div class="sidebar os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.3s" data-os-animation-duration="2s">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside>
