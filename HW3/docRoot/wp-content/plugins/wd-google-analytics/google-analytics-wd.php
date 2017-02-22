<?php

/**
 * Plugin Name:     Google Analytics
 * Plugin URI:		  https://web-dorado.com/products/wordpress-google-analytics-plugin.html
 * Description:     Google Analytics WD is a user-friendly all in one plugin, which allows to manage and monitor your website analytics from WordPress dashboard.
 * Version:         1.0.15
 * Author:          WebDorado
 * Author URI:      https://web-dorado.com
 * License:         GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
if (!defined('GAWD_DIR')) {
    define('GAWD_DIR', dirname(__FILE__));
}

if (!defined('GWD_NAME')) {
define('GWD_NAME', plugin_basename(dirname(__FILE__)));
}

if (!defined('GAWD_URL')) {
    define('GAWD_URL', plugins_url(plugin_basename(dirname(__FILE__))));
}

if (!defined('GAWD_INC')) {
    define('GAWD_INC', GAWD_URL . '/inc');
}

if (!defined('GAWD_VERSION')) {
    define('GAWD_VERSION', '1.0.15');
}



$upload_dir = wp_upload_dir();
if (!is_dir($upload_dir['basedir'] . '/' . plugin_basename(dirname(__FILE__)))) {
    mkdir($upload_dir['basedir'] . '/' . plugin_basename(dirname(__FILE__)), 0777);
}
$GAWD_UPLOAD_DIR = $upload_dir['basedir'] . '/' . plugin_basename(dirname(__FILE__));


if (!defined('GAWD_UPLOAD_DIR')) {
    define('GAWD_UPLOAD_DIR', $GAWD_UPLOAD_DIR);
}

require_once( 'gawd_class.php' );

add_action('plugins_loaded', array('GAWD', 'get_instance'));

register_activation_hook(__FILE__, array('GAWD', 'activate'));
register_deactivation_hook(__FILE__, array('GAWD', 'deactivate'));
