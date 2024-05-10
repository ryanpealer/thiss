<?php
function publication_post_type() {

    $labels = array(
        'name' => __('Publications'),
        'singular_name' => 'Publication',
        'menu_name' => __('Publications', 'iowa_league-admin'),
        'name_admin_bar' => 'publications',
        'add_new' => __('Add New Publication', 'iowa_league-admin'),
        'add_new_item' => __('Add New Publication', 'iowa_league-admin'),
        'new_item' => __('New Publication', 'iowa_league-admin'),
        'edit_item' => __('Edit Publication', 'iowa_league-admin'),
        'view_item' => __('View Publication', 'iowa_league-admin'),
        'all_items' => __('All Publications', 'iowa_league-admin'),
        'search_items' => __('Search Publications', 'iowa_league-admin'),
        'parent_item_colon' => __('Parent Publication:', 'iowa_league-admin'),
        'not_found' => __('No Publications found.', 'iowa_league-admin'),
        'not_found_in_trash' => __('No Publications found in Trash.', 'iowa_league-admin')
    );

    $args = array(
        'public' => true,
        'labels' => $labels,
        'menu_position' => 36,
        'rewrite' => array('with_front' => false),
        'menu_icon' => 'dashicons-book-alt',
        'has_archive' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions', 'author', 'excerpt'),
        'description' => 'Publications'
    );

    register_post_type('publications', $args);

}

add_action('init', 'publication_post_type');