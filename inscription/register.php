<?php
/*
Plugin Name: Inscription
Plugin URI:
Description: Plugin pour enregistrer l'utilisateur
Author: Emilie Follin
Version: 1.0
Author URI:
*/



class UsersManagerPlugin {

    public function __construct(){

        require_once(plugin_dir_path(__FILE__).'/registerWidget.php');
        add_action ('wp_loaded',array($this,'addNewUser'));
        add_action ('widgets_init',function(){
            register_widget('UsersManagerWidget');
        });

        add_shortcode('register_form', array($this, 'shortcodeAction'));
    }

//    public static function pluginActivation(){
//        global $wpdb;
//
//        $wpdb->query('CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'user (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255),firstname VARCHAR(255),email VARCHAR(255),password VARCHAR(255))');
//    }
//
//    public static function uninstall(){
//        global $wpdb;
//        $wpdb->query('DROP TABLE IF EXISTS '.$wpdb->prefix.'user');
//    }


   /* public function addNewUser(){
        if(isset($_POST['email'])){
            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                global $wpdb;

                $checkIfExist = $wpdb->get_var(
                    $wpdb->prepare(
                        'SELECT count(*) FROM '.$wpdb->prefix.'user WHERE email = %s', $_POST['email']
                    )
                );
                if($checkIfExist == 0){
                    wp_create_user($_POST['email'], $_POST['password'], $_POST['email']);
                  // $wpdb->query($wpdb->prepare('INSERT INTO '.$wpdb->prefix.'user(name,firstname,birthday,email,password) VALUES(%s,%s,%s,%s,%s)',$_POST['name'],$_POST['firstName'],$_POST['birthday'],$_POST['email'],$_POST['password']));
                   $this->displayMsg('Inscription réussi');
                } else {
                    $this->displayMsg('Email déja utilisé');
                }
            } else {
                $this->displayMsg('Email invalide');
            }
        }
    } */

   public function addNewUser(){

       $userdata = array(
           'first_name' =>  $_POST['name'],
           'last_name'   =>  $_POST['firstName'],
           'user_email'  =>  $_POST['email'],
           'user_login'  => $_POST['email'],
           'user_pass'   =>  $_POST['password'],

       );

       wp_insert_user($userdata);


   }

   /* public function displayMsg($msg){

        add_action('wp_enqueue_scripts',function() use ($msg){
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    alert('<?php echo $msg; ?>');
                });
            </script>
            <?php
        });
    } */

    public function shortcodeAction(){
        the_widget('UsersManagerWidget');
    }



}

add_shortcode( 'register', array( 'UsersManagerPlugin', 'addNewUser' ) );




register_activation_hook(__FILE__, array('UsersManagerPlugin','pluginActivation'));
register_uninstall_hook(__FILE__, array('UsersManagerPlugin','uninstall'));

add_action( 'plugins_loaded', function(){
    new UsersManagerPlugin();
} );