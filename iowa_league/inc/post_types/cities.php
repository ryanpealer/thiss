<?php
function cities_post_type() {

    $labels = array(
        'name' => __('Cities', 'iowa_league-admin'),
        'singular_name' => 'Cities',
        'menu_name' => __('Cities', 'iowa_league-admin'),
        'name_admin_bar' => 'cities',
        'add_new' => __('Add New City', 'iowa_league-admin'),
        'add_new_item' => __('Add New City', 'iowa_league-admin'),
        'new_item' => __('New City', 'iowa_league-admin'),
        'edit_item' => __('Edit City', 'iowa_league-admin'),
        'view_item' => __('View City', 'iowa_league-admin'),
        'all_items' => __('All Cities', 'iowa_league-admin'),
        'search_items' => __('Search Cities', 'iowa_league-admin'),
        'parent_item_colon' => __('Parent City:', 'iowa_league-admin'),
        'not_found' => __('No Cities found.', 'iowa_league-admin'),
        'not_found_in_trash' => __('No Cities found in Trash.', 'iowa_league-admin')
    );

    $args = array(
        'public' => true,
        'labels' => $labels,
        'menu_position' => 31,
        'rewrite' => array('with_front' => false),
        'menu_icon' => 'dashicons-building',
        'has_archive' => true,
        'show_in_rest' => true,
        // 'taxonomies' => array('post_tag'),
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions', 'author','excerpt', 'custom-fields'),
        'description' => __('Cities Index', 'iowa_league-admin')
    );

    register_post_type('cities', $args);
}

add_action('init', 'cities_post_type');

function cities_register_taxonomy()
{

    $args = array(
        'label' => __('Cities Categories'),
        'labels' => array(
            'menu_name' => esc_html__('Cities Categories', 'iowa_league-admin'),
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
            'name' => esc_html__('Departments', 'iowa_league-admin'),
            'singular_name' => esc_html__('Cities Categories', 'iowa_league-admin'),
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

    register_taxonomy('cities_tax', array('cities'), $args);
}

{
    // Add new taxonomy, NOT hierarchical (like tags)
    // $labels = array(
    //   'name' => _x( 'Cities Tags', 'taxonomy general name' ),
    //   'singular_name' => _x( 'Cities Tag', 'taxonomy singular name' ),
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
  
    // register_taxonomy('tag',array('cities'),array(
    //   'hierarchical' => false,
    //   'labels' => $labels,
    //   'show_ui' => true,
    //   'update_count_callback' => '_update_post_term_count',
    //   'query_var' => true,
    //   'rewrite' => array( 'slug' => 'tag' ),
    // ));
  }

//add_action('init', 'cities_register_taxonomy', 0);

