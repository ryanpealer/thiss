<?php

/**
 * Example - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-inner-es-slider';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
// Load values.
$data = get_fields();

$settings = $data['es_slider_settings'];
$items = $data['es_slider'];

if ($settings['show_outside'] == true) {
    $className .= ' show-outside';
}


?>

<div class="<?php echo esc_attr($className); ?>">
    <div class="slider-list js-endor-slider-list"
         data-item-count="<?php echo $settings['visible_count']['desktop'] ?>"
         data-item-tablet-count="<?php echo $settings['visible_count']['tablet'] ?>"
         data-item-mobile-count="<?php echo $settings['visible_count']['mobile'] ?>"
            data-arrow-status="<?php echo $settings['show_arrow'] ?>"
            data-dots-status="<?php echo $settings['show_bullets'] ?>">
            <?php foreach ($items as $item): ?>
            <div class="item">
                <blockquote>
                    <div class="text">
                        <?php echo do_shortcode($item['text']); ?>
                    </div>
                    <div class="author">
                        <figure>
                            <?php echo isset($item['image']['id']) && $item['image']['id'] ? wp_get_attachment_image($item['image']['id'], 'full') : ''; ?>
                        </figure>
                        <cite>
                            <?php echo $item['person_name'] ?><br/>
                            <small><?php echo $item['person_title'] ?></small>
                        </cite>
                    </div>
                </blockquote>
            </div>
        <?php endforeach; ?>
    </div>
</div>