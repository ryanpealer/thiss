<?php
//add_filter( 'wpseo_breadcrumb_links', 'unbox_breadcrumb_link' );
//function unbox_breadcrumb_link( $links ) {
//    global $post;
//    if( is_singular('post')){
//        $links[1] = array('text' => 'Service Directory', 'url' => site_url() . '/service-directory/', 'allow_html' => 1);
//    }
//    return $links;
//}

add_filter( 'wpseo_breadcrumb_links', 'wpse_100012_override_yoast_breadcrumb_trail' );

function wpse_100012_override_yoast_breadcrumb_trail( $links ) {
    global $post;

    if ( is_singular( 'awards' ) ) {
        $breadLinks = get_field('single_awards_breadcrumbs', 'option');
        if($breadLinks){
            foreach($breadLinks as $link) {
                $breadcrumb[] = array(
                    'url' => get_permalink($link),
                    'text' => get_the_title($link),
                );
            }
        }

        array_splice( $links, 1, -1, $breadcrumb );
    } elseif ( is_singular( 'resource' ) ) {
        $term_obj_list = get_the_terms( $post->ID, 'resources_tax' );
        if ( $term_obj_list && ! is_wp_error( $term_obj_list ) ) :

                $breadLinks = get_field('single_resource_breadcrumbs', 'resources_tax_'. $term_obj_list[0]->term_id);
                if ($breadLinks) {
                    foreach ($breadLinks as $link) {
                        $breadcrumb[] = array(
                            'url' => get_permalink($link),
                            'text' => get_the_title($link),
                        );
                    }
                }
        endif;

        array_splice( $links, 1, -1, $breadcrumb );
    }

    return $links;
}