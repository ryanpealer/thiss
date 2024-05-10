<?php

function office_post_type() {

    $labels = array(
        'name'               => __('Office', 'iowa_league-admin'),
        'singular_name'      => 'office',
        'menu_name'          => __('Office', 'iowa_league-admin'),
        'name_admin_bar'     => __('Office', 'iowa_league-admin'),
        'add_new'            => __('Add New Office', 'iowa_league-admin'),
        'add_new_item'       => __('Add New Office', 'iowa_league-admin'),
        'new_item'           => __('New Office', 'iowa_league-admin'),
        'edit_item'          => __('Edit Office', 'iowa_league-admin'),
        'view_item'          => __('View Office', 'iowa_league-admin'),
        'all_items'          => __('All Office', 'iowa_league-admin'),
        'search_items'       => __('Search Office', 'iowa_league-admin'),
        'parent_item_colon'  => __('Parent Office:', 'iowa_league-admin'),
        'not_found'          => __('No Office found.', 'iowa_league-admin'),
        'not_found_in_trash' => __('No Office found in Trash.', 'iowa_league-admin')
    );

    $args = array(
        'public'      => true,
        'labels'      => $labels,
        'menu_position' => 35,
        'rewrite' => array('with_front' => false),
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon'     => 'dashicons-location-alt',
        'supports' => array('title', 'editor','thumbnail', 'page-attributes', 'revisions','author'),
        'taxonomies' => array('district'),
        'description' => __('Office', 'iowa_league-admin')
    );

    register_post_type('office', $args);
}
add_action('init', 'office_post_type');


function office_register_taxonomy() {
    $args = array(
        'label' => __('District', 'iowa_league-admin'),
        'labels' => array(
            'menu_name' => esc_html__('District', 'iowa_league-admin'),
            'all_items' => esc_html__('All Districts', 'iowa_league-admin'),
            'edit_item' => esc_html__('Edit District', 'iowa_league-admin'),
            'view_item' => esc_html__('View District', 'iowa_league-admin'),
            'update_item' => esc_html__('Update District', 'iowa_league-admin'),
            'add_new_item' => esc_html__('Add new District', 'iowa_league-admin'),
            'new_item_name' => esc_html__('New District', 'iowa_league-admin'),
            'parent_item' => esc_html__('Parent District', 'iowa_league-admin'),
            'parent_item_colon' => esc_html__('Parent District:', 'iowa_league-admin'),
            'search_items' => esc_html__('Search District', 'iowa_league-admin'),
            'popular_items' => esc_html__('Popular Districts', 'iowa_league-admin'),
            'separate_items_with_commas' => esc_html__('Separate Districts with commas', 'iowa_league-admin'),
            'add_or_remove_items' => esc_html__('Add or remove District', 'iowa_league-admin'),
            'choose_from_most_used' => esc_html__('Choose most used District', 'iowa_league-admin'),
            'not_found' => esc_html__('No Districts found', 'iowa_league-admin'),
            'name' => esc_html__('Districts', 'iowa_league-admin'),
            'singular_name' => esc_html__('Districts', 'iowa_league-admin'),
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'show_in_rest' => false,
        'has_archive' => true,
        'hierarchical' => true,
        'query_var' => true,
        'sort' => false,
        'rewrite_no_front' => false,
        'rewrite_hierarchical' => false,
        'rewrite' => true,
    );

    register_taxonomy('district', array('office'), $args);
}

add_action('init', 'office_register_taxonomy', 0);