<?php

if(!class_exists('DownloadWidget')) {

  class DownloadWidget extends WP_Widget {

    /**
    * Sets up the widgets name etc
    */
    public function __construct() {
      $widget_ops = array(
        'classname' => 'download_widget',
        'description' => 'Download Widget',
      );
      parent::__construct( 'download_widget', 'GWidget: Download', $widget_ops );
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
      $files = get_field( 'files', $widget_id );

      echo $args['before_widget'];

      if ( $title ) {
        echo $args['before_title'] . esc_html($title) . $args['after_title'];
      }
      $rows = get_field( 'files', $widget_id );
        if( $rows ) {
            echo '<ul class="downloads-list">';
            foreach( $rows as $row ) { 
              $title = $row['title'];
              $file = $row['file']; 
              //echo '<pre>'.var_dump($file);             
            ?>
              <?php if(!empty($file)): ?>
              <li>
                <a target="_blank" href="<?php echo $file['url']; ?>">
                  <?php echo $title;?>
                  <span class="icon">
                      <?php echo $file['subtype']?>
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M7 10L12 15L17 10"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M12 15V3"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>                    
                  </span>
                </a>
              </li>
              <?php else: ?>
              <li>
                <p>Select file on widget settings.</p>
              </li>
              <?php endif; ?>
            <?php }
            echo '</ul>';
        }

      echo $args['after_widget'];
      
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
function register_download_widget()
{
  register_widget( 'DownloadWidget' );
}
add_action( 'widgets_init', 'register_download_widget' );

