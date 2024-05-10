<?php

$service = get_query_var( 'service' );

global $wpdb;
$services = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}service_new WHERE `ID` = {$service}", OBJECT );

get_header(); 
$options = get_fields('option');

$website = $services[0]->WebSite;

?>

<main id="content" role="main" class="main-content">
    <?php //if (have_posts()) : while (have_posts()) : the_post();
        if (isset($services[0])) {
            ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="container">

            <div id="breadcrumbs" class="breadcrumbs">
                <a href="<?php site_url() ;?>">Home</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="4" height="8" viewBox="0 0 4 8" fill="none">
                    <path d="M4 4L-1.11273e-07 8L2.38419e-07 -1.74846e-07L4 4Z" fill="#424242"></path>
                </svg>

                <a href="<?php site_url() ;?>/service-directory/">Service Directory</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="4" height="8" viewBox="0 0 4 8" fill="none">
                    <path d="M4 4L-1.11273e-07 8L2.38419e-07 -1.74846e-07L4 4Z" fill="#424242"></path>
                </svg>

                <strong class="breadcrumb_last" aria-current="page">
                    <?php echo $services[0]->Organization ?>
                </strong>
            </div>


            <div class="">
                <div class="">


                    <!-- <header class="hentry-header">
                            Search Cities in Iowa
                            <div style="max-width: 278px;">
                                <?php //echo do_shortcode("[wd_asp elements='search,results' ratio='100%,100%' id=5]"); ?>
                            </div>
                            <hr>
                        </header> -->
                    <div class="hentry-content">
                        <div class="post-content-entry">
                            <p></p>
                            <div class="d-flex flex-wrap">

                                <div class="group-col">


                                    <?php if (!empty($services[0]->Organization)) { ?>
                                    <h4 class="has-primary-1-color is-style-medium">
                                        <?php echo $services[0]->Organization ?></h4>
                                    <?php } ?>
                                    <div class="wp-block-button is-style-fill">
                                        <a class="wp-block-button__link no-border-radius <?php echo (!empty($website)) && ($website != 'Not Provided') ? '' : 'btn-disabled'; ?>"
                                            href="<?php if(substr($website,0,4)!=="http"){echo "//".$website;} else {echo $website;} ?>" tabindex="-1" target="_blank">
                                            Website
                                            <?php echo (!empty($website)) && ($website != 'Not Provided') ? ' ': 'unavailable' ; ?>
                                        </a>
                                    </div>


                                </div>

                                <div class="group-col">
                                    <div style="width:129px">
                                        <?php 
                                        function UR_exists($url){
                                            $headers=get_headers($url);
                                            return stripos($headers[0],"200 OK")?true:false;
                                         }
                                         $url = get_site_url() . '/wp-content/uploads/ServiceDirectory/' . $services[0]->ID . '.PNG';
                                         if(UR_exists($url)) { ?>
                                        <img width="232" height="288" src="<?php echo $url; ?>"
                                            class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">

                                <div class="group-col">
                                    <h4 class="has-primary-1-color is-style-medium">Contact Information</h4>

                                    <?php if (!empty($services[0]->FullName)) { ?>
                                    <strong>Name</strong>
                                    <p><?php echo $services[0]->FullName ?></p>
                                    <?php } ?>

                                    <?php if (!empty($services[0]->PersonRole)) { ?>
                                    <strong>Title</strong>
                                    <p><?php echo $services[0]->PersonRole ?></p>
                                    <?php } ?>

                                    <?php if (!empty($services[0]->BusinessPhone)) { ?>
                                    <strong>Phone</strong>
                                    <p><?php echo $services[0]->BusinessPhone ?></p>
                                    <?php } ?>

                                    <?php if (!empty($services[0]->Email)) { ?>
                                    <strong>Email</strong>
                                    <p><a class="has-primary-1-color fz-16"
                                            href="<?php echo 'mailto:' . $services[0]->Email ?>"><?php echo $services[0]->Email ?></a>
                                    </p>
                                    <?php } ?>

                                    <?php if (!empty($services[0]->Street1)) { 
                                            
                                            $br = (empty($services[0]->Street2)) ? '<br>' : '';

                                            $Street1 = (!empty($services[0]->Street1)) ? $services[0]->Street1 . ' ' . $br : '';
                                            $Street2 = (!empty($services[0]->Street2)) ? $services[0]->Street2 . '<br>' : '';
                                            $City = (!empty($services[0]->City)) ? $services[0]->City . ', ' : '';
                                            $State = (!empty($services[0]->State)) ? $services[0]->State . ' ' : '';
                                            $ZipCode = (!empty($services[0]->ZipCode)) ? $services[0]->ZipCode . ' ' : '';
                                            
                                            ?>
                                    <strong>Location</strong>
                                    <p>
                                        <?php
                                                echo $Street1 . $Street2 . $City . $State . $ZipCode . '<br>United States';;
                                                ?>
                                    </p>
                                    <?php } ?>
                                </div>

                                <div class="group-col flex-1">
                                    <h4 class="has-primary-1-color is-style-medium">Description</h4>

                                    <?php if (!empty($services[0]->Description)) { ?>
                                    <p class="fz-16"><?php echo $services[0]->Description ?></p>
                                    <?php } ?>

                                    <?php if (!empty($services[0]->Category)) { ?>
                                    <strong>Primary Service</strong>
                                    <p><a class="has-primary-1-color fz-16"
                                            href="<?php echo get_site_url() . '/service-directory?wdt_column_filter[3]=' . $services[0]->Category . '#table__wrapper'; ?>"><?php echo $services[0]->Category ?></a>
                                    </p>
                                    <?php } ?>

                                    <?php if (!empty($services[0]->AssociateSecondaryCatg)) { ?>
                                    <strong>Additional Services</strong>
                                    <p class="fz-16"><?php echo $services[0]->AssociateSecondaryCatg ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                /**
                 * Multi Cloumn Listing - Block Template.
                 *
                 * @param array $block The block settings and attributes.
                 * @param string $content The block inner HTML (empty).
                 * @param bool $is_preview True during AJAX preview.
                 * @param   (int|string) $post_id The post ID this block is saved to.
                 */

                // Create class attribute allowing for custom "className" and "align" values.
                $className = 'blck-inner-mc-listing';
                if (!empty($block['className'])) {
                    $className .= ' ' . $block['className'];
                }
                if (!empty($block['align'])) {
                    $className .= ' align' . $block['align'];
                }
                $desktop = isset($options['settings_services']['visible_count']['desktop']) ? $options['settings_services']['visible_count']['desktop'] : '';
                $tablet = isset($options['settings_services']['visible_count']['tablet']) ? $options['settings_services']['visible_count']['tablet'] : '';
                $mobile = isset($options['settings_services']['visible_count']['mobile']) ? $options['settings_services']['visible_count']['mobile'] : '';
                $options['settings_services']['card_as_link'] = false;
            ?>

            <div class="wp-block-columns alignfull nonprint">
                <div class="wp-block-column">
                    <div class="wp-block-columns ">
                        <div class="wp-block-column">

                            <div id="section-heading-block_62206ef5051333a"
                                class="blck-section-heading section-top-pad-default section-bot-pad-none">
                                <div class="container">
                                    <h2 class="title has-primary-1-color">
                                        <?php echo isset($options['title_services']) ? $options['title_services'] : ''; ?>
                                    </h2>
                                    <p class="subtitle">
                                        <?php echo isset($options['subtitle_services']) ? $options['subtitle_services'] : ''; ?>
                                    </p>
                                </div>
                                <p>&nbsp;</p>
                            </div>

                            <div>
                                <div
                                    class="blck-inner-mc-listing card-style card_custom_items section-top-pad-none section-bot-pad-default">
                                    <div class="mc-grid"
                                        style="--desktop:<?php echo $desktop ?>;--tablet:<?php echo $tablet ?>;--mobile:<?php echo $mobile ?>;--justify:center;">
                                        <?php if ($options['settings_services']['content_type'] == 'custom_items') : ?>
                                            <?php foreach ($options['items_services'] as $item): ?>
                                                <?php if ($options['settings_services']['card_as_link'] == true) { ?>
                                                <a class="mc-grid-item" href="<?php echo $item['link']['url'] ?>"
                                                    <?php if ($item['link']['target']) echo ' target="' . $item['link']['target'] . '"' ?>>
                                                    <?php } else { ?>
                                                    <div class="mc-grid-item">
                                                        <?php } ?>
                                                        <figure>
                                                            <?php echo isset($item['icon']['id']) && $item['icon']['id'] ? wp_get_attachment_image($item['icon']['id'],'large') : '';?>
                                                        </figure>

                                                        <?php 
                                                                    if (!empty($options['settings_services']['card_as_link'])) {
                                                                        if (!empty($item['title'])) { ?>
                                                                            <div class="name"><?php echo do_shortcode($item['title']) ?></div>
                                                                            <?php } ?>
                                                                            <?php if (!empty($item['text'])) { ?>
                                                                            <div class="text"><?php echo do_shortcode($item['text']); ?></div>
                                                                            <?php } ?>

                                                                            <?php if (!empty($item['link']['title'])) { ?>
                                                                            <?php if ($options['settings_services']['card_as_link'] != true) { ?>
                                                                            <a class="btn-link btn-arrow" href="<?php echo $item['link']['url'] ?>"
                                                                                <?php if ($item['link']['target']) echo ' target="' . $item['link']['target'] . '"' ?>>
                                                                                <?php echo $item['link']['title']; ?>
                                                                            </a>
                                                                            <?php } else { ?>
                                                                            <div class="name"><?php echo $item['link']['title']; ?></div>
                                                                            <?php } ?>
                                                                            <?php }
                                                                    } else { ?>

                                                        <div class="text">
                                                            <?php if (!empty($item['title'])) { ?>
                                                            <div class="name"><?php echo do_shortcode($item['title']) ?></div>
                                                            <?php } ?>
                                                            <?php if (!empty($item['text'])) { ?>
                                                            <?php echo do_shortcode($item['text']); ?>
                                                            <?php } ?>
                                                            <?php if (!empty($item['link'])) {
                                                                echo '<div class="btn-wrap">';
                                                                foreach ($item['link'] as $link) {
                                                                if (!empty($link['link'])) {
                                                                    if ($options['settings_services']['card_as_link'] != true) { ?>
                                                                            <a class="btn-link btn-arrow" href="<?php echo $link['link']['url'] ?>" <?php if ($link['link']['target']) echo ' target="' . $link['link']['target'] . '"' ?>>
                                                                                <?php echo $link['link']['title']; ?>
                                                                            </a><br>
                                                                    <?php } else { ?>
                                                                    <div class="name"><?php echo $link['link']['title']; ?></div>
                                                                    <?php } 

                                                                } ?>
                                                                <?php }
                                                                echo '</div>';
                                                                } ?>
                                                        </div>
                                                        <?php } ?>
                                                        <?php if ($options['settings_services']['card_as_link'] == true) { ?>
                                                </a>
                                                <?php } else { ?>
                                            </div>
                                            <?php } ?>
                                            <?php endforeach; ?>


                                        <?php elseif ($options['settings_services']['content_type'] == 'post_data'):
                                                $args = array(
                                                    'post_type' => $options['select_post_type_services'],
                                                    'posts_per_page' => !empty($options['settings_services']['visible_count']['total_count_to_show']) ? $options['settings_services']['visible_count']['total_count_to_show'] : '',
                                                    'orderby' => 'post_date',
                                                    'post_status' => 'publish',
                                                );
                                                $query = new WP_Query($args);
                                                
                                                $i=1;
                                                if ($query->have_posts()):
                                                    ?>
                                        <?php while ($query->have_posts()): $query->the_post(); ?>
                                        <div class="mc-grid-item item-<?php echo $i; ?>">
                                            <!-- <div class="box"> -->
                                            <figure>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('large'); ?>
                                                </a>
                                            </figure>
                                            <div class="text">
                                                <div class="name">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </div>
                                                <div class="item-rte"><?php echo the_excerpt(); ?></div>

                                                <a class="btn-link" href="<?php the_permalink(); ?>">
                                                    See Details
                                                </a>
                                            </div>
                                        </div>
                                        <?php $i++; endwhile; ?>
                                        <?php endif; wp_reset_query(); ?>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </article>
    <?php //endwhile;
        } else {
            echo '<main class="main-content"><div class="container"><br><br><br><h1>Service not found</h1>';
            ?>
    <a class="btn-back btn-dark" href="<?php echo get_site_url() . '/service-directory'; ?>">
        <?php echo iconSvg('arrow-left');?>
        Back to Service Directory
    </a>
    <br><br><br><br>
    </div>
</main>
<?php
        }
        ?>
<?php //endif; ?>
</main>
<?php get_footer(); ?>