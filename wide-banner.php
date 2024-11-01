<?php
/**
 * Plugin Name: Wide Banner
 * Plugin URI: 
 * Description:  Display a banner on your website. Easy, simple and free banner plugin for wordpress.
 * Version: 1.0.4
 * Author: Plugins and Play
 * Author URI: https://www.plugin-and-play.fr
 * License: GPL2
 *
 */

/********sécurité *********/
defined( 'ABSPATH' ) or die( 'go away !' ); // sécurité
global $wp_version; // version de wordpress
if ( !version_compare($wp_version, "4.8", ">=")){
  die ("Your WP version is too old. Please update.");
}
/*********************/
 require_once(__DIR__.'/database/database.php');
function activation_wb_banner(){
 error_log("For information: it has just been activated.");
    wideban_database_install();
}
register_activation_hook(__FILE__, "activation_wb_banner");
/****/
function uninstall_wb_banner(){
    error_log("For information: there has just been an uninstall");
     wideban_database_uninstall();
}
register_uninstall_hook(__FILE__, "uninstall_wb_banner");
/****/
function deactivation_wide_bn(){
 error_log("For information: it has just been desactivated.");
     wideban_database_uninstall();
}
register_deactivation_hook(__FILE__, "deactivation_wide_bn");
/*********************/


//include wb fonctions 
require_once plugin_dir_path(__FILE__) . 'include/functions.php';
// Include wb class 
require_once plugin_dir_path(__FILE__) . 'include/wb.class.php';

/////
    $banner = new wb_banner();

?>
