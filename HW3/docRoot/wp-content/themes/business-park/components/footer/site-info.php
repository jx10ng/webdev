	<div class="site-info">
		<?php
		$options = business_park_get_theme_options();
		if ( ! empty( $options['copyright_text'] ) ) { ?>
			<div class="bottom-footer">
			    <span class="copyright"><?php echo esc_html( $options['copyright_text'] );?></span>
			</div><!-- end bottom-footer -->
		<?php } ?>
		<?php esc_html_e( 'Proudly powered by', 'business-park' );?><a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>"><?php esc_html_e( ' WordPress', 'business-park' ); ?></a> |
		<?php
		$theme_data  = wp_get_theme();
		$theme_name  = $theme_data->get('Name');
		$theme_uri   = $theme_data->get('ThemeURI');
		$author_name = $theme_data->get('Author');
		$author_uri = $theme_data->get('AuthorURI');
		echo '<a target="_blank" href="'.esc_url( $theme_uri ).'">'.esc_html( $theme_name ).'</a>'.
				__( ' by ', 'business-park' ).
				'<a target="_blank" href="'.esc_url( $author_uri ).'">'.esc_html( $author_name ).'</a>';
		?>
	</div><!-- .site-info -->