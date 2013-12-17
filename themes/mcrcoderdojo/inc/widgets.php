<?php

class MCD_Social_Icons_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'mcd_social_icons_widget', // Base ID
            'MCD Social Icons Widget', // Name
            array('description' => 'Adds social icons to a sidebar')
        );

        $this->fields = array(
            'title' => 'Title',
            'twitter' => 'Twitter',
            'google-plus' => 'Google+',
            'facebook' => 'Facebook',
            'youtube' => 'YouTube',
            'flickr' => 'Flickr',
            'github' => 'GitHub',
            'gittip' => 'Gittip',
            'google-groups' => 'Google Groups',
        );
    }

    public function widget($args, $instance) {
        $title = $instance['title'];

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $social_sites = $this->fields;
        unset($social_sites['title']);

        foreach ($social_sites as $ref => $name) {
            $link = $instance[$ref];
            if (!empty($link)): ?>
                <a href="<?php echo $link; ?>" target="_blank" title="<?php echo $name; ?>"><img src="<?php bloginfo('template_directory'); echo "/images/{$ref}-32x32.png"; ?>" width="32" height="32" /></a>
            <?php endif;
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        foreach ($this->fields as $ref => $name) {
            $value = $instance[$ref]; ?>

            <p>
                <label for="<?php echo $this->get_field_id($ref); ?>"><?php echo $name; ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id($ref); ?>" name="<?php echo $this->get_field_name($ref); ?>" type="text" value="<?php echo esc_attr($value); ?>" />
            </p><?php
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        foreach ($this->fields as $ref => $name) {
            $instance[$ref] = !empty($new_instance[$ref]) ? strip_tags($new_instance[$ref]) : '';
        }

        return $instance;
    }
}
function register_mcd_social_icons_widget() {
    register_widget('MCD_Social_Icons_Widget');
}
add_action('widgets_init', 'register_mcd_social_icons_widget');
