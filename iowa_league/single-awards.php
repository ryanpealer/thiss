<?php 
    get_header(); 
    $fields = get_fields();
    $options = get_fields('options');

    $city_name = !empty($fields['city_name']) ? $fields['city_name'] : '';
    $table_title = !empty($fields['table_title']) ? $fields['table_title'] : '';
    $table_subtitle = !empty($fields['table_subtitle']) ? $fields['table_subtitle'] : '';
    $table_shortcode = !empty($fields['table_shortcode']) ? $fields['table_shortcode'] : '';
?>
    <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<div class="container"><div id="breadcrumbs" class="breadcrumbs">','</div></div>' );
        }
    ?>

    <main id="content" role="main" class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post();
            $post_tags = get_the_terms(get_the_ID(), 'post_tag');
            $post_cat = get_the_terms(get_the_ID(), 'category');
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- <figure class="hentry-thumbnail">
                    <?php /*the_post_thumbnail('post-thumbnail', array('loading' => 'eager')); ?>
                    <?php if (wp_get_attachment_caption(get_post_thumbnail_id())) : ?>
                        <figcaption
                                class="wp-caption-text"><?php echo wp_kses_post(wp_get_attachment_caption(get_post_thumbnail_id())); ?></figcaption>
                    <?php endif; */?>
                </figure> -->
                <div class="container">

                    <div class="wp-block-columns has-white-background-color has-background">
                        <div class="wp-block-column">


                            <header class="hentry-header">
                                <?php
                                    if ($post_tags) {
                                    ?>
                                    <div class="tags-section">
                                        <!-- <div class="tags-section-title"><?php //_e('Related Tags:', 'iowa_league') ?></div> -->
                                        <div class="tags-section-list">
                                            <?php
                                            $string = '';
                                            foreach ($post_tags as $t) {
                                                $string .= ' <a href="' . get_term_link($t->slug, $t->taxonomy) . '">' . $t->name . '</a>';
                                            }
                                            $string = substr($string, 1);
                                            echo $string;
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            
                                <h1 class="hentry-header--title">
                                    <?php the_title(); ?>
                                </h1>
                                <!-- <div class="hentry-header--author">
                                    <div class="hentry-header--author--avatar">
                                        <?php $author_id = get_the_author_meta('ID');
                                        echo get_avatar($author_id, 58); ?>
                                    </div>
                                </div> -->
                                <?php if (!empty($city_name)) { ?>
                                    <p>
                                        <strong><?php echo $city_name ?></strong>
                                    </p>
                                <?php } ?>
                                
                                <div class="hentry-header--author--info">
                                    <!-- <span class="author"><?php //_e('Written by ', 'iowa_league'); ?><strong><?php echo get_the_author(); ?></strong></span> -->
                                    <p><em class="date"><?php echo get_the_date('l, F j, Y'); ?></em></p><br>
                                </div>

                                <div class="hentry-header--meta">
                                    <?php
                                    if ($post_cat) { ?>
                                        <div class="hentry-header--meta--categories">
                                            <?php
                                            $string = '';
                                            foreach ($post_cat as $c) {
                                                $string .= ', <a href="' . get_term_link($c->slug, $c->taxonomy) . '">' . $c->name . '</a>';
                                            }
                                            $string = substr($string, 1);
                                            echo $string;
                                            ?>
                                        </div>
                                    <?php } else {
                                        echo '<span></span>';
                                    } ?>

                                </div>
                                <?php
                                //$title = __('Read About', 'iowa_league') . ' ' . get_the_title();
                                //shareArticle($title, get_permalink(), get_the_post_thumbnail_url(), 'Share this with a colleague:');
                                ?>
                            </header>
                            <div class="hentry-content">
                                <div class="post-content-entry">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <!-- <br><br> -->
                    <!-- <div class="tables-wrapper">
                        <?php /*
                        
                        if( has_term('all-stars', 'awards_tax') ){
                            ?>
                                <h2 class="block-heading-title has-primary-1-color has-text-color">
                                All-Star Past Awards
                                </h2>
                                <p class="block-heading-subtitle">
                                Mi proin sed libero enim. Duis tristique sollicitudin nibh sit amet commodo. Ullamcorper morbi tincidunt ornare massa eget egestas.
                                </p>
                                <?php echo do_shortcode('[wpdatatable id=34]') ?>
                            <?php  
                        } else { ?>

                                <h2 class="block-heading-title has-primary-1-color has-text-color">
                                Past Awards
                                </h2>
                                <p class="block-heading-subtitle">
                                Mi proin sed libero enim. Duis tristique sollicitudin nibh sit amet commodo. Ullamcorper morbi tincidunt ornare massa eget egestas.
                                </p>
                                <?php echo do_shortcode('[wpdatatable id=13]') ?>
                                <?php echo do_shortcode('[wpdatatable id=14]') ?>

                                <div class="text-center">
                                    <a href="#" class="btn btn-tertiary">Load More</a>
                                </div>
                                <p></p>

                        <?php } */ ?>
                    </div> -->
                    
                    
                    
                </div>


                <footer class="hentry-footer">
                    <div class="hentry-footer--meta">

                        <?php
                        $title = __('Share this with a colleague:', 'iowa_league') . ' ' . get_the_title();
                        shareArticle($title, get_permalink(), get_the_post_thumbnail_url(), 'Share this with a colleague:');
                        ?>
                    </div>
                    <!-- <div class="hentry-footer--author">
                        <div class="hentry-footer--author--avatar">
                            <?php //$author_id = get_the_author_meta('ID');
                            //echo get_avatar($author_id, 58); ?>
                        </div>
                        <div class="hentry-footer--author--info">
                            <span class="author"><?php //_e('Written by ', 'iowa_league'); ?><strong><?php echo get_the_author(); ?></strong></span>
                            <span class="date"><?php //echo get_the_date('M j, Y'); ?></span>
                        </div>
                    </div> -->
                </footer>











               



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
                    $data = [];
                    $data = get_fields('options');
                    // var_dump($data);
                    $items = isset($data['items_awards']) ? $data['items_awards'] : '';

                    if (!empty($data['settings_awards']['card_style'])) {
                        $className .= ' card-style';
                    }
                    if (!empty($data['settings_awards']['text_alignments'])) {
                        $className .= ' text-'.$data['settings_awards']['text_alignments'];
                    }

                    // if(isset($data['section_padding']) && $data['section_padding']){
                    //     $className .= ' section-top-pad-'.$data['section_padding']['top'];
                    //     $className .= ' section-bot-pad-'.$data['section_padding']['bottom'];
                    // }

                    $desktop = isset($data['settings_awards']['visible_count']['desktop']) ? $data['settings_awards']['visible_count']['desktop'] : '';
                    $tablet = isset($data['settings_awards']['visible_count']['tablet']) ? $data['settings_awards']['visible_count']['tablet'] : '';
                    $mobile = isset($data['settings_awards']['visible_count']['mobile']) ? $data['settings_awards']['visible_count']['mobile'] : '';
                    ?>  
<div class="wp-block-columns alignfull">
    <div class="wp-block-column">
        <div class="wp-block-columns has-white-background-color has-background">
            <div class="wp-block-column">
                    <div id="section-heading-block_62206ef5051333a" class="blck-section-heading section-top-pad-half section-bot-pad-default">
                        <div class="container">
                            <h2 class="title has-primary-1-color"><?php echo $options['title_awards']; ?></h2>
                            <p class="subtitle"><?php echo $options['subtitle_awards']; ?></p>
                            <!-- <p>&nbsp;</p> -->
                        </div>
                    </div>

                    <div class="<?php echo esc_attr($className); ?>">
                        <div class="">
                            <div class="mc-grid" style="--desktop:<?php echo $desktop ?>;--tablet:<?php echo $tablet ?>;--mobile:<?php echo $mobile ?>">
                            
                             
            <?php if ($data['settings_awards']['content_type'] == 'custom_post') :
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

                            <?php //if ($data['settings_awards']['hide_excerpt'] == false) { ?>
                            <div class="item-rte"><?php the_excerpt($item->ID); ?></div>
                            <?php //} ?>
                                <a class="btn-link" href="<?php the_permalink($item->ID); ?>">See Details</a>
                        </div>
                    </div>
                <?php $i++; endforeach;  ?>
        
            <!-- <div class="" data-item-count="<?php //echo !empty($data['desktop']) ? $data['desktop'] : '';  ?>" data-item-tablet-count="<?php //echo !empty($data['tablet']) ? $data['tablet'] : ''; ?>"> -->
            <?php elseif ($data['settings_awards']['content_type'] == 'custom_items') : ?>
                <?php foreach ($data['items_awards'] as $item): ?>
                <?php if ($data['settings_awards']['card_as_link'] == true) { 
                    
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
                        if (!empty($data['settings_awards']['card_as_link'])) {
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
                                        <?php if ($data['settings_awards']['card_as_link'] != true) { ?>
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
                                        <?php if ($data['settings_awards']['card_as_link'] != true) { ?>
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
                <?php if ($data['settings_awards']['card_as_link'] == true) { ?>
                    </a>
                <?php } else { ?>
                    </div>
                <?php } ?>   
            <?php endforeach; ?>


            <?php elseif ($data['settings_awards']['content_type'] == 'post_data'):

                    if(isset($data['settings_awards']['select_terms']) && !empty($data['settings_awards']['select_terms'])){
                    // var_dump('<pre>',$data['settings_awards']['select_terms']);
                    $args = array(
                        'post_type' => $data['select_post_type_awards'],
                        'posts_per_page' => $data['settings_awards']['visible_count']['total_count_to_show'],
                        'orderby' => 'post_date',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => $data['settings_awards']['select_taxonomy'][0],
                                'field'    => 'term_id',
                                'terms'    => $data['settings_awards']['select_terms'][0],
                            ),
                        ),
                    );
                } else {
                    $args = array(
                        'post_type' => $data['select_post_type_awards'],
                        'posts_per_page' => $data['settings_awards']['visible_count']['total_count_to_show'],
                        'orderby' => 'post_date', 
                        'post_status' => 'publish', 
                    );
                }
                $query = new WP_Query($args);
                
                $i=1;
                if ($query->have_posts()):
                    ?>
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                    <div class="mc-grid-item item-<?php echo $i; ?>">
                        <?php /*if (has_post_thumbnail()) { ?>
                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('mc_listing'); ?>
                                </a>
                            </figure>
                        <?php }*/ ?>
                            <div class="text">

                                <div class="name">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>

                                <?php /* //if ($data['settings_awards']['hide_excerpt'] == false) { ?>
                                <div class="item-rte"><?php the_excerpt(); ?></div>
                                <?php //} */ ?>
                                 <a class="btn-link" href="<?php the_permalink(); ?>">See Details</a>
                            </div>
                    </div>
                <?php $i++; endwhile; ?>
                <?php endif; wp_reset_query(); ?>
            <?php endif; ?>
            </div>            
        </div>            
    </div>            
</div>     
                            
                            
                            
                            
                            
                            
                            
                            
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

            </article>
        <?php endwhile; ?>
        <?php endif; ?>
    </main>
<?php get_footer(); ?>