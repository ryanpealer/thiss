<?php

/**
 * Post Slider - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-inner-post-slider';
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
    <div class="slider-list js-slider-list" data-item-count="<?php echo $data['items_per_row'] ?>" data-item-tablet-count="<?php echo $data['items_per_row_tablet'] ?>">
        <?php

        // var_dump('<pre>', $data);
        // $q = uksort($data['content_type'][0]->post_title);
        if ($data['content_type'] == 'custom_post') :
            $i=1;
            ?>
            <?php 
            $ids = array();
            $title = array();
            foreach ($data['select_posts'] as $item ){
                $ids[] = $item->ID;
                $title[] = $item->post_title;
            }
            $newquery = array_combine($ids, $title);
            $q = array_keys($newquery);

            $args = array(
                'post_type' => array('page', 'post', 'resource', 'awards', 'events', 'office', 'publications', 'services', 'team' ),
                'order' => 'ASC',
                'orderby' => 'title',
                'post__in' => $q,
                'posts_per_page' => -1,
                'post_status' => 'publish',
            );

            $query_sort = new WP_Query($args);

            $is_sort_alphabetically = !empty($data['is_sort_alphabetically']) ? $data['is_sort_alphabetically'] : '';
            if( $is_sort_alphabetically == true) { 
            $iii=1;
                while ( $query_sort->have_posts() ) {
                    $query_sort->the_post(); 
                    
                    get_the_title();
                    
                    ?>

                
                    <div class="mc-grid-item item item-<?php echo $iii; ?>">
                        <div class="box">
                            
                            <?php if (has_post_thumbnail()) { ?>
                                <figure>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('mc_listing'); ?>
                                    </a>
                                </figure>
                            <?php } ?>
                            <div class="text">
                                <div class="item-title name">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
                                <div class="item-rte"> 
                                    <p>
                                    <?php 
                                    if (!empty(get_the_excerpt())) {
                                        echo get_the_excerpt();
                                    } else {
                                        $maxchar = 150;
                                        $text = strip_tags( $item->post_content );
                                        echo mb_substr( $text, 0, $maxchar ) . '...';
                                    }
                                    ?>
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a class="btn-link" href="<?php the_permalink(); ?>">See Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
               <?php  $iii++; }  wp_reset_postdata(); ?>


            <?php 

            } else {

                $i=1;
                foreach ($data['select_posts'] as $item):
                    ?>
                    <div class="mc-grid-item item item-<?php echo $i; ?>">
                        <div class="box">
                            
                            <?php if (has_post_thumbnail($item->ID)) { ?>
                                <figure>
                                    <a href="<?php the_permalink($item->ID); ?>">
                                    <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'mc_listing')[0]; ?>" alt="" />
                                    </a>
                                </figure>
                            <?php } ?>
                            <div class="text">
                                <div class="item-title name">
                                    <a href="<?php the_permalink($item->ID); ?>">
                                        <?php echo $item->post_title; ?>
                                    </a>
                                </div>
                                <div class="item-rte"> 
                                    <p>
                                    <?php 
                                    if (!empty(get_the_excerpt($item->ID))) {
                                        echo get_the_excerpt($item->ID);
                                    } else {
                                        $maxchar = 150;
                                        $text = strip_tags( $item->post_content );
                                        echo mb_substr( $text, 0, $maxchar ) . '...';
                                    }
                                    ?>
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a class="btn-link" href="<?php the_permalink($item->ID); ?>">See Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php $i++; endforeach;  } ?>
        <?php
        elseif ($data['content_type'] == 'custom_items') :
            $k=1;
            ?>
            <?php foreach ($data['items'] as $item): ?>
            <div class="item item-<?php echo $k; ?>">
                <div class="box">
                  <?php
                  if($item['image']):?>
                    <figure>
                        <?php if ($item['link_from_title']){ ?>
                        <a href="<?php echo $item['link_from_title']['url'] ?>">
                            <?php } ?>
                            <?php echo isset($item['image']['id']) && $item['image']['id'] ? wp_get_attachment_image($item['image']['id'], 'mc_listing') : ''; ?>

                            <?php if ($item['link_from_title']){ ?>
                        </a>
                    <?php } ?>
                    </figure>
                  <?php endif;?>
                    <div class="text">
                        <div class="item-title">
                            <?php if ($item['link_from_title']){ ?>
                            <a href="<?php echo $item['link_from_title']['url'] ?>">
                                <?php } ?>
                                <?php echo $item['title']; ?>
                                <?php if ($item['link_from_title']){ ?>
                            </a>
                        <?php } ?>
                        </div>
                        
                        <div class="item-rte"><p><?php echo !empty($item['excerpt']) ? $item['excerpt'] : ''; ?></p></div>
                        
                        <?php if ($item['button']) {
                            customButton($item['button'], 'btn-link btn-arrow');
                        } ?>
                    </div>
                </div>
            </div>
        <?php $k++; endforeach; ?>
        <?php elseif ($data['content_type'] == 'post_data'):
        
            if(isset($data['select_terms']) && !empty($data['select_terms'])){
                $args = array(
                    'post_type' => $data['select_post_type'],
                    'posts_per_page' => $data['total_count_to_show'],
                    'orderby' => 'date',
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
                    'orderby' => 'date',
                    'post_status' => 'publish',
                );
            }

            $query = new WP_Query($args);
            $i=1;
            if ($query->have_posts()):
                ?>
                <?php while ($query->have_posts()): $query->the_post(); ?>

                <?php 

                    $type = get_post_type();

                    $tax = '';
                    
                    if ( $type == 'services' ) {
                        $tax = 'services_tax';
                    } elseif ( $type == 'post' ) {
                        $tax = 'category';
                    } elseif ( $type == 'resource' ) {
                        $tax = 'resources_tax';
                    } elseif ( $type == 'awards' ) {
                        $tax = 'awards_tax';
                    } elseif ( $type == 'video' ) {
                        $tax = 'video_cat';
                    }
                    
                    $cur_terms = get_the_terms( get_the_ID(), $tax );
                ?>

                <div class="item item-<?php echo $i; ?>">
                    <div class="box">
                        <?php if (has_post_thumbnail() ) { ?>
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('mc_listing'); ?>
                            </a>
                        </figure>
                        <?php } ?>
                        <div class="text">
                            <?php if($data['show_meta_above_title'] != ''){ ?>
                                <div class="meta-above-title">
                                    <?php if($data['show_meta_above_title'] == 'category'){ ?>
                                        <div class="meta-cats-list">
                                            <?php
                                            if( is_array( $cur_terms ) ){
                                                $item3 = '';
                                                $string = '';
                                                foreach ($cur_terms as $item3):
                                                    // echo '<span class="item-tag label yellow">' . $item3->name . '</span>';
                                                    $string .= ', <a href="' . get_term_link($item3->slug, $item3->taxonomy) . '">' . $item3->name . '</a>';
                                                endforeach;
                                                $string = substr($string, 1);
                                                echo '<p>'.$string.'</p>';
                                            } 
                                            ?>
                                            <?php /*
                                            $cats = wp_get_post_categories( get_the_ID(), array('fields' => 'all') );
                                            var_dump($cats);
                                            foreach( $cats as $cat ){
                                                if($cat->name != 'Uncategorized') {
                                                    $term_link = get_term_link($cat, 'category');
                                                    echo '<a href="' . $term_link . '">' . $cat->name . '</a> ';
                                                }
                                            }
                                            */?>
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
                                                // var_dump($eventstart);
                                                ?>
                                                <?php if (!empty($event_date_from)) { ?>
                                                    <?php echo $event_date_from; ?>
                                                    <?php echo ' at ' . $event_time_from; ?>
                                                    <?php echo ' • ' . $data_post['event_place']; ?>
                                                <?php } ?>
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
                                            if( is_array( $cur_terms ) ){
                                                $item3 = '';
                                                $string = '';
                                                foreach ($cur_terms as $item3):
                                                    // echo '<span class="item-tag label yellow">' . $item3->name . '</span>';
                                                    $string .= ', <a href="' . get_term_link($item3->slug, $item3->taxonomy) . '">' . $item3->name . '</a>';
                                                endforeach;
                                                $string = substr($string, 1);
                                                echo '<p>'.$string.'</p>';
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
                                                <?php
                                                $e_date_from = isset($data_post['event_date_from']) && !empty($data_post['event_date_from']) ? $data_post['event_date_from'] : '';
                                                $e_time_from = isset($data_post['event_time_from']) && !empty($data_post['event_time_from']) ? $data_post['event_time_from'] : '';

                                                $eventstart = DateTime::createFromFormat('Ymd', $e_date_from);
                                                $timestart = DateTime::createFromFormat('g:i a', $e_time_from);
                                
                                                $event_date_from = !empty($eventstart) ? $eventstart->format('F j, Y') : '';
                                                $event_time_from = !empty($timestart) ? $timestart->format('g:i a') : '';
                                                // var_dump($eventstart);
                                                ?>
                                                <?php if (!empty($event_date_from)) { ?>
                                                    <?php echo $event_date_from; ?>
                                                    <?php echo ' at ' . $event_time_from; ?>
                                                    <?php echo ' • ' . $data_post['event_place']; ?>
                                                <?php } ?>
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
                            <div class="item-rte">
                                <p>
                                <?php if (!empty(get_the_excerpt())) {
                                    echo get_the_excerpt();
                                } else {
                                    $maxchar = 150;
                                    $text = strip_tags( get_the_content() );
                                    echo !empty($text) ? mb_substr( $text, 0, $maxchar ) . '...' : '';
                                }
                                ?>
                                </p>
                            </div>

                            <?php if($data['show_meta_below_content'] != ''){ ?>
                                <div class="meta-below-content">
                                    <?php if($data['show_meta_below_content'] == 'category'){ ?>
                                        <div class="meta-cats-list">
                                            <?php
                                            if( is_array( $cur_terms ) ){
                                                $item3 = '';
                                                $string = '';
                                                foreach ($cur_terms as $item3):
                                                    // echo '<span class="item-tag label yellow">' . $item3->name . '</span>';
                                                    $string .= ', <a href="' . get_term_link($item3->slug, $item3->taxonomy) . '">' . $item3->name . '</a>';
                                                endforeach;
                                                $string = substr($string, 1);
                                                echo '<p>'.$string.'</p>';
                                            } 
                                            ?>
                                        </div>
                                    <?php } elseif ($data['show_meta_below_content'] == 'post_tag'){ ?>
                                        <div class="meta-tags-list">
                                            <?php the_tags( '', ', ', '' ); ?>
                                        </div>
                                    <?php } elseif ($data['show_meta_below_content'] == 'date'){ ?>
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
                                                // var_dump($eventstart);
                                                ?>
                                                <?php if (!empty($event_date_from)) { ?>
                                                    <?php echo $event_date_from; ?>
                                                    <?php echo ' at ' . $event_time_from; ?>
                                                    <?php echo ' • ' . $data_post['event_place']; ?>
                                                <?php } ?>
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
</div>
