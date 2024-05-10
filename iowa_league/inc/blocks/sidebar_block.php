<?php
add_action('acf/init', 'my_acf_init_sidebar_block');
function my_acf_init_sidebar_block()
{

    if (function_exists('acf_register_block_type')) {

        // register a research slider block.
        acf_register_block_type(array(
            'name' => 'sidebar',
            'title' => __('Sidebar', 'iowa_league-admin'),
            'description' => __('Sidebar', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/sidebar_block/sidebar/sidebar.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/sidebar_block/sidebar/sidebar.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/sidebar_block/sidebar/sidebar.svg' ),
            'category' => 'glibrary_other_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'jsx' => false
            ),
        ));
        acf_register_block_type(array(
            'name' => 'sidebar_block',
            'title' => __('GBlock: Sidebar BLock', 'iowa_league-admin'),
            'description' => __('GBlock: Sidebar BLock', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/sidebar_block/main-block/sidebar_block.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/sidebar_block/main-block/sidebar_block.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/sidebar_block/main-block/sidebar_block.svg' ),
            'category' => 'glibrary_other_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => true,
                'jsx' => true
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