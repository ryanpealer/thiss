<?php

/**
 * Multi Cloumn Listing 2 - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/multi_column/listing2/preview.jpg">';
else:

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-inner-mc-listing';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}


// Load values.
$data = get_fields();
$items = isset($data['items']) ? $data['items'] : '';

if (!empty($data['settings']['card_style'])) {
    $className .= ' card-style';
}
if (!empty($data['settings']['text_alignments'])) {
    $className .= ' text-'.$data['settings']['text_alignments'];
}

// if(isset($data['section_padding']) && $data['section_padding']){
//     $className .= ' section-top-pad-'.$data['section_padding']['top'];
//     $className .= ' section-bot-pad-'.$data['section_padding']['bottom'];
// }

$desktop = isset($data['settings']['visible_count']['desktop']) ? $data['settings']['visible_count']['desktop'] : '';
$tablet = isset($data['settings']['visible_count']['tablet']) ? $data['settings']['visible_count']['tablet'] : '';
$mobile = isset($data['settings']['visible_count']['mobile']) ? $data['settings']['visible_count']['mobile'] : '';
?>  
<div class="<?php echo esc_attr($className); ?>">
    <div class="">
        <div class="mc-grid" style="--desktop:<?php echo $desktop ?>;--tablet:<?php echo $tablet ?>;--mobile:<?php echo $mobile ?>">
        <?php if (!empty($items)): ?>    
        <?php foreach($items as $item): ?>
                <div class="mc-grid-item">
                <?php if (!empty($item['icon']['id'])) { ?>
                    <figure>
                        <?php echo isset($item['icon']['id']) && $item['icon']['id'] ? wp_get_attachment_image($item['icon']['id'],'mc_listing') : '';?>
                    </figure>
                <?php } ?>
                <div class="text">
                    <?php if (!empty($item['title'])) { ?>
                    <div class="name"><?php echo do_shortcode($item['title']) ?></div>
                    <?php } ?>
                    <?php if (!empty($item['text'])) { ?>
                        <?php echo do_shortcode($item['text']); ?>
                    <?php } ?>
                    <?php if (!empty($item['link'])) { 
                        foreach ($item['link'] as $link) {
                        ?>
                            <a class="btn-link btn-arrow has-darker-green-color" href="<?php echo $link['link']['url'] ?>" <?php if ($link['link']['target']) echo ' target="' . $link['link']['target'] . '"' ?>>
                                <?php echo $link['link']['title']; ?>
                            </a>
                    <?php }} ?>
                </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>