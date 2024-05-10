<?php

add_action('acf/init', 'my_acf_init_impact_block');
function my_acf_init_impact_block() {

    if( function_exists('acf_register_block_type') ) {

        //reports

        acf_register_block_type(array(
            'name'              => 'impact_listing',
            'title'             => __('Impact Listing', 'iowa_league-admin'),
            'description'       => __('GBlock - Impact Listing', 'iowa_league-admin'),
            'render_template'   => 'template-parts/gblocks/impact/listing/listing.php',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/gblocks/impact/listing/listing.js',
            'category'          => 'glibrary_content_blocks',
            'icon'              => file_get_contents( get_template_directory() . '/template-parts/gblocks/impact/listing/listing.svg' ),
            'keywords'          => array('impact'),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'jsx' => false
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'gblock_impact',
            'title'             => __('Impact Section', 'iowa_league-admin'),
            'description'       => __('Spacer, 3 cards with counters, spacer. Also could be added some headers, paragraphs, buttons above and/or below cards', 'iowa_league-admin'),
            'render_template'   => 'template-parts/gblocks/impact/block/block.php',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/gblocks/impact/block/block.js',
            'category'          => 'glibrary_content_blocks',
            'icon'              => file_get_contents( get_template_directory() . '/template-parts/gblocks/impact/block/block.svg' ),
            'keywords'          => array('impact'),
            'supports'          => array(
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
    };
}