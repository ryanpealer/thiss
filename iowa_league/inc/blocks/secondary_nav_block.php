<?php

add_action('acf/init', 'my_acf_init_nav_block');
function my_acf_init_nav_block() {

    if( function_exists('acf_register_block_type') ) {

        //timeline

        acf_register_block_type(array(
            'name'              => 'secondary_nav',
            'title'             => __('Secondary Navigation', 'iowa_league-admin'),
            'description'       => __('Secondary Navigation to change "Choose your journey"', 'iowa_league-admin'),
            'render_template'   => 'template-parts/gblocks/secondary_nav/style1/style1.php',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/gblocks/secondary_nav/style1/style1.js',
            'category' => 'glibrary_other_blocks',
            'icon'              => file_get_contents( get_template_directory() . '/template-parts/gblocks/secondary_nav/style1/style1.svg' ),
            'keywords'          => array(),
            'post_types' => array('page'),
            'supports'          => array(
                'align' => true
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