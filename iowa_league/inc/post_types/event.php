<?php
function event_post_type() {

    $labels = array(
        'name' => __('Events'),
        'singular_name' => 'Event',
        'menu_name' => __('Events', 'iowa_league-admin'),
        'name_admin_bar' => 'events',
        'add_new' => __('Add New Event', 'iowa_league-admin'),
        'add_new_item' => __('Add New Event', 'iowa_league-admin'),
        'new_item' => __('New Event', 'iowa_league-admin'),
        'edit_item' => __('Edit Event', 'iowa_league-admin'),
        'view_item' => __('View Event', 'iowa_league-admin'),
        'all_items' => __('All Events', 'iowa_league-admin'),
        'search_items' => __('Search Events', 'iowa_league-admin'),
        'parent_item_colon' => __('Parent Event:', 'iowa_league-admin'),
        'not_found' => __('No Events found.', 'iowa_league-admin'),
        'not_found_in_trash' => __('No Events found in Trash.', 'iowa_league-admin')
    );

    $args = array(
        'public' => true,
        'labels' => $labels,
        'menu_position' => 33,
        'rewrite' => array('with_front' => false),
        'menu_icon' => 'dashicons-calendar-alt',
        'has_archive' => false,
        'hierarchical' => false,
        'show_in_rest' => true, // Important for Gutenberg
        'taxonomies' => array('workshop_cat','event_type'),
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions', 'author', 'excerpt'),
        'description' => 'Events'
    );

    register_post_type('events', $args);

}

add_action('init', 'event_post_type');


function event_register_taxonomy()
{

    $args = array(
        'label' => __('Workshops Category'),
        'labels' => array(
            'menu_name' => esc_html__('Workshops Category', 'iowa_league-admin'),
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
            'name' => esc_html__('Workshops Categories', 'iowa_league-admin'),
            'singular_name' => esc_html__('Workshops Category', 'iowa_league-admin'),
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'show_in_rest' => true, // Important for Gutenberg
        'has_archive' => true,
        'hierarchical' => true,
        'query_var' => true,
        'sort' => false,
        'rewrite_no_front' => false,
        'rewrite_hierarchical' => false,
        'rewrite' => true,
    );

    $args2 = array(
        'label' => __('Types'),
        'labels' => array(
            'menu_name' => esc_html__('Event Types', 'iowa_league-admin'),
            'all_items' => esc_html__('All Types', 'iowa_league-admin'),
            'edit_item' => esc_html__('Edit Type', 'iowa_league-admin'),
            'view_item' => esc_html__('View Type', 'iowa_league-admin'),
            'update_item' => esc_html__('Update Type', 'iowa_league-admin'),
            'add_new_item' => esc_html__('Add new Type', 'iowa_league-admin'),
            'new_item_name' => esc_html__('New Type', 'iowa_league-admin'),
            'parent_item' => esc_html__('Parent Type', 'iowa_league-admin'),
            'parent_item_colon' => esc_html__('Parent Type:', 'iowa_league-admin'),
            'search_items' => esc_html__('Search Type', 'iowa_league-admin'),
            'popular_items' => esc_html__('Popular Types', 'iowa_league-admin'),
            'separate_items_with_commas' => esc_html__('Separate Types with commas', 'iowa_league-admin'),
            'add_or_remove_items' => esc_html__('Add or remove Type', 'iowa_league-admin'),
            'choose_from_most_used' => esc_html__('Choose most used Type', 'iowa_league-admin'),
            'not_found' => esc_html__('No Types found', 'iowa_league-admin'),
            'name' => esc_html__('Event Types', 'iowa_league-admin'),
            'singular_name' => esc_html__('Event Type', 'iowa_league-admin'),
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'show_in_rest' => true, // Important for Gutenberg
        'has_archive' => true,
        'hierarchical' => true,
        'query_var' => true,
        'sort' => false,
        'rewrite_no_front' => false,
        'rewrite_hierarchical' => false,
        'rewrite' => true,
    );


    register_taxonomy('workshop_cat', array('events'), $args);
    register_taxonomy('event_type', array('events'), $args2);
}

add_action('init', 'event_register_taxonomy', 0);