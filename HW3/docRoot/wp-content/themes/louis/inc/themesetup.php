<?php

// load colors
function louis_load_theme_colors()
{
	$bodyBackgroundColor = esc_attr( get_theme_mod( 'louis_body_background_color', '#ffffff;' ) );
	$accentColor = esc_attr( get_theme_mod( 'louis_accent_color', '#0ea6f2' ) );
	$heroImageOverlayColor = esc_attr( get_theme_mod( 'louis_hero_overlay_color', '#1f242d' ) );
	$heroImageOverlayOpacity = esc_attr( get_theme_mod( 'louis_hero_overlay_opacity', '90' ) );
	$heroImageBlur = esc_attr( get_theme_mod( 'louis_hero_blur_enabled', '0' ) );
	echo '<style type="text/css">';

	if ( !empty( $bodyBackgroundColor ) ) {
		$hash = '';
		if ( strpos( $bodyBackgroundColor, '#' ) === false ) {
			$hash = '#';
		}
		echo 'body { background-color: ' . $hash . $bodyBackgroundColor . '}';
	}


	if ( !empty( $accentColor ) ) {
		$hash = '';
		if ( strpos( $accentColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '.blogposttitle a:hover, a,  .blogpostmeta .fa, .featurewidgeticon .fa, .socialmediamenu .fa, .profile_cont .fa, .herotext a, .postcontentmeta .fa, #hero .fa, .authormeta a, .post-edit-link, #content a, #comments a, #respond a { color: ' . $hash . $accentColor . '} ';
		echo '.postmeta li a:hover, .blogpostmeta a:hover, .postcontentmeta a:hover, .sidebarwidget .fa:hover, .sidebarwidget li a:hover, #cssmenu > ul > li:hover > a {color: ' . $hash . $accentColor . '} ';
		echo '.page-links a, .tab_head li:hover, .blogimage .fa, .search input.submit, .tab_head li:hover, .tab_head li.active, #hero .button.blue, .pagination a{background-color: ' . $hash . $accentColor . '} ';
		echo '::selection {background-color: ' .$hash.$accentColor. '}';
		echo '*::-moz-selection {background-color: ' .$hash.$accentColor. '}';
		echo '.main-navigation ul ul a:hover {background-color: ' .$hash.$accentColor. '}';
		//echo '.menu-item.has-sub a::before, .menu-item.has-sub a::after {background: ' .$hash . $accentColor. ' !important;}';
		echo 'h1.site-title a,  .postcontent a:hover, .footerwidget a:hover, .authormeta a:hover, .post-edit-link:hover, #hero .button.seethrough, .sidebarwidget a:hover, .tab_cont .clear, .logged-in-as a:hover {border-color: ' . $hash . $accentColor . ' } ';
		echo '.tab_head li:hover a {color: #fff !important;}';
	}
	echo '#hero .hero-overlay {background-color: '.$heroImageOverlayColor.'; opacity: '.round($heroImageOverlayOpacity / 100, 2).'}';
	echo '#hero .hero-bg {filter: blur('.$heroImageBlur.'px); -webkit-filter: blur('.$heroImageBlur.'px);}';
	echo '#hero .hero-bg { background-image: ' . ( $hero_image_bg ? 'url(' . $hero_image_bg . ')' : 'none' ) . '}';
	echo '</style>';
}

add_action( 'wp_head', 'louis_load_theme_colors' );