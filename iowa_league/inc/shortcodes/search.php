<?php
add_shortcode( 'iowa_league_search', 'iowa_league_search_func' );
function iowa_league_search_func( $atts ) {
    $atts = shortcode_atts( array(), $atts, 'iowa_league_search' );
    $form = '';
    $form .= '<form role="search" method="get" class="custom-searchform" action="' . home_url( '/' ) . '" >';
    $form .= '<div class="search-column">';
    $form .= '<div class="search-row">';
    $form .= '<label>'. __('Topics', 'iowa_league') .'</label>';
    $form .= '<select id="search-topics" name="topics" class="search-control">';
    $form .= '<option>'. __('All Topics', 'iowa_league') .'</option>';
    $form .= '</select>';
    $form .= '</div>';
    $form .= '<div class="search-row">';
    $form .= '<label>'. __('Types', 'iowa_league') .'</label>';
    $form .= '<select id="search-type" name="type" class="search-control">';
    $form .= '<option>'. __('All Types', 'iowa_league') .'</option>';
    $form .= '</select>';
    $form .= '</div>';
    $form .= '</div>';
    $form .= '<div class="search-row"><label for="s">' . __( 'Keyword', 'iowa_league' ) . '</label>';
    $form .= '<div class="search-field-button">';
    $form .= '<input type="search" class="search-control" placeholder="'. __('Type your search here...', 'iowa_league') .'" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" class="btn-primary is-style-xsmall" value="'. esc_attr__( 'Search' ) .'" /></div></div>';
    $form .= '</form>';

    return $form;

//    return "foo = {$atts['foo']}";
    return $form;
}