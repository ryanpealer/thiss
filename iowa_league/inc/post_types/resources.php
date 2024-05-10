<?php
function resources_post_type() {

    $labels = array(
        'name' => __('Resources', 'iowa_league-admin'),
        'singular_name' => 'Resources',
        'menu_name' => __('Resources', 'iowa_league-admin'),
        'name_admin_bar' => 'resources',
        'add_new' => __('Add New Resource', 'iowa_league-admin'),
        'add_new_item' => __('Add New Resource', 'iowa_league-admin'),
        'new_item' => __('New Resource', 'iowa_league-admin'),
        'edit_item' => __('Edit Resource', 'iowa_league-admin'),
        'view_item' => __('View Resource', 'iowa_league-admin'),
        'all_items' => __('All Resources', 'iowa_league-admin'),
        'search_items' => __('Search Resources', 'iowa_league-admin'),
        'parent_item_colon' => __('Parent Resource:', 'iowa_league-admin'),
        'not_found' => __('No Resources found.', 'iowa_league-admin'),
        'not_found_in_trash' => __('No Resources found in Trash.', 'iowa_league-admin')
    );

    $args = array(
        'public' => true,
        'labels' => $labels,
        'menu_position' => 37,
        'rewrite' => array('with_front' => false),
        'menu_icon' => 'dashicons-open-folder',
        'has_archive' => true,
        'show_in_rest' => true,
        'taxonomies' => array('resources_tax'),
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions', 'author','excerpt', 'custom-fields'),
        'description' => __('Resources Index', 'iowa_league-admin')
    );

    register_post_type('resource', $args);
}

add_action('init', 'resources_post_type');




function resources_register_taxonomy()
{

    $args = array(
        'label' => __('Resources Categories'),
        'labels' => array(
            'menu_name' => esc_html__('Resources Categories', 'iowa_league-admin'),
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
            'name' => esc_html__('Resources Categories', 'iowa_league-admin'),
            'singular_name' => esc_html__('Resources Category', 'iowa_league-admin'),
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'query_var' => true,
        'sort' => false,
        'rewrite_no_front' => false,
        'rewrite_hierarchical' => false,
        'rewrite' => true,
    );

    register_taxonomy('resources_tax', array('resources'), $args);
}

add_action('init', 'resources_register_taxonomy', 0);


// add_action( 'init', 'prefix_unregister_tax', 99 );
// function prefix_unregister_tax(){
// 	unregister_taxonomy_for_object_type( 'resources_tax', 'post' );
// }

