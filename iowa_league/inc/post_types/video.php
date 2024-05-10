<?php

function videos_post_type() {

    $labels = array(
        'name'               => __('Videos', 'imwca'),
        'singular_name'      => 'videos',
        'menu_name'          => __('Videos', 'imwca-admin'),
        'name_admin_bar'     => __('Videos', 'imwca-admin'),
        'add_new'            => __('Add New Videos', 'imwca-admin'),
        'add_new_item'       => __('Add New Videos', 'imwca-admin'),
        'new_item'           => __('New Videos', 'imwca-admin'),
        'edit_item'          => __('Edit Videos', 'imwca-admin'),
        'view_item'          => __('View Videos', 'imwca-admin'),
        'all_items'          => __('All Videos', 'imwca-admin'),
        'search_items'       => __('Search Videos', 'imwca-admin'),
        'parent_item_colon'  => __('Parent Videos:', 'imwca-admin'),
        'not_found'          => __('No Videos found.', 'imwca-admin'),
        'not_found_in_trash' => __('No Videos found in Trash.', 'imwca-admin')
    );

    $args = array(
        'public'      => true,
        'labels'      => $labels,
        'menu_position' => 35,
        'rewrite' => array('with_front' => false),
        'has_archive' => false,
        'show_in_rest' => true,
        'menu_icon'     => 'dashicons-media-video',
        'supports' => array('title', 'page-attributes', 'revisions','author', 'excerpt', 'thumbnail'),
        'taxonomies' => array('video_cat'),
        'description' => __('Videos', 'imwca-admin')
    );

    register_post_type('videos', $args);
}
add_action('init', 'videos_post_type');


function videos_register_taxonomy() {
    $args = array(
        'label' => __('Video Category', 'imwca'),
        'labels' => array(
            'menu_name' => esc_html__('Video Category', 'imwca-admin'),
            'all_items' => esc_html__('All Categories', 'imwca-admin'),
            'edit_item' => esc_html__('Edit Category', 'imwca-admin'),
            'view_item' => esc_html__('View Category', 'imwca-admin'),
            'update_item' => esc_html__('Update Category', 'imwca-admin'),
            'add_new_item' => esc_html__('Add new Category', 'imwca-admin'),
            'new_item_name' => esc_html__('New Category', 'imwca-admin'),
            'parent_item' => esc_html__('Parent Category', 'imwca-admin'),
            'parent_item_colon' => esc_html__('Parent Category:', 'imwca-admin'),
            'search_items' => esc_html__('Search Category', 'imwca-admin'),
            'popular_items' => esc_html__('Popular Categories', 'imwca-admin'),
            'separate_items_with_commas' => esc_html__('Separate Categories with commas', 'imwca-admin'),
            'add_or_remove_items' => esc_html__('Add or remove Category', 'imwca-admin'),
            'choose_from_most_used' => esc_html__('Choose most used Category', 'imwca-admin'),
            'not_found' => esc_html__('No Categories found', 'imwca-admin'),
            'name' => esc_html__('Video Categories', 'imwca-admin'),
            'singular_name' => esc_html__('Video Categories', 'imwca-admin'),
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

    register_taxonomy('video_cat', array('videos'), $args);
}

add_action('init', 'videos_register_taxonomy', 0);