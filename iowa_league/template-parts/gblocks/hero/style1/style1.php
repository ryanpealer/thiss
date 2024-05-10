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
$id = 'hero-style1-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-hero-style1';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

// Load values.
$data = get_fields();

if(isset($data['font_size']) && $data['font_size'] != 'default'){
    $className .= ' has-' . $data['font_size'].'-font-size';
}

if(isset($data['vertical_content_position']) && $data['vertical_content_position']) {
    $className .= ' valign-'. $data['vertical_content_position'];
}

$containerClass = 'container';
if(isset($data['content_width']) && $data['content_width'] != 'default'){
    $containerClass .= ' '.$data['content_width'];
}

$allowed_blocks = array('core/image', 'core/heading', 'core/paragraph', 'core/buttons');
$template = array(
    array('core/heading', array(
        'level' => 1,
        'placeholder' => 'Add a root-level heading',
        'className' => 'h1'
    )),
    array('core/paragraph', array(
        'placeholder' => 'Add a paragraph',
    ))
);

$styleWrap = '';
$styleWrap .= isset($data['bg_color']) && $data['bg_color'] ? '--section-bg:'.$data['bg_color'].';' : '--section-bg: transparent;';
$styleWrap .= isset($data['text_color']) && $data['text_color'] ? '--section-text-color:'.$data['text_color'].';' : '--section-text-color:inherit;';
$styleWrap .= isset($data['bg_size']) && $data['bg_size'] ? '--bg-img-size:'.$data['bg_size'].';' : '--bg-img-size:inherit;';
$styleWrap .= isset($data['bg_position']) && $data['bg_position'] ? '--bg-img-position:'.$data['bg_position'].';' : '--bg-img-position:center;';
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php echo $styleWrap; ?>">
        <style type="text/css">
        #<?php echo $id?> {
            <?php
            echo isset($data['mobile_height']) && $data['mobile_height'] ? 'height:'.$data['mobile_height'].';' : '';
            echo isset($data['min_mobile_height']) && $data['min_mobile_height'] ? 'min-height:'.$data['min_mobile_height'].';' : '';
            ?>
        }
        @media (min-width: 768px){
            #<?php echo $id?> {
                <?php
                    echo isset($data['desktop_height']) && $data['desktop_height'] ? 'height:'.$data['desktop_height'].';' : '';
                    echo isset($data['min_desktop_height']) && $data['min_desktop_height'] ? 'min-height:'.$data['min_desktop_height'].';' : '';
                ?>
            }
        }
    </style>
    <?php echo isset($data['bg_image']['id']) && $data['bg_image']['id'] ? wp_get_attachment_image($data['bg_image']['id'],'full', false, array('class'=>'bg-image')) : '';?>
    <div class="<?php echo $containerClass; ?>">
        <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)) ?>"
                     template="<?php echo esc_attr(wp_json_encode($template)) ?>"/>
    </div>
</div>
