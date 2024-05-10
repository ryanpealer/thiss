<?php
/**
 * Register widgetized areas.
 *
 */
function widgetized_area_init() {

    register_sidebar( array(
        'name'          => __('Header top right','iowa_league-admin'),
        'id'            => 'header_top',
        'before_widget' => '<div id="%1$s" class=" %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="sidebar-widget--title">',
        'after_title'   => '</div><div class="sidebar-widget--content">',
    ) );    

    register_sidebar( array(
        'name'          => __('Sidebar Type #1','iowa_league-admin'),
        'id'            => 'type1',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="sidebar-widget--title">',
        'after_title'   => '</div><div class="sidebar-widget--content">',
    ) );    
    register_sidebar( array(
        'name'          => __('Sidebar Type #2','iowa_league-admin'),
        'id'            => 'type2',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="sidebar-widget--title">',
        'after_title'   => '</div><div class="sidebar-widget--content">',
    ) );
    register_sidebar( array(
        'name'          => __('Sidebar Type #3','iowa_league-admin'),
        'id'            => 'type3',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="sidebar-widget--title">',
        'after_title'   => '</div><div class="sidebar-widget--content">',
    ) );
    register_sidebar( array(
        'name'          => __('Footer Info Box','iowa_league-admin'),
        'id'            => 'footer_info',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="h3">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => __('Footer Top','iowa_league-admin'),
        'id'            => 'footer_top',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="h3">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => __('Footer Middle (Column 1)','iowa_league-admin'),
        'id'            => 'footer_middle_col1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="h3">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => __('Footer Middle (Column 2)','iowa_league-admin'),
        'id'            => 'footer_middle_col2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="h3">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => __('Footer Middle (Column 3)','iowa_league-admin'),
        'id'            => 'footer_middle_col3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="h3">',
        'after_title'   => '</div>',
    ) );    
    register_sidebar( array(
        'name'          => __('Footer Middle (Column 4)','iowa_league-admin'),
        'id'            => 'footer_middle_col4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="h3">',
        'after_title'   => '</div>',
    ) );        
    register_sidebar( array(
        'name'          => __('Footer Bottom','glibrary--admin'),
        'id'            => 'footer_bottom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="h3">',
        'after_title'   => '</div>',
    ) );

}
add_action( 'widgets_init', 'widgetized_area_init' );
?>