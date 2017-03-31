
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
define('DB_NAME', 'sport');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'zgoba-90');

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
define('AUTH_KEY',         '^Gf>pp]%:&=Y`[&DBq|L87)E2shJ!#6,ycq@kZfJfUBRIf<DN%6Aj2^ZGD`M}##2');
define('SECURE_AUTH_KEY',  '#`N`N8p?l;#U#Qn]g||-r(lKGrj)GY.7o!$3veL6.3Zd`aFuomG_J* CO*Rp/|Db');
define('LOGGED_IN_KEY',    'b5%q3Im]GNpSWFEn[0dUW/0o g3PI|~68Hh9p2V)ifI19-fDZvenKk61^}8C?#YK');
define('NONCE_KEY',        '5F=up[34S.*X(@IDPVTNVslq+TY@Og:9)3&8X8Q#N$01x8i{01.`*ve0TuuDXdVd');
define('AUTH_SALT',        'wsK~3H600-JoSk/O}xP%Q/_ [}vZJ.G{elIeqzo9FXXwL[=p S%Z^W}-qxrxzg)+');
define('SECURE_AUTH_SALT', 'Ke./k;9 <:Y$<nQ^aFCz*gU#pFN+cM8dJ)%0oZ^v2u5!x,liF|f2P|[`7D[5{* t');
define('LOGGED_IN_SALT',   'd[#h,`6K4HW:*li#:_c@y^kcPnGp9M[i_kwz9nRWYfgB_1DSs](Z&C:(&gH7ioyU');
define('NONCE_SALT',       '<?Wzdt}qDjay?)GriQc9x kPFu_U][5}jvFNG;tic6FBe5MJ$k(w#u)>1:~vF~wk');

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
