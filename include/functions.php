<?php

function wideban_admin_scripts(){ 
            wp_enqueue_style( 'admin-css', plugins_url('../css/wb-plugin.css', __FILE__), array(), null, 'all' );
            wp_enqueue_script( 'admin-init', plugins_url('../js/scripts.js', __FILE__) , array('jquery'), null, true );

}
 add_action( 'admin_enqueue_scripts', 'wideban_admin_scripts' );
/////////
function wideban_front_styles() {
    wp_enqueue_style( 'admin-css', plugins_url('../css/wb-front.css', __FILE__), array(), null, 'all' );
}
function wideban_front_script() {     
    wp_enqueue_script( 'wideban',plugins_url( '../js/wb.js', __FILE__ ) , array( 'jquery' ), '1.0', true );
    wp_localize_script( 'wideban', 'ajaxurl',  admin_url( 'admin-ajax.php' ) );
    
}
add_action( 'wp_enqueue_scripts', 'wideban_front_styles' );
add_action( 'wp_enqueue_scripts', 'wideban_front_script' );
/////////
function wideban_load_textdomain() {
  load_plugin_textdomain( 'wideban', false, basename( dirname( __FILE__ ) ) . '/../languages' );
  
}
add_action( 'plugins_loaded', 'wideban_load_textdomain' );
////
add_action( 'wp_ajax_save_wb', 'wideban_save_wb' );
add_action( 'wp_ajax_nopriv_save_wb', 'wideban_save_wb' );

function wideban_save_wb() {
   
    
    ////verify et sanitize color
    if(empty(sanitize_hex_color($_POST['bg_color_hexa']))){ $bg_color_wb = sanitize_hex_color($_POST['bg_color']); }else{ $bg_color_wb = sanitize_hex_color($_POST['bg_color_hexa']);}
    if(empty(sanitize_hex_color($_POST['text_color_hexa']))){ $text_color_wb = sanitize_hex_color($_POST['text_color']); }else{ $text_color_wb = sanitize_hex_color($_POST['text_color_hexa']);}
    if(empty(sanitize_hex_color($_POST['btn_bg_color_hexa']))){ $btn_bg_color = sanitize_hex_color($_POST['btn_bg_color']); }else{ $btn_bg_color = sanitize_hex_color($_POST['btn_bg_color_hexa']);}
    if(empty(sanitize_hex_color($_POST['btn_color_hexa']))){ $btn_text_color = sanitize_hex_color($_POST['btn_color']); }else{ $btn_text_color = sanitize_hex_color($_POST['btn_color_hexa']);}
    
    //verify major fields
    if(!empty(sanitize_text_field($_POST['wb_banner']))){
        if ((isset($_POST['add_btn'])) && ((sanitize_text_field($_POST['add_btn']) == 'btn')||(sanitize_text_field($_POST['add_btn']) == 'full'))) {
            //add link?
             if(((!empty(sanitize_text_field($_POST['wb_btn_text']))) && (!empty($_POST['btn_link']))) || (sanitize_text_field($_POST['add_btn']) == 'full')
               ) {
                 $btn = '';
                 $btn_type = sanitize_text_field($_POST['add_btn']);
                 if(sanitize_text_field($_POST['add_btn']) == 'btn'){
                    $btn = sanitize_text_field($_POST['wb_btn_text']);
                 }
                
                 //
                 $link = esc_url_raw($_POST['btn_link']);  
                 /// verify url 
                 if (preg_match('#^(http|https)://[w-]+[w.-]+.[a-zA-Z]{2,6}#i', $link)){
                //everything is OK
                 global $wpdb;
                $db_table_prefix = $wpdb->prefix;
                     
                  $add_wb = $wpdb->prepare("INSERT into ".$db_table_prefix."wb_banner (texte,bg_color,txt_color,type_btn,btn,btn_bg_color,btn_txt_color,link) VALUES (
				'".sanitize_text_field($_POST['wb_banner'])."',
				'".$bg_color_wb."',
                '".$text_color_wb."',
                '".$btn_type."',
                '".$btn."',
                '".$btn_bg_color."',
                '".$btn_text_color."',
                '".$link."'
                )") ;
                $wpdb->query($add_wb);
                 }else{
                     echo 'error_url';  //url KO
                 }
             }else{
                 if(empty($_POST['wb_btn_text'])) {
                      echo 'wb_btn_text'; // text btn empty
                 }else if(empty($_POST['btn_link'])) {
                      echo 'btn_link'; // link empty
                 }else{
                     echo 'error_all'; //too much errors
                 }
                
             }
             
        }else{
            global $wpdb;
              $db_table_prefix = $wpdb->prefix;
              $add_wb = $wpdb->prepare("INSERT into ".$db_table_prefix."wb_banner (texte,bg_color,txt_color) VALUES (
				'".sanitize_text_field($_POST['wb_banner'])."',
				'".$bg_color_wb."',
                '".$text_color_wb."'
                )") ;
				$wpdb->query($add_wb);
            
        }
    }else{
       echo 'wb_banner';
    }
    wp_die();
}

///////
function wideban_liste_wb() {
    
   global $wpdb;
     $db_table_prefix = $wpdb->prefix;
    $resultats = $wpdb->get_results("SELECT * FROM ".$db_table_prefix."wb_banner order by id DESC") ;
    ///how many
    $numbers = $wpdb->num_rows;
    $i = 0;
    if( $numbers > 0){
        echo '<div id="liste-of-banner"><table class="liste">
                <tr>
                    <th>';
                    echo _e('Text Banner', 'wide_bn' );
                    echo '</th>
                    <th>';
                    echo _e('Button', 'wide_bn' );
                    echo '</th>
                    <th>';
                    echo _e('Link', 'wide_bn' );
                    echo '</th>
                    <th>';
                    echo _e('Activate', 'wide_bn' );
                    echo '</th>
                    <th>';
                    echo _e('Delete', 'wide_bn' );
                    echo '</th>
                </tr>
            ';
            
        foreach ($resultats as $post) {
            $etat = '';
            $active = is_numeric($post->active);
            if ($active ) {
                if($post->active == '1'){$etat = 'checked';}
                if ($i % 2){ echo '<tr class="lineb" id="line-'.esc_attr($post->id).'">';}else{ echo '<tr id="line-'.esc_attr($post->id).'">';}
                    echo '<td>'.esc_html($post->texte).'</td>';
                    echo '<td>';
                     if(empty($post->btn)){echo '-';}else{ echo esc_html($post->btn);}
                    echo '</td>';
                    echo '<td>';
                        if(empty($post->link)){echo '-';}else{ echo esc_url($post->link);}
                    echo '</td>';
                    echo '<td class="switchon" id="wb-'.esc_attr($post->id).'"><input type="checkbox" name="activate" '.$etat.' class="activate" data-id="'.esc_attr($post->id).'"><span class="info_update"></span></td>';
                    echo '<td  class="deleteit" id="delete-'.esc_attr($post->id).'"><span class="delete" data-id="'.esc_attr($post->id).'">X</span></td>';
                echo '</tr>';
            }
        $i++;
        }  
        echo '</table></div';
        
        }else{
            echo 'No banner yet'; 

        }
    }


        
 //////desactivate
add_action( 'wp_ajax_desactivate_wb', 'wideban_desactivate_wb' );
add_action( 'wp_ajax_nopriv_desactivate_wb', 'wideban_desactivate_wb' );

function wideban_desactivate_wb() {
    global $wpdb;
     $db_table_prefix = $wpdb->prefix;
    //verify id
    $id_wb = absint($_POST['idban']); 
        $update_wb = $wpdb->prepare("update ".$db_table_prefix."wb_banner SET
                    active = '0'
                    where id='".$id_wb."'") ;
                    $wpdb->query( $update_wb);  
         wp_die();  
}
////activate
add_action( 'wp_ajax_activate_wb', 'wideban_activate_wb' );
add_action( 'wp_ajax_nopriv_activate_wb', 'wideban_activate_wb' );

function wideban_activate_wb() {
    global $wpdb;
     //verify id
     $db_table_prefix = $wpdb->prefix;
    $id_wb = absint($_POST['idban']);
    $activate_wb = $wpdb->prepare("update ".$db_table_prefix."wb_banner SET
				active = '1'
                where id='".$id_wb."'") ;
				$wpdb->query( $activate_wb);  
       wp_die();
}
////delete
add_action( 'wp_ajax_delete_wb', 'wideban_delete_wb' );
add_action( 'wp_ajax_nopriv_delete_wb', 'wideban_delete_wb' );

function wideban_delete_wb() {
    global $wpdb;
     $db_table_prefix = $wpdb->prefix;
     //verify id
    $id_wb = absint($_POST['idban']);
    $delete_wb = $wpdb->prepare("delete from ".$db_table_prefix."wb_banner where id='".$id_wb."'") ;
	$wpdb->query( $delete_wb);  
    wp_die();
}
////
add_action( 'wp_ajax_show_wb', 'wideban_show_wb' );
add_action( 'wp_ajax_nopriv_show_wb', 'wideban_show_wb' );


function wideban_show_wb() {
    global $wpdb;
     $db_table_prefix = $wpdb->prefix;
     $resultats = $wpdb->get_results("SELECT * FROM ".$db_table_prefix."wb_banner where active='1' order by id DESC") ;
    ///how many
    $numbers = $wpdb->num_rows;
    $i = 0;
    if( $numbers > 0){
   
        foreach ($resultats as $post) {
           if((!empty($post->type_btn)) && ($post->type_btn == 'full')){echo '<a href="'.esc_url($post->link).'">';}
            echo '
                <div class="wb" id="wb_'.esc_attr($post->id).'" style="color:'.esc_attr($post->txt_color).';background-color:'.esc_attr($post->bg_color).'">
                    '.esc_html($post->texte);
            if((!empty($post->type_btn)) && ($post->type_btn == 'btn')){
                echo '<a href="'.esc_url($post->link).'" style="color:'.esc_attr($post->btn_txt_color).';background-color:'.esc_attr($post->btn_bg_color).'" id="wb_btn_'.esc_attr($post->id).'">'.esc_html($post->btn).'</a>';
                
            }
            echo '</div>';
            if((!empty($post->type_btn)) && ($post->type_btn == 'full')){echo '</a>';}
         }
    }
 
    wp_die();
}
?>
