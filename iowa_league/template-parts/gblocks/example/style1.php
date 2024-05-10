<?php

/**
 * Example - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'example-style1-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-example-style1';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values.
$data = get_fields();

if(isset($data['font_size']) && $data['font_size'] != 'default'){
    $className .= ' has-' . $data['font_size'].'-font-size';
}

$allowed_blocks = array( 'core/image', 'core/heading', 'core/paragraph', 'core/buttons' );
$template = array(
    array( 'core/heading', array(
        'level' => 2,
        'placeholder' => 'Add a root-level heading',
        'className' => 'h1'
    ) ),
    array( 'core/paragraph', array(
        'placeholder' => 'Add a paragraph',
    ) )
);
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <style type="text/css">
        <?php if(isset($data['bg_color']) && $data['bg_color']){ ?>
      #<?php echo $id?> {
          <?php
          echo isset($data['bg_color']) && $data['bg_color'] ? 'background-color:'.$data['bg_color'].';' : '';
          echo isset($data['text_color']) && $data['text_color'] ? 'color: '.$data['text_color'].';' : '';
          ?>
      }
        <?php } ?>
    <?php if(isset($data['bg_image']['id']) && $data['bg_image']['id']){ ?>
      #<?php echo $id?> img {
          <?php
            echo isset($data['bg_size']) && $data['bg_size'] ? 'object-fit:'.$data['bg_size'].';' : '';
            echo isset($data['bg_position']) && $data['bg_position'] ? 'object-position:'.$data['bg_position'].';' : '';
           ?>
      }
      <?php } ?>
    </style>

    <?php echo isset($data['bg_image']['id']) && $data['bg_image']['id'] ? wp_get_attachment_image($data['bg_image']['id'],'full') : ''; ?>
    <div class="container<?php echo isset($data['content_width']) && $data['content_width'] != 'default' ? ' '.$data['content_width'] :'' ?>">
        <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ) ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ) ?>" />
    </div>
</div>
