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
define('DB_NAME', 'growbeyond');

/** MySQL database username */
define('DB_USER', 'ria');

/** MySQL database password */
define('DB_PASSWORD', '2cVrhNxRE1q1');

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
define('AUTH_KEY',         '/42iL4H-+[*^&+*-q:Ky#TdmR]nk^9We}Z|(7JCI$|!*TQYvQg 3O^GcpY3ooz|B');
define('SECURE_AUTH_KEY',  'dLnS*3,iV_eoIOE745 ^.sF*CxHQJdYDN5(1#E RZbCHhyNvRGcT)y[@Y,|dr9(C');
define('LOGGED_IN_KEY',    '+`&b)$vMpbaD00$V2a87/C5mZpuVOmYRSM+8>L&?/``[P-:$P6!g{-FFt.myaCm8');
define('NONCE_KEY',        'r&EKtBQ^>b/D9d]A>TQ`8x=q9?9[B@.eZJ+<@z*4Z![wslp->4gX/|z#nwGN5Flj');
define('AUTH_SALT',        '&,LV1fSN~6<;y(LZt@jtiS8;5, 6fIZLx#cnJ|{TFSp*#$->+&1nQ/|4hPhJBUP_');
define('SECURE_AUTH_SALT', '?=_,pMg0GyYT2j!pz{TcY; J&K#?+%_k%+-[1fr%S*JO:wD0XU~-dhpa_-|(0nv=');
define('LOGGED_IN_SALT',   'dE5xv?T.!uh9Fh:+b|+=gB32@Dfz|oGB2ZV97uu8ETtC|9iA-=`fPefOe3.`/5Iy');
define('NONCE_SALT',       'g/hEe+66|p+uG&hAC/gE;^Ov1|><i|1Y3X]d7;DwgjNt[O6 x#cB&U!ufY0:7$2h');

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
