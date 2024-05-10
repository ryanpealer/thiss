<?php get_header(); 

$fields = get_fields();
$options = get_fields('options');

// var_dump('<pre>', $options);
    // $fields = get_field_objects();
    
$event_place = isset($fields['event_place']) && !empty($fields['event_place']) ? $fields['event_place'] : '';
$e_date_from = isset($fields['event_date_from']) && !empty($fields['event_date_from']) ? $fields['event_date_from'] : '';
$e_time_from = isset($fields['event_time_from']) && !empty($fields['event_time_from']) ? $fields['event_time_from'] : '';
$e_date_to = isset($fields['event_date_to']) && !empty($fields['event_date_to']) ? $fields['event_date_to'] : '';
$e_time_to = isset($fields['event_time_to']) && !empty($fields['event_time_to']) ? $fields['event_time_to'] : '';

// $format = "Ymd\THis\Z";
// YYYYMMDDTHHmmSSZ
// $eventstart = date($format , $event_date_from . $event_time_from);
// $eventend = date($format , $event_date_to . $event_time_to);

$eventstart = DateTime::createFromFormat('Ymd', $e_date_from);
$eventend = DateTime::createFromFormat('Ymd', $e_date_to);
$timestart = DateTime::createFromFormat('g:i a', $e_time_from);
$timeend = DateTime::createFromFormat('g:i a', $e_time_to);

// $eventend->format('l, M j, Y')
$event_date_from = !empty($eventstart) ? $eventstart->format('l, M j, Y') : '';
$event_date_to = !empty($eventend) ? $eventend->format('l, M j, Y') : '';
$event_time_from = !empty($timestart) ? $timestart->format('His') : '';
$event_time_to = !empty($timeend) ? $timeend->format('His') : '';

$ex = get_the_excerpt();
?>

<?php
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="container"><div id="breadcrumbs" class="breadcrumbs">','</div></div>' );
    }
?>
<br>

<main id="content" role="main" class="main-content container">
    <?php if (have_posts()) : while (have_posts()) : the_post();
            $type_obj_list = get_the_terms(get_the_ID(), 'event_type');
            $cat_obj_list = get_the_terms(get_the_ID(), 'workshop_cat');
            ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <!-- <figure class="hentry-thumbnail">
                    <?php /* the_post_thumbnail('post-thumbnail', array('loading' => 'eager')); ?>
                    <?php if (wp_get_attachment_caption(get_post_thumbnail_id())) : ?>
                        <figcaption
                        class="wp-caption-text"><?php echo wp_kses_post(wp_get_attachment_caption(get_post_thumbnail_id())); ?></figcaption>
                        <?php endif; */?>
                </figure> -->

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
                <h1 class="is-style-medium text-center has-primary-1-color"><?php the_title(); ?></h1>
                <p class="text-center h6"><?php echo iconSvg('file-text', 24); ?>&nbsp;&nbsp;<span class="date"> Posted
                        on <?php echo get_the_date('F j, Y'); ?></span></p>

                <div class="tags-section">
                    <!-- <div class="tags-section-title"><?php //_e('Related Tags:', 'iowa_league') ?></div> -->
                    <div class="tags-section-list">
                        <?php if ($type_obj_list) {
                                        $string = '';
                                        foreach ($type_obj_list as $t) {
                                            $string .= ' <a href="' . get_term_link($t->slug, $t->taxonomy) . '">' . $t->name . '</a>';
                                        }
                                        $string = substr($string, 1);
                                        echo $string;
                                    } ?>

                        <?php if ($cat_obj_list) { 
                                        $string = '';
                                        foreach ($cat_obj_list as $c) {
                                            $string .= ', <a href="' . get_term_link($c->slug, $c->taxonomy) . '">' . $c->name . '</a>';
                                        }
                                        $string = substr($string, 1);
                                        echo $string;
                                    } ?>
                    </div>
                </div>

                <hr>

                <div class="event-info d-flex">
                    <div class="col">
                        <?php if (!empty($event_place)) : ?>
                        <div><?php echo $event_place; ?></div>
                        <div>
                            <a class="no-underline"
                                href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($event_place)?>"
                                target="_blank" rel="nofollow">
                                <?php echo iconSvg('map'); ?><small><?php _e('View on Map', 'iowa_league') ?></small>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($event_date_from)) : 
                                $t = get_the_title();
                                $ex = get_the_excerpt();
                            ?>
                    <div class="col">
                        <div>
                            <?php echo $event_date_from; echo  !empty($event_date_to) && $event_date_from != $event_date_to ? '&nbsp;&mdash;&nbsp;' . $event_date_to : '';?>
                        </div>
                        <?php if (!empty($e_time_from)) : ?>
                        <div>
                            <?php echo iconSvg('time-m'); ?><?php echo '&nbsp;&nbsp;&nbsp;' . ($e_time_from); ?><?php echo !empty($e_time_to) ? '&nbsp;&mdash;&nbsp;' . ($e_time_to) : ''; ?>
                        </div>
                        <?php endif; ?>
                        <div>
                            <a class="no-underline"
                                href="http://www.google.com/calendar/event?action=TEMPLATE&text=<?php echo urlencode($t); ?>&dates=<?php echo $e_date_from .'T'. $event_time_from; if (!empty($e_date_to) && !empty($e_date_to)) { ?>/<?php echo $e_date_to .'T'. $event_time_to; } else { echo '/'.$e_date_from .'T'. $event_time_from;} ?>&details=<?php echo urlencode($ex); ?>&location=<?php echo urlencode($event_place); ?>"
                                target="_blank" rel="nofollow">
                                <?php echo iconSvg('calendar'); ?><small><?php _e('Add to Calendar', 'iowa_league') ?></small>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

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
            </footer>
        </div>

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

$desktop = isset($options['settings_events']['visible_count']['desktop']) ? $options['settings_events']['visible_count']['desktop'] : '';
$tablet = isset($options['settings_events']['visible_count']['tablet']) ? $options['settings_events']['visible_count']['tablet'] : '';
$mobile = isset($options['settings_events']['visible_count']['mobile']) ? $options['settings_events']['visible_count']['mobile'] : '';
?>

        <div class="wp-block-columns alignfull nonprint">
            <div class="wp-block-column">
                <div class="wp-block-columns ">
                    <div class="wp-block-column">

                        <?php if (isset($options['title_events']) || (isset($options['title_events']))) { ?>
                            <div id="section-heading-block_62206ef5051333a"
                                class="blck-section-heading section-top-pad-default section-bot-pad-none">
                                <div class="container">
                                    <?php if (isset($options['title_events'])) { ?>
                                    <h2 class="title has-primary-1-color">
                                        <?php echo $options['title_events'] ?>
                                    </h2>
                                    <?php } ?>
                                    <?php if (isset($options['subtitle_events'])) { ?>
                                    <p class="subtitle">
                                        <?php echo $options['subtitle_events'] ?>
                                    </p>
                                    <?php } ?>
                                </div>
                                <p>&nbsp;</p>
                            </div>
                        <?php } ?>

                        <div class="<?php echo esc_attr($className); ?>">
                            <div
                                class="blck-inner-mc-listing card-style card_custom_items section-top-pad-none section-bot-pad-default">
                                <div class="mc-grid"
                                    style="--desktop:<?php echo $desktop ?>;--tablet:<?php echo $tablet ?>;--mobile:<?php echo $mobile ?>">


                                    <!-- <div class="" data-item-count="<?php //echo !empty($data['desktop']) ? $data['desktop'] : '';  ?>" data-item-tablet-count="<?php echo !empty($data['tablet']) ? $data['tablet'] : ''; ?>"> -->
                                    <?php if ($options['settings_events']['content_type'] == 'custom_items') : ?>
                                    <?php foreach ($options['items_events'] as $item): ?>
                                    <?php if ($options['settings_events']['card_as_link'] == true) { ?>
                                    <a class="mc-grid-item" href="<?php echo $item['link']['url'] ?>"
                                        <?php if ($item['link']['target']) echo ' target="' . $item['link']['target'] . '"' ?>>
                                        <?php } else { ?>
                                        <div class="mc-grid-item">
                                            <?php } ?>
                                            <figure>
                                                <?php echo isset($item['icon']['id']) && $item['icon']['id'] ? wp_get_attachment_image($item['icon']['id'],'large') : '';?>
                                            </figure>

                                            <?php 
                        if (!empty($options['settings_events']['card_as_link'])) {
                            if (!empty($item['title'])) { ?>
                                            <div class="name"><?php echo do_shortcode($item['title']) ?></div>
                                            <?php } ?>
                                            <?php if (!empty($item['text'])) { ?>
                                            <div class="text"><?php echo do_shortcode($item['text']); ?></div>
                                            <?php } ?>

                                            <?php if (!empty($item['link']['title'])) { ?>
                                            <?php if ($options['settings_events']['card_as_link'] != true) { ?>
                                            <a class="btn-link btn-arrow" href="<?php echo $item['link']['url'] ?>"
                                                <?php if ($item['link']['target']) echo ' target="' . $item['link']['target'] . '"' ?>>
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
                                                <?php if ($options['settings_events']['card_as_link'] != true) { ?>
                                                <a class="btn-link btn-arrow" href="<?php echo $item['link']['url'] ?>"
                                                    <?php if ($item['link']['target']) echo ' target="' . $item['link']['target'] . '"' ?>>
                                                    <?php echo $item['link']['title']; ?>
                                                </a>
                                                <?php } else { ?>
                                                <div class="name"><?php echo $item['link']['title']; ?></div>
                                                <?php } ?>
                                                <?php } ?>
                                            </div>

                                            <?php }
                        ?>
                                            <?php if ($options['settings_events']['card_as_link'] == true) { ?>
                                    </a>
                                    <?php } else { ?>
                                </div>
                                <?php } ?>
                                <?php endforeach; ?>


                                <?php elseif ($options['settings_events']['content_type'] == 'post_data'):
                $args = array(
                    'post_type' => $options['select_post_type_events'],
                    'posts_per_page' => !empty($options['settings_events']['visible_count']['total_count_to_show']) ? $options['settings_events']['visible_count']['total_count_to_show'] : '',
                    'orderby' => 'post_date',
                    'post_status' => 'publish',
                );
                $query = new WP_Query($args);
                
                $i=1;
                if ($query->have_posts()):
                    ?>
                                <?php while ($query->have_posts()): $query->the_post(); ?>
                                <div class="mc-grid-item item-<?php echo $i; ?>">
                                    <figure>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large'); ?>
                                        </a>
                                    </figure>
                                    <div class="text">
                                        <div class="name">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </div>
                                        <div class="item-rte"><?php echo the_excerpt(); ?></div>

                                        <a class="btn-link" href="<?php the_permalink(); ?>">
                                            See Details
                                        </a>
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

    </article>
    <?php endwhile; ?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>