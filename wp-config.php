<?php
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
define( 'DB_NAME', 'kidba' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'Co1hTj7gN*r<mP:(BLb8r9pCi[2(n3&Sm&?#qmcEMS*+e(Wgyp`d_SgU!>H1/<&M' );
define( 'SECURE_AUTH_KEY',  '/JU]~SAN{|is+O%RUtj{~+R^N]-U0o*#xGN%L15X<YXw/=jiu_Z^QucuxG(@xrx!' );
define( 'LOGGED_IN_KEY',    'peJ|pz@J;0M;* jy9s?TmxvNk<`#k5`T%0nt4,,GH0[xt41&=KCfZw~yYO?[ug9<' );
define( 'NONCE_KEY',        '!wz=9o>+q)*TDvu#[y/!,hsp=nh,>KBHX?v]}7BV7 UZ|.dI*IDC}RTLjN[jS;.t' );
define( 'AUTH_SALT',        '.G^V|rz#mFjyQe4 _ WGAxb_lxIt?z_Cf$XAMCd]8Xmr?0WsV]?(OW]&a5vHl}y/' );
define( 'SECURE_AUTH_SALT', 'i+s3=C~fiY=B9~}l{v}UaGyhZoB02#au2:=~a9m34ZO;f9pSK_&PMl@S53:cKni.' );
define( 'LOGGED_IN_SALT',   '1Bp.WDm5Ye4z5K&CVdoiB|)lKKxK<(Ijo8B5*]>kzfM$w]#zU?Essk&,W68r9H]+' );
define( 'NONCE_SALT',       ';1NJaUiKH?Nx1%MGvinHcsPQZ3JdA!w3eE!0Oq4/c.sa}a[,.Q%a!hH%S,/Qcpoj' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
