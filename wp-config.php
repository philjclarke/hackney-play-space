<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'downview_WPPNT');

/** Database username */
define('DB_USER', 'downview_WPPNT');

/** Database password */
define('DB_PASSWORD', 'C#7_2wBg!BhwS-rHf');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '464ed43e63d6cd010c855ae21f907800a795b4f73996cc8d485217aaac5103cd');
define('SECURE_AUTH_KEY', '9d289af48fc2138a0431e8572a146b3d874d4db566030aede66169e7112b5702');
define('LOGGED_IN_KEY', 'f4c5a19cfa457db162214bf9176a33122c40192988cf76579eed6fefc6d010be');
define('NONCE_KEY', 'e9d4443051c89fde5b0ab7d87712dd4ed0f133b028de678a3f98635f54675638');
define('AUTH_SALT', 'fdfe2c98d10afdd834eb96df186fdbf8dc094c587292513dc94af39495fa2b6e');
define('SECURE_AUTH_SALT', 'd4c4ae2ea981c03913103aa156b64bdb11441382ef5a599f4c1b0837108dc243');
define('LOGGED_IN_SALT', '20ed8848d44213b4e1f6f1d5671b0331b0582b75d30bcabd22eb1008b36204db');
define('NONCE_SALT', '718d2f1f5c0b716c2c162aa92fadaf9a60e74f31f965d0dc37347f5a56d1cb00');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '0kx_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 5);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
