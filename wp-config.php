<?php
/**
 * The base configuration for WordPress.
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
 * @see https://codex.wordpress.org/Editing_wp-config.php
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_cotcwptheme');

/* MySQL database username */
define('DB_USER', 'wp_cotcwptheme');

/* MySQL database password */
define('DB_PASSWORD', 'wp_cotcwptheme');

/* MySQL hostname */
define('DB_HOST', 'localhost');

/* Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/* The Database Collate type. Don't change this if in doubt. */
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
define('AUTH_KEY', '$WdCigL*WOU3T*RQaAVgL1g ?]w4.6wit12Z)c#m0MJDtAzVYPNM=&g8>9*|9IG?');
define('SECURE_AUTH_KEY', 'Jghoi?y[Zrkn}xZ:#6RV=3LDPOIibul DE)}qW.iHH/xf~LHHp8;Y_u+>cb(t7e2');
define('LOGGED_IN_KEY', '?|bW~bDng~ZkV0u.h_5?(P|J4A4gf`2:a)UURGMF1?5 2Ih9vIzHho DhGMC`8rp');
define('NONCE_KEY', 'vcsNd;i=+[,]R`oMS[`a?{=swcslQ!}{;&yN.EiJ|-o7!tT*Q>6j?&K00vB3W^kg');
define('AUTH_SALT', 'kh-@KBW|B2Spn[$&FMMG]>GYUzUHp[#>8)p:58gUB_$AzA{iKB4 z}RMea1X:I67');
define('SECURE_AUTH_SALT', 'kQHg;-C7>%W>/tm@Mh)MNUYjwU(AiirLaR8`g3`VHA8_Y)jAn`2twuHM;)7-vfhZ');
define('LOGGED_IN_SALT', '#O}RS^i|+N*v(xrGr#2wDF=wRXh0J&aD[!)6[FC 0m|20B<}O!Z-v)9Gc3oF4Y!H');
define('NONCE_SALT', '38<O2V@XgnbNLUAlZ<JvUZ|5)yC%5z*Vwg-e?Z1`S_5&<Y}z#6Io.G!N8>tSfWKK');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/*
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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/* Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__).'/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH.'wp-settings.php';
