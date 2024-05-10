<?php

add_action('acf/init', 'my_acf_init_notice_block');
function my_acf_init_notice_block() {

    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'gblock_notice',
            'title'             => __('Notice Block', 'iowa_league-admin'),
            'description'       => __('GBlock - Notice', 'iowa_league-admin'),
            'render_template'   => 'template-parts/gblocks/notice/notice.php',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/gblocks/notice/notice.js',
            'category'          => 'glibrary_other_blocks',
            'icon'              => file_get_contents( get_template_directory() . '/template-parts/gblocks/notice/notice.svg' ),
            'keywords'          => array('notice'),
            'post_types'        => array('post','events'),
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
