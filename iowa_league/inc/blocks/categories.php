<?php
/*
 * Add custom category to gutenbergs blocks
 * */

add_filter('block_categories_all', 'glibrary_block_category', 10, 2);
function glibrary_block_category($categories, $post) {
    $welcoop_blocks = array_merge(
        array(
            array(
                'slug' => 'glibrary_hero_blocks',
                'title' => __('Goji Hero Blocks', 'iowa_league-admin'),
            ),
            array(
                'slug' => 'glibrary_carousel_blocks',
                'title' => __('Goji Carousel Blocks', 'iowa_league-admin'),
            ),
            array(
                'slug' => 'glibrary_content_blocks',
                'title' => __('Goji Content Blocks', 'iowa_league'),
            ),              
            array(
                'slug' => 'glibrary_other_blocks',
                'title' => __('Goji Other Blocks', 'iowa_league-admin'),
            ),
            array(
                'slug' => 'glibrary_reports_blocks',
                'title' => __('Goji Reports Blocks', 'iowa_league-admin'),
            ),
            array(
                'slug' => 'glibrary_impact_blocks',
                'title' => __('Goji Impact Blocks', 'iowa_league-admin'),
            ),
            array(
                'slug' => 'glibrary_tools_blocks',
                'title' => __('Goji Tools Blocks', 'iowa_league'),
            ),            
            array(
                'slug' => 'glibrary_timeline_blocks',
                'title' => __('Goji Timeline Blocks', 'iowa_league-admin'),
            )                        
        ),
        $categories
    );

    return $welcoop_blocks;
}