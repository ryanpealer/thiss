<?php
add_action('acf/init', 'my_acf_init_select_service_category_block');
function my_acf_init_select_service_category_block() {

    if (function_exists('acf_register_block_type')) {
        // register a post slider subblock.
        acf_register_block_type(array(
            'name' => 'select_service_category',
            'title' => __('Select Service Category', 'iowa_league-admin'),
            'description' => __('Select Service Category list', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/select_service_category/style1.php',
            // 'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/select_service_category/style1.js',
            'enqueue_assets' => function(){
                wp_enqueue_script( 'block-select_service_category', get_template_directory_uri() . '/template-parts/gblocks/select_service_category/style1.js', array('jquery'), '0.2', true );
              },
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/select_service_category/style1.svg' ),
            'category' => 'glibrary_other_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => true,
                'anchor' => true,
                'jsx' => true
            ),
            'example'  => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => ['is_example' => true]
                ]
            ]
        ));
        // acf_register_block_type(array(
        //     'name' => 'services_style1',
        //     'title' => __('Services Style 1', 'iowa_league-admin'),
        //     'description' => __('Services block', 'iowa_league-admin'),
        //     'render_template' => 'template-parts/gblocks/services/style1/style1.php',
        //     'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/services/style1/style1.js',
        //     'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/services/style1/style1.svg' ),
        //     'category' => 'glibrary_other_blocks',
        //     'keywords' => array(),
        //     'supports' => array(
        //         'align' => true,
        //         'anchor' => true,
        //         'jsx' => true
        //     ),
        // ));
    }
}