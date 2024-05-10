<?php
add_action('acf/init', 'my_acf_init_calendar_block');
function my_acf_init_calendar_block()
{

    if (function_exists('acf_register_block_type')) {
        // register a research slider subblock.
        acf_register_block_type(array(
            'name' => 'calendar_block',
            'title' => __('Calendar', 'iowa_league-admin'),
            'description' => __('Calendar', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/calendar/calendar.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/calendar/calendar.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/calendar/calendar.svg' ),
            'category' => 'glibrary_archive_blocks',
            'keywords' => array('calendar','archive'),
            'post_types' => array('page'),
            'supports' => array(
                'align' => false,
                'anchor' => true
            ),
            'example'  => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => ['is_example' => true]
                ]
            ]
        ));
    }
}