<?php get_header(); 

// $allposts= get_posts( array('post_type'=>'resource','numberposts'=>-1) );
// foreach ($allposts as $eachpost) {
// wp_delete_post( $eachpost->ID, true );
// }

$fields = get_fields();
$options = get_fields('options');

$ex = get_the_excerpt();
?>

<?php
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="container"><div id="breadcrumbs" class="breadcrumbs">','</div></div>' );
    }
?>
<br>
    <?php if (have_posts()) : while (have_posts()) : the_post();
        $type_obj_list = get_the_terms(get_the_ID(), 'resources_tax');
    ?>
    <?php if (has_post_thumbnail()) { ?>
        <figure class="hentry-thumbnail">
            <?php  the_post_thumbnail('full', array('loading' => 'eager')); ?>
            <?php if (wp_get_attachment_caption(get_post_thumbnail_id())) : ?>
                <figcaption
                class="wp-caption-text"><?php echo wp_kses_post(wp_get_attachment_caption(get_post_thumbnail_id())); ?></figcaption>
                <?php endif; ?>
        </figure>
    <?php } ?>
    <main id="content" role="main" class="main-content container">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <div class="btns-share-wrap nonprint">
                    <div class="btns-share btn btn-tertiary">
                        <?php
                            $title = __('Read About', 'iowa_league') . ' ' . get_the_title();
                            shareArticle($title, get_permalink(), get_the_post_thumbnail_url(), '');
                        ?>
                    </div>
                </div>
                <div class="container small">
                    <header class="hentry-header">
                        <div class="hentry-header--meta-top">
                            <div class="tag-block"></div>
                            <span>
                                <a href="#" class="print-link" onclick="window.print();return false;">
                                    <?php _e('Print Friendly Version','iowa_league');?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9V2H18V9" stroke="#424242" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6 18H4C3.46957 18 2.96086 17.7893 2.58579 17.4142C2.21071 17.0391 2 16.5304 2 16V11C2 10.4696 2.21071 9.96086 2.58579 9.58579C2.96086 9.21071 3.46957 9 4 9H20C20.5304 9 21.0391 9.21071 21.4142 9.58579C21.7893 9.96086 22 10.4696 22 11V16C22 16.5304 21.7893 17.0391 21.4142 17.4142C21.0391 17.7893 20.5304 18 20 18H18" stroke="#424242" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M18 14H6V22H18V14Z" stroke="#424242" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                </a>
                            </span>
                        </div>

                        <h1 class="is-style-medium text-center has-primary-1-color"><?php the_title(); ?></h1>
                        <div class="single-post-date">
                            <?php if (get_the_modified_date( 'l, F j, Y' ) != get_the_date( 'l, F j, Y' )) { ?>
                                <span class="has-primary-1-color"><?php echo iconSvg('check-circle', 24); ?>&nbsp;&nbsp;<span class="date"> <?php echo __('Updated on ', 'iowa_league') . get_the_modified_date('F j, Y'); ?></span></span>
                            <?php } ?>
                            <span><?php echo iconSvg('file-text', 24); ?>&nbsp;&nbsp;<span class="date"><?php echo __('Posted on ', 'iowa_league') . get_the_date('F j, Y'); ?></span></span>
                        </div>
                        <?php
                        if ($type_obj_list) {
                            ?>
                            <div class="tags-section">
                                <div class="tags-section-list">
                                    <?php
                                    $string = '';
                                    foreach ($type_obj_list as $t) {
                                        $string .= ' <a href="' . get_term_link($t->slug, $t->taxonomy) . '">' . $t->name . '</a>';
                                    }
                                    $string = substr($string, 1);
                                    echo $string;
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        
                        

                        <!-- <div class="text-center h5">
                            <?php //if ( has_excerpt() ) { the_excerpt(); } else { echo ''; } ?>
                        </div> -->

                        <hr>
                    </header>
                    <div class="hentry-content">
                        <div class="post-content-entry">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <footer class="hentry-footer">

                        <div class="text-center nonprint">
                                <?php
                                $posttitle = __('Read About', 'iowa_league') . ' ' . get_the_title();
                                $title = __('Did you find this page useful? Share with a colleague', 'iowa_league');
                                shareArticle($posttitle, get_permalink(), get_the_post_thumbnail_url(), $title);
                                ?>
                            </div>
                        <!-- <div class="hentry-footer--author">
                            <div class="hentry-footer--author--avatar">
                                <?php //$author_id = get_the_author_meta('ID');
                              //  echo get_avatar($author_id, 58); ?>
                            </div>
                            <div class="hentry-footer--author--info">
                                <span class="author"><?php //_e('Written by ', 'iowa_league'); ?><strong><?php// echo get_the_author(); ?></strong></span>
                                <span class="date"><?php //echo get_the_date('M j, Y'); ?></span>
                            </div>
                        </div> -->
                    </footer>
                </div>

                <br class="nonprint">
                <br class="nonprint">
                <br class="nonprint">

                <?php

                        /**
                         * Multi Cloumn Listing - Block Template.
                         *
                         * @param array $block The block settings and attributes.
                         * @param string $content The block inner HTML (empty).
                         * @param bool $is_preview True during AJAX preview.
                         * @param   (int|string) $post_id The post ID this block is saved to.
                         */

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
                        // var_dump('<pre>', $data);

                        // if select_post_type
                        // $items = $args = '';


                        // if (!empty($options['settings_resources']['card_style'])) {
                        //     $className .= ' card-style';
                        // }

                        // if (!empty($options['settings_resources']['card_as_link'])) {
                        //     $className .= ' card_as_link';
                        // }
                        // if (!empty($options['settings_resources']['text_alignments'])) {
                        //     $className .= ' text-'.$options['settings_resources']['text_alignments'];
                        // }

                        // if (!empty($options['settings_resources']['content_type'])) {
                        //     $className .= ' card_'.$options['settings_resources']['content_type'];
                        // }

                        // if(isset($data['section_padding']) && $data['section_padding']){
                        //     $className .= ' section-top-pad-'.$data['section_padding']['top'];
                        //     $className .= ' section-bot-pad-'.$data['section_padding']['bottom'];
                        // }

                        $desktop = $options['settings_resources']['visible_count']['desktop'];
                        $tablet = $options['settings_resources']['visible_count']['tablet'];
                        $mobile = $options['settings_resources']['visible_count']['mobile'];
                        ?>


                <div class="wp-block-columns alignfull nonprint">
                    <div class="wp-block-column">
                        <div class="wp-block-columns ">
                            <div class="wp-block-column">
                                
                            <div id="section-heading-block_62206ef5051333a" class="blck-section-heading section-top-pad-default section-bot-pad-default">
                                <div class="container">
                                    <h2 class="title has-primary-1-color"><?php echo $options['title_resources']; ?></h2>
                                    <p class="subtitle"><?php echo $options['subtitle_resources']; ?></p>
                                    <!-- <p>&nbsp;</p> -->
                                </div>
                            </div>

                            <div class="<?php echo esc_attr($className); ?>">
                                <div class="blck-inner-mc-listing card-style card_custom_items section-top-pad-none section-bot-pad-default">
                                    <div class="mc-grid" style="--desktop:<?php echo $desktop ?>;--tablet:<?php echo $tablet ?>;--mobile:<?php echo $mobile ?>">
                                        
                                    
                                    <!-- <div class="" data-item-count="<?php echo !empty($data['desktop']) ? $data['desktop'] : '';  ?>" data-item-tablet-count="<?php echo !empty($data['tablet']) ? $data['tablet'] : ''; ?>"> -->
                                        <?php
                                        if ($options['settings_resources']['content_type'] == 'custom_items') :
                                            // var_dump($data);
                                        ?>
                                            <?php foreach ($data['items_resources'] as $item): ?>
                                            <?php if ($options['settings_resources']['card_as_link'] == true) { ?>
                                                <a class="mc-grid-item" href="<?php echo $item['link']['url'] ?>" <?php if ($item['link']['target']) echo ' target="' . $item['link']['target'] . '"' ?>>
                                            <?php } else { ?>
                                                <div class="mc-grid-item">
                                            <?php } ?>
                                                    <figure>
                                                        <?php echo isset($item['icon']['id']) && $item['icon']['id'] ? wp_get_attachment_image($item['icon']['id'],'large') : '';?>
                                                    </figure>
                                                    
                                                    <?php 
                                                    if (!empty($options['settings_resources']['card_as_link'])) {
                                                        if (!empty($item['title'])) { ?>
                                                            <div class="name"><?php echo do_shortcode($item['title']) ?></div>
                                                            <?php } ?>
                                                            <?php if (!empty($item['text'])) { ?>
                                                                <div class="text"><?php echo do_shortcode($item['text']); ?></div>
                                                            <?php } ?>
                                                            
                                                            <?php if (!empty($item['link']['title'])) { ?>
                                                                <?php if ($options['settings_resources']['card_as_link'] != true) { ?>
                                                                <a class="btn-link btn-arrow" href="<?php echo $item['link']['url'] ?>" <?php if ($item['link']['target']) echo ' target="' . $item['link']['target'] . '"' ?>>
                                                                    <?php echo $item['link']['title']; ?>
                                                                </a>
                                                                <?php } else { ?>
                                                                <div class="name"><?php echo $item['link']['title']; ?></div>
                                                                <?php } ?>
                                                        <?php }
                                                    } else { ?>
                                                            
                                                        <div class="text">
                                                            <?php if (!empty($item['title'])) { ?>
                                                                <div class="name"><?php echo do_shortcode($item['title']) ?></div>
                                                            <?php } ?>
                                                                <?php if (!empty($item['text'])) { ?>
                                                                <?php echo do_shortcode($item['text']); ?>
                                                                <?php } ?>
                                                                <?php if (!empty($item['link']['title'])) { ?>
                                                                    <?php if ($options['settings_resources']['card_as_link'] != true) { ?>
                                                                    <a class="btn-link btn-arrow" href="<?php echo $item['link']['url'] ?>" <?php if ($item['link']['target']) echo ' target="' . $item['link']['target'] . '"' ?>>
                                                                        <?php echo $item['link']['title']; ?>
                                                                    </a>
                                                                    <?php } else { ?>
                                                                    <div class="name"><?php echo $item['link']['title']; ?></div>
                                                                    <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                            
                                                    <?php }
                                                    ?>
                                                    
                                                    
                                                <!-- </div> -->
                                            <?php if ($options['settings_resources']['card_as_link'] == true) { ?>
                                                </a>
                                            <?php } else { ?>
                                                </div>
                                            <?php } ?>   
                                        <?php endforeach; ?>


                                        <?php elseif ($options['settings_resources']['content_type'] == 'post_data'):
                                            $args = array(
                                                'post_type' => $options['select_post_type_resources'],
                                                'posts_per_page' => !empty($options['settings_resources']['visible_count']['total_count_to_show']) ? $options['settings_resources']['visible_count']['total_count_to_show'] : '',
                                                'orderby' => 'post_date',
                                                'post_status' => 'publish',
                                            );
                                            $query = new WP_Query($args);
                                            
                                            $i=1;
                                            if ($query->have_posts()):
                                                ?>
                                                <?php while ($query->have_posts()): $query->the_post(); ?>
                                                <div class="mc-grid-item item-<?php echo $i; ?>">
                                                    <!-- <div class="box"> -->
                                                        <figure>
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_post_thumbnail('large'); ?>
                                                            </a>
                                                        </figure>
                                                        <div class="text">
                                                            <?php /* if($data['show_meta_above_title'] != ''){ ?>
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
                                                                                <?php echo $data_post['event_date']; ?> 
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
                                                            <?php } */ ?>
                                                            <div class="name">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </div>
                                                            <div class="item-rte">
                                                                <p><?php echo wp_trim_words(get_the_excerpt(), 16); ?></p>
                                                            </div>

                                                            <a class="btn-link" href="<?php the_permalink(); ?>">
                                                                See Details
                                                            </a>
                                                        </div>
                                                    <!-- </div> -->
                                                </div>
                                            <?php $i++; endwhile; ?>
                                            <?php endif; wp_reset_query(); ?>
                                        <?php endif; ?>
                                    <!-- </div> -->
                                    
                                    
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>

            </article>
        </main>
        <?php endwhile; ?>
        <?php endif; ?>
<?php get_footer(); ?>