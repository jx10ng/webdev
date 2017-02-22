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
    <?php get_template_part( 'inc/partials/content', 'header-hero' ); ?>
    <?php get_template_part( 'inc/partials/content', 'header-social' ); ?>
  </div>
  <!-- End Wrapper --> 
</div>
<!-- End Hero --> 