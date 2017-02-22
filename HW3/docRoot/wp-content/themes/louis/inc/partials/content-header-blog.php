<?php
/**
 * The template part for displaying the blog header
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package louis
 */
 
 	?>

<div id="hero">
  <div class="hero-bg"><img src="<?php header_image(); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" /></div>
  <?php
	$louis_hero_overlay_enabled = get_theme_mod( 'louis_hero_overlay_enabled', 'yes' );
	$hidden = '';
	if ( $louis_hero_overlay_enabled === 'no' ) {
		$hidden = 'hidden';
	}
	echo '<div class="hero-overlay ' . $hidden . '"></div>';
	?>
  <div class="wrapper">
   	<h2><?php single_post_title() ?></h2>
  </div>
  <!-- End Wrapper --> 
</div>
<!-- End Hero --> 