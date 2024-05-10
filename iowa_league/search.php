<?php get_header(); 
// Load values.
$data = get_fields();
$items = $args = '';
global $wp;

$url = home_url(add_query_arg(array(), '/'));
$catQuery = get_query_var('post_type');
$sortQuery = get_query_var('order');
$searchQuery = get_query_var('s');
$selectedCatAll = '';
if(!isset($catQuery) && $catQuery != 'all') {
    $selectedCatAll = ' selected';
}

// var_dump('<pre>',$catQuery);

$type = get_post_type();

if ( $type == 'services' ) {
    $tax = 'services_tax';
} elseif ( $type == 'resource' ) {
    $tax = 'resources_tax';
}

$post_types = array(
    array(
        'slug' => 'awards',
        'name' => 'Awards',
    ),
    array(
        'slug' => 'events',
        'name' => 'Events',
    ),
    array(
        'slug' => 'post',
        'name' => 'News',
    ),
    array(
        'slug' => 'publications',
        'name' => 'Publications',
    ),
    array(
        'slug' => 'resource',
        'name' => 'Resource',
    ),
    // array(
    //     'slug' => 'services',
    //     'name' => 'Services',
    // ),
);

// var_dump('<pre>',get_post_types());
?>
    <main id="content" role="main" class="main-content">
        <div class="container">
            <div class="calendar-articles-list">
                <div id="search__wrap"></div>
                <div class="articles-list">
                    <div class="search-area">
                        <h4 class="is-style-light has-primary-1-color has-text-color">
                            Search 
                            <?php echo !empty($searchQuery) ? ' results for <em>"'.$searchQuery.'"</em>' : '' ?>
                        </h4>
                        <p>
                    <?php
                    if (!empty($searchQuery)) {
                            printf(
                                // esc_html(
                                /* translators: %d: The number of search results. */
                                    _n(
                                        'We found <strong>%d</strong> result for your search.',
                                        'We found <strong>%d</strong> results for your search.',
                                        (int) $wp_query->found_posts,
                                        'iowa_league'
                                    ),
                                // ),
                                (int) $wp_query->found_posts
                            );
                        }?>
                    </p>
                        <form role="search" method="get" class="news-searchform" id="news-searchform" action="<?php echo esc_url($url); ?>">
                            <div class="form-group">
                                <label for="search-cat"><?php _e('Filter category by','iowa_league');?></label>
                                <select id="search-cat" name="post_type" class="search-control js-style-select">
                                    <option value="all"<?php echo $selectedCatAll ?>><?php _e('All Categories', 'iowa_league') ?></option>';
                                    <?php foreach( $post_types as $category ) {
                                        $selectedCat = '';
                                        // var_dump($category['slug'],$catQuery[0]);die;
                                        if($catQuery == $category['slug']){
                                            $selectedCat = ' selected';
                                        }
                                        echo '<option value="'. esc_attr( $category['slug'] ) .'"'. $selectedCat .'>'. esc_html( $category['name'] ) .'</option>';
                                    } ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="sort-by"><?php _e('Sort by','iowa_league');?></label>
                                <select id="sort-by" name="order" class="search-control js-style-select">
                                    <option value="desc"<?php echo $sortQuery != 'ASC' ? ' selected' : '' ?>><?php _e('Date Descending','iowa_league');?></option>
                                    <option value="asc"<?php echo $sortQuery == 'ASC' ? ' selected' : '' ?>><?php _e('Date Ascending','iowa_league');?></option>
                                </select>
                            </div>
                            <div class="form-group large">
                                <label for="s"><?php _e('Search','iowa_league');?></label>
                                <div class="search-field-button">
                                    <input type="search" class="search-field" placeholder="<?php _e('Type your search here...', 'iowa_league') ?>" value="<?php echo $searchQuery; ?>" name="s" id="s" />
                                    <input type="submit" id="searchsubmit" class="search-submit" value="<?php _e( 'Search', 'iowa_league' ); ?>" />
                                </div>
                            </div>
                        </form>
                        <!--
                        <div class="advanced_search">
                            <a href="#"><?php //echo iconSvg('plus-circle');?> <span>Advanced Search</span></a>
                        </div>
                        -->
                    </div>

                    <?php 
                    if (have_posts()) {
                        while (have_posts()) : the_post();
                            get_template_part( 'template-parts/search-item' );
                        endwhile;
                    } else {
                        echo '<br><br><br><p class="h6 text-center">No search results for <strong><em>'.$searchQuery.'</em></strong>.</p><br><br><br><br><br><br>';
                    } wp_reset_query();
                 ?>
                </div>
                <?php queryPagination(); ?>
            </div>
        </div>
    </main>
<?php get_footer(); ?>