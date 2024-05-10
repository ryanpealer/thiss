<?php 
    get_header(); 
    $options = get_fields('option');
?>

<?php 
$fields = get_field_objects();
$website = $fields['contact_information']['value']['website'];
?>

    <main id="content" role="main" class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
               
                <div class="container">

                <div id="hero-style2-block_6053548a7ce5aaa" class="blck-hero-style2 alignfull">
                    <style type="text/css">
                        #hero-style2-block_6053548a7ce5aaa img 
                        {object-fit:cover;}
                        @media (min-width: 768px) {#hero-style2-block_6053548a7ce5aaa{height:600px;}}    
                    </style>

                    <?php 
                        $img_id = $options['hero_background']['id'];
                        echo wp_get_attachment_image($img_id, 'full', false, array('class' => 'attachment-full size-full'))
                    ?>
                    

                <div class="container has-media-on-the-right">
                        

                <div class="wp-block-columns">
                <div class="wp-block-column"></div>



                <div class="wp-block-column" style="flex-basis:65%">
                    <a class="btn-back" href="<?php echo get_site_url() . '/cities-in-iowa'; ?>">
                        <?php echo iconSvg('arrow-left');?>
                        Back to Cities In Iowa
                    </a>
                    <h1 class="city-title display1 is-style-medium has-white-color has-text-color">
                        <?php the_title(); ?>
                    </h1>
                    
                    <div class="wp-block-button is-style-fill">
                        <a class="wp-block-button__link no-border-radius <?php echo !empty($website) ? '' : 'btn-disabled'; ?>" 
                        href="//<?php echo $website; ?>"
                        tabindex="-1" 
                        target="_blank">
                        Website 
                        <?php echo !empty($website) ? ' ': 'unavailable' ; ?>
                        </a>
                    </div>



                    <p></p>
                    </div>
                    </div>


                        </div>
                    </div>


                    <div class="wp-block-columns has-background">
                        <div class="wp-block-column">


                            <header class="hentry-header">
                                Search Cities in Iowa
                                <div style="max-width: 278px;">
                                    <?php echo do_shortcode("[wd_asp elements='search,results' ratio='100%,100%' id=5]"); ?>
                                </div>
                                <hr>
                            </header>
                            <div class="">
                                <div class="post-content-entry">
                                    <?php the_content(); ?>
                                    <div class="d-flex flex-wrap">
                                        <?php if( $fields ) {
                                            // $arrr = array();
                                            foreach( $fields as $field ) {
                                                $values = $field['value']; 
                                                // $subs = $field['sub_fields'];

                                                // var_dump($field['name']);
                                                
                                                
                                                if ($field['name'] != 'city_official' && $field['name'] != 'city_official_copy') {
                                                    echo '<div class="group-col">';
                                                    echo $field['label'] ? '<h4 class="has-primary-1-color is-style-medium">' . $field['label'] . '</h4>' : '';
                                                }
                                                
                                                // foreach( $subs as $key => $value ) {
                                                //     $k = $key;
                                                //     $v = $value['label'];
                                                //     $arrr[$key] = $v;
                                                // }

                                                foreach( $values as $k => $v ) {
                                                    if(!empty($v) && ($field['name'] != 'city_official' && $field['name'] != 'city_official_copy')) {
                                                        $key = str_replace("meeting_message", "<span></span>", $k);
                                                        $key1 = str_replace("_", " ", $key);
                                                        $key2 = str_replace(" of", "<span style='text-transform:none;'> of</span>", $key1);
                                                    ?>
                                                        <strong> <?php echo $key2 ?> </strong>
                                                        <?php if ($k == "website") { ?>
                                                        <p> <a class="has-primary-1-color fz-16" href="//<?php echo $v ; ?>" target="_blank"><?php echo $v ; ?></a></p>
                                                        
                                                   <?php  } else { ?>
                                                       <p data-view="<?php echo seo_friendly_url($key2); ?>" <?php echo $k == "meeting_message" ? 'class="fz-20"' : ''; ?>> 
                                                          <?php if($k == "population"):?>
                                                            <?php echo number_format($v, 0, '.', ','); ?> 
                                                          <?php else: ?>
                                                            <?php echo $v ; ?> 
                                                          <?php endif; ?>
                                                    </p>
                                                    <?php
                                                        }
                                                    }
                                                }
                                               

                                                if ($field['name'] != 'city_official' && $field['name'] != 'city_official_copy') {
                                                    echo '</div>';
                                                }

                                                $mayor = get_field('city_official');
                                                $clerk = get_field('city_official_copy');


                                                // var_dump($mayor, $clerk);


                                                if ($field['name'] == 'city_official' && !empty($mayor['name'])) {
                                                    echo '<div class="group-col">';
                                                    echo '<h4 class="has-primary-1-color is-style-medium">' . $field['label'] . '</h4>';
                                                    echo '<strong>Name</strong>';
                                                    echo '<p>' . $mayor['name'] . '</p>';
                                                    echo '<strong>Position</strong>';
                                                    echo '<p>' . $mayor['position'] . '</p>';
                                                    echo '</div>';
                                                }

                                                if ($field['name'] == 'city_official_copy' && !empty($clerk['name'])) {
                                                    echo '<div class="group-col">';
                                                    echo '<h4 class="has-primary-1-color is-style-medium">' . $field['label'] . '</h4>';
                                                    echo '<strong>Name</strong>';
                                                    echo '<p>' . $clerk['name'] . '</p>';
                                                    echo '<strong>Position</strong>';
                                                    echo '<p>' . $clerk['position'] . '</p>';
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
                                    <h2 class="title has-primary-1-color"><?php echo $options['title']; ?></h2>
                                    <p class="subtitle"><?php echo $options['subtitle']; ?></p>
                                </div>
                            </div>
                            
                            <?php 
                            $items = $options['items'];
                            if( !empty($items) ) {
                                echo ' <div class="blck-inner-mc-listing card-style card_custom_items section-top-pad-none section-bot-pad-default">';
                                echo ' <div class="mc-grid" style="--desktop:3;--tablet:3;--mobile:1">';
                            foreach( $items as $item ) {
                                ?> 
                                <div class="mc-grid-item">
                                <div class="text">    
                                <div class="name"><?php echo $item['title']; ?></div>                           
                                    <?php echo $item['text']; ?>                         
                                    <a class="btn-link btn-arrow" href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>"><?php echo $item['link']['title']; ?></a>
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