<?php
add_action('acf/init', 'my_acf_init_es_block');
function my_acf_init_es_block() {

    if (function_exists('acf_register_block_type')) {
        // register a endorsement slider subblock.
        acf_register_block_type(array(
            'name' => 'endorsement_slider',
            'title' => __('Endorsement Slider', 'iowa_league-admin'),
            'description' => __('Endorsement Slider list', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/endorsement/endorsement_slider/slider.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/endorsement/endorsement_slider/slider.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/endorsement/endorsement_slider/slider.svg' ),
            'category' => 'glibrary_carousel_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
        ));

        // register a endorsement slider block.
        acf_register_block_type(array(
            'name' => 'es_style1',
            'title' => __('Endorsement Block', 'iowa_league-admin'),
            'description' => __('GBlock - Endorsement Block', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/endorsement/style1/style1.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/endorsement/style1/style1.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/endorsement/style1/style1.svg' ),
            'category' => 'glibrary_carousel_blocks',
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