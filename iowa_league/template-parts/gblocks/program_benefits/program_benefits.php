<?php

/**
 * Program Benefits - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/program_benefits/preview.jpg">';
else:

// Create id attribute allowing for custom "anchor" value.
$id = 'form-wrapper-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-program-benefits';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values.
$data = get_fields();
$items = isset($data['items']) ? $data['items'] : '';

if(isset($data['font_size']) && $data['font_size'] != 'default'){
    $className .= ' has-' . $data['font_size'].'-font-size';
}

$allowed_blocks = array( 'acf/gblock-spacer', 'core/columns' );

$styleWrap = '';
$styleWrap .= isset($data['bg_color']) && $data['bg_color'] ? '--section-bg:'.$data['bg_color'].';' : '--section-bg: transparent;';
$styleWrap .= isset($data['text_color']) && $data['text_color'] ? '--section-text-color:'.$data['text_color'].';' : '--section-text-color:inherit;';
$styleWrap .= isset($data['bg_size']) && $data['bg_size'] ? '--bg-img-size:'.$data['bg_size'].';' : '--bg-img-size:inherit;';
$styleWrap .= isset($data['bg_position']) && $data['bg_position'] ? '--bg-img-position:'.$data['bg_position'].';' : '--bg-img-position:center;';
?>

<div id="<?php echo esc_attr($id); ?>" style="<?php echo $styleWrap; ?>" class="<?php echo esc_attr($className); ?> container<?php echo isset($data['content_width']) && $data['content_width'] != 'default' ? ' '.$data['content_width'] :'' ?>">
  <div class="<?php echo esc_attr($className); ?>">
    <div class="">
      <div class="pb-grid" >
          <div class="pb-grid-heading">
            <div class="pb-grid-heading-left"><a href="javascript:printPart('program-benefits')" class="nonprint">Print Friendly Version <?php echo iconSvg('print');?></a></div>
            <div class="pb-grid-heading-right">
              <div class="pb-grid-heading-checkbox">Partner Program</div>
              <div class="pb-grid-heading-checkbox">Associate Program</div>
            </div>

          </div>
		  <?php if (!empty($items)): ?>
			  <?php foreach($items as $item): ?>
	      <?php if (!empty($item['title'])) { ?>
              <div class="pb-grid-item">
                <div class="pb-grid-text">
                  <div class="title"><?php echo do_shortcode($item['title']) ?></div>
	                <?php if (!empty($item['description'])) { ?>
                      <div class="description"><?php echo do_shortcode($item['description']); ?></div>
	                <?php } ?>
                </div>
                <div class="pb-grid-checkbox">
	                <?php if (!empty($item['partner_program']) || !$item['partner_program']) { ?>
                      <div class="pb-grid-checkbox <?php echo do_shortcode($item['partner_program']) ? 'checked': 'unchecked' ?>"></div>
	                <?php } ?>
	                <?php if (!empty($item['associate_program']) || !$item['associate_program']) { ?>
                      <div class="pb-grid-checkbox <?php echo do_shortcode($item['associate_program']) ? 'checked': 'unchecked' ?>"></div>
	                <?php } ?>
                </div>
              </div>
        <?php }?>
			  <?php endforeach; ?>
		  <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>