<?php
/**
* Displays social navigation menu
* @param array $args Arguments
*/
if ( has_nav_menu( 'top' ) ) {
    $args = array(
        'theme_location'  => 'top',
        'container'       => 'nav',
        'container_id'    => 'site-navigation',
        'container_class' => 'main-navigation',
        'menu_id'         => 'primary-menu',
        'menu_class'      => 'menu nav-menu',
        'items_wrap'      => '<button class="menu-toggle icon"><i class="fa fa-bars"></i></button><ul id = "%1$s" class = "%2$s">%3$s</ul>',
        'depth'           => 0,
    );

    wp_nav_menu( $args );
}
?>
