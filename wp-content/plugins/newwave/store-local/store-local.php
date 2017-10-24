<?php
/*
 Plugin Name: Newwave
 Plugin URI: http://wordpress.org
 Description: Plugins Newwave
 Author: newwave.vn
 Version: 1.0
 Author URI: http://newwave.vn/
 */

define('NEWWAVE_URL'            , plugin_dir_url(__FILE__));                    // URL

define('NEWWAVE_DIR'            , ABSPATH . 'wp-content/plugins/newwave/');     // DIR

define('NEWWAVE_DOMAIN'            , 'nws');                                    // DOMAIN

global $wpdb;
define('NEWWAVE_CUSTOMER'          , $wpdb->prefix . 'nws_customer');           // TABLE

require_once ('includes/class-tgm-plugin-activation.php');
require_once NEWWAVE_DIR . "store-local/store-local.php";
require_once NEWWAVE_DIR . "footer-bar/footer-bar.php";
require_once NEWWAVE_DIR . "service/service.php";
require_once NEWWAVE_DIR . "service/customer/customer.php";
include_once(ABSPATH.'wp-admin/includes/plugin.php');

global $wpdb;

class Newwave{
  private $_menu_slug         = 'newwave';
  public function __construct(){
    add_action('admin_menu', array($this, '_setActiveMenu'));
    add_action('tgmpa_register', array($this, 'plugin_activation') );
    add_action("plugins_loaded", array($this, 'init'), 99);
    
  }

  public function _setActiveMenu(){
    add_menu_page(__('Newwave', NEWWAVE_DOMAIN), __('Newwave', NEWWAVE_DOMAIN), 'manage_options', $this->_menu_slug 
      , array($this, 'init_null'), "dashicons-smiley", 30);
  }

  public function init(){
    $storeLocal = new StoreLocal();
    new footerBar();
    $this->create_table_customer();

    $dirStoreLocal    = WP_PLUGIN_DIR . "/wp-store-locator/wp-store-locator.php";

    if(file_exists($dirStoreLocal)){
      if( is_plugin_active("wp-store-locator/wp-store-locator.php") ){
        $storeLocal->auto_update();
        new service();
      }
    }
  }

  public function init_null(){}

  public function create_table_customer(){
    global $wpdb;
    $table_name = NEWWAVE_CUSTOMER;
      if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
               //table not in database. Create new table
       $charset_collate = $wpdb->get_charset_collate();

       $sql = "CREATE TABLE $table_name (
       `id` mediumint(9) NOT NULL AUTO_INCREMENT,
       `service` varchar(100) NOT NULL,
       `category` varchar(100) NOT NULL,
       `total` varchar(100) NOT NULL,
       `name_customer` text NOT NULL,
       `phone_number` varchar(20) NOT NULL,
       `store` varchar(150) NOT NULL,
       `time` date NOT NULL,
       `hours` varchar(20) NOT NULL,
       `email_store` varchar(100) NOT NULL,
       `email` varchar(100) NOT NULL,
       UNIQUE KEY id (`id`)
     ) $charset_collate;";
     require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
     dbDelta( $sql );
   }
  }

  public function plugin_activation() {
          //  plugin active
    $plugins = array(
      array(
        'name'                  => 'WP Store Locator', 
        'slug'                  => 'wp-store-locator',
        'required'              => true, 
      ),
      array(
        'name'                  => 'Taxonomy Images', 
        'slug'                  => 'taxonomy-images',
        'required'              => true, 
      ),
      array(
        'name'                  => 'WP Mail SMTP by WPForms', 
        'slug'                  => 'wp-mail-smtp',
        'required'              => true, 
      ),
    );

          // Setting TGM
    $configs = array(
      'menu'          => 'tp_plugin_install',
      'has_notice'    =>  true,
      'dismissable'   => false,
      'is_automatic'  => true
    );
    tgmpa( $plugins, $configs );
  }
  

}
function init(){
  new Newwave();    
}
add_action("plugins_loaded", 'init', 55);




add_action('nws_twicedaily_event', 'nws_store_twicedaily');

if (!wp_next_scheduled('nws_twicedaily_event')) {
  wp_schedule_event( time(), 'hourly', 'nws_twicedaily_event' );
}

function nws_store_twicedaily() {
  $dirStoreLocal    = WP_PLUGIN_DIR . "/wp-store-locator/wp-store-locator.php";
  if(file_exists($dirStoreLocal)){
    if( is_plugin_active("wp-store-locator/wp-store-locator.php") ){
      $storeLocal = new StoreLocal();
      $storeLocal->auto_update(true);
    }
  }
}










