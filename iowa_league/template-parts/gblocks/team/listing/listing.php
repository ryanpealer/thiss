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
$className = 'blck-inner-team-listing section-top-pad-none section-bot-pad-none';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}
// Load values.
$data = get_fields();
$items = $args = '';
$terms = '';

if($data['items'] == 'all') {
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'orderby'=> 'menu_order',
    );
} elseif ($data['items'] == 'department') {
    $terms = $data['select_department_tax'];
    // foreach ($terms as $term_item) {
    //     // $ter[] = $term_item->term_id;
    //     $terr[] = $term_item;
    // }
    // var_dump($terr);
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'team_departments',
                'field' => 'term_id',
                'terms' => $terms,
            ),
        ),
    );


} elseif ($data['items'] == 'custom') {
    $args = array(
        'post_type' => 'team',
        'post__in' => $data['select_team'],
        'orderby'=> 'menu_order',
    );
}
$items = new WP_Query($args);
if($items->have_posts()):

    $desktop = $data['settings']['visible_count']['desktop'];
    $tablet = $data['settings']['visible_count']['tablet'];
    $mobile = $data['settings']['visible_count']['mobile'];
    $hide_image = $data['settings']['hide_image'];
    $add_link_to_single = $data['settings']['add_link_to_single'];
    $congressional_district_styles = $data['settings']['congressional_district_styles'];
    $hide_department_title = $data['settings']['hide_department_title'];
    if (!empty($congressional_district_styles)) {
        $className .= ' congressional_district_styles';
    }

    if (!empty($terms)) {
        foreach ($terms as $t) {
            $term = get_term_by( 'id', $t, 'team_departments' );
            $args = array(
                'post_type' => 'team',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order'   => 'ASC',
                // 'order'   => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'team_departments',
                        'field' => 'term_id',
                        'terms' => $t,
                    ),
                ),
            );
    
            $items = new WP_Query($args);
    
            ?>
                <?php if(isset($hide_department_title) && $hide_department_title == false) { ?>
                    <h4 class="is-style-medium"><?php echo $term->name?></h4>
                <?php } ?>
                <div class="<?php echo esc_attr($className); ?>">
                    <div class="">
                        <div class="team-grid" style="--justify:<?php echo $data['settings']['horizontal_align'] ?>;--desktop:<?php echo $desktop ?>;--tablet:<?php echo $tablet ?>;--mobile:<?php echo $mobile ?>">
                            <?php while ($items->have_posts()):$items->the_post();
                                $fields = get_fields(get_the_ID());
                                ?>
                                <div class="team-grid-item">
                                    <?php if($hide_image != true): ?>
                                        <figure class="img">
                                            <?php the_post_thumbnail('team_grid'); ?>
                                        </figure>
                                    <?php endif; ?>
                                    <div class="txt">
                                            <?php if(isset($fields['job_position']) && !empty($fields['job_position'])): ?>
                                                <div class="job"><?php echo do_shortcode($fields['job_position']); ?></div>
                                            <?php endif; ?>
                                            <?php if(isset($congressional_district_styles) && !empty($congressional_district_styles)): ?>
                                                <?php 
                                                $terms = wp_get_post_terms( get_the_ID(), 'team_departments');
                                                foreach($terms as $term) {
                                                    if( get_post_meta(get_the_ID(), '_yoast_wpseo_primary_team_departments',true) == $term->term_id ) {
                                                    echo '<div class="job">' . $term->name . '</div>';
                                                    }
                                                }
                                            ?>
                                            <?php endif; ?>
                                            <div class="name"><?php the_title(); ?></div>
                                            <?php if(isset($congressional_district_styles) && $congressional_district_styles == false): ?>
                                                <div class="content"><?php the_content(); ?></div>
                                            <?php endif; ?>
                                            <?php if(isset($add_link_to_single) && !empty($add_link_to_single)): ?>
                                                <a class="btn btn-link" href="<?php the_permalink(); ?>">
                                                    See Details
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <p></p>
            <?php
        }
    } else {
        ?>
        
                <div class="<?php echo esc_attr($className); ?>">
                    <div class="">
                        <div class="team-grid" style="--justify:<?php echo $data['settings']['horizontal_align'] ?>;--desktop:<?php echo $desktop ?>;--tablet:<?php echo $tablet ?>;--mobile:<?php echo $mobile ?>">
                            <?php while ($items->have_posts()):$items->the_post();
                                $fields = get_fields(get_the_ID());
                                ?>
                                <div class="team-grid-item">
                                    <?php if($hide_image != true): ?>
                                        <figure class="img">
                                            <?php the_post_thumbnail('team_grid'); ?>
                                        </figure>
                                    <?php endif; ?>
                                    <div class="txt">
                                            <?php if(isset($fields['job_position']) && !empty($fields['job_position'])): ?>
                                                <div class="job"><?php echo do_shortcode($fields['job_position']); ?></div>
                                            <?php endif; ?>
                                            <?php if(isset($congressional_district_styles) && !empty($congressional_district_styles)): ?>
                                                <?php 
                                                $terms = wp_get_post_terms( get_the_ID(), 'team_departments');
                                                foreach($terms as $term) {
                                                    if( get_post_meta(get_the_ID(), '_yoast_wpseo_primary_team_departments',true) == $term->term_id ) {
                                                    echo '<div class="job">' . $term->name . '</div>';
                                                    }
                                                }
                                            ?>
                                            <?php endif; ?>
                                            <div class="name"><?php the_title(); ?></div>
                                            <?php if(isset($congressional_district_styles) && $congressional_district_styles == false): ?>
                                                <div class="content"><?php the_content(); ?></div>
                                            <?php endif; ?>
                                            <?php if(isset($add_link_to_single) && !empty($add_link_to_single)): ?>
                                                <a class="btn btn-link" href="<?php the_permalink(); ?>">
                                                    See Details
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <p></p>
        <?php
    }
?>

    
<?php endif; ?>