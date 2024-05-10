<?php

/**
 * Post Slider - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/image_slider/style1/preview.jpg">';
else:
// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-inner-image_slider alignfull';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load values.
$data = get_fields();

$className .= isset($data['is_style_cards']) && $data['is_style_cards'] != false  ? ' is-style-cards' : '';
$className .= isset($data['is_grid_mosaic']) && $data['is_grid_mosaic'] != false  ? ' is-grid-mosaic' : '';
$className .= isset($data['is_grid_grid']) && $data['is_grid_grid'] != false  ? ' is-grid-grid' : '';
$className .= isset($data['is_margin_bottom_0']) && $data['is_margin_bottom_0'] != false  ? ' is-margin-bottom-0' : '';

$data_post = get_fields(get_the_ID());


// Load values.

if(isset($data['font_size']) && $data['font_size'] != 'default'){
    $className .= ' has-' . $data['font_size'].'-font-size';
}

if(isset($data['section_padding']) && $data['section_padding']){
    // if($data['section_padding']['top'] != 'default'){
        $className .= ' section-top-pad-'.($data['section_padding']['top']);
    // }
    // if($data['section_padding']['bottom'] != 'default'){
        $className .= ' section-bot-pad-'.$data['section_padding']['bottom'];
    // }
  }


?>

<div class="<?php echo esc_attr($className); ?>">

    <div class="image-slider-list js-image-slider-list" data-item-count="<?php echo $data['items_per_row'] ?>" data-item-tablet-count="<?php echo $data['items_per_row_tablet'] ?>">
        <?php
        if ($data['content_type'] == 'custom_items') :
            $k=1;
            ?>
            <?php foreach ($data['items'] as $item): ?>
            <div class="item item-<?php echo $k; ?>">
                <div class="box">
                  <?php
                  if($item['image']):?>
                    <figure>
                        <?php echo isset($item['image']['id']) && $item['image']['id'] ? wp_get_attachment_image($item['image']['id'], 'large') : ''; ?>
                    </figure>
                  <?php endif;?>
                    <div class="container">
                        <div class="text">
                            <div class="item-title">
                                <?php echo $item['title']; ?>
                            </div>
                            <?php if ($item['excerpt']) { ?>
                                <div class="item-rte"><p><?php echo $item['excerpt'] ?></p></div>
                            <?php } ?>
                            <?php if ($item['button']) {
                                customButton($item['button'], 'btn-link btn-arrow');
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php $k++; endforeach; ?>
        <?php elseif ($data['content_type'] == 'post_data'):
        
            if(isset($data['select_terms']) && !empty($data['select_terms'])){
                $args = array(
                    'post_type' => $data['select_post_type'],
                    'posts_per_page' => $data['total_count_to_show'],
                    'orderby' => 'post_date',
                    'post_status' => 'publish',
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => $data['select_taxonomy'][0],
                            'field'    => 'term_id',
                            'terms'    => $data['select_terms'],
                        ),
                    ),
                );
            } else {
                $args = array(
                    'post_type' => $data['select_post_type'],
                    'posts_per_page' => $data['total_count_to_show'],
                    'orderby' => 'post_date',
                    'post_status' => 'publish',
                );
            }

            $query = new WP_Query($args);
            $i=1;
            if ($query->have_posts()):
                ?>
                <?php while ($query->have_posts()): $query->the_post(); ?>
                <div class="item item-<?php echo $i; ?>">
                    <div class="box">
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        </figure>
                        <div class="text">
                            <?php if($data['show_meta_above_title'] != ''){ ?>
                                <div class="meta-above-title">
                                    <?php if($data['show_meta_above_title'] == 'category'){ ?>
                                        <div class="meta-cats-list">
                                            <?php
                                            $cats = wp_get_post_categories( get_the_ID(), array('fields' => 'all') );
                                            foreach( $cats as $cat ){
                                                if($cat->name != 'Uncategorized') {
                                                    $term_link = get_term_link($cat, 'category');
                                                    echo '<a href="' . $term_link . '">' . $cat->name . '</a> ';
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php } elseif ($data['show_meta_above_title'] == 'post_tag'){ ?>
                                        <div class="meta-tags-list">
                                            <?php the_tags( '', ', ', '' ); ?>
                                        </div>
                                    <?php } elseif ($data['show_meta_above_title'] == 'date'){ ?>

                                        <?php
                                            $data_post = get_fields(get_the_ID());
                                            if ($data['select_post_type'][0] == 'events') { ?>
                                            <div class="meta-date">
                                                <?php
                                                $e_date_from = isset($data_post['event_date_from']) && !empty($data_post['event_date_from']) ? $data_post['event_date_from'] : '';
                                                $e_time_from = isset($data_post['event_time_from']) && !empty($data_post['event_time_from']) ? $data_post['event_time_from'] : '';

                                                $eventstart = DateTime::createFromFormat('Ymd', $e_date_from);
                                                $timestart = DateTime::createFromFormat('g:i a', $e_time_from);
                                
                                                $event_date_from = !empty($eventstart) ? $eventstart->format('F j, Y') : '';
                                                $event_time_from = !empty($timestart) ? $timestart->format('g:i a') : '';
                                                ?>
                                                <?php echo $event_date_from; ?>
                                                <?php echo ' at ' . $event_time_from; ?>
                                                <?php echo ' • ' . $data_post['event_place']; ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="meta-date">
                                                <?php echo $data['select_post_type'][0] === 'publications' ? 'Published ' : '' ?>
                                                <?php echo get_the_date(); ?>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="item-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </div>
                            <?php if($data['show_meta_below_title'] != ''){ ?>
                                <div class="meta-below-title">
                                    <?php if($data['show_meta_below_title'] == 'category'){ ?>
                                        <div class="meta-cats-list">
                                            <?php
                                            $cats = wp_get_post_categories( get_the_ID(), array('fields' => 'all') );
                                            foreach( $cats as $cat ){
                                                if($cat->name != 'Uncategorized') {
                                                    $term_link = get_term_link($cat, 'category');
                                                    echo '<a href="' . $term_link . '">' . $cat->name . '</a>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php } elseif ($data['show_meta_below_title'] == 'post_tag'){ ?>
                                        <div class="meta-tags-list">
                                            <?php the_tags( '', ', ', '' ); ?>
                                        </div>
                                    <?php } elseif ($data['show_meta_below_title'] == 'date'){ ?>
                                        <?php
                                            $data_post = get_fields(get_the_ID());
                                            if ($data['select_post_type'][0] == 'events') { ?>
                                            <div class="meta-date">
                                                <?php echo $data_post['event_date_from']; ?>
                                                <?php echo ' • ' . $data_post['event_place']; ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="meta-date"><?php echo get_the_date(); ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="item-rte"><?php echo the_excerpt(); ?></div>

                            <?php if($data['show_meta_below_content'] != ''){ ?>
                                <div class="meta-below-content">
                                    <?php if($data['show_meta_below_content'] == 'category'){ ?>
                                        <div class="meta-cats-list">
                                            <?php
                                            $cats = wp_get_post_categories( get_the_ID(), array('fields' => 'all') );
                                            foreach( $cats as $cat ){
                                                if($cat->name != 'Uncategorized') {
                                                    $term_link = get_term_link($cat, 'category');
                                                    echo '<a href="' . $term_link . '">' . $cat->name . '</a>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php } elseif ($data['show_meta_below_content'] == 'post_tag'){ ?>
                                        <div class="meta-tags-list">
                                            <?php the_tags( '', ', ', '' ); ?>
                                        </div>
                                    <?php } elseif ($data['show_meta_below_content'] == 'date'){ ?>
                                        <div class="meta-date"><?php echo get_the_date(); ?></div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php
                            $button = array(
                                'url' => get_the_permalink(),
                                'title' => $data['button_text'],
                                'target' => false
                            );
                            customButton($button, $data['button_class']);
                            ?>
                        </div>
                    </div>
                </div>
            <?php $i++; endwhile; ?>
            <?php endif; wp_reset_query(); ?>
        <?php endif; ?>
    </div>
    <div class="image-slider-nav">
        <div class="link prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="52" viewBox="0 0 60 52" fill="none">
                <rect x="1.25" y="1.25" width="57.5" height="49.5" fill="white" fill-opacity="0.25"/>
                <path d="M37 26H23" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M30 33L23 26L30 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="1.25" y="1.25" width="57.5" height="49.5" stroke="white" stroke-width="1.5"/>
            </svg>
        </div>
         <div id="dots" class="dots">
            <?php $k=1; foreach ($data['items'] as $item): ?>
                <div class="link dot dot-<?php echo $k; ?>"></div>
            <?php $k++; endforeach; ?>
         </div>
         <div class="link next">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="52" viewBox="0 0 60 52" fill="none">
                <rect x="1.36755" y="1.25" width="57.5" height="49.5" fill="white" fill-opacity="0.25"/>
                <path d="M23.1176 26H37.1176" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M30.1176 19L37.1176 26L30.1176 33" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="1.36755" y="1.25" width="57.5" height="49.5" stroke="white" stroke-width="1.5"/>
            </svg>
         </div>

   </div>
</div>
<?php endif; ?>