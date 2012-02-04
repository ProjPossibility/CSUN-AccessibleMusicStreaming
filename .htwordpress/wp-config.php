<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'pass');

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
define('AUTH_KEY',         'A[*Dhd+33f)JbT&SZ;4([M|mRH/@$FHM9AY,W>e8]rT$%|+~(AkNqZ#.pSLVNW|]');
define('SECURE_AUTH_KEY',  'A|%*%?@+{RGQOZ}Eg-}pF*=Pw2+4$P0CA2|AwS.,pO$KPUzZ#+B!-12si-f`5^sa');
define('LOGGED_IN_KEY',    'L07v_RqWRg`..q@|&k.o8$e#M&d7lDS~!v&sxb$%:0,vOrez.C[sqH1[Lh.>#eE~');
define('NONCE_KEY',        'A b$2jlo|chHu+-h|kb&9jM+0KRpeg:i{Qs`ufBXnU~fT:.V3.7v+q-W||qi1c!F');
define('AUTH_SALT',        's[ spDocp82o5lGFtY1YfV6_-d}=k@rXRXX>C^Cs|6>EkI.ZQEtVK6M9J9p0NoBZ');
define('SECURE_AUTH_SALT', '5B;/68+EoeB0F,4:a+)sZmfZNp^]:Ft?4U:o#1Q|2>,1q#5c.OG?l<d*Ts1.-%E^');
define('LOGGED_IN_SALT',   '#+[-J6?Q&a](#x+2+w1rFCKHV|TxYb0EmcWK9<@THN^(},jyK8!sBc{?X-V7TQ6E');
define('NONCE_SALT',       'qAPo*d+MK2v0PN~H0E|z_9D3[G6dXbYK}jZ;S9_dz)W8w4I%=^!d3gckl+q~VNyT');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

