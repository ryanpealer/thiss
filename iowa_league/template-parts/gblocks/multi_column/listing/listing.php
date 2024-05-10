<?php

/**
 * Multi Cloumn Listing - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/multi_column/listing/preview.jpg">';
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
$data = [];
$data = get_fields();
// $items = $args = '';

// if select_post_type
$items = $args = '';


if (!empty($data['settings']['card_style'])) {
    $className .= ' card-style';
}

if (!empty($data['settings']['card_as_link'])) {
    $className .= ' card_as_link';
}
if (!empty($data['settings']['text_alignments'])) {
    $className .= ' text-'.$data['settings']['text_alignments'];
}

if (!empty($data['settings']['content_type'])) {
    $className .= ' card_'.$data['settings']['content_type'];
}

if(isset($data['section_padding']) && $data['section_padding']){
    $className .= ' section-top-pad-'.$data['section_padding']['top'];
    $className .= ' section-bot-pad-'.$data['section_padding']['bottom'];
}

$desktop = $data['settings']['visible_count']['desktop'];
$tablet = $data['settings']['visible_count']['tablet'];
$mobile = $data['settings']['visible_count']['mobile'];
?>
<div class="<?php echo esc_attr($className); ?>">
    <div class="">
        <div class="mc-grid <?php echo $data['settings']['content_type']; ?>" style="--desktop:<?php echo $desktop ?>;--tablet:<?php echo $tablet ?>;--mobile:<?php echo $mobile ?>">
        
            <?php 
            if ($data['settings']['content_type'] == 'custom_post') :
                $i=1;
                ?>
                <?php foreach ($data['select_posts'] as $item): ?>
                    <div class="mc-grid-item item-<?php echo $i; ?>">
                        
                        <?php if (has_post_thumbnail($item->ID)) { ?>
                            <figure>
                                <a href="<?php the_permalink($item->ID); ?>">
                                <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'mc_listing')[0]; ?>" alt="" />
                                </a>
                            </figure>
                        <?php } ?>
                        <div class="text">

                            <div class="name">
                                <a href="<?php the_permalink($item->ID); ?>">
                                    <?php echo $item->post_title; ?>
                                </a>
                            </div>

                            <?php //if ($data['settings']['hide_excerpt'] == false) { ?>
                            <div class="item-rte"><?php the_excerpt($item->ID); ?></div>
                            <?php //} ?>
                                <a class="btn-link" href="<?php the_permalink($item->ID); ?>">See Details</a>
                        </div>
                    </div>
                <?php $i++; endforeach;  ?>
        
            <!-- <div class="" data-item-count="<?php //echo !empty($data['desktop']) ? $data['desktop'] : '';  ?>" data-item-tablet-count="<?php //echo !empty($data['tablet']) ? $data['tablet'] : ''; ?>"> -->
            <?php elseif ($data['settings']['content_type'] == 'custom_items') : ?>
                <?php foreach ($data['items'] as $item): ?>
                <?php if ($data['settings']['card_as_link'] == true) { 
                    
                    // var_dump ('<pre>',$item['link_card']);
                    ?>
                    <a class="mc-grid-item" href="<?php echo $item['link_card']['url'] ?>" <?php if ($item['link_card']['target']) echo ' target="' . $item['link_card']['target'] . '"' ?>>
                <?php } else { ?>
                    <div class="mc-grid-item">
                <?php } ?>
                <?php if (isset($item['icon']['id']) && $item['icon']['id']) { ?>
                    <figure>
                        <?php echo isset($item['icon']['id']) && $item['icon']['id'] ? wp_get_attachment_image($item['icon']['id'],'large') : '';?>
                    </figure>
                <?php } ?>
                        
                        <?php 
                        if (!empty($data['settings']['card_as_link'])) {
                            if (!empty($item['title'])) { ?>
                                <div class="name"><?php echo do_shortcode($item['title']) ?></div>
                                <?php } ?>
                                <?php if (!empty($item['text'])) { ?>
                                    <div class="text"><?php echo do_shortcode($item['text']); ?></div>
                                <?php } ?>
                                
                                
                                <?php 
                                
                                if (!empty($item['link_card'])) {
                                        // foreach ($item['link'] as $link) {
                                        ?>
                                        <?php if ($data['settings']['card_as_link'] != true) { ?>
                                                <a class="btn-link btn-arrow" href="<?php echo $item['link']['url'] ?>" <?php if ($item['link']['target']) echo ' target="' . $item['link']['target'] . '"' ?>>
                                                    <?php echo $item['link']['title']; ?>
                                                </a>
                                        <?php } else { ?>
                                            <div class="name"><?php echo $item['link_card']['title']; ?></div>
                                        <?php } ?>
                                    <?php //}
                                    }
                        } else { ?>
                                
                            <div class="text">
                                <?php if (!empty($item['title'])) { ?>
                                    <div class="name"><?php echo do_shortcode($item['title']) ?></div>
                                <?php } ?>
                                    <?php if (!empty($item['text'])) { ?>
                                    <?php echo do_shortcode($item['text']); ?>
                                    <?php } ?>

                                    <?php if (!empty($item['link'])) { 
                                        echo '<div class="btn-wrap">';
                                        foreach ($item['link'] as $link) {
                                        ?>
                                        <?php if ($data['settings']['card_as_link'] != true) { ?>
                                                <a class="btn-link btn-arrow" href="<?php echo $link['link']['url'] ?>" <?php if ($link['link']['target']) echo ' target="' . $link['link']['target'] . '"' ?>>
                                                    <?php echo $link['link']['title']; ?>
                                                </a>
                                        <?php } else { ?>
                                        <div class="name"><?php echo $link['link']['title']; ?></div>
                                        <?php } ?>
                                    <?php }
                                    echo '</div>';
                                } ?>

                                        
                            </div>
                                
                        <?php }
                        ?>
                        
                        
                    <!-- </div> -->
                <?php if ($data['settings']['card_as_link'] == true) { ?>
                    </a>
                <?php } else { ?>
                    </div>
                <?php } ?>   
            <?php endforeach; ?>


            <?php elseif ($data['settings']['content_type'] == 'post_data'):

                    if(isset($data['settings']['select_terms']) && !empty($data['settings']['select_terms'])){
                    // var_dump('<pre>',$data['settings']['select_terms']);
                    $args = array(
                        'post_type' => $data['select_post_type'],
                        'posts_per_page' => $data['settings']['visible_count']['total_count_to_show'],
                        'orderby' => 'post_date',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => $data['settings']['select_taxonomy'][0],
                                'field'    => 'term_id',
                                'terms'    => $data['settings']['select_terms'][0],
                            ),
                        ),
                    );
                } else {
                    $args = array(
                        'post_type' => $data['select_post_type'],
                        'posts_per_page' => $data['settings']['visible_count']['total_count_to_show'],
                        'orderby' => 'post_date',
                        'post_status' => 'publish'
                    );
                }
                $query = new WP_Query($args);
                
                $i=1;
                if ($query->have_posts()):
                    ?>
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                    <div class="mc-grid-item item-<?php echo $i; ?>">
                        <?php if (has_post_thumbnail()) { ?>
                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('mc_listing'); ?>
                                </a>
                            </figure>
                        <?php } ?>
                            <div class="text">

                                <div class="name">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>

<!--                            --><?php //if ($data['settings']['hide_excerpt'] == false) { ?>
                                <div class="item-rte"><?php the_excerpt(); ?></div>
<!--                            --><?php //} ?>
                                 <a class="btn-link" href="<?php the_permalink(); ?>">See Details</a>
                            </div>
                    </div>
                <?php $i++; endwhile; ?>
                <?php endif; wp_reset_query(); ?>
            <?php endif; ?>
        <!-- </div> -->
        
        
        </div>
    </div>
</div>
<?php endif; ?>