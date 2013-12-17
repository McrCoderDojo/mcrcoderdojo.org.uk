<?php

class MCD_Social_Icons_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'mcd_social_icons_widget', // Base ID
            'MCD Social Icons Widget', // Name
            array('description' => 'Adds social icons to a sidebar')
        );
    }

    public function widget($args, $instance) {
        $title = $instance['title'];
        $twitter = $instance['twitter'];
        $gplus = $instance['gplus'];
        $facebook = $instance['facebook'];
        $youtube = $instance['youtube'];
        $flickr = $instance['flickr'];
        $github = $instance['github'];
        $gittip = $instance['gittip'];

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        if (!empty($twitter)): ?>
            <a href="<?php echo $twitter; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/twitter-32x32.png" width="32" height="32" /></a>
        <?php endif;
        if (!empty($gplus)): ?>
        <a href="<?php echo $gplus; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/google-plus-32x32.png" width="32" height="32" /></a>
        <?php endif;
        if (!empty($facebook)): ?>
        <a href="<?php echo $facebook; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/facebook-32x32.png" width="32" height="32" /></a>
        <?php endif;
        if (!empty($youtube)): ?>
        <a href="<?php echo $youtube; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/youtube-32x32.png" width="32" height="32" /></a>
        <?php endif;
        if (!empty($flickr)): ?>
        <a href="<?php echo $flickr; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/flickr-32x32.png" width="32" height="32" /></a>
        <?php endif;
        if (!empty($github)): ?>
        <a href="<?php echo $github; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/github-32x32.png" width="32" height="32" /></a>
        <?php endif;
        if (!empty($gittip)): ?>
        <a href="<?php echo $gittip; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/gittip-32x32.png" width="32" height="32" /></a>
        <?php endif;

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = $instance['title'];
        $twitter = $instance['twitter'];
        $gplus = $instance['gplus'];
        $facebook = $instance['facebook'];
        $youtube = $instance['youtube'];
        $flickr = $instance['flickr'];
        $github = $instance['github'];
        $gittip = $instance['gittip'];

        ?>
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('twitter'); ?>">Twitter:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('gplus'); ?>">Google+:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" type="text" value="<?php echo esc_attr($gplus); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('facebook'); ?>">Facebook:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('youtube'); ?>">YouTube:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('flickr'); ?>">Flickr:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo esc_attr($flickr); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('github'); ?>">GitHub:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('github'); ?>" name="<?php echo $this->get_field_name('github'); ?>" type="text" value="<?php echo esc_attr($github); ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('gittip'); ?>">Gittip:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('gittip'); ?>" name="<?php echo $this->get_field_name('gittip'); ?>" type="text" value="<?php echo esc_attr($gittip); ?>" />
        </p>

        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        $instance['twitter'] = !empty($new_instance['twitter']) ? strip_tags($new_instance['twitter']) : '';
        $instance['gplus'] = !empty($new_instance['gplus']) ? strip_tags($new_instance['gplus']) : '';
        $instance['facebook'] = !empty($new_instance['facebook']) ? strip_tags($new_instance['facebook']) : '';
        $instance['youtube'] = !empty($new_instance['youtube']) ? strip_tags($new_instance['youtube']) : '';
        $instance['flickr'] = !empty($new_instance['flickr']) ? strip_tags($new_instance['flickr']) : '';
        $instance['github'] = !empty($new_instance['github']) ? strip_tags($new_instance['github']) : '';
        $instance['gittip'] = !empty($new_instance['gittip']) ? strip_tags($new_instance['gittip']) : '';

        return $instance;
    }
}
function register_mcd_social_icons_widget() {
    register_widget('MCD_Social_Icons_Widget');
}
add_action('widgets_init', 'register_mcd_social_icons_widget');
