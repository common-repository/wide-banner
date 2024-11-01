<?php
/*
 * Add mymenu to the Admin Control Panel
 */
 
class wb_banner
    {

        public function __construct()
        {

            defined( 'ABSPATH' ) or die( 'go away !' ); // sécurité
            ///construction du menu
            add_action('admin_menu', array($this, 'wideban_menu_admin'));    
            
        }

        ///// menu element
        public function wideban_menu_admin() {
        /**
         * create element menu
         */
        add_menu_page('Wide Banner', 'Wide Banner', 'manage_options', 'create_wb' , array($this, 'wideban_create_wb'), 'dashicons-admin-site-alt', 65);
        add_submenu_page( 'create_wb', 'Add a banner', 'New banner', 'manage_options', 'create_wb');
        add_submenu_page( 'create_wb', 'List of banners', 'List of banners', 'manage_options', 'list-of-banner',array($this, 'wideban_list_wb'));
       
        
        }
        ///page ->create banner
        public function wideban_create_wb() {
           //verify
            if (!current_user_can('manage_options')) {
                wp_die(__('You do not have the rights to access this page.'));
            }
           //create page
     
              include(plugin_dir_path(__FILE__).'../views/wide-banner-options.php');
            
          
        }
        ///
        public function wideban_list_wb() {
             //verify
            if (!current_user_can('manage_options')) {
                wp_die(__('You do not have the rights to access this page.'));
            }
           //create page
            include(plugin_dir_path(__FILE__).'../views/liste-wb.php');
            wideban_liste_wb();
            
        }
    
       



    
}
