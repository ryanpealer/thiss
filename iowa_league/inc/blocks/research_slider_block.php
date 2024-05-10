<?php
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types()
{

    if (function_exists('acf_register_block_type')) {
// register a research slider subblock.
        acf_register_block_type(array(
            'name' => 'research_slider',
            'title' => __('Research Slider', 'iowa_league-admin'),
            'description' => __('Research Slider List', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/research/slider/slider.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/research/slider/slider.js',
            'icon' => file_get_contents(get_template_directory() . '/template-parts/gblocks/research/slider/slider.svg'),
            'category' => 'glibrary_carousel_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
        ));

// register a research slider block.
        acf_register_block_type(array(
            'name' => 'rs_style1',
            'title' => __('Research Block Style 1', 'iowa_league-admin'),
            'description' => __('GBlock - Research Block', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/research/style1/style1.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/research/style1/style1.js',
            'icon' => file_get_contents(get_template_directory() . '/template-parts/gblocks/research/style1/style1.svg'),
            'category' => 'glibrary_carousel_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
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