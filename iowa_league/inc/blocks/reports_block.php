<?php

add_action('acf/init', 'my_acf_init_reports_block');
function my_acf_init_reports_block() {

    if( function_exists('acf_register_block_type') ) {

        //reports

        acf_register_block_type(array(
            'name'              => 'gblock_reports',
            'title'             => __('GBlock: Report List Section', 'iowa_league-admin'),
            'description'       => __('GBlock - Report List', 'iowa_league-admin'),
            'render_template'   => 'template-parts/gblocks/reports/gblock_reports.php',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/gblocks/reports/gblock_reports.js',
            'category' => 'glibrary_reports_blocks',
            'icon'              => file_get_contents( get_template_directory() . '/template-parts/gblocks/reports/reports.svg' ),
            'keywords'          => array(),
            'post_types' => array('page'),
            'supports'          => array(
                'align' => true,
                'mode' => true,
                'jsx' => true
            ),
            'example'  => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => ['is_example' => true]
                ]
            ]
        ));
    };
}