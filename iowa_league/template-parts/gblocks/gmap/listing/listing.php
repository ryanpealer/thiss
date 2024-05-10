<?php

/**
 * Team Listing - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-inner-gmap-listing alignfull';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load values.
$data = get_fields();

if($data['settings']['show_district_list'] == true) {
    $exclude_district = $data['settings']['exclude_district'];
//content
    $districts = get_terms(array(
        'taxonomy' => 'district',
        'hide_empty' => false,
        'exclude' => $exclude_district,
    ));
}
$args = array(
    'post_type' => 'office',
    'posts_per_page' => -1
);
$offices = new WP_Query($args);
?>
<div class="<?php echo esc_attr($className); ?>">
    <?php if($data['settings']['show_district_list'] == true): ?>
    <div class="container">
        <ul class="district-list">

            <?php foreach ($districts as $dist): ?>
                <li>
                    <span class="color" style="background: <?php echo get_field('district_color', $dist->taxonomy . '_' . $dist->term_id) ?>"></span>
                    <?php echo $dist->name; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <?php if ($offices->have_posts()): ?>

        <div class="acf-map">
            <?php while ($offices->have_posts()): $offices->the_post();
                $office = get_fields(get_the_ID());
            if($data['settings']['show_district_list'] == true) {
                $district = get_the_terms(get_the_ID(), 'district');
                $distSlug = $district[0]->slug;
                $distIcon = get_field('map_icon', $district[0]->taxonomy . '_' . $district[0]->term_id);
                $icon = $distIcon['url'];
            } else {
                $icon = '';
                $distSlug = '';
            }
                if ($office) {
                    ?>
                    <div class="marker"
                         data-lat="<?php echo esc_attr($office['position']['lat']); ?>"
                         data-lng="<?php echo esc_attr($office['position']['lng']); ?>"
                         data-icon="<?php echo $icon ?>"
                         data-district="<?php echo $distSlug ?>">
                        <p><strong><?php the_title(); ?></strong></p>
                        <?php the_content(); ?>
                        <div class="text-right"><a href="<?php the_permalink(); ?>"><?php _e('Learn More', 'ih'); ?></a></div>
                    </div>
                <?php } ?>
            <?php endwhile;
            wp_reset_query(); ?>
        </div>

    <?php endif; ?>
</div>