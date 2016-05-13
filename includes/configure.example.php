<?php
  define('HTTP_SERVER', 'http://localhost');
  define('HTTPS_SERVER', 'http://localhost');
  define('ENABLE_SSL', false);
  define('HTTP_COOKIE_DOMAIN', '');
  define('HTTPS_COOKIE_DOMAIN', '');
  define('HTTP_COOKIE_PATH', '/osCommerce/');
  define('HTTPS_COOKIE_PATH', '/osCommerce/');
  define('DIR_WS_HTTP_CATALOG', '/osCommerce/');
  define('DIR_WS_HTTPS_CATALOG', '/osCommerce/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', '/var/www/osCommerce/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

  define('DB_SERVER', 'localhost.53');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', 'root');
  define('DB_DATABASE', 'oscommerce');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
  define('CFG_TIME_ZONE', 'Europe/Berlin');

  // autoload methods
  
  function gsAutoload( $class ) {
  	$fileName = DIR_FS_CATALOG . DIR_WS_CLASSES . 'autoload/' . $class . '.php';
  
  	if( file_exists( $fileName ) ) {
  		require_once( $fileName );
  	}
  }
  
  function __autoload_namespaced_module($class) {
  	$path = str_replace('\\', '/', $class);
  	if (file_exists($file = (DIR_FS_CATALOG . DIR_WS_MODULES . $path . '.php'))) {
  		require_once($file);
  	}
  }
  spl_autoload_register();
  spl_autoload_register('gsAutoload');
  spl_autoload_register('__autoload_namespaced_module');
  
  