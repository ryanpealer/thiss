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
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/section_heading/preview.jpg">';
else:
// Create id attribute allowing for custom "anchor" value.
$id = 'section-heading-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-section-heading';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values.
$page_fields = get_fields();

if(isset($page_fields['font_size']) && $page_fields['font_size'] != 'default'){
    $className .= ' has-' . $page_fields['font_size'].'-font-size';
}

if(isset($page_fields['section_padding']) && $page_fields['section_padding']){
    // if($page_fields['section_padding']['top'] != 'default'){
        $className .= ' section-top-pad-'.($page_fields['section_padding']['top']);
    // }
    // if($page_fields['section_padding']['bottom'] != 'default'){
        $className .= ' section-bot-pad-'.$page_fields['section_padding']['bottom'];
    // }
  }

$allowed_blocks = array( 'core/heading', 'core/paragraph' );
$template = array(
    array( 'core/heading', array(
        'level' => 2,
        'placeholder' => 'Add a root-level heading',
        'className' => 'title',
        'align_text' => 'center'
    ) ),
    array( 'core/paragraph', array(
        'placeholder' => 'Add a paragraph',
        'align_text' => 'center',
        'className' => 'subtitle',
    ) )
);
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <style type="text/css">
        <?php if(isset($page_fields['bg_color']) && $page_fields['bg_color']){ ?>
      #<?php echo $id?> {
          <?php
          echo isset($page_fields['text_color']) && $page_fields['text_color'] ? 'color: '.$page_fields['text_color'].';' : '';
          ?>
      }
        <?php } ?>
    
    </style>

    <div class="container<?php echo isset($page_fields['content_width']) && $page_fields['content_width'] != 'default' ? ' '.$page_fields['content_width'] :'' ?>">
        <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ) ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ) ?>" />
    </div>
</div>
<?php endif; ?>