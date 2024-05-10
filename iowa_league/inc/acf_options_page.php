<?php
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => __('General Setup', 'iowa_league-admin'),
        'menu_title' => __('Theme Setup', 'iowa_league-admin'),
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
        'position' => 50
    ));


    acf_add_options_sub_page(array(
        'page_title' => __('Header Options', 'iowa_league-admin'),
        'menu_title' => __('Header Options', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => __('Footer Options', 'iowa_league-admin'),
        'menu_title' => __('Footer Options', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' => __('Cities Footer Options', 'iowa_league-admin'),
        'menu_title' => __('Cities Footer Options', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' => __('Services Footer Options', 'iowa_league-admin'),
        'menu_title' => __('Services Footer Options', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' => __('Events Footer Options', 'iowa_league-admin'),
        'menu_title' => __('Events Footer Options', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' => __('Single Footer Options', 'iowa_league-admin'),
        'menu_title' => __('Single Footer Options', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' => __('Resources Footer Options', 'iowa_league-admin'),
        'menu_title' => __('Resources Footer Options', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' => __('Awards Footer Options', 'iowa_league-admin'),
        'menu_title' => __('Awards Footer Options', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' => __('Resources Footer Options', 'iowa_league-admin'),
        'menu_title' => __('Resources Footer Options', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => __('Extra Code', 'iowa_league-admin'),
        'menu_title' => __('Extra Code', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => __('Social Accounts', 'iowa_league-admin'),
        'menu_title' => __('Social Accounts', 'iowa_league-admin'),
        'parent_slug' => 'theme-general-settings',
    ));
    
    acf_add_options_page(array(
        'page_title' => __('Reports', 'iowa_league-admin'),
        'menu_title' => __('Reports', 'iowa_league-admin'),
        'menu_slug' => 'theme-reports',
        'capability' => 'edit_posts',
        'icon_url' => 'dashicons-pdf',
        'redirect' => false
    ));     
}

add_filter('acf/load_field/name=social_type', 'acf_load_social_type');
function acf_load_social_type($field) {

    $field['choices']['airbnb'] = 'Airbnb';
    $field['choices']['dribbble'] = 'Dribbble';
    $field['choices']['facebook'] = 'Facebook';
    $field['choices']['flickr'] = 'Flickr';
    $field['choices']['foursquare'] = 'Foursquare';
    $field['choices']['github'] = 'Github';
    $field['choices']['instagram'] = 'Instagram';
    $field['choices']['linkedin'] = 'LinkedIn';
    $field['choices']['pinterest'] = 'Pinterest';
    $field['choices']['reddit'] = 'Reddit';
    $field['choices']['skype'] = 'Skype';
    $field['choices']['slack'] = 'Slack';
    $field['choices']['snapchat'] = 'Snapchat';
    $field['choices']['soundcloud'] = 'Soundcloud';
    $field['choices']['squarespace'] = 'Squarespace';
    $field['choices']['telegram'] = 'Telegram';
    $field['choices']['tiktok'] = 'TikTok';
    $field['choices']['tinder'] = 'Tinder';
    $field['choices']['tumblr'] = 'Tumblr';
    $field['choices']['twitter'] = 'Twitter';
    $field['choices']['viber'] = 'Viber';
    $field['choices']['vimeo'] = 'Vimeo';
    $field['choices']['wechat'] = 'WeChat';
    $field['choices']['whatsapp'] = 'WhatsApp';
    $field['choices']['yelp'] = 'Yelp';
    $field['choices']['youtube'] = 'YouTube';
    $field['choices']['youtubemusic'] = 'YouTube Music';

    // return the field
    return $field;
}

add_filter('acf/load_field/name=bg_size', 'acf_load_bg_size');
function acf_load_bg_size($field) {

    $field['choices']['cover'] = 'Cover';
    $field['choices']['contain'] = 'Contain';

    // return the field
    return $field;
}

add_filter('acf/load_field/name=bg_position', 'acf_load_bg_position');
function acf_load_bg_position($field) {

    $field['choices']['center center'] = 'Center Center';
    $field['choices']['center left'] = 'Center Left';
    $field['choices']['center right'] = 'Center Right';
    $field['choices']['top center'] = 'Top Center';
    $field['choices']['top left'] = 'Top Left';
    $field['choices']['top right'] = 'Top Right';
    $field['choices']['bottom center'] = 'Bottom Center';
    $field['choices']['bottom left'] = 'Bottom Left';
    $field['choices']['bottom right'] = 'Bottom Right';

    // return the field
    return $field;
}

add_filter('acf/load_field/name=bg_repeat', 'acf_load_bg_repeat');
function acf_load_bg_repeat($field) {

    $field['choices']['no-repeat'] = 'No repeat';
    $field['choices']['repeat'] = 'Repeat';
    $field['choices']['repeat-x'] = 'Repeat X';
    $field['choices']['repeat-y'] = 'Repeat Y';

    // return the field
    return $field;
}

add_filter('acf/load_field/name=vertical_content_position', 'acf_load_vcp');
function acf_load_vcp($field) {

    $field['choices']['flex-start'] = 'Top';
    $field['choices']['center'] = 'Center';
    $field['choices']['flex-end'] = 'Bottom';

    // return the field
    return $field;
}

add_filter('acf/load_field/name=content_width', 'acf_load_cw');
function acf_load_cw($field) {

    $field['choices']['default'] = 'Default';
    $field['choices']['middle'] = 'Middle';
    $field['choices']['small'] = 'Small';

    // return the field
    return $field;
}

add_filter('acf/load_field/name=font_size', 'acf_load_fs');
function acf_load_fs($field) {

    $field['choices']['default'] = 'Default';
    $field['choices']['small'] = 'Small';
    $field['choices']['large'] = 'Large';

    // return the field
    return $field;
}

add_filter('acf/load_field/name=select_post_type', 'acf_load_spt');
function acf_load_spt($field) {

    $field['choices']['post'] = 'Post';
    $field['choices']['page'] = 'Page';
    $field['choices']['attachment'] = 'Attachment';
    $field['choices']['mc4wp-form'] = 'Sign-up Form';
    $field['choices']['team'] = 'Team';
    $field['choices']['awards'] = 'Awards';
    $field['choices']['cities'] = 'Cities';
    $field['choices']['classified_list'] = 'Classified';
    $field['choices']['events'] = 'Events';
    $field['choices']['news_list'] = 'News List';
    $field['choices']['office'] = 'Office';
    $field['choices']['publications'] = 'Publications';
    $field['choices']['resource'] = 'Resource';
    $field['choices']['videos'] = 'Videos';

    // return the field
    return $field;
}

add_filter('acf/load_field/name=select_taxonomy', 'acf_load_stax');
function acf_load_stax($field) {
    $field['choices']['category'] = 'Category';
    $field['choices']['post_tag'] = 'Tag';
    $field['choices']['post_format'] = 'Format';
    $field['choices']['awards_tag'] = 'Awards Tag';
    $field['choices']['awards_tax'] = 'Awards Categories';
    $field['choices']['team_departments'] = 'Team Departments';
    $field['choices']['workshop_cat'] = 'Workshops Category';
    $field['choices']['event_type'] = 'Event Type';
    $field['choices']['news_cat'] = 'News Categories';
    $field['choices']['district'] = 'Districts';
    $field['choices']['resources_tax'] = 'Resources Category';
    $field['choices']['services_tax'] = 'Services Category';
    $field['choices']['video_cat'] = 'Video Categories';

    // return the field
    return $field;
}

add_filter('acf/load_field/name=select_terms', 'acf_load_sterms');
function acf_load_sterms($field) {
    $terms = get_terms( array(
        'taxonomy' => 'resources_tax',
        'hide_empty' => false,
    ));

    if ( $terms ) {
        foreach ( $terms as $term ) {
            $field['choices'][$term->term_id] = $term->name;
        }
    }

    // return the field
    return $field;
}

add_filter('acf/load_field/name=select_department', 'acf_load_sdep');
function acf_load_sdep($field) {
    $terms = get_terms( array(
        'taxonomy' => 'team_departments',
        'hide_empty' => false,
    ));

    if ( $terms ) {
        foreach ( $terms as $term ) {
            $field['choices'][$term->term_id] = $term->name;
        }
    }

    // return the field
    return $field;
}

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects($items, $args){
    // loop
    foreach ($items as &$item) {
        // vars
        $icon = get_field('icon', $item);
        $mega = get_field('mega_menu', $item);
        $small_text = get_field('small_text', $item);
        $svg_icon = get_field('svg_icon', $item);
        // append icon
        if ($icon) {
            $item->title = iconSvg($icon) .' ' .$item->title;
        }
        if ($small_text && $svg_icon) {
            $item->title = '<span><small>'. $small_text .'</small>' .$item->title . '</span>'. $svg_icon;
        }
        if($mega){
            array_push($item->classes, 'menu-item-mega-menu');
        }
    }
    // return
    return $items;

}

add_action( 'acf/input/admin_enqueue_scripts', function() {
    wp_enqueue_script( 'acf-custom-colors', get_template_directory_uri() .'/inc/js/aw-colors.js', 'acf-input', '1.0', true );
});