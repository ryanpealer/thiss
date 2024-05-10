<?php

/**
 * Calendar - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/calendar/preview.jpg">';
else:
// Create id attribute allowing for custom "anchor" value.
$id = 'calendar-wrapper-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-calendar-wrapper';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

// Load values.
global $wp;
$format_in = 'Ymd'; // the format your value is saved in (set in the field options)
$timezoneFormat = new DateTimeZone('America/Los_Angeles');

$pastDate = date('Ymd', strtotime('-30 days'));
$nextDate = date('Ymd', strtotime('+6 month'));
//Today's date
$dateNow = date('Ymd');
$date_now = DateTime::createFromFormat($format_in, $dateNow, $timezoneFormat);
$date_now = $date_now->format('Ymd');

$args = array(
    'post_type' => 'events',
    'posts_per_page' => 1,
    'meta_key' => 'event_date_from',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key'		=> 'event_date_from',
            'compare'	=> '>=',
            'value'		=> $date_now,
            'type' => 'DATE'
        )
    ),
);
$args2 = array(
    'post_type' => 'events',
    'posts_per_page' => -1,
    'meta_key'			=> 'event_date_from',
	'orderby'			=> 'meta_value',
	'order'				=> 'ASC',
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'event_date_from',
            'value' => $pastDate,
            'compare' => '>=',
        ),
        array(
            'key' => 'event_date_from',
            'value' => $nextDate,
            'compare' => '<=',
        ),
    ),
);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// var_dump($date_now);
$args3 = array(
    'post_type' => 'events',
    'posts_per_page' => 10,
    // 'orderby' => 'date',
    'paged' => $paged,
    'meta_key' => 'event_date_from',
    'meta_query' => array(
        array(
            'key'		=> 'event_date_from',
            'compare'	=> '>=',
            'value'		=> $date_now,
            // 'value'		=> '20211201',
            'type' => 'DATE'
        )
    ),
    'orderby' => 'meta_value',
    'order' => 'ASC',
    );

$args4 = array(
    'post_type' => 'events',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'paged' => $paged,
);


$current_url =  $wp->request;
$pos = strpos($current_url , 'page');
$finalurl = $pos ? substr($current_url,0,$pos) : $current_url;
$url = home_url(add_query_arg(array(), $finalurl)).'#search__wrap';
$letterCat = get_terms( array(
    'taxonomy' => 'workshop_cat',
    'hide_empty' => false,
) );

$catQuery = get_query_var('workshop_cat');
$sortQuery = get_query_var('sort_by');
$searchQuery = get_query_var('search');

$selectedCatAll = '';
if(!isset($catQuery) && $catQuery != 'all') {
    $selectedCatAll = ' selected';
}

if($searchQuery){
    $args3['s'] = $searchQuery;
}
if($sortQuery && $sortQuery != 'desc'){
    $args3['order']   = $sortQuery;
}  else {
    $args3['order']   = 'asc';
}
if($catQuery && $catQuery != 'all') {
    $args3['tax_query'] = array(
        array(
            'taxonomy' => 'workshop_cat',
            'field' => 'term_id',
            'terms' => $catQuery,
        ),
    );
}

$items = new WP_Query($args);
$items2 = new WP_Query($args2);
$allItems = new WP_Query($args3);
$allItemsEvents = new WP_Query($args4);

$page_fields = get_fields();



// var_dump('<pre>',$allItemsEvents);
//$currentPost = $items->posts[0]->ID;
?>
<?php if ($allItems->have_posts()):
    add_action('wp_footer', function ($arguments) use ($allItems, $allItemsEvents, $format_in, $timezoneFormat) { ?>
        <script id="events-list">
            // calendarJs(id, options, startDateTime)

            var addClassToEvent = function() {
                jQuery('.event-no-hover').each(function(){
                    console.log('each');
                    jQuery(this).parents('.cell').addClass('cell-has-event');
                });
            }
            
            var calendarInstance = new calendarJs("eventCalendar", {
                dragAndDropForEventsEnabled: false,
                extraSelectableYearsAhead: 7,
                exportEventsEnabled: false,
                manualEditingEnabled: false,
                autoRefreshTimerDelay: 0,
                fullScreenModeEnabled: false,
                tooltipsEnabled: false,
                eventTooltipDelay: 500,
                useOnlyDotEventsForMainDisplay: false,
                showDayNumberOrdinals: false,
                dayHeaderNames: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                holidays: false,
                showWeekNumbersInTitles: true,
                onNextMonth: addClassToEvent,
                onPreviousMonth: addClassToEvent,
                onNextYear: addClassToEvent,
                onPreviousYear: addClassToEvent,
                maximumEventsPerDayDisplay: 0,
            });
            var events = [
                
                <?php if ($allItemsEvents->have_posts()): while($allItemsEvents->have_posts()):$allItemsEvents->the_post();
                $fields = get_fields(get_the_ID());

                $event_place = isset($fields['event_place']) && !empty($fields['event_place']) ? $fields['event_place'] : '';
                $e_date_from = isset($fields['event_date_from']) && !empty($fields['event_date_from']) ? $fields['event_date_from'] : '';
                $e_time_from = isset($fields['event_time_from']) && !empty($fields['event_time_from']) ? $fields['event_time_from'] : '';
                $e_date_to = isset($fields['event_date_to']) && !empty($fields['event_date_to']) ? $fields['event_date_to'] : '';
                $e_time_to = isset($fields['event_time_to']) && !empty($fields['event_time_to']) ? $fields['event_time_to'] : '';

                $eventstart = DateTime::createFromFormat('Ymd', $e_date_from);
                $eventend = DateTime::createFromFormat('Ymd', $e_date_to);
                $timestart = DateTime::createFromFormat('g:i a', $e_time_from);
                $timeend = DateTime::createFromFormat('g:i a', $e_time_to);

                $event_date_from = !empty($eventstart) ? $eventstart->format('Y-m-d') : '';
                $event_date_to = !empty($eventend) ? $eventend->format('Y-m-d') : $event_date_from;
                $event_time_from = !empty($timestart) ? $timestart->format('H:i') : '';
                $event_time_to = !empty($timeend) ? $timeend->format('H:i') : $event_time_from;

                if(isset($event_date_from) && isset($event_date_to)):
                ?>
                {
                    id: "<?php echo get_the_ID(); ?>",
                    from: new Date("<?php echo $event_date_from . ' ' . $event_time_from ; ?>"),
                    to: new Date("<?php echo $event_date_to . ' ' . $event_time_to ; ?>"),
                    title: "<?php the_title(); ?>",
                    isAllDayEvent: true,
                },
                
                <?php endif; endwhile; endif; ?>
            ];
            calendarInstance.addEvents(events);
            
            // calendarInstance.onEventUpdated(events);
            jQuery('.list-all-events-view').remove();
            jQuery('.list-all-week-events-view').remove();

            addClassToEvent();
            
            // jQuery(':not(.today)').each(function(){
            //     jQuery(this).parents('.cell').addClass('cell-expired');
            // });

            jQuery('.day-muted').each(function(){
                jQuery(this).parents('.cell').addClass('cell-muted');
            });

            jQuery(document).on('click', '#eventCalendar .cell-has-event .event-no-hover', function(e){
                e.preventDefault();
                var id = jQuery(this).attr('id').substr(4),
                url = '<?php echo home_url() ?>/?p=' + id
                window.open(url, '_blank')
                // jQuery('.event-list-item').not('[data-event-id='+id+']').removeClass('active');
                // $event.addClass('active');
                // $event.get(0).scrollIntoView({block: "center", behavior: "smooth"});
                // jQuery('[data-event-id='+id+'] .js-event-reload').click();
            });
        </script>
    <?php }, 99); endif;
    wp_reset_query();
    /* add_action('wp_footer', function ($arguments) use ($allItems, $allItemsEvents, $format_in, $timezoneFormat) { 
        
        ?>
        <script id="calendar-ajax">
            jQuery(document).ready(function () {
                var headerH = jQuery('.js-header-box').outerHeight(),
                    barH = 0;

                if (jQuery('#wpadminbar').length) {
                    barH = jQuery('#wpadminbar').outerHeight();
                }
                var top = jQuery('#calendar-ajax').offset().top - 48 - barH - headerH;

                jQuery(document).on('click', '.js-event-reload', function () {
                    var post_id = jQuery(this).attr('id'),
                        $this = jQuery(this);
                    jQuery.ajax({
                        url: '<?php echo admin_url("admin-ajax.php") ?>',
                        type: 'post',
                        data: {
                            post_id: post_id,
                            action: 'data_fetch'
                        },
                        success: function (response) {
                            jQuery('html,body').animate({
                                scrollTop: top
                            }, 100);
                            console.log(response)
                            jQuery('.event-list-item').removeClass('active')
                            $this.parents('.event-list-item').addClass('active')
                            jQuery('#calendar-ajax').html(response);
                        }
                    });
                    return false;
                });

            });
        </script>
    <?php }, 100); */ ?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <br>
        <h1 class="is-style-medium has-primary-1-color h1">Calendar</h1>
        <div id="eventCalendar"></div>
        
        <div class="add-calendar-item-block">
            <hr>
            <div class="txt">
                <?= $page_fields['add_item_text'] ? $page_fields['add_item_text'] : ''; ?>
            </div>
            <hr>

            <?php $link = isset($page_fields['add_item_link']) ? $page_fields['add_item_link'] : ''; ?>
            <?php if (!empty($link)) { ?>
            <div class="link">
                <a class="btn btn-link btn-dark" href="<?= $page_fields['add_item_link']['url'] ?>" target="<?= $page_fields['add_item_link']['target'] ?>">
                    <?= $page_fields['add_item_link']['title'] ?>
                </a>
            </div>
            <?php } ?>
            <hr>
        </div>
        
        <div id="calendar-ajax" class="calendar-articles-list">
            <div id="section-heading-block_62206ef5051333a" class="blck-section-heading section-top-pad-default section-bot-pad-half">
                <div class="container">
                    <h2 class="title"><?= $page_fields['calendar_title'] ? $page_fields['calendar_title'] : ''; ?></h2>
                    <p class="subtitle"><?= $page_fields['calendar_subtitle'] ? $page_fields['calendar_subtitle'] : ''; ?></p>
                </div>
            </div>

            <div id="search__wrap"></div>

            <div class="articles-list">
                <div class="search-area">
                    <h4 class="is-style-light has-primary-1-color has-text-color">
                        Search
                        <?php echo !empty($searchQuery) ? ' results for <em>"'.$searchQuery.'"</em>' : '' ?>
                    </h4>
                    <p>
                    <?php
                    if (!empty($searchQuery)) {
                        printf(
                            // esc_html(
                            /* translators: %d: The number of search results. */
                                _n(
                                    'We found <strong>%d</strong> result for your search.',
                                    'We found <strong>%d</strong> results for your search.',
                                    (int) $allItems->found_posts,
                                    'iowa_league'
                                ),
                            // ),
                            (int) $allItems->found_posts
                        );
                    }
                            ?>
                    </p>
                    <form role="search" method="get" class="news-searchform" id="news-searchform" action="<?php echo esc_url($url); ?>">
                        <div class="form-group">
                            <label for="search-cat"><?php _e('Filter category by','iowa_league');?></label>
                            <select id="search-cat" name="workshop_cat" class="search-control js-style-select">
                                <option value="all"<?php echo $selectedCatAll ?>><?php _e('All Categories', 'iowa_league') ?></option>';
                                <?php foreach( $letterCat as $category ) {
                                    $selectedCat = '';
                                    if($catQuery == $category->term_id){
                                        $selectedCat = ' selected';
                                    }
                                    echo '<option value="'. esc_attr( $category->term_id ) .'"'. $selectedCat .'>'. esc_html( $category->name ) .'</option>';
                                } ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="sort-by"><?php _e('Sort by','iowa_league');?></label>
                            <select id="sort-by" name="sort_by" class="search-control js-style-select">
                                <option value="asc"<?php echo $sortQuery == 'asc' || $sortQuery == '' ? ' selected' : '' ?>><?php _e('Date Ascending','iowa_league');?></option>
                                <option value="desc"<?php echo $sortQuery != 'asc' ? ' selected' : '' ?>><?php _e('Date Descending','iowa_league');?></option>
                            </select>
                        </div>
                        <div class="form-group large">
                            <label for="s"><?php _e('Search our News, Events, and Publications','iowa_league');?></label>
                            <div class="search-field-button">
                                <input type="search" class="search-field" placeholder="<?php _e('Type your search here...', 'iowa_league') ?>" value="<?php echo $searchQuery; ?>" name="search" id="s" />
                                <input type="submit" id="searchsubmit" class="search-submit" value="<?php _e( 'Search', 'iowa_league' ); ?>" />
                            </div>
                        </div>
                    </form>
                    <div class="advanced_search">
                        <a href="#"><?php echo iconSvg('plus-circle');?> <span>Advanced Search</span></a>
                    </div>
                </div>




                <?php if ($allItems->have_posts()): while ($allItems->have_posts()):$allItems->the_post();
                    get_template_part( 'template-parts/calendar-event' );
                    endwhile; 
                else:
                    echo '<br><br><br><p class="h6 text-center">No search results for <strong><em>'.$searchQuery.'</em></strong>.</p><br><br><br><br><br><br>';
                endif; 
                wp_reset_query();
                ?>
            </div>
            <?php queryPagination($allItems); ?>


        </div>
    </div>
<?php endif; ?>