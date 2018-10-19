
<?php
/*
Plugin Name: Edit Profil
Description: Outil d'édition de profil.
Author: Lou Lemarié
Version: 1.0
*/
class EditManagerPlugin {
    public function __construct(){
        require_once(plugin_dir_path(__FILE__).'/edit.php');
        add_action ('wp_loaded',array($this,'editProfil'));
        add_action ('widgets_init',function(){
            register_widget('EditManagerWidget');
        });
        add_shortcode('edit', array($this, 'shortcodeAction'));
    }
    public function editProfil(){
        $userdata = array(
            'first_name' =>  $_POST['name'],
            'last_name'   =>  $_POST['firstName'],
            'user_email'  =>  $_POST['email'],
            'user_login'  => $_POST['email'],
            'user_pass'   =>  $_POST['password'],
            'ID'          =>  session_id(),
        );
        wp_update_user ($userdata);
    }
    public function shortcodeAction(){
        the_widget('EditManagerWidget');
    }
}
register_activation_hook(__FILE__, array('EditManagerPlugin','pluginActivation'));
register_uninstall_hook(__FILE__, array('EditManagerPlugin','uninstall'));
add_action( 'plugins_loaded', function(){
    new EditManagerPlugin();
} );