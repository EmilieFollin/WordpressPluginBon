<?php

define( 'MY_PLUGIN_DIR', plugin_dir_path(__FILE__ ) );


class UserRealisationWidget extends WP_Widget{
    public function __construct(){
        $option = array(
            'classname'   => 'userrealisationwwidget',
            'description' => 'Affichage de la page de réalisation'
        );

        parent::__construct('userrealisationwidget','Realisation',$option);
    }
    public function widget($args, $instance){

        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];


        if (isset($_FILES['image']) && $_FILES ['image']['error'] == 0){

            if ($_FILES['image'] ){

                $informationsImage = pathinfo($_FILES['image']['name']);
                $extensionImage = $informationsImage['extension'];
                $extensionsArray = array('png','gif','jpg','jpeg');
                if(in_array($extensionImage, $extensionsArray)) {

                  //  move_uploaded_file($_FILES['image']['tmp_name'],MY_PLUGIN_DIR.'Uploads/'.($_FILES['image']['name']));
                    move_uploaded_file($_FILES['image']['tmp_name'],MY_PLUGIN_DIR.'Uploads/'.($_FILES['image']['name']));
                    echo "Envois réussi";
                }
            }
        }
     echo'  
      <form method ="post" enctype="multipart/form-data">
  <p>
      <h1>Formulaire</h1>
      <input type="text" name="title" placeholder="Titre"><br>
      <input type="text" name="description" placeholder="durée du projet, idée... "><br>
      <input type="file" name="image"><br>
      <input type="submit" value="Envoyez">
  </p>
    </form>';







        echo $args['after_widget'];
    }

}