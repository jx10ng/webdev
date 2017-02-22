<div class="site-branding">
	<div class="site-logo">
	   <?php business_park_the_custom_logo();?>
	</div><!-- end .site-logo -->
	<?php if ( get_theme_mod( 'header_text' ) ) : ?>
	   <div id="site-header">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<h2 class="site-description"><?php echo esc_html( $description ); ?></h2>
			<?php endif; ?>
	   </div><!-- end #site-header -->
	<?php endif; ?>
</div><!-- end .site-branding -->