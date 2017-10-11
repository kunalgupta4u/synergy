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
define('DB_NAME', 'synergydb_uae');

/** MySQL database username */
define('DB_USER', 'synergy_uae_user');

/** MySQL database password */
define('DB_PASSWORD', 'SDeXdqW7_I3w');

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
define('AUTH_KEY',         '79M(gYECaE)g2{R~j3f1<P7^X7.y!JpJDROyo)RD9uGE#ob#pUyFy|PwN/g0.(Xb');
define('SECURE_AUTH_KEY',  '[#A/HckI>o2Y@E!/!f!&M&(3Xy)AU-ktxi#i{&H%&1$a/E6F~.z]7IE)lQrS)>QF');
define('LOGGED_IN_KEY',    '*7=dMxbD8VOEtMnM7!!&zjD9x=>PX63:VFQO9Sfk}fdZ)B3SC]?vOHBjbP+?~a_O');
define('NONCE_KEY',        'l?(ryp|*_?.1]8:SqtIO1k@AbYRUF*JYCh_W*_nIIM]AMK:4k6q4Z{NNDt7hJ{OM');
define('AUTH_SALT',        '!a4#EA4Qranf]0:TZv7JIF>tDJsS{AbgLYtRP$<[NLK~c~x*Rw:0qEzPW8`+@3y0');
define('SECURE_AUTH_SALT', 'rZ=}E2~f?qV=W/%m-+]gu2lWM/dYFRigZ6Sq@%SQt%o>OPx#zOdpIxp>8dbK.l{&');
define('LOGGED_IN_SALT',   'Zdh+iD]K~]lDbQr?&AK9bKf/!Kzid?{L>$1P,n8WY5(<eq*x-(?0t4Z6$$3j2NDj');
define('NONCE_SALT',       'MU;`<Vl;wzV`aFG4V%nX*Lzzy>X }B,Cg>&Wo7jgtfNv0&wVup:z.&V;EUhK)ygl');

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
