<?php

add_action('acf/init', 'my_acf_init_sidebar_block_widget');
function my_acf_init_sidebar_block_widget() {

    if( function_exists('acf_register_block_type') ) {

        //sidebar_block_widget

        acf_register_block_type(array(
            'name'              => 'gblock_sidebar_block_widget',
            'title'             => __('GBlock: Sidebar Block Widget', 'iowa_league-admin'),
            'description'       => __('GBlock - Content block + Widget area', 'iowa_league-admin'),
            'render_template'   => 'template-parts/gblocks/sidebar_block_widget/sidebar_block_widget.php',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/gblocks/sidebar_block_widget/sidebar_block_widget.js',
            'category' => 'glibrary_content_blocks',
            'icon'              => file_get_contents( get_template_directory() . '/template-parts/gblocks/sidebar_block_widget/sidebar_block_widget.svg' ),
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