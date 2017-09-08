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

//** SSL **//

if ( (!empty( $_SERVER['HTTP_X_FORWARDED_HOST'])) ||
     (!empty( $_SERVER['HTTP_X_FORWARDED_FOR'])) ) { 
 
    // http://wordpress.org/support/topic/wordpress-behind-reverse-proxy-1
    $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
 
//    define('WP_HOME', 'https://3ceasy.newwave.vn');
//    define('WP_SITEURL', 'https://3ceasy.newwave.vn');
 
    // http://wordpress.org/support/topic/compatibility-with-wordpress-behind-a-reverse-proxy
    $_SERVER['HTTPS'] = 'on';
}


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '3ceasy_full2');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'C{&=N_10G/;%1Dj5V<-wfeMy`[XHn]{6JEZo>z#96rQ*%r}=[w6.}*<c|l6#FP59');
define('SECURE_AUTH_KEY',  'it?75`g/IE:XBxnXQA?s2/13AykqqDe_}M<?BtXog}#*4 F!K]Rm:plRyT}Qt|x3');
define('LOGGED_IN_KEY',    'k5A0y<hq4:)_9XrSo6)%`}vPES>)d_Vz[+op(J%865M70+!c#:UKmkY3)+5&9h:(');
define('NONCE_KEY',        '),9Xx`xNmXt/k(4%:=#JF)V}IAa$YlAW;+F^b>+(Hka]5~~s@~N$Q?v0!KLt`Bxc');
define('AUTH_SALT',        '6P,,DWa3D[{U)bMCS/CVQ=KDD#D)akOXQg/O}#$E62CoTovN7qQQSK<d],/:9)kO');
define('SECURE_AUTH_SALT', 'r/JSyG>jWrr<byCsc(va2l=0#lHvsoZL?a%HG<$`(t]YQ]x$7k>;`>Qw99z-&!$J');
define('LOGGED_IN_SALT',   'H,g*u)&CcTNf|h#Jtqm4sTyw2HA]sq<7C$eM1QuN5-/(}MQ?R|xk+-|6O@KNHU@+');
define('NONCE_SALT',       ':c,J/k$WJ0INghq!3<eWcg@h=5Lw*]rx*XI;%KzZiCxB4~X05NYtTV12)`Y);=*J');

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
