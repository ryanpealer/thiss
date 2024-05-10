<?php

/**
 * Newsletter Listing - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-inner-news-listing';

// Load values.
$data = get_fields();
$items = $args = '';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$catQuery = get_query_var('news_cat');
$sortQuery = get_query_var('sort_by');
$searchQuery = get_query_var('search');

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'post_status' => 'publish',
    'paged' => $paged,
    'orderby' => 'date',
);
if($searchQuery){
    $args['s'] = $searchQuery;
}
if($sortQuery && $sortQuery != 'desc'){
    $args['order']   = $sortQuery;
}  else {
    $args['order']   = 'desc';
}
if($catQuery && $catQuery != 'all') {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $catQuery,
        ),
    );
}
$items = new WP_Query($args); ?>

<div class="<?php echo esc_attr($className); ?>">
  <?php if ($items->have_posts()):
    $year = false;
  ?>
      <div class="articles-list">
        <div class="showing_pages">Showing <?php echo $items->found_posts; ?> / <?php echo wp_count_posts('post')->publish; ?></div>

          <?php while ($items->have_posts()):$items->the_post();
              $fields = get_fields(get_the_ID());
              if (!empty($fields['external_link'])) {
                  $link = $fields['external_link'];
              } else {
                  $link = get_the_permalink();
              }
              if (!empty($fields['download_pdf'])) {
                $pdf = $fields['download_pdf'];
              }
              if (!empty($fields['view_full_event_details'])) {
                $eventDetails = $fields['view_full_event_details'];
              }
              if (!empty($fields['view_in_epub_reader'])) {
                $epubReader = $fields['view_in_epub_reader'];
              }
              $post_tags = get_the_terms(get_the_ID(), 'post_tag');
            ?>
            <!--                --><?php //if ($year == get_the_date('Y')) {
            //                    echo '';
            //                } else {
            //                    $year = get_the_date('Y');
            //                    echo '<div class="section-year">' . $year . '</div>';
            //                } ?>
          <div class="list-container">
            <div class="list-item">
                <?php
                if ($post_tags) {
                    ?>
                    <div class="tag-block">
                        <?php
                        $string = '';
                        foreach ($post_tags as $t) {
                            $string .= '<a class="item-tag" href="' . get_term_link($t->slug, $t->taxonomy) . '">' . $t->name . '</a>';
                        }
                        echo $string;
                        ?>
                    </div>
                <?php } ?>
                <div class="h3 title ">
                    <a class="item-title no-underline" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>
              <div class="post_divider"></div>
              <div class="publish_update_date">
                <span class="item-date-publish"><?php echo iconSvg('file-text');?> Posted on <?php echo get_the_date( 'l, F j, Y' ); ?></span>
                <span class="item-date-update"><?php echo iconSvg('check-circle');?> Updated on <?php echo get_the_modified_date( 'l, F j, Y' ); ?></span>
              </div>

              <!--                <span class="event-title">Event Details</span>-->


              <div class="item-rte">
                  <?php the_excerpt(); ?>
              </div>
              <div class="item-btn">
                  <a href="<?php echo get_post_permalink(); ?>" class="btn-link btn-arrow">
                      <?php _e('Read More', 'iowa_league') ?>
                  </a>
              </div>
              <?php
              $title = __('Share this article with a colleague:', 'iowa_league') . ' ' . get_the_title();
              shareArticle($title, get_permalink(), get_the_post_thumbnail_url(), 'Share this article with a colleague:');
              ?>

            </div>
            <div class="list-sidebar">

              <?php if(!empty($fields['external_link']) || !empty($fields['download_pdf']) || !empty($fields['view_full_event_details']) || !empty($fields['view_in_epub_reader'])):?>
              <span class="list-sidebar-title">In this Article:</span>
                <?php if(!empty($fields['download_pdf'])):?>
                  <a href="<?php echo $fields['download_pdf']; ?>" class="sidebar-btn btn-tertiary">Download PDF</a>
                <?php endif;?>
                <?php if(!empty($fields['external_link'])):?>
                  <a href="<?php echo $fields['external_link']; ?>" class="sidebar-btn btn-tertiary">External Links</a>
                <?php endif;?>
                <?php if(!empty($fields['view_full_event_details'])):?>
                  <a href="<?php echo $fields['view_full_event_details']; ?>" class="sidebar-btn btn-tertiary">View Full Event Details</a>
                <?php endif;?>
                <?php if(!empty($fields['view_in_epub_reader'])):?>
                  <a href="<?php echo $fields['view_in_epub_reader']; ?>" class="sidebar-btn btn-tertiary">View in ePub Reader</a>
                <?php endif;?>

              <?php endif;?>
                <?php if(!empty($fields['relevant_resources'])): ?>
              <span class="list-sidebar-title">Relevant Resources:</span>
                <?php
                foreach($fields['relevant_resources'] as $link) {
                    // var_dump($link);
                    echo '<a target="' . $link['resource_link']['target'] . '" href="' . $link['resource_link']['url'] . '" class="default-link" title="' . $link['resource_link']['title'] . '">';
                    echo $link['resource_link']['title'];
                    echo '</a>';
                }
                ?>
                <?php endif; ?>
            </div>
          </div>

          <?php endwhile; wp_reset_query(); ?>
      </div>
      <?php 
      queryPagination($items); ?>
  <?php else : ?>
  <!-- <p><?php //esc_html_e('Sorry, nothing matched your search. Please try again.', 'iowa_league'); ?></p> -->
  <?php echo '<br><br><br><p class="h6 text-center">No search results for <strong><em>'.$searchQuery.'</em></strong>.</p><br><br><br><br><br><br>'; ?>
  <?php endif; ?>
</div>
<?php wp_reset_query(); ?>
