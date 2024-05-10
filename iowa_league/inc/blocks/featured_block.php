<?php
add_action('acf/init', 'my_acf_init_featured');
function my_acf_init_featured() {

    if (function_exists('acf_register_block_type')) {
        // register a post slider block.
        acf_register_block_type(array(
            'name' => 'block_featured',
            'title' => __('GBlock: Featured Section', 'iowa_league-admin'),
            'description' => __('GBlock - Block Featured', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/featured/featured.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/featured/featured.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/featured/featured.svg' ),
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