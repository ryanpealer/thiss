<?php
add_action('acf/init', 'my_acf_init_mc_block');
function my_acf_init_mc_block() {

    if (function_exists('acf_register_block_type')) {
        // register a post slider subblock.
        acf_register_block_type(array(
            'name' => 'mc_listing',
            'title' => __('Multi Column Listing', 'iowa_league-admin'),
            'description' => __('Multi Column Listing', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/multi_column/listing/listing.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/multi_column/listing/listing.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/multi_column/listing/listing.svg' ),
            'category' => 'glibrary_other_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
            'example'  => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => ['is_example' => true]
                ]
            ]
        ));
        
        acf_register_block_type(array(
            'name' => 'mc_listing2',
            'title' => __('Multi Column Listing 2', 'iowa_league-admin'),
            'description' => __('Multi Column Listing 2', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/multi_column/listing2/listing.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/multi_column/listing2/listing.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/multi_column/listing2/listing.svg' ),
            'category' => 'glibrary_other_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
            'example'  => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => ['is_example' => true]
                ]
            ]
        ));

        // register a post slider block.
        acf_register_block_type(array(
            'name' => 'mc_style1',
            'title' => __('Multi Column Style 1', 'iowa_league-admin'),
            'description' => __('GBlock - Multi Column', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/multi_column/style1/style1.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/multi_column/style1/style1.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/multi_column/style1/style1.svg' ),
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
        
        
        // register a post slider block.
        acf_register_block_type(array(
            'name' => 'mc_style2',
            'title' => __('Multi Column Style 2', 'iowa_league-admin'),
            'description' => __('GBlock - Multi Column', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/multi_column/style2/style2.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/multi_column/style2/style2.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/multi_column/style2/style2.svg' ),
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