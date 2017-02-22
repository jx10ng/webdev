<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wpadmin');

/** MySQL database password */
define('DB_PASSWORD', 'wppass');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'uUMw8ATu^UZ>mDlU~Y]ajm+r8Ej.+|W%>n(nLPA.diXB_RYgR-%2IF(@Y^N@Xxoe');
define('SECURE_AUTH_KEY',  'nL7v+wN9~n(R>.gjN1/CKA[18mZAR.^>b@-AWM$Cg%<jmL<!A#:Z`EihJ7(pDbd=');
define('LOGGED_IN_KEY',    'IwZ/gHm$(>$!T&Lh8FlQ-O?I87ySV *qc105i,SrpEu]F}p||cI8ct-sfNn`?]7X');
define('NONCE_KEY',        ';=}BQaJAE:vF>R*Mor5stVnUf4O#A1q}#ED&SzkeXObrnK/:%UyeS~aHnt~SJdX:');
define('AUTH_SALT',        '{-:-{r2XK]MeC>j SfQmWHvx)3v$ZcPv;s#P$Bpko|++^ST3]ofabU~;Em({<#M ');
define('SECURE_AUTH_SALT', '6@O~E?9y~HX[}IuXLo90st=]GUQxC5}s]N^]hIBh]#Z_v~e> 1s7J~G,;SdM^NJR');
define('LOGGED_IN_SALT',   'DJ2)mmTZ8{C3]u/MA|_dZ3VRBx07d!)e1Q9fbvu~RWp8^)2BlKP$Nt%)g>TvG=%G');
define('NONCE_SALT',       '7lpdt[.*yfroObpPb)#nw:{nNffV~X2/k%D1J Or#q`b|MFx Rm|l:S0|^z#9 03');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
