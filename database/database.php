<?php
    function wideban_database_install() {
    global $wpdb;

        $db_table_name = $wpdb->prefix .'wb_banner';  // table name
          $charset_collate = $wpdb->get_charset_collate();
           $sql = "CREATE TABLE $db_table_name (
                    id int(11) NOT NULL auto_increment,
                    texte text NOT NULL,
                    bg_color varchar(11) NOT NULL,
                    txt_color varchar(11) NOT NULL,
                    type_btn tinytext NOT NULL,
                    btn tinytext NOT NULL,
                    btn_bg_color varchar(11) NOT NULL,
                    btn_txt_color varchar(11) NOT NULL,
                    link varchar(255) NOT NULL,
                    active tinyint(1) NOT NULL DEFAULT '1',
                    UNIQUE KEY id (id)
            ) $charset_collate;";
        
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
}

function  wideban_database_uninstall() {
    global $wpdb;
    $db_table_name = $wpdb->prefix .'wb_banner';  // table name
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "DROP TABLE IF EXISTS ".$db_table_name;
    $wpdb->query($sql);

     $sql = "DROP TABLE IF EXISTS ".$db_table_name2;
    $wpdb->query($sql2);


}
