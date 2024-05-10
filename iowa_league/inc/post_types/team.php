<?php
function team_post_type() {

    $labels = array(
        'name' => __('Team', 'iowa_league-admin'),
        'singular_name' => 'Team',
        'menu_name' => __('Team', 'iowa_league-admin'),
        'name_admin_bar' => 'team',
        'add_new' => __('Add New Team Member', 'iowa_league-admin'),
        'add_new_item' => __('Add New Team Member', 'iowa_league-admin'),
        'new_item' => __('New Team Member', 'iowa_league-admin'),
        'edit_item' => __('Edit Team Member', 'iowa_league-admin'),
        'view_item' => __('View Team Member', 'iowa_league-admin'),
        'all_items' => __('All Team Members', 'iowa_league-admin'),
        'search_items' => __('Search Team Members', 'iowa_league-admin'),
        'parent_item_colon' => __('Parent Team Member:', 'iowa_league-admin'),
        'not_found' => __('No Team Members found.', 'iowa_league-admin'),
        'not_found_in_trash' => __('No Team Members found in Trash.', 'iowa_league-admin')
    );

    $args = array(
        'public' => true,
        'labels' => $labels,
        'menu_position' => 37,
        'rewrite' => array('with_front' => false),
        'menu_icon' => 'dashicons-groups',
        'has_archive' => true,
        'show_in_rest' => true,
        'taxonomies' => array('team_departments'),
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions', 'author','excerpt', ),
        'description' => __('Team Members', 'iowa_league-admin')
    );

    register_post_type('team', $args);
}

add_action('init', 'team_post_type');

function team_register_taxonomy()
{

    $args = array(
        'label' => __('Team Departments'),
        'labels' => array(
            'menu_name' => esc_html__('Team Departments', 'iowa_league-admin'),
            'all_items' => esc_html__('All Departments', 'iowa_league-admin'),
            'edit_item' => esc_html__('Edit Department', 'iowa_league-admin'),
            'view_item' => esc_html__('View Department', 'iowa_league-admin'),
            'update_item' => esc_html__('Update Department', 'iowa_league-admin'),
            'add_new_item' => esc_html__('Add new Department', 'iowa_league-admin'),
            'new_item_name' => esc_html__('New Department', 'iowa_league-admin'),
            'parent_item' => esc_html__('Parent Department', 'iowa_league-admin'),
            'parent_item_colon' => esc_html__('Parent Department:', 'iowa_league-admin'),
            'search_items' => esc_html__('Search Department', 'iowa_league-admin'),
            'popular_items' => esc_html__('Popular Departments', 'iowa_league-admin'),
            'separate_items_with_commas' => esc_html__('Separate Departments with commas', 'iowa_league-admin'),
            'add_or_remove_items' => esc_html__('Add or remove Department', 'iowa_league-admin'),
            'choose_from_most_used' => esc_html__('Choose most used Department', 'iowa_league-admin'),
            'not_found' => esc_html__('No Departments found', 'iowa_league-admin'),
            'name' => esc_html__('Departments', 'iowa_league-admin'),
            'singular_name' => esc_html__('Team Departments', 'iowa_league-admin'),
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'query_var' => true,
        'sort' => false,
        'rewrite_no_front' => false,
        'rewrite_hierarchical' => true,
        'rewrite' => true,
    );

    register_taxonomy('team_departments', array('team'), $args);
}

add_action('init', 'team_register_taxonomy', 0);