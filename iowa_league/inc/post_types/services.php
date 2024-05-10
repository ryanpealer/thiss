<?php
function services_post_type() {

    $labels = array(
        'name' => __('Services', 'iowa_league-admin'),
        'singular_name' => 'Services',
        'menu_name' => __('Services', 'iowa_league-admin'),
        'name_admin_bar' => 'services',
        'add_new' => __('Add New Service', 'iowa_league-admin'),
        'add_new_item' => __('Add New Service', 'iowa_league-admin'),
        'new_item' => __('New Service', 'iowa_league-admin'),
        'edit_item' => __('Edit Service', 'iowa_league-admin'),
        'view_item' => __('View Service', 'iowa_league-admin'),
        'all_items' => __('All Services', 'iowa_league-admin'),
        'search_items' => __('Search Services', 'iowa_league-admin'),
        'parent_item_colon' => __('Parent Service:', 'iowa_league-admin'),
        'not_found' => __('No Services found.', 'iowa_league-admin'),
        'not_found_in_trash' => __('No Services found in Trash.', 'iowa_league-admin')
    );

    $args = array(
        'public' => true,
        'labels' => $labels,
        'menu_position' => 38,
        'rewrite' => array('with_front' => false),
        'menu_icon' => 'dashicons-admin-generic',
        'has_archive' => true,
        'show_in_rest' => true,
        'taxonomies' => array('services_tax'),
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions', 'author','excerpt', 'custom-fields'),
        'description' => __('Services Index', 'iowa_league-admin')
    );

    register_post_type('services', $args);
}

add_action('init', 'services_post_type');




function services_register_taxonomy()
{

    $args = array(
        'label' => __('Services Categories'),
        'labels' => array(
            'menu_name' => esc_html__('Services Categories', 'iowa_league-admin'),
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
            'name' => esc_html__('Services Categories', 'iowa_league-admin'),
            'singular_name' => esc_html__('Services Category', 'iowa_league-admin'),
        ),
        'public' => true,
        'show_in_rest' => true,
        'show_ui' => true,
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
        'rewrite_hierarchical' => false,
        'rewrite' => true,
    );

    register_taxonomy('services_tax', array('services'), $args);
}

// {
    // Add new taxonomy, NOT hierarchical (like tags)
    // $labels = array(
    //   'name' => _x( 'Services Tags', 'taxonomy general name' ),
    //   'singular_name' => _x( 'Services Tag', 'taxonomy singular name' ),
    //   'search_items' =>  __( 'Search Tags' ),
    //   'popular_items' => __( 'Popular Tags' ),
    //   'all_items' => __( 'All Tags' ),
    //   'parent_item' => null,
    //   'parent_item_colon' => null,
    //   'edit_item' => __( 'Edit Tag' ), 
    //   'update_item' => __( 'Update Tag' ),
    //   'add_new_item' => __( 'Add New Tag' ),
    //   'new_item_name' => __( 'New Tag Name' ),
    //   'separate_items_with_commas' => __( 'Separate tags with commas' ),
    //   'add_or_remove_items' => __( 'Add or remove tags' ),
    //   'choose_from_most_used' => __( 'Choose from the most used tags' ),
    //   'menu_name' => __( 'Tags' ),
    // ); 
  
    // register_taxonomy('tag',array('services'),array(
    //   'hierarchical' => false,
    //   'labels' => $labels,
    //   'show_ui' => true,
    //   'update_count_callback' => '_update_post_term_count',
    //   'query_var' => true,
    //   'rewrite' => array( 'slug' => 'tag' ),
    // ));
//   }

add_action('init', 'services_register_taxonomy', 0);

