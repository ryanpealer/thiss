<?php

// Creating the widget
class social_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(

// Base ID of your widget
            'goji_social_widget',

// Widget name will appear in UI
            __('Social Accounts Listing', 'iowa_league-admin'),

// Widget description
            array(
                'description' => __('Show list of social accounts. Account can be add in Theme Settings -> Social Accounts', 'iowa_league-admin'),
                'classname' => 'widget_social'
            )
        );
    }

// Creating widget front-end

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
        $fields = get_fields('option'); ?>
        <ul>
            <?php foreach($fields['social_accounts'] as $item): ?>
                <li>
                    <a href="<?php echo $item['link'] ?>" target="_blank" class="socicon-<?php echo $item['social_type'] ?>">
                        <span class="screen-reader-text"><?php echo $item['social_type'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php echo $args['after_widget'];
    }

// Widget Backend 
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Follow Us', 'iowa_league');
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

// Class wpb_widget ends here
}


// Register and load the widget
function wpb_load_widget()
{
    register_widget('social_widget');
}

add_action('widgets_init', 'wpb_load_widget');