<?php
function classified_post_type() {

    $labels = array(
        'name' => __('Classified List'),
        'singular_name' => 'Classified',
        'menu_name' => __('Classifieds', 'iowa_league-admin'),
        'name_admin_bar' => 'classified',
        'add_new' => __('Add New Classified', 'iowa_league-admin'),
        'add_new_item' => __('Add New Classified', 'iowa_league-admin'),
        'new_item' => __('New Classified', 'iowa_league-admin'),
        'edit_item' => __('Edit Classified', 'iowa_league-admin'),
        'view_item' => __('View Classified', 'iowa_league-admin'),
        'all_items' => __('All Classified List', 'iowa_league-admin'),
        'search_items' => __('Search Classified', 'iowa_league-admin'),
        'parent_item_colon' => __('Parent Classified:', 'iowa_league-admin'),
        'not_found' => __('No Classified found.', 'iowa_league-admin'),
        'not_found_in_trash' => __('No Classified found in Trash.', 'iowa_league-admin')
    );

    $args = array(
        'public' => true,
        'labels' => $labels,
        'menu_position' => 32,
        'rewrite' => array('with_front' => false),
        'menu_icon' => 'dashicons-editor-table',
        'has_archive' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions', 'author', 'excerpt'),
        'description' => 'Classified List',
        'exclude_from_search' => true,
    );

    register_post_type('classified_list', $args);

}

add_action('init', 'classified_post_type');


/* make CPT posts in admin order by date */
/* Sort posts in wp_list_table by column in ascending or descending order. */
function custom_post_order($query){
    if ($query->get('post_type') == 'classified_list') {

        if ($query->get('orderby') == 'menu_order title' && $query->get('order') == 'asc')  {
            $query->set('orderby', 'date');
            $query->set('order', 'desc');
        }
        // var_dump($query->get('order'));die;
       
    }
}
if(is_admin()){
    add_action('pre_get_posts', 'custom_post_order');
}