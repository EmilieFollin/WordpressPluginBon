<?php
class LanguagesmanagerWidget extends WP_Widget {
    public function __construct() {
        $options = array(
            'classname' => 'languagesmanagerwidget',
            'description' => 'Ajout de langues, experience et certif'
        );
        parent::__construct('languagesmanagerwidget', 'Languages', $options);
    }
    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];
        ?>


        <form action="" method="POST">
            <p>
                <label for="languagesmanagerselect">Langue : </label>
                <select id="languagesmanagerselect" name="languagesmanager_select">
                    <option value="">Choisir</option>
                    <option value="FR">FRANCAIS</option>
                    <option value="EN">ANGLAIS</option>
                    <option value="ES">ESPAGNOL</option>
                </select>
            </p>
            <p>
                <label for="experience">Experience</label>
                <textarea id="experience" name="experience" rows="10" cols="50"></textarea>
            </p>

            <p>
                <label for="certification">Certification : </label>
                <textarea id="certification" name="certification" rows="10" cols="50"></textarea>
            </p>

            <input type="submit" name="submit" value="envoyer">
        </form>




        <?php
        echo $args['after_widget'];
    }
    public function form($instance){
        if(isset($instance['title'])){
            $title = $instance['title'];
        } else {
            $title = '';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title:') ?></label>
            <input id="<?php echo $this->get_field_id('title') ?>" type="text" value="<?php echo $title ?>" name="<?php echo $this->get_field_name('title') ?>">
        </p>

        <?php
    }
}