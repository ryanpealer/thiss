<?php

/**
 * Team - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/news/style1/preview.jpg">';
else:
// Create id attribute allowing for custom "anchor" value.
$id = 'news-wrapper-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-news-wrapper';
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

$allowed_blocks = array( 'core/heading', 'core/paragraph', 'acf/gblock-spacer', 'core/buttons', 'acf/news-search', 'acf/news-listing' );
$template = array(
    array( 'acf/gblock-spacer', array(
        'data' => array(
            'field_603671d454a5e' => '96',
            'field_603672c254a5f' => '50'
        )
    ) ),
    array( 'acf/news-search', array() ),
    array( 'acf/news-listing', array() ),
    array( 'acf/gblock-spacer', array(
        'data' => array(
            'field_603671d454a5e' => '96',
            'field_603672c254a5f' => '50'
        )
    ) ),
);
$styleWrap = '';
$styleWrap .= isset($data['bg_color']) && $data['bg_color'] ? '--section-bg:'.$data['bg_color'].';' : '--section-bg: transparent;';
$styleWrap .= isset($data['text_color']) && $data['text_color'] ? '--section-text-color:'.$data['text_color'].';' : '--section-text-color:inherit;';
$styleWrap .= isset($data['bg_size']) && $data['bg_size'] ? '--bg-img-size:'.$data['bg_size'].';' : '--bg-img-size:inherit;';
$styleWrap .= isset($data['bg_position']) && $data['bg_position'] ? '--bg-img-position:'.$data['bg_position'].';' : '--bg-img-position:center;';
?>
<div id="search__wrap"></div>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php echo $styleWrap; ?>">
    <?php echo isset($data['bg_image']['id']) && $data['bg_image']['id'] ? wp_get_attachment_image($data['bg_image']['id'],'full', false, array('class'=>'bg-image')) : ''; ?>
    <div class="container<?php echo isset($data['content_width']) && $data['content_width'] != 'default' ? ' '.$data['content_width'] :'' ?>">
        <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ) ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ) ?>" />
    </div>
</div>
<?php endif; ?>