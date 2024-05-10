<?php
add_action('acf/init', 'my_acf_init_section_heading');
function my_acf_init_section_heading() {

    if (function_exists('acf_register_block_type')) {
        // register a post slider block.
        acf_register_block_type(array(
            'name' => 'block_heading',
            'title' => __('Block Heading', 'iowa_league-admin'),
            'description' => __('GBlock - Block Heading', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/section_heading/style1.php',
            // 'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/section_heading/style1.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/section_heading/style1.svg' ),
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