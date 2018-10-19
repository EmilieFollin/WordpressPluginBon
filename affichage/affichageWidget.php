<?php
class AffichageWidget extends WP_Widget
{
    public function __construct()
    {
        $options = array(
            'classname' => 'affichagewidget',
            'description' => 'show affichage'
        );
        parent::__construct('affichagewidget', 'affichage', $options);
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];

        echo $args['after_widget'];
    }
}

