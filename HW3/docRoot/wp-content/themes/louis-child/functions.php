<?php
function my_theme_enqueue_styles() {

    $parent_style = 'louis'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $louis, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'louis-child',
        get_stylesheet_directory_uri() . '/style.css',
        array( $louis ),
        wp_get_theme()->get('1.0.0')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
?>
