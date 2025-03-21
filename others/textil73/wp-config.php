<?php
define('WP_CACHE', true); // WP-Optimize Cache
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'textil73_db' );
/** MySQL database username */
define( 'DB_USER', 'andre' );
/** MySQL database password */
define( 'DB_PASSWORD', 'pw' );
/** MySQL hostname */
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
define( 'AUTH_KEY',         'fduz9h3v5i0cibhgdblixcla6j77pulbnkjzjrcjtbzahuuqkrhvns47wkubvam1' );
define( 'SECURE_AUTH_KEY',  'yntzgxyrvrmteqfkwjmanqiywijfvryezeaxzuruqxoukvdsecggazg8itwm1juv' );
define( 'LOGGED_IN_KEY',    'ptpdhaq5pwjzhrvvfjkkmzw9bicexzyis5jwycgmchjqgmk6tsovb4x5derpy3h6' );
define( 'NONCE_KEY',        'ncbjyzvz0tezvttc32ifslqi5rc5eywytqn4cetw6vaq6ndbvj4qpe7ctqldzhbq' );
define( 'AUTH_SALT',        'l2wcn1zqfja3doi9w1agoajgjrhvgqpnodpgijaluvbl1bzfuqyzx40i5vvgzkcv' );
define( 'SECURE_AUTH_SALT', 'qi6zitd2jfpsylgumvkyy7oj4ipvem2bj9s0fb2ct5vbjubcumhrinlj4qlwjaxu' );
define( 'LOGGED_IN_SALT',   'lipv3sjp9theagm0oxnel463p17uauvxk9umyvxd8iajsltzqgrskre6lnl031ym' );
define( 'NONCE_SALT',       'uyjtptwcr5qm8em4l8gxvccex3spcgbxpmj23l5pbme40ctvicn6nr3jutxaxk8f' );
/**#@-*/
/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpd7_';
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
define( 'WP_DEBUG', false );
/* Add any custom values between this line and the "stop editing" line. */
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
