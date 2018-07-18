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
define('DB_NAME', 'codeline_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'sonoftheweb');

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
define('AUTH_KEY',         'aY34c$e@VOAW!sVeEi3lF[n {9n/@2yPd%a&%a64!otF2h)D%ALWuauoYY6X&K>R');
define('SECURE_AUTH_KEY',  'x8V5FI/VC[>/FeT@E_?v_3o}i0A8/R$u5XfOzS7_9Hoo.Ae9D5jm)[px=#V7[IpB');
define('LOGGED_IN_KEY',    '.6J;fM+l%Zj{5fk9}jxSUKRc3?OY6c4TLRx<Frdkhd u}|]jsxUc)e.,@@q`aoUB');
define('NONCE_KEY',        'NgU%Kg(m/KJ:#,;iA5E=t$EFhzWH}ty`#ndOtCpxe=_MqNHhtXS4M_T ,C>ioLgW');
define('AUTH_SALT',        '][SLUn&eI@l<og&nw}okGd$(-{.SZ vjR|utRwO471xz|n+g!>c..EbRLMwD9[SP');
define('SECURE_AUTH_SALT', 'es%6&mFaH3L6-_I{&z*jka&O2+`!tf5(@R,P7k+wmj@i%Nx5uq9b&npnzH!Oknp#');
define('LOGGED_IN_SALT',   ';jz,Rk!Es.540{K$W8*.XWtqyFU./y(<^4:Jyg`|IP$7}o4RR`/uq>wXQg~wq:O?');
define('NONCE_SALT',       '4qRY3m{e9&)Ys)$NBhl&l?$4.}{Ik:N57BjrawcNV3CERJj!hF;zl99BFDc9=w:u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'codeline_';

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
define('WP_DEBUG', true);

define('FS_METHOD','direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
