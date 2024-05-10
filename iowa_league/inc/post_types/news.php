<?php

function news_post_type() {

    $labels = array(
        'name'               => __('News List', 'iowa_league-admin'),
        'singular_name'      => 'News List',
        'menu_name'          => __('News List', 'iowa_league-admin'),
        'name_admin_bar'     => __('News List', 'iowa_league-admin'),
        'add_new'            => __('Add New News', 'iowa_league-admin'),
        'add_new_item'       => __('Add New News', 'iowa_league-admin'),
        'new_item'           => __('New News', 'iowa_league-admin'),
        'edit_item'          => __('Edit News', 'iowa_league-admin'),
        'view_item'          => __('View News', 'iowa_league-admin'),
        'all_items'          => __('All News', 'iowa_league-admin'),
        'search_items'       => __('Search News', 'iowa_league-admin'),
        'parent_item_colon'  => __('Parent News:', 'iowa_league-admin'),
        'not_found'          => __('No News found.', 'iowa_league-admin'),
        'not_found_in_trash' => __('No News found in Trash.', 'iowa_league-admin')
    );

    $args = array(
        'public'      => true,
        'labels'      => $labels,
        'menu_position' => 34,
        'rewrite' => array('with_front' => false),
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon'     => 'dashicons-text-page',
        'supports' => array('title', 'editor', 'page-attributes', 'revisions','author', 'excerpt', 'thumbnail'),
        'taxonomies' => array('news_cat'),
        'description' => __('News List', 'iowa_league-admin')
    );

    register_post_type('news_list', $args);
}
add_action('init', 'news_post_type');


function news_register_taxonomy() {
    $args = array(
        'label' => __('Category', 'iowa_league-admin'),
        'labels' => array(
            'menu_name' => esc_html__('Category', 'iowa_league-admin'),
            'all_items' => esc_html__('All Categories', 'iowa_league-admin'),
            'edit_item' => esc_html__('Edit Category', 'iowa_league-admin'),
            'view_item' => esc_html__('View Category', 'iowa_league-admin'),
            'update_item' => esc_html__('Update Category', 'iowa_league-admin'),
            'add_new_item' => esc_html__('Add new Category', 'iowa_league-admin'),
            'new_item_name' => esc_html__('New Category', 'iowa_league-admin'),
            'parent_item' => esc_html__('Parent Category', 'iowa_league-admin'),
            'parent_item_colon' => esc_html__('Parent Category:', 'iowa_league-admin'),
            'search_items' => esc_html__('Search Category', 'iowa_league-admin'),
            'popular_items' => esc_html__('Popular Categories', 'iowa_league-admin'),
            'separate_items_with_commas' => esc_html__('Separate Categories with commas', 'iowa_league-admin'),
            'add_or_remove_items' => esc_html__('Add or remove Category', 'iowa_league-admin'),
            'choose_from_most_used' => esc_html__('Choose most used Category', 'iowa_league-admin'),
            'not_found' => esc_html__('No Categories found', 'iowa_league-admin'),
            'name' => esc_html__('Categories', 'iowa_league-admin'),
            'singular_name' => esc_html__('Categories', 'iowa_league-admin'),
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'show_tagcloud' => false,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'show_in_rest' => false,
        'has_archive' => false,
        'hierarchical' => true,
        'query_var' => true,
        'sort' => false,
        'rewrite_no_front' => false,
        'rewrite_hierarchical' => false,
        'rewrite' => true,
    );

    register_taxonomy('news_cat', array('news'), $args);
}

add_action('init', 'news_register_taxonomy', 0);
