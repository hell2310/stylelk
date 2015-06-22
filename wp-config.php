<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'stylelk');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '6t_y9-pNYM#v)GY&g/|dW&n^o>k5(E(t[m7*V>+`2.u)K!{!GU4>xNue^5LG4ae,');
define('SECURE_AUTH_KEY',  'cQ-28^MX$LiH=sXeJ0!n60cg!w8$Ygu0q~S( D+X+vS`!K1V:[xTo8QHHV6mf*F]');
define('LOGGED_IN_KEY',    'Zv8=$0-3r?tWs+Li8EvS0%>|N29z&;r6|zC{$wYh|XYq#-ZTwn.*L[lYan;[2mGi');
define('NONCE_KEY',        'h~cYWIytRlY=Z|P{}rD^msG28Z_pX|Z3QiKHq_~.eRp/L=-y:]|-_ X%5=Ys77h*');
define('AUTH_SALT',        ']|$e8ctLlX+j|ow~_r:UZ2:)|k:L-ef8dK6<]yv#6y~o%z5]dJdw.fmNOY]PYNX|');
define('SECURE_AUTH_SALT', '~@|T$,mi.{TM|e}O$OdXpRUfQRM@^5<%((lswT|g`R5CHQC[D )^,&T?DU,*jAgN');
define('LOGGED_IN_SALT',   'SyB}MkX.j5pzfrdUq$c|7<d0tcyncCkz`_2I-HcU2?jWF~,XkK:vwnQ=R!x3z$B6');
define('NONCE_SALT',       '$XOyj2;|ITZaHl+Uo|4xM48HemsClyNbN4>^+RWZ:o{ PW8R)@AQbekn%4Qk_AfC');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
