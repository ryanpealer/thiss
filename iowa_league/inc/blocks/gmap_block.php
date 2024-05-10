<?php
add_action('acf/init', 'my_acf_init_map_block');
function my_acf_init_map_block()
{

    if (function_exists('acf_register_block_type')) {
        // register a research slider subblock.
        acf_register_block_type(array(
            'name' => 'gmap',
            'title' => __('Map', 'iowa_league-admin'),
            'description' => __('Map', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/gmap/listing/listing.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/gmap/listing/listing.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/gmap/listing/listing.svg' ),
            'enqueue_assets' => function(){
                wp_enqueue_script('gmap', 'https://maps.googleapis.com/maps/api/js?key=&libraries=places&language=en', array( 'jquery'), time(), true);
            },
            'category' => 'glibrary_other_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
        ));

        // register a research slider block.
        acf_register_block_type(array(
            'name' => 'gmap_style1',
            'title' => __('Gmap Style 1', 'iowa_league-admin'),
            'description' => __('GBlock - Google Map', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/gmap/style1/style1.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/gmap/style1/style1.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/gmap/style1/style1.svg' ),
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