<?php
/*
Plugin Name: Création
Plugin URI:
Description: Insert you're own creation
Author: Romain Revert
Version: 10
Author URI:
*/
define( 'MY_PLUGIN_DIR', plugin_dir_path(__FILE__ ) );

class UsersRealisationPlugin {

    public function __construct(){
        require_once(plugin_dir_path(__FILE__).'/formulaireWidget.php');
        add_action ('wp_loaded', array($this,'addNewRealisation'));
        add_action ('widgets_init',function(){
            register_widget('UserRealisationWidget');
        });
        add_shortcode('formulaire', array($this, 'shortcodeAction'));


    }

    public static function pluginActivation()
    {



            $dossier_upload = MY_PLUGIN_DIR.'Uploads/';
            if (!is_dir($dossier_upload)) {
                mkdir($dossier_upload);
            }




    }

    public function addNewRealisation(){

            $postdata = array(
                'post_title' => $_POST['title'],
                'post_content' => $_POST['description'],
                'post_status' => 'publish',




            );


            $idpost =  wp_insert_post($postdata);


            add_post_meta( $idpost , 'image', $_FILES['image']['name']);

        }










      public function shortcodeAction(){
           the_widget('UserRealisationWidget');
       }



}
register_activation_hook(__FILE__, array('UsersRealisationPlugin','pluginActivation'));
register_uninstall_hook(__FILE__, array('UsersRéalisationPlugin','uninstall'));

add_action( 'plugins_loaded', function(){
    new UsersRealisationPlugin();
} );


