<?php
function queryPagination($items = ''){
    global $wp, $wp_rewrite, $wp_query;
    $query = !empty($items) ? $items : $wp_query ;
    // var_dump($items);
    $total_pages = $query->max_num_pages;
    if ($total_pages > 1){

        $current_page = max(1, get_query_var('paged'));

        $max = intval( $total_pages );


        echo '<div class="pagination-wrapper">';

        $pagination = array(
            'base' => @add_query_arg('page','%#%'),
            'format' => '',
            'total' => $total_pages,
            'current' => $current_page,
            'prev_text' => __('Previous'),
            'next_text' => __('Next'),
            'end_size' => 1,
            'mid_size' => 3,
            'show_all' => false,
            'type' => 'array'
        );
        $current_url =  home_url( $wp->request );
        $pos = strpos($current_url , 'page');
        $finalurl = $pos ? substr($current_url,0,$pos) : $current_url;

        if ( $wp_rewrite->using_permalinks() )
                $pagination['base'] = trailingslashit( $finalurl . '/page/%#%/', 'paged' . remove_query_arg( 's', get_pagenum_link( 1 ) ) ). '#search__wrap' ;
        if ( !empty( $query->query_vars['s'] ) )
                $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
        $pages = paginate_links( $pagination );
        $firstclass = '';
        $lastclass = '';
        $current_page == 1 ? $firstclass = 'disabled': '';
            
        echo '<a class="first page-numbers '.$firstclass.'" href="'.esc_url( get_pagenum_link( 1 ) ).'">'.iconSvg('chevrone-left').' First</a>';
        if ( $current_page == 1) {
            echo '<a href="#" class="prev btn btn-tertiary disabled">Previous</a>';
        }
        foreach ($pages as $page) :
            echo ''.$page.'';
        endforeach;
        if ( $current_page == $total_pages ) {
            echo '<a href="#" class="next btn btn-tertiary disabled">Next</a>';
            $lastclass = 'disabled';
        }
        echo '<a class="last page-numbers '.$lastclass.' " href="'.esc_url( get_pagenum_link( $max ) ).'">Last '.iconSvg('chevrone-right').' </a>';

        echo '';



        // var_dump($current_page);
        // if ($current_page != 1) {
        //     echo '<a class="page-numbers" href="'.esc_url( get_pagenum_link( 1 ) ).'">First</a>';
        // }
        // echo paginate_links(array(
        //     'base' => get_pagenum_link(1) . '%_%',
        //     'format' => 'page/%#%',
        //     'current' => $current_page,
        //     'total' => $total_pages,
        //     'prev_next' => true,
        //     'prev_text'    => __('Previous','iowa_league'),
        //     'next_text'    => __('Next','iowa_league'),
        //     'add_args'  => array(),
        //     'before_page_number' => '',
        //     'after_page_number' => '',
        // ));
        // if ($current_page != $total_pages) {
        //     echo '<a class="page-numbers" href="'.esc_url( get_pagenum_link( $max ) ).'">Last</a>';
        // }
        // echo '</div>';
    }
}
