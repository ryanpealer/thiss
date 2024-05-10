<?php

/**
 * GBlock: Sidebar Block Widget
 *
 */
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/sidebar_block_widget/preview.jpg">';
else:
$allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/list', 'acf/gblock-spacer', 'core/buttons', 'gravityforms/form' );

$template = array(
    array( 'core/heading', array(
        'level' => 3,
        'placeholder' => 'Add a root-level heading',
        'className' => ''
    ) ),
);
$data = get_fields();
$show_sidebar = $data['show_sidebar'];
$select_sidebar = $data['select_sidebar'];
?>
<!-- <style type="text/css">
    <?php /*if(isset($data['bg_color']) && $data['bg_color']){ ?>
        .blck-sidebar-widget {
            <?php
            echo isset($data['bg_color']) && $data['bg_color'] ? 'background-color:'.$data['bg_color'].';' : '';
            // echo isset($data['text_color']) && $data['text_color'] ? 'color: '.$data['text_color'].';' : '';
            ?>
        }
    <?php } */?>  
</style> -->
<div class="blck-sidebar-widget">
    <div class="blck-sidebar-widget-main<?php if($show_sidebar && $select_sidebar): ?> has-sidebar<?php endif; ?>">
        <div class="blck-sidebar-widget--content">
            <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ) ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ) ?>" />
        </div>
        <?php

        if($show_sidebar && $select_sidebar):
            if (is_active_sidebar($select_sidebar)) :
                echo '<div class="blck-sidebar-widget--aside">';
                    dynamic_sidebar($select_sidebar);
                echo '</div>';
            endif;
        endif;
        ?>

    </div>
</div>
<?php endif; ?>