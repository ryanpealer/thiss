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
$className = 'blck-inner-rs-slider';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}
// Load values.
$data = get_fields();

?>
<div class="<?php echo esc_attr($className); ?>">
    <figure class="image"><?php echo wp_get_attachment_image($data['image']['id'],'full'); ?></figure>
    <div class="text-part">
        <div class="slide-list">
            <div class="js-rs-slide">
                <?php foreach($data['slides'] as $slide):
                    $link_url = $slide['link']['url'];
                    $link_title = $slide['link']['title'];
                    $link_target = $slide['link']['target'] ? $data['cta']['target'] : '_self';?>
                    <div class="item">
                        <div class="h3"><?php echo do_shortcode($slide['title']); ?></div>
                        <?php echo do_shortcode($slide['text']); ?>
                        <p><a href="<?php echo esc_url( $link_url ); ?>" class="link-simple" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>