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

// Install plugins without FTP (loclhost)
define('FS_METHOD', 'direct');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'fanatka');

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
define('AUTH_KEY',         ';0:$bmn!JG#>|Y3l,>8U1xX{L]3m.1uS3T-A=-1s/_,zX@,~qEp8:4<I(D}:;]93');
define('SECURE_AUTH_KEY',  'm2;^lkoRT{8ScEJO6O&~,yUC9FK4VoPud[`Q[>]/A~1t@1o[id oS|C9M1_yh,{V');
define('LOGGED_IN_KEY',    'R]+[FZ.[pmSK%jwgn[C`,m1.;ILJ-&dZ3=vo`gT:+HxHd0{=xVp)8[na@X#~e$jz');
define('NONCE_KEY',        '<+3iq<F;*)*8sPCtHns8g%:m-.a(3U|^z$B$I<Y~U&w ]Mj|GYv6MGlU+~gS;4)5');
define('AUTH_SALT',        '3Ey*&C!`ZTnCNO8U{.~}Bi6^f.oozJX:9USY:A3=&6zUQJFc$%<:7VT,o] =qFeS');
define('SECURE_AUTH_SALT', 'auILA&p_tG%=,/RON:au}[ENov%.tB.*FOS<Y4.d&8}}]K%,nT-5giju?4Y1NR(M');
define('LOGGED_IN_SALT',   ',I3jg|=Vm>jf+*A;)v~5;Ub/SSH|019Foo|xzPkLPj(R.UE|=xj1`Gqv?#YC4)QS');
define('NONCE_SALT',       '~T@&bVS+S=|UY,{/^CJIEqa&CZ-^gm* dr%~g:e2H})+75.UaPtEsYop<V.M{}(V');

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

