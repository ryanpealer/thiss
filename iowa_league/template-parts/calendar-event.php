<?php $fields = get_fields(get_the_ID());

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


if (!empty($e_date_from)){
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

    if (!empty($e_date_to)){
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

?>
<article id="post-<?php the_ID(); ?>" class="list-container event-list-item" data-event-id="day-<?php the_ID() ?>">
<div class="list-item">
    <header>
        <div class="h3 title">
            <a class="item-title no-underline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </div>
        <div class="post_divider"></div>
        <div class="publish_update_date">
            <?php if (get_the_modified_date( 'l, F j, Y' ) != get_the_date( 'l, F j, Y' )) { ?>
                <span class="item-date-update"><?php echo iconSvg('check-circle'); echo __('Updated on ', 'iowa_league'); echo get_the_modified_date( 'l, F j, Y' ); ?></span>
            <?php } else { ?>
                <span class="item-date-publish"><?php echo iconSvg('file-text'); echo __('Posted on ', 'iowa_league'); echo get_the_date( 'l, F j, Y' ); ?></span>
            <?php } ?>
        </div>
    </header>
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

        <?php /* if (isset($fields['location_or_building_name']) && !empty($fields['location_or_building_name'])) { ?>
            <div class="build">
                <?php echo $fields['location_or_building_name']; ?>
            </div>
        <?php } ?>
        <?php if (isset($fields['event_place']) && !empty($fields['event_place'])) { ?>
            <div class="address">
                <?php echo $fields['event_place']; ?>
            </div>
        <?php } */ ?>
    </div>
    <?php if (has_excerpt()) { ?>
        <div class="excerpt">
            <?php the_excerpt(); ?>
        </div>
    <?php } ?>
    <?php /* if ($fields['small_description']) { ?>
        <div class="rte">
            <?php echo $fields['small_description']; ?>
        </div>
    <?php } */ ?>
    </div>

    <div class="list-sidebar">

        <a href="<?php the_permalink() ?>" class="sidebar-btn btn-tertiary">View Full Event Details</a>
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
        
        <?php
        $posttitle = __('Read About', 'iowa_league') . ' ' . get_the_title();
        $title = __('<small>Share this article with a colleague:</small>', 'iowa_league');
        shareArticle($posttitle, get_permalink(get_the_ID()), get_the_post_thumbnail_url(), $title);
        ?>
    </div>
</article>