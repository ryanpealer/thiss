<?php
add_action('acf/init', 'my_acf_init_ps_block');
function my_acf_init_ps_block() {

    if (function_exists('acf_register_block_type')) {
        // register a post slider subblock.
        acf_register_block_type(array(
            'name' => 'post_slider',
            'title' => __('Post Slider', 'iowa_league-admin'),
            'description' => __('Post Slider list', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/post_slider/post_slider/slider.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/post_slider/post_slider/slider.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/post_slider/post_slider/slider.svg' ),
            'category' => 'glibrary_carousel_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
        ));

        // register a post slider block.
        acf_register_block_type(array(
            'name' => 'ps_style1',
            'title' => __('Post Carousel Cards', 'iowa_league-admin'),
            'description' => __('GBlock - Post Carousel Cards 1-4', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/post_slider/style1/style1.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/post_slider/style1/style1.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/post_slider/style1/style1.svg' ),
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