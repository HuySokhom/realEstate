<?php
  define('HTTP_SERVER', 'http://localhost');
  define('HTTPS_SERVER', 'http://localhost');
  define('ENABLE_SSL', false);
  define('HTTP_COOKIE_DOMAIN', '');
  define('HTTPS_COOKIE_DOMAIN', '');
  define('HTTP_COOKIE_PATH', '/osCommerce/admin');
  define('HTTPS_COOKIE_PATH', '/osCommerce/admin');
  define('HTTP_CATALOG_SERVER', 'http://localhost');
  define('HTTPS_CATALOG_SERVER', 'http://localhost');
  define('ENABLE_SSL_CATALOG', 'false');
  define('DIR_FS_DOCUMENT_ROOT', '/var/www/osCommerce/');
  define('DIR_WS_ADMIN', '/osCommerce/admin/');
  define('DIR_WS_HTTPS_ADMIN', '/osCommerce/admin/');
  define('DIR_FS_ADMIN', '/var/www/osCommerce/admin/');
  define('DIR_WS_CATALOG', '/osCommerce/');
  define('DIR_WS_HTTPS_CATALOG', '/osCommerce/');
  define('DIR_FS_CATALOG', '/var/www/osCommerce/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
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
    $fileName = DIR_FS_ADMIN . DIR_WS_CLASSES . 'autoload/' . $class . '.php';
  
    if( file_exists( $fileName ) ) {
      require_once( $fileName );
    }
  }
  
  function __autoload_namespaced_module($class) {
    $path = str_replace('\\', '/', $class);
    if (file_exists($file = (DIR_FS_ADMIN . DIR_WS_MODULES . $path . '.php'))) {
      require_once($file);
    }
  }
  spl_autoload_register();
  spl_autoload_register('gsAutoload');
  spl_autoload_register('__autoload_namespaced_module');