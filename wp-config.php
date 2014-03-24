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
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wp_firesale');

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
define('AUTH_KEY',         '`Gv S+YL+>_ki.#R^K{--/Tj4p8w uM?*91poxQDHc!poFsCWZ+ME-Jzf83(4uU{');
define('SECURE_AUTH_KEY',  '~._&@Jc535!wT_x7`LB$R4E69!h4l]72_Tu/i4_#mzWW(og_R9;><Q;+^X],]Y!U');
define('LOGGED_IN_KEY',    'QlfC+>r>Y`Xa@}mx`1m-jwbIDGlgiA;-q`2@iV[:+T[Kz,^|2~,~C8Yl[8/^tpU,');
define('NONCE_KEY',        '}|+~WZ-j4RKgJ12=$BWc_JVl[B%imdS8xfyDff1C&#)%KQSIAX]t~FR=6=iTs8z{');
define('AUTH_SALT',        ';;6RilfF&42Nq86=*}LMW $ogsx?2QU+{1bxFd>igO%6_w`6~x]7rUeA%z~V2+r;');
define('SECURE_AUTH_SALT', 'kQwQrch _!-E-FZM$M[3$k15C9`csUev?W12rF: nX1OzCF_c+!W%Ebp{n7$[Wzg');
define('LOGGED_IN_SALT',   '_af3Im.$=Hk--<qwE!-%[LO3Gz fO!;+Qo>: s`~Z6ds(lEgI12|IoZl? p_!LA;');
define('NONCE_SALT',       'j$1M{B:uxNn3Q84E)hP; Gf+bDjDjGL8C&Eea^!4i`mUOx0?<<!i(*$c?->`J^o:');

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
