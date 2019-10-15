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

if (file_exists(dirname(__FILE__) . '/local.php')) {

/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress-project' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
}else{
	/** The name of the database for WordPress */
define( 'DB_NAME', 'epiz_22999767_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'epiz_22999767' );

/** MySQL database password */
define( 'DB_PASSWORD', 'aLbania12' );

/** MySQL hostname */
define( 'DB_HOST', 'sql102.epizy.com' );
}

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'N5WQ,P-+j9KEjXzsEe<z[o-xiz*]K=}3.1w@FJt @U9,W]$GnY>y#_doX_J^&e=H' );
define( 'SECURE_AUTH_KEY',  'K#J 4J8MCE[T0`[eE)N`<ePpu(b~x]X=Js=obHZ?Dessp4INTDO-[0!0_2f75&v3' );
define( 'LOGGED_IN_KEY',    '/Al)iM3{F6l}X|6cQX+L%C]Kc({|rm?QI W}T~hqB]4k@ZdTw$K<1@I>~vj`UHI]' );
define( 'NONCE_KEY',        'UtB]xC6c-62n`y4`$HT.G}x}#&vyU+RbhJ*!lQB9R+D#uXU#X@}v+YB^X[25^>76' );
define( 'AUTH_SALT',        ';:Kr<k4OJO!Jm<>dUVlpI (`3OM(i/[vsxS~r7SQxUYQYmG~7fV8!_*h5@A>NY;T' );
define( 'SECURE_AUTH_SALT', 't`b]m}+:$VlJ4F>X|&ZAv]zuR)Fzg%FWdQUw zUi6U~.BqQ3Wdi(X4YNT2`M ^y-' );
define( 'LOGGED_IN_SALT',   '{/Gk:PG[<bsy[?Q#?blmZ[?CY/fIKu;PC4ssXIE#yEm|hp%ko]Up(/:l+5%wKRgr' );
define( 'NONCE_SALT',       'vB>ek6 CAZ0@efRTO}TN-0urEN8 O(f}oq&BxHL5y{Ta~TIKInUl!Hv]_ Brsq[!' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
