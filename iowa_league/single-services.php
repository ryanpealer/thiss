<?php
// $allposts= get_posts( array('post_type'=>'services','numberposts'=>-1) );
// foreach ($allposts as $eachpost) {
// wp_delete_post( $eachpost->ID, true );
// }

    get_header(); 
    $options = get_fields('option');
    $fields = get_field_objects();
    // var_dump(get_post_meta(get_the_ID()));
    $website = $fields['website']['value'];
?>
    <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<div class="container"><div id="breadcrumbs" class="breadcrumbs">','</div></div>' );
        }
    ?>
    <br>

    <main id="content" role="main" class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="container">
                    <div class="">
                        <div class="wp-block-column">


                            <header class="hentry-header">
                                <!-- <p><a class="" href="<?php //echo get_site_url() . '/service-directory'; ?>">
                                    <?php //echo iconSvg('arrow-left-dark');?>
                                    Back to Service Directory
                                </a></p> -->
                                <!-- TODO: need to change search -->
                                Search Service Directory
                                <div style="max-width: 278px;">
                                    <?php echo do_shortcode("[wd_asp elements='search,results' ratio='100%,100%' id=8]"); ?>
                                </div>
                                <hr>
                            </header>
                            <div class="hentry-content">
                                <div class="post-content-entry">
                                    
                                    <div class="d-flex flex-wrap">
                                        <div class="group-col">
                                            <h4 class="has-primary-1-color is-style-medium"><?php the_title(); ?></h4>
                                            <div class="wp-block-button is-style-fill">
                                                
                                            <?php // var_dump($website); ?>
                                            <a class="wp-block-button__link no-border-radius <?php echo !empty($website) && $website != 'http://' ? '' : 'btn-disabled'; ?>" 
                                                href="<?php echo $website; ?>"
                                                tabindex="-1" 
                                                target="_blank">
                                                Website 
                                                <?php echo !empty($website) && $website != 'http://' ? ' ': 'unavailable' ; ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="group-col">
                                            <div style="width:129px">
                                                <?php echo the_post_thumbnail();  ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <?php if( $fields ) {
                                            unset($fields['website']);
                                            unset($fields['relevant_resources']);
                                            // var_dump($fields);

                                            foreach( $fields as $field ) {
                                                $values = $field['value']; 
                                                
                                                if ($field['name'] != 'website') {
                                                    $flex = $field['name'] == 'description' ? ' flex-1' : '';
                                                    echo '<div class="group-col' . $flex .'">';
                                                    echo $field['label'] ? '<h4 class="has-primary-1-color is-style-medium">' . $field['label'] . '</h4>' : '';
                                                }

                                                foreach( $values as $k => $v ) {
                                                    if(!empty($v) && ($field['name'] != 'website')) {
                                                        $key = str_replace("_", " ", $k);
                                                    ?>
                                                        <?php if ($k != "description") { ?>
                                                        <strong> <?php echo $key ?> </strong>
                                                        <?php } ?>
                                                        <?php if ($k == "email" && $v != 'Not Provided' ) { ?>
                                                        <p> <a class="has-primary-1-color fz-16" href="mailto:<?php echo $v ; ?>" target="_blank"><?php echo $v ; ?></a></p>
                                                        <?php  } elseif ($k == "primary_service") { ?>
                                                        <p> <a class="has-primary-1-color fz-16" href="<?php echo get_site_url() . '/service-directory?wdt_column_filter[1]=' . $v ?>" target="_blank"><?php echo $v ; ?></a></p>
                                                        <?php  } else { ?>
                                                       <p <?php echo $k == "description" || $k == "additional_services" ? 'class="fz-16"' : ''; ?>> <?php echo $v ; ?> </p>
                                                        <?php
                                                        }
                                                    }
                                                }
                                               
                                                if ($field['name'] != 'website') {
                                                    echo '</div>';
                                                }
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="wp-block-columns alignfull">
                    <div class="wp-block-column">
                        <div class="wp-block-columns ">
                            <div class="wp-block-column">
                                
                                <div id="section-heading-block_62206ef5051333a"
                                class="blck-section-heading section-top-pad-default section-bot-pad-default">
                                <div class="container">
                                    <h2 class="title has-primary-1-color"><?php echo $options['title_services']; ?></h2>
                                    <p class="subtitle"><?php echo $options['subtitle_services']; ?></p>
                                </div>
                            </div>
                            
                            <?php 
                            $items = $options['items_services'];
                            if( !empty($items) ) {
                                echo ' <div class="blck-inner-mc-listing card-style card_custom_items section-top-pad-none section-bot-pad-default">';
                                echo ' <div class="mc-grid" style="--desktop:3;--tablet:3;--mobile:1">';
                                foreach( $items as $item ) {
                                ?> 
                                <div class="mc-grid-item">
                                    <div class="text">
                                        <div class="name"><?php echo $item['title']; ?></div>                           
                                        <?php echo $item['text']; ?>
                                        <?php if (!empty($item['link'])) { 
                                        foreach ($item['link'] as $link) {
                                        ?>
                                            <a class="btn-link btn-arrow has-darker-green-color" href="<?php echo $link['link']['url'] ?>" <?php if ($link['link']['target']) echo ' target="' . $link['link']['target'] . '"' ?>>
                                                <?php echo $link['link']['title']; ?>
                                            </a>
                                    <?php }} ?>
                                    </div>                           
                                </div>
                            <?php }
                            ?>
                            </div>
                        </div>
                        <div class="wp-block-button aligncenter is-style-tertiary section-top-pad-half">
                            <a class="btn-tertiary" href="<?php echo get_site_url() . '/service-directory'; ?>">
                                View Service Directory
                            </a>
                        </div>
                                <?php
                            } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </article>
        <?php endwhile; ?>
        <?php endif; ?>
    </main>
    <?php get_footer(); ?>