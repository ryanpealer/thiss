<?php

add_action('acf/init', 'my_acf_init_spacer_block');
function my_acf_init_spacer_block() {

    if( function_exists('acf_register_block_type') ) {

        //reports

        acf_register_block_type(array(
            'name'              => 'gblock_spacer',
            'title'             => __('GBlock: Spacer', 'iowa_league'),
            'description'       => __('GBlock - Spacer', 'iowa_league'),
            'render_template'   => 'template-parts/gblocks/tools/spacer/gblock_spacer.php',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/gblocks/tools/spacer/gblock_spacer.js',
            'category' => 'glibrary_tools_blocks',
            'icon'              => file_get_contents( get_template_directory() . '/template-parts/gblocks/tools/spacer/gblock_spacer.svg' ),
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