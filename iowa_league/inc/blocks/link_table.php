<?php

add_action('acf/init', 'my_acf_init_link_table_block');
function my_acf_init_link_table_block() {

    if( function_exists('acf_register_block_type') ) {

        //reports

        acf_register_block_type(array(
            'name'              => 'gblock_link_table',
            'title'             => __('GBlock: Links Table', 'iowa_league'),
            'description'       => __('GBlock - Relevant Downloads and Links Table', 'iowa_league'),
            'render_template'   => 'template-parts/gblocks/link_table/style1.php',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/gblocks/link_table/style1.js',
            'category' => 'glibrary_content_blocks',
            'icon'              => file_get_contents( get_template_directory() . '/template-parts/gblocks/link_table/style1.svg' ),
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