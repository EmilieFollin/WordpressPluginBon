<?php

/*
Plugin Name: affichage
Description: Permet d'afficher les realisations
Author: Lou Lemarié & Emilie Follin
Version: 1.0

*/

class AffichagePlugin
{

    public function __construct()
    {
        require_once(plugin_dir_path(__FILE__) . '/affichageWidget.php');
        add_action('widgets_init', function () {
            register_widget('affichageWidget');
        });
        add_shortcode('affichage_cv', array($this, 'displayCV'));

    }



    public function displayCV()
    {
        $post_id = get_the_ID();
        get_post_meta($post_id, 'image', true);
        $imagepost = get_post_meta($post_id, 'image', true);

        ?>


        <img src="<?php echo get_site_url(); ?>/wp-content/plugins/formulaire/Uploads/<?php echo $imagepost ?>">


        <?php



        $infopost = get_post($post_id, ARRAY_A);
        $titrepost = $infopost['post_title'];
        $contentpost = $infopost['post_content'];


    }

  //  public function displaymonCV{



  //  }


    public function shortcodeAction()
    {
        the_widget('AffichageWidget');
    }

}

register_activation_hook(__FILE__, array('AffichagePlugin', 'pluginActivation'));
register_uninstall_hook(__FILE__, array('AffichagePlugin', 'uninstall'));
add_action('plugins_loaded', function ()
{
    new AffichagePlugin();
});

