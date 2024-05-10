<?php

/**
 * Example - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/hero/style2/preview.jpg">';
else:

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-style2-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-hero-style2';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

// Load values.
$data = get_fields();

if (isset($data['font_size']) && $data['font_size'] != 'default') {
    $className .= ' has-' . $data['font_size'] . '-font-size';
}

$allowed_blocks = array('core/image', 'core/heading', 'core/paragraph', 'core/buttons');
$template = array(
    array('core/columns', array(), array(

        array('core/column', array(), array(
            array('core/image', array(
                'className' => ''
            )),
        )),

        array('core/column', array(), array(
            array('core/heading', array(
                'level' => 1,
                'placeholder' => 'Add a top level heading',
                'className' => 'display1'
            )),
            array('core/paragraph', array(
                'placeholder' => 'Add a inner paragraph'
            )),
        )),
    ))
);


$containerClass = 'container';

if (isset($data['content_width']) && $data['content_width'] != 'default') {
    $containerClass .= ' ' . $data['content_width'];
}

if (isset($data['image_position'])) {
    $containerClass .= ' has-media-on-the-' . $data['image_position'];
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <style type="text/css">
      <?php
      echo '#'.$id .'{';
        echo isset($data['bg_color']) && $data['bg_color'] ? 'background-color:'.$data['bg_color'].';' : '';
        echo isset($data['text_color']) && $data['text_color'] ? 'color: '.$data['text_color'].';' : '';
        echo '}';
        if(isset($data['bg_image']['id']) && $data['bg_image']['id']){
            echo '#'.$id.' img {';
            echo isset($data['bg_size']) && $data['bg_size'] ? 'object-fit:'.$data['bg_size'].';' : '';
            echo isset($data['bg_position']) && $data['bg_position'] ? 'object-position:'.$data['bg_position'].';' : '';
            echo 'height:100%;'; 
            echo isset($data['mobile_height']) && $data['mobile_height'] ? 'height:'.$data['mobile_height'].';' : '';
            echo isset($data['min_mobile_height']) && $data['min_mobile_height'] ? 'min-height:'.$data['min_mobile_height'].';' : '';
        echo '}';
      }
      echo '@media (min-width: 768px) {';
        echo '#'.$id .'{';
          echo isset($data['desktop_height']) && $data['desktop_height'] ? 'height:'.$data['desktop_height'].';' : '';
          echo isset($data['min_desktop_height']) && $data['min_desktop_height'] ? 'min-height:'.$data['min_desktop_height'].';' : '';
        echo '}';
      echo '}';
      ?>
    </style>
    <?php echo isset($data['bg_image']['id']) && $data['bg_image']['id'] ? wp_get_attachment_image($data['bg_image']['id'], 'full') : ''; ?>
    <div class="<?php echo $containerClass ?>">
        <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)) ?>"
                     template="<?php echo esc_attr(wp_json_encode($template)) ?>"/>
    </div>
</div>
<?php endif; ?>