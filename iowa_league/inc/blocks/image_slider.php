<?php
add_action('acf/init', 'my_acf_init_image_slider_block');
function my_acf_init_image_slider_block()
{

    if (function_exists('acf_register_block_type')) {
        // register a research slider subblock.
        acf_register_block_type(array(
            'name' => 'image_slider',
            'title' => __('Image Slider', 'iowa_league-admin'),
            'description' => __('Image Slider List', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/image_slider/image_slider/image_slider.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/image_slider/image_slider/image_slider.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/image_slider/image_slider/image_slider.svg' ),
            'category' => 'glibrary_other_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
        ));

        // register a research slider block.
        acf_register_block_type(array(
            'name' => 'image_slider_style1',
            'title' => __('Image Slider Block', 'iowa_league-admin'),
            'description' => __('GBlock - Image Slider Block', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/image_slider/style1/style1.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/image_slider/style1/style1.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/image_slider/style1/style1.svg' ),
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