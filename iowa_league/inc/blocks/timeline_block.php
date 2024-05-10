<?php

add_action('acf/init', 'my_acf_init_timeline_block');
function my_acf_init_timeline_block() {

    if( function_exists('acf_register_block_type') ) {

        //timeline

        acf_register_block_type(array(
            'name'              => 'gblock_timeline',
            'title'             => __('GBlock: Timeline Section', 'iowa_league-admin'),
            'description'       => __('GBlock - Timeline', 'iowa_league-admin'),
            'render_template'   => 'template-parts/gblocks/timeline/gblock_timeline.php',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/gblocks/timeline/gblock_timeline.js',
            'category' => 'glibrary_timeline_blocks',
            'icon'              => file_get_contents( get_template_directory() . '/template-parts/gblocks/timeline/timeline.svg' ),
            'keywords'          => array(),
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