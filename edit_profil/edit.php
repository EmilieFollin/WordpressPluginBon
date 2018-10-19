<?php


class EditManagerWidget extends WP_Widget
{
    public function __construct()
    {
        $options = array(
            'classname' => 'editmanagerwidget',
            'description' => 'Outil d\'édition de profil.'
        );

        parent::__construct('editmanagerwidget', 'EditProfil', $options);
    }


    public function widget($args, $instance)
    {

        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];

        ?>
        <form method="post" action="">
            <?php
            $current_user = wp_get_current_user();

            echo 'User last name: ' . $current_user->user_lastname . '<br>';
            echo '<label for="name">Nom :</label><input type="text" name="name" required><br>';
            echo 'User first name: ' . $current_user->user_firstname . '<br>';
            echo '<label for="firstName">Prénom :</label><input type="text" name="firstName" required><br>';
            echo 'Password :' . $current_user->user_pass_md5 . '<br>';
            echo '<label for="password">Mot de passe</label><input type="password" name="password" required><br>';
            ?>
            <input type="submit" value="Modifier">
        </form>
        <?php
        echo $args['after_widget'];
    }



}