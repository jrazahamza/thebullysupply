<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sql_thebullysupp' );

/** Database username */
define( 'DB_USER', 'sql_thebullysupp' );

/** Database password */
define( 'DB_PASSWORD', 'c25a61e1cbd52' );

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
define( 'AUTH_KEY',         'B)_<wdV7^>n5073@E~-:2qks2$oq^P:LWY26O6L/.3;Dwm;^c~e.]C)^/Tp)QdI;' );
define( 'SECURE_AUTH_KEY',  'q.LK{$&93-6^e3]qr#=f<Db]}oFU-9v^SK0XV;epDcK4G[+6:_Rt *Glxpr^vmUe' );
define( 'LOGGED_IN_KEY',    '4(EL*QSFKj8C<YT!DTPJzJB6/b)FVKn txojf-cnuYz^IXFKJxUR&S`r@ONB*NK8' );
define( 'NONCE_KEY',        '~06UZwly^UoA:8zDted{8o$$bA(=vfI7d2<3t2uM6;>5}Fm]y>-S+9yvyP(O4>;T' );
define( 'AUTH_SALT',        ' {sQGw&]k+>NR(F_uiO?G,zY-kn1?o{!^O,;^e5$A& JF3(,9$`EDhC94S;+{pvN' );
define( 'SECURE_AUTH_SALT', '%,W[Rbe%yqmAePZ:r1GJNp<u>&^$g48b3<;;YrR.d{;oOJX};3pJ7,Add%Bj>QYy' );
define( 'LOGGED_IN_SALT',   'F^b^7zzO+nI.s3/4UtnD|cBc=qJs,`&cI$6LY=IFDzWZg;;(7/U%g$NF4a8b#p?J' );
define( 'NONCE_SALT',       '?>[pR*!3OdvmWTM8f:h^h,u=q6cFG}IIX^i|F-LCX,&KcUbgk)v@(k>V1%Z^}(T>' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_3ee71d_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
