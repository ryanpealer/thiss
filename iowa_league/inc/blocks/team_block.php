<?php
add_action('acf/init', 'my_acf_init_team_block');
function my_acf_init_team_block()
{

    if (function_exists('acf_register_block_type')) {
        // register a research slider subblock.
        acf_register_block_type(array(
            'name' => 'team_listing',
            'title' => __('Team Listing', 'iowa_league-admin'),
            'description' => __('Team List', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/team/listing/listing.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/team/listing/listing.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/team/listing/listing.svg' ),
            'category' => 'glibrary_other_blocks',
            'post_types' => array('page'),
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
        ));

        // register a research slider block.
        acf_register_block_type(array(
            'name' => 'team_style1',
            'title' => __('Team Block Style 1', 'iowa_league-admin'),
            'description' => __('GBlock - Team Block', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/team/style1/style1.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/team/style1/style1.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/team/style1/style1.svg' ),
            'category' => 'glibrary_other_blocks',
            'keywords' => array(),
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