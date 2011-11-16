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
define('DB_NAME', 'lazycrazyacres');

/** MySQL database username */
define('DB_USER', 'appie');

/** MySQL database password */
define('DB_PASSWORD', 'fFvG7Rqrvuk9');

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
define('AUTH_KEY',         'wCW+DE:d_ -!&};GY:M7o:l}Z-9$pPoHP_)`>~ TX,`vz|0WW@Izj`wS^mh/wZ;G');
define('SECURE_AUTH_KEY',  '1U!c@yt$^g|C744%!)*pR`7t,j1.X5Ws`c>j3% TZ9:;0ky]2&ZV-?~!z+HMJaAm');
define('LOGGED_IN_KEY',    'gbbsKWo?:^i2,j>kh3zh`Ns-nxVZ~4+-+hJ-vayntP.--|K^8E<S~g-:m~>M=.x)');
define('NONCE_KEY',        ']Z2L4CM|F,OU,c[d-*!>>R3HGJudf;<XUyOM-Pp@QX$Xe-oP8+Pps`n<2W%<fd_,');
define('AUTH_SALT',        'NI#DMAP)|^884vs5;e}%R_|e-B>=4`i+i{}od8x_31kl:k;|[;/.5,[V!vopPolC');
define('SECURE_AUTH_SALT', 'C$1Co#rV*|-QE8OVT&kM~bK^Jgshs?2R6:)4 (TpsO&:~.*[d$1[8IQ(yr#d-A^,');
define('LOGGED_IN_SALT',   'c}}|a{#fGq[|KR78r%# w6:59U%R+C_J|nW`|x52f6#Jnr1L_gI!N.>_E(5GVS!X');
define('NONCE_SALT',       '>=r+Xc{ZR#/.mMmZ|5dnuBmtLgI<70A/y`,pFwnr i(P7q:7<@$Qm+E?y|?yNO19');

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
