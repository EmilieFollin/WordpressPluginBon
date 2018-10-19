<?php
/*
Plugin Name: test
Description: Languages
Version: 1.0.0
Author: Moi
*/
class LanguagesmanagerPlugin {
    public function __construct() {
        require_once( plugin_dir_path(__FILE__) . '/moncvWidget.php' );
        add_action('wp_loaded', array($this, 'addNewLanguage'));
        add_action('wp_loaded', array($this, 'addNewExperience'));
        add_action('wp_loaded', array($this, 'addNewCertification'));
        add_action('widgets_init', function() {
            register_widget('LanguagesmanagerWidget');
        });
        add_shortcode('langage', array($this, 'shortcodeAction'));
    }
    public static function pluginActivation(){
        global $wpdb;
        $wpdb->query('CREATE TABLE IF NOT EXISTS '. $wpdb->prefix .'languages (id INT AUTO_INCREMENT PRIMARY KEY, NAME VARCHAR(45))');
        $wpdb->query('CREATE TABLE IF NOT EXISTS '. $wpdb->prefix .'experiences (id INT AUTO_INCREMENT PRIMARY KEY, DESCRIPTION VARCHAR(255))');
        $wpdb->query('CREATE TABLE IF NOT EXISTS '. $wpdb->prefix .'certifications (id INT AUTO_INCREMENT PRIMARY KEY, DESCRIPTION VARCHAR(255))');
    }
    public static function uninstall(){
        global $wpdb;
        $wpdb->query('DROP TABLE IF EXISTS '.$wpdb->prefix.'langages');
        $wpdb->query('DROP TABLE IF EXISTS '. $wpdb->prefix .'experiences');
        $wpdb->query('DROP TABLE IF EXISTS '. $wpdb->prefix .'certifications');
    }
    public function addNewLanguage() {
        if(isset($_POST['languagesmanager_select'])) {
            if($_POST['languagesmanager_select'] === "") {
                return;
            } else {
                global $wpdb;
                $wpdb->query(
                    $wpdb->prepare(
                        'INSERT INTO '. $wpdb->prefix .'languages (NAME) VALUES (%s)', $_POST['languagesmanager_select']
                    )
                );
            }
        }
    }
    public function addNewExperience() {
        if(isset($_POST['experience'])) {
            if($_POST['experience'] === "") {
                return;
            } else {
                global $wpdb;
                $wpdb->query(
                    $wpdb->prepare(
                        'INSERT INTO '. $wpdb->prefix .'experiences (DESCRIPTION) VALUES (%s)', $_POST['experience']
                    )
                );
            }
        }
    }


    public function addNewCertification() {
        if(isset($_POST['certification'])) {
            if($_POST['certification'] === "") {
                return;
            } else {
                global $wpdb;
                $wpdb->query(
                    $wpdb->prepare(
                        'INSERT INTO '. $wpdb->prefix .'certifications (DESCRIPTION) VALUES (%s)', $_POST['certification']
                    )
                );
            }
        }
    }

    public function displayMsg($msg){
        add_action('wp_enqueue_scripts',function() use ($msg){
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    alert('<?php echo $msg; ?>');
                });
            </script>
            <?php
        });
    }
    public function shortcodeAction(){
        the_widget('LanguagesmanagerWidget');
    }
}
register_activation_hook(__FILE__, array('LanguagesmanagerPlugin', 'pluginActivation'));
register_uninstall_hook(__FILE__, array('LanguagesmanagerPlugin', 'uninstall'));
add_action( 'plugins_loaded', function(){
    new LanguagesmanagerPlugin();
} );