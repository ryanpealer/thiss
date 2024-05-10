<?php

/**
 * News Search - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-inner-news-search';

// Load values.
$data = get_fields();
$items = $args = '';
global $wp;
$current_url =  $wp->request;
$pos = strpos($current_url , 'page');
$finalurl = $pos ? substr($current_url,0,$pos) : $current_url;
$url = home_url(add_query_arg(array(), $finalurl)).'#search__wrap';
$letterCat = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => false,
    'hierarchical' => false
) );
$catQuery = get_query_var('news_cat');
$sortQuery = get_query_var('sort_by');
$searchQuery = get_query_var('search');
$selectedCatAll = '';
if(!isset($catQuery) && $catQuery != 'all') {
    $selectedCatAll = ' selected';
}
    ?>
    <div class="<?php echo esc_attr($className); ?>">
        <form role="search" method="get" class="news-searchform" id="news-searchform" action="<?php echo esc_url($url); ?>">
            <div class="form-group">
                <label for="search-cat"><?php _e('Filter category by','iowa_league');?></label>
                <select id="search-cat" name="news_cat" class="search-control js-style-select">
                    <option value="all"<?php echo $selectedCatAll ?>><?php _e('All Categories', 'iowa_league') ?></option>';
                    <?php foreach( $letterCat as $category ) {
                        $selectedCat = '';
                        if($catQuery == $category->term_id){
                            $selectedCat = ' selected';
                        }
                        echo '<option value="'. esc_attr( $category->term_id ) .'"'. $selectedCat .'>'.esc_html( $category->name ) .'</option>';
                        $childCat = get_terms( array(
                            'taxonomy' => 'category',
                            'hide_empty' => false,
                            'child_of' => $category->term_id
                        ) );
                        foreach( $childCat as $childCategory ) {
                            $selectedCat = '';
                            if ($catQuery == $childCategory->term_id) {
                                $selectedCat = ' selected';
                            }
                            echo '<option value="' . esc_attr($childCategory->term_id) . '"' . $selectedCat . '>-- ' . esc_html($childCategory->name) . '</option>';
                        }
                    } ?>
                    </select>
            </div>
            <div class="form-group">
                <label for="sort-by"><?php _e('Sort by','iowa_league');?></label>
                <select id="sort-by" name="sort_by" class="search-control js-style-select">
                    <option value="desc"<?php echo $sortQuery != 'asc' ? ' selected' : '' ?>><?php _e('Date Descending','iowa_league');?></option>
                    <option value="asc"<?php echo $sortQuery == 'asc' ? ' selected' : '' ?>><?php _e('Date Ascending','iowa_league');?></option>
                </select>
            </div>
            <div class="form-group large">
                <label for="s"><?php _e('Search our News, Events, and Publications','iowa_league');?></label>
                <div class="search-field-button">
                    <input type="search" class="search-field" placeholder="<?php _e('Type your search here...', 'iowa_league') ?>" value="<?php echo $searchQuery; ?>" name="search" id="s" />
                    <input type="submit" id="searchsubmit" class="search-submit" value="<?php _e( 'Search', 'iowa_league' ); ?>" />
                </div>
            </div>
        </form>
        <!--
      <div class="advanced_search">
        <a href="#"><?php //echo iconSvg('plus-circle');?> <span>Advanced Search</span></a>
      </div>-->
    </div>
