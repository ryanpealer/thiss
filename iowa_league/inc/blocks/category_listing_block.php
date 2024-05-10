<?php
add_action('acf/init', 'my_acf_init_category_listing_block');
function my_acf_init_category_listing_block() {

    if (function_exists('acf_register_block_type')) {

        // register a post slider block.
        acf_register_block_type(array(
            'name' => 'category_listing_block',
            'title' => __('Category Listing block', 'iowa_league-admin'),
            'description' => __('GBlock - Category Listing', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/category_listing/category_listing.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/category_listing/category_listing.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/category_listing/category_listing.svg' ),
            'category' => 'glibrary_other_blocks',
            'keywords' => array('category_listing'),
            'post_types' => array('page'),
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
