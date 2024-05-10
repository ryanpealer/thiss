<?php

/**
 * Services List - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
// Create id attribute allowing for custom "anchor" value.

// Create class attribute allowing for custom "className" and "align" values.
$className = 'service-list';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
// Load values.
$data = get_fields();

?>
        <div class="<?php echo esc_attr($className); ?>">
            <?php foreach ($data['service_list'] as $item) :
                $link_url = $item['link']['url'];
                $link_title = $item['link']['title'];
                $link_target = $item['link']['target'] ? $item['link']['target'] : '_self';
                ?>
                <div class="service-list-item">
                    <a href="<?php echo esc_url( $link_url ) ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <div class="item-name"><?php echo $item['title']; ?></div>
                        <div class="item-text"><?php echo $item['text']; ?></div>
                        <span class="item-link"><?php echo esc_html( $link_title ); ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>