<?php

if(!class_exists('UploadPortalWidget')) {

  class UploadPortalWidget extends WP_Widget {

    /**
    * Sets up the widgets name etc
    */
    public function __construct() {
      $widget_ops = array(
        'classname' => 'upload_portal_widget',
        'description' => 'Upload Portal Widget',
      );
      parent::__construct( 'upload_portal_widget', 'GWidget: Upload Portal', $widget_ops );
    }

    /**
    * Outputs the content of the widget
    *
    * @param array $args
    * @param array $instance
    */
    /* Outputs the content of the widget
    *
    * @param array $args
    * @param array $instance
    */
    public function widget( $args, $instance ) {
      // outputs the content of the widget
      if ( ! isset( $args['widget_id'] ) ) {
        $args['widget_id'] = $this->id;
      }

      // widget ID with prefix for use in ACF API functions
      $widget_id = 'widget_' . $args['widget_id'];

      $title = get_field( 'title', $widget_id ) ? get_field( 'title', $widget_id ) : '';
      $text = get_field( 'text', $widget_id );
      $link = get_field( 'link', $widget_id );

      echo $args['before_widget'];

      if ( $title ) {
        echo $args['before_title'] . esc_html($title) . $args['after_title'];
      }
      ?>
      <?php if($text): ?>
        <div class="text">
          <?php echo do_shortcode($text);?>
        </div>
      <?php endif; ?>
      <?php if($link): ?>
        <div class="wp-block-button is-style-outline">
          <a class="wp-block-button__link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?><?php echo iconSvg('file');?></a>
        </div>
      <?php endif; ?>      

      <?php echo $args['after_widget'];
      
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }

  }

}

/**
 * Register our CTA Widget
 */
function register_upload_portal_widget()
{
  register_widget( 'UploadPortalWidget' );
}
add_action( 'widgets_init', 'register_upload_portal_widget' );

