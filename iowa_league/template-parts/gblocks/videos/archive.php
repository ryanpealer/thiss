<?php

/**
 * Videos archive - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'videos-archive-wrapper-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-video-archive-wrapper';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/videos/preview.jpg">';
else:
// Load values.
global $wp;
$data = get_fields();
$catQuery = get_query_var('video-cat');
$current_url = home_url(add_query_arg(array(), $wp->request));

$videoCat = get_terms( array(
    'taxonomy' => 'video_cat',
    'hide_empty' => false,
) );

if(isset($data['font_size']) && $data['font_size'] != 'default'){
    $className .= ' has-' . $data['font_size'].'-font-size';
}

$allowed_blocks = array( 'core/heading', 'core/paragraph', 'acf/gblock-spacer', 'core/buttons' );
$template = array(
    array( 'core/heading', array(
        'level' => 3,
        'placeholder' => 'Add a root-level heading',
        'className' => 'is-style-bold'
    ) ),
);
$styleWrap = '';
$styleWrap .= isset($data['bg_color']) && $data['bg_color'] ? '--section-bg:'.$data['bg_color'].';' : '--section-bg: transparent;';
$styleWrap .= isset($data['text_color']) && $data['text_color'] ? '--section-text-color:'.$data['text_color'].';' : '--section-text-color:inherit;';
$styleWrap .= isset($data['bg_size']) && $data['bg_size'] ? '--bg-img-size:'.$data['bg_size'].';' : '--bg-img-size:inherit;';
$styleWrap .= isset($data['bg_position']) && $data['bg_position'] ? '--bg-img-position:'.$data['bg_position'].';' : '--bg-img-position:center;';
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php echo $styleWrap; ?>">
    <?php echo isset($data['bg_image']['id']) && $data['bg_image']['id'] ? wp_get_attachment_image($data['bg_image']['id'],'full', false, array('class'=>'bg-image')) : ''; ?>
    <div class="container<?php echo isset($data['content_width']) && $data['content_width'] != 'default' ? ' '.$data['content_width'] :'' ?>">
        <div class="text-block">
            <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ) ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ) ?>" />
        </div>
        <form method="get" name="search-filter" action="<?php echo $current_url; ?>" class="news-searchform">
            <div class="form-group">
                <label for="video-cat-select"><?php _e('Filter by','imwca');?></label>
                <select class="form-control js-style-select" name="video-cat" id="video-cat-select">
                    <option value="all"<?php echo $catQuery != 'all' ? '' : ' selected';?>><?php _e('All Categories','imwca');?></option>
                    <?php
                    foreach ($videoCat as $cat) {
                        $catQuery == $cat->slug ? $selected = ' selected' : $selected = '';
                        echo '<option value="' . $cat->slug . '"' . $selected . '>' . $cat->name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </form>
        <?php
            $args = array(
                'post_type' => 'videos',
                'posts_per_page' => -1,
            );
            if(isset($catQuery) && !empty($catQuery) && $catQuery != 'all'){
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'video_cat',
                        'field'    => 'slug',
                        'terms'    => $catQuery,
                    ),
                );
            }
            $items = new WP_Query($args);
            if($items->have_posts()):

        ?>
            <div class="video-archive-list">
                <?php while ($items->have_posts()):$items->the_post();
                $fields = get_fields(get_the_ID());
                    preg_match(
                        '/[\?\&]v=([^\?\&]+)/',
                        $fields['youtube_url'],
                        $matches
                    );
                    $id = $matches[1];
                    ?>
                    <div class="video-archive-item">
                        <figure class="item-image">
                            <a href="<?php echo $fields['youtube_url'] ?>" <?php echo $fields['playlist'] == false ? 'class="js-video-popup"': 'target="_blank"'; ?>>
                                <?php
                                if(has_post_thumbnail()) {
                                    the_post_thumbnail('video_archive');
                                } else {
                                    echo '<img src="https://img.youtube.com/vi/'.$id.'/maxresdefault.jpg" width="1280" height="720" />';
                                }
                                ?>
                            </a>
                        </figure>
                        <div class="item-name"><?php the_title(); ?></div>
                        <div class="item-rte">
                            <?php echo do_shortcode($fields['description'])?>
                        </div>
                        <div class="item-link">
                            <a href="<?php echo $fields['youtube_url'] ?>" <?php echo $fields['playlist'] == false ? 'class="btn-tertiary js-video-popup"': 'class="btn-tertiary" target="_blank"'; ?>><?php _e('Watch Video Now','iowa_league');?></a></div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p><?php esc_html_e('Sorry, nothing matched your search. Please try again.', 'iowa_league'); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>