<?php get_header();
$description = get_the_archive_description(); ?>
<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div class="container"><div id="breadcrumbs" class="breadcrumbs">', '</div></div>');
}
?>
    <main id="content" role="main" class="main-content">
        <div class="container">
            <div class="blck-section-heading wp-block-acf-block-heading section-top-pad-default section-bot-pad-default">
                <div class="container">
                    <?php the_archive_title('<h1 class="title">', '</h1>'); ?>
                    <div class="subtitle"><?php echo wp_kses_post(wpautop($description)); ?></div>
                </div>
            </div>
            <?php if (have_posts()) : ?>
                <div class="articles-list">
                    <?php while (have_posts()) : the_post();
                        $fields = get_fields();
        if ( get_post_type( get_the_ID() ) == 'events' ) {

            $format_in = 'Y-m-d H:i'; // the format your value is saved in (set in the field options)
            $timezoneFormat = new DateTimeZone('America/Los_Angeles');

            $type_obj_list = get_the_terms(get_the_ID(), 'event_type');
            $cat_obj_list = get_the_terms(get_the_ID(), 'workshop_cat');
            $u_time = get_the_time('U');
            $u_modified_time = get_the_modified_time('U');

            $event_place = isset($fields['event_place']) && !empty($fields['event_place']) ? $fields['event_place'] : '';
            $e_date_from = isset($fields['event_date_from']) && !empty($fields['event_date_from']) ? $fields['event_date_from'] : '';
            $e_time_from = isset($fields['event_time_from']) && !empty($fields['event_time_from']) ? $fields['event_time_from'] : '';
            $e_date_to = isset($fields['event_date_to']) && !empty($fields['event_date_to']) ? $fields['event_date_to'] : '';
            $e_time_to = isset($fields['event_time_to']) && !empty($fields['event_time_to']) ? $fields['event_time_to'] : '';


            if (!empty($e_date_from)) {
                $eventstart = DateTime::createFromFormat('Ymd', $e_date_from);
                $timestart = DateTime::createFromFormat('g:i a', $e_time_from);
                $event_date_from = !empty($eventstart) ? $eventstart->format('Y-m-d') : '';
                $event_time_from = !empty($timestart) ? $timestart->format('H:i') : '00:00';
                $from = $event_date_from . ' ' . $event_time_from;
                $date_start = DateTime::createFromFormat($format_in, $from);
                $dateStart = $date_start->format('m/d/Y');
                $event_time_from = $date_start->format('Hi');
                $displayStart = $date_start->format('l, M j, Y');
                $displayTimeStart = $date_start->format('g:i a');

                if (!empty($e_date_to)) {
                    $eventend = DateTime::createFromFormat('Ymd', $e_date_to);
                    $timeend = DateTime::createFromFormat('g:i a', $e_time_to);
                    $event_date_to = !empty($eventend) ? $eventend->format('Y-m-d') : '';
                    $event_time_to = !empty($timeend) ? $timeend->format('H:i') : '00:00';
                    $to = $event_date_to . ' ' . $event_time_to;
                    $date_end = DateTime::createFromFormat($format_in, $to);
                    $dateEnd = $date_end->format('m/d/Y');
                    $event_time_to = $date_end->format('Hi');
                    $displayEnd = $date_end->format('l, M j, Y');
                    $displayTimeEnd = $date_end->format('g:i a');
                }
            }
        } elseif (get_post_type( get_the_ID() ) == 'post') {
            $type_obj_list = get_the_terms(get_the_ID(), 'category');
            $cat_obj_list = get_the_terms(get_the_ID(), 'post_tag');
        }
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('list-container'); ?>>
                            <div class="list-item">
                                <header>
                                    <div class="h3 title">
                                        <a class="item-title no-underline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </div>
                                    <div class="post_divider"></div>
                                    <div class="publish_update_date">
                                        <span class="item-date-publish"><?php echo iconSvg('file-text'); echo __('Posted on ', 'iowa_league'); echo get_the_date( 'l, F j, Y' ); ?></span>
                                        <span class="item-date-update"><?php echo iconSvg('check-circle'); echo __('Updated on ', 'iowa_league'); echo get_the_modified_date( 'l, F j, Y' ); ?></span>
                                    </div>
                                </header>
                                <?php if ( get_post_type( get_the_ID() ) == 'events' ) { ?>
                                <div class="event-details">
                                    <div class="section-header">
                                        <p class="name h6 has-primary-1-color"><?php _e('Event Details', 'iowa_league'); ?></p>
                                        <div class="event-info d-flex">
                                            <?php if (!empty($event_place)) : ?>
                                                <div class="col">
                                                    <div><?php echo $event_place; ?></div>
                                                    <div>
                                                        <a class="no-underline" href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($event_place)?>" target="_blank" rel="nofollow">
                                                            <?php echo iconSvg('map'); ?><small><?php _e('View on Map', 'iowa_league') ?></small>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($event_date_from)) :
                                                $t = get_the_title();
                                                $ex = get_the_excerpt();
                                                ?>
                                                <div class="col">
                                                    <div><?php echo $displayStart; echo  !empty($displayEnd) && !empty($displayStart) && $displayStart != $displayEnd ? '&nbsp;&mdash;&nbsp;' . $displayEnd : '';?> </div>
                                                    <?php if (!empty($e_time_from)) : ?>
                                                        <div><?php echo iconSvg('time-m'); ?><?php echo '&nbsp;&nbsp;&nbsp;' . ($e_time_from); ?><?php echo !empty($displayEnd) ? '&nbsp;&mdash;&nbsp;' . ($e_time_to) : ''; ?></div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <a class="no-underline" href="http://www.google.com/calendar/event?action=TEMPLATE&text=<?php echo urlencode($t); ?>&dates=<?php echo $e_date_from .'T'. $event_time_from; if (!empty($e_date_to) && !empty($e_date_to)) { ?>/<?php echo $e_date_to .'T'. $event_time_to; } else { echo '/'.$e_date_from .'T'. $event_time_from;} ?>&details=<?php echo urlencode($ex); ?>&location=<?php echo urlencode($event_place); ?>" target="_blank" rel="nofollow">
                                                            <?php echo iconSvg('calendar'); ?><small><?php _e('Add to Calendar', 'iowa_league') ?></small>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="post_divider"></div>
                                </div>
                                <?php } ?>
                                <div class="excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <?php /* if ($fields['small_description']) { ?>
        <div class="rte">
            <?php echo $fields['small_description']; ?>
        </div>
    <?php } */ ?>

                                <footer>
                                    <p><a href="<?php the_permalink(); ?>" class="btn btn-link btn-arrow"><?php _e('See More', 'iowa_league'); ?></a></p>
                                </footer>
                            </div>

                            <div class="list-sidebar">

                                <?php if(!empty($fields['download_pdf'])):?>
                                    <a href="<?php echo $fields['download_pdf']; ?>" class="sidebar-btn btn-tertiary">Download PDF</a>
                                <?php endif;?>
                                <?php if(!empty($fields['external_link'])):?>
                                    <a href="<?php echo $fields['external_link']; ?>" class="sidebar-btn btn-tertiary">External Links</a>
                                <?php endif;?>
                                <?php //if(!empty($fields['view_full_event_details'])):?>
<!--                                <a href="--><?php //the_permalink() ?><!--" class="sidebar-btn btn-tertiary">View Full Event Details</a>-->
                                <?php //endif;?>
                                <?php if(!empty($fields['view_in_epub_reader'])):?>
                                    <a href="<?php echo $fields['view_in_epub_reader']; ?>" class="sidebar-btn btn-tertiary">View in ePub Reader</a>
                                <?php endif;?>

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
                                <?php
                                $posttitle = __('Read About', 'iowa_league') . ' ' . get_the_title();
                                $title = __('<small>Share this article with a colleague:</small>', 'iowa_league');
                                shareArticle($posttitle, get_permalink(get_the_ID()), get_the_post_thumbnail_url(), $title);
                                ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
<?php get_footer(); ?>