<?php
add_action('acf/init', 'my_acf_init_hero_block');
function my_acf_init_hero_block(){

    if (function_exists('acf_register_block_type')) {

        // register a hero banner block.
        acf_register_block_type(array(
            'name' => 'hb_style1',
            'title' => __('Fullwidth single image', 'iowa_league-admin'),
            'description' => __('GBlock - Hero Fullwidth image + CTA', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/hero/style1/style1.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/hero/style1/style1.js',
            'icon' => file_get_contents(get_template_directory() . '/template-parts/gblocks/hero/style1/style1.svg'),
            'category' => 'glibrary_hero_blocks',
            'keywords' => array(),
            'align' => 'full',
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
        // register a hero banner block.
        acf_register_block_type(array(
            'name' => 'hb_style2',
            'title' => __('Hero image + Content', 'iowa_league-admin'),
            'description' => __('GBlock - Hero image + Content', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/hero/style2/style2.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/hero/style2/style2.js',
            'icon' => file_get_contents(get_template_directory() . '/template-parts/gblocks/hero/style2/style2.svg'),
            'category' => 'glibrary_hero_blocks',
            'keywords' => array(),
            'align' => 'full',
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