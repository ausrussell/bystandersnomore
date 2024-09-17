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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'bMYuJBzvxn<Z^x<G3m VxQVdi_hcw1,y&8mK*_AR?d*.EDUf_)JdD=O~JlZ0r[/z' );
define( 'SECURE_AUTH_KEY',   'f2$lRz:,$: [uX:Co_p8H=qI^S7tq@Ag]K99BF_hqPg_9*mS]KW:K$NM8G(w;1rE' );
define( 'LOGGED_IN_KEY',     '&YWC5/`Ao/y+C9V^jmG}Q.<&+ACT/G^Yg_EaDIC9UNZJmb1.s*/mbQ/ BjN?]HC|' );
define( 'NONCE_KEY',         'UTT)>1U^~2F6xm4z!eWALS3zJym.7oL5F]>[RE>w7C&hY-%)HxR`of2QyrzC8Q])' );
define( 'AUTH_SALT',         '%l}azp_c2TlXt?jhfKFKg>yu;Fp!tLDf.u*G:Zj>)rSyA$FZQ%]qts]|:n~JJy&Z' );
define( 'SECURE_AUTH_SALT',  'Z@-72IB af9`=bN%VlH}5,RY^hO+KkJLi@@QR7T1QTt~vUl)Bc]2%1Li-IQt3?Ym' );
define( 'LOGGED_IN_SALT',    '<jB8>Tmfv(OW;q)Jw}={woz<{IR>WUe6x*rlrBQ[;V74x0=+BYdBq<lkV$&uArvM' );
define( 'NONCE_SALT',        '$>xt&{uqaPF{]&(v4i xRqxV>kgnb7vg]=HQTXn +4?t9mJX8HHbbcAVyFemj@|g' );
define( 'WP_CACHE_KEY_SALT', '{M3G-gHLP^Oc=TM,Cft87A<mpAfwG EUG8tg(I0jsf*RngpK-{[[.sx4,*gRptEL' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
