<?php
define( 'WP_CONTENT_URL', 'http://oticadiaria.test/assets/' );
define( 'WP_CONTENT_DIR', '/var/www/html/oticadiaria/assets' );
define( 'DB_NAME', 'oticadiariapt_test' );
define( 'DB_USER', 'andre' );
define( 'DB_PASSWORD', 'pw' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'AUTH_KEY',          'ccK$%Q?*>k6VF$R%cG>`*{v ljx&eK ,Np2udeMA LyS@6x_6[[)C>@/|XN{XCj5' );
define( 'SECURE_AUTH_KEY',   'GD8L)Owd3vjVyFV%rL!R*|#3T7=|q=B]nj-xt.`gp(2gDy,po-Azhf-R?%k|KfhL' );
define( 'LOGGED_IN_KEY',     'n?9J4;x9-#g;Ig] WU&kvzI)i uU1F,^AFMQ}g|]oWX#sYH2yP<;!(3HseZhBU|^' );
define( 'NONCE_KEY',         '[zvXt[h qj+po!0Z,vH`o^%TM+(?1=z/y~f!)HuM[=v5)%}_$Nra$+`B}6; &BB~' );
define( 'AUTH_SALT',         'XXD3PjXGCC$}cYu3{mou+H.bOjkqjJl=q!s2$jey*W?] 26aA%jgRiz/EnHH@[O[' );
define( 'SECURE_AUTH_SALT',  'a)Ns7mMFo?J>#B]xQp7,MDc_+S?#KTKSa|3;U,TC,u|?0[|5o,b#6T82 x)fllTf' );
define( 'LOGGED_IN_SALT',    'DE1W!/j3*F;H(5SZ%VCRfz{:}}Jyi|JX_RPXhXQ_ErA4iU:$-_S|#~k6.aVLn:Dk' );
define( 'NONCE_SALT',        '~:WmYC%zd4G<zpr!bv,TR|&8S:w`CNbX{@4(3ck^iPbGrl.dwDmHK/AWL!8Y]CRf' );
define( 'WP_CACHE_KEY_SALT', 'u(}_xTw|p9E-+*Qih# jXu$_[.*V%vpPNXVq6*L|(P )]X?[HSoX(Xj2l#<dnvNT' );
$table_prefix = 'oticadiariapt_5n_';
define( 'WP_POST_REVISIONS', 10 );
define( 'CORE_UPGRADE_SKIP_NEW_BUNDLED', true );
define( 'AUTOSAVE_INTERVAL', 60 );
define( 'WP_ENV', 'development' );
define( 'WP_DEBUG', true );
define( 'WP_CACHE', false );
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
require_once ABSPATH . 'wp-settings.php';
