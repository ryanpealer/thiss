<?php

$city = get_query_var( 'city' );

global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}city WHERE `ID` = {$city}", OBJECT );

/** @var array $persons */
$persons = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}person WHERE `ID` = {$city}", OBJECT );

get_header(); 
$options = get_fields('option');

// $fields = get_field_objects();
// $website = $fields['contact_information']['value']['website'];

$website = $results[0]->WEBSITE;

// foreach ($persons as $person) {
//     echo implode(', ', [$person->Person_ID, $person->TITLE, $person->FirstName . ' ' . $person->LastName]) . "<br />";
// }
//var_dump('<pre>',$persons[0]);

?>

    <main id="content" role="main" class="main-content">
        <?php //if (have_posts()) : while (have_posts()) : the_post();
        if (isset($results[0])) {
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
                        <?php echo $results[0]->Organization; ?>
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
                                        <h4 class="has-primary-1-color is-style-medium">Contact Information</h4>
                                        <?php if (!empty($results[0]->Street1)) { ?>
                                            <strong>Location</strong>
                                            <p>
                                                <?php
                                                echo $results[0]->Street1 . ' ' . $results[0]->Street2 . '<br>';
                                                echo $results[0]->CITY . ', ' . $results[0]->State . ' ' . $results[0]->ZipCode . '<br>United States';
                                                ?>
                                            </p>
                                        <?php } ?>

                                        <?php if (!empty($results[0]->OfficeHours)) { ?>
                                            <strong>Office Hours</strong>
                                            <p><?php echo $results[0]->OfficeHours ?></p>
                                        <?php } ?>

                                        <?php if (!empty($results[0]->BusinessPhone)) { ?>
                                            <strong>Phone</strong>
                                            <p><?php echo $results[0]->BusinessPhone ?></p>
                                        <?php } ?>

                                        <?php if (!empty($results[0]->BusinessFax)) { ?>
                                            <strong>Fax</strong>
                                            <p><?php echo $results[0]->BusinessFax ?></p>
                                        <?php } ?>

                                        <?php if (!empty($website)) { ?>
                                            <strong>Website</strong>
                                            <p><a class="has-primary-1-color fz-16" href="//<?php echo $website ?>" target="blank"><?php echo $website ?></a></p>
                                        <?php } ?>
                                    </div>


                                    <div class="group-col">
                                        <h4 class="has-primary-1-color is-style-medium">Demographics</h4>

                                        <?php if (!empty($results[0]->Population)) { ?>
                                            <strong>Population</strong>
                                            <p><?php echo $results[0]->Population ?></p>
                                        <?php } ?>

                                        <?php if (!empty($results[0]->Government)) { ?>
                                            <strong>Type of Government</strong>
                                            <p><?php echo $results[0]->Government ?></p>
                                        <?php } ?>

                                        <?php if (!empty($results[0]->County)) { ?>
                                            <strong>County</strong>
                                            <p><?php echo $results[0]->County ?></p>
                                        <?php } ?>

                                        <?php if (!empty($results[0]->HouseDistrict)) { ?>
                                            <strong>House District</strong>
                                            <p><?php echo $results[0]->HouseDistrict ?></p>
                                        <?php } ?>

                                        <?php if (!empty($results[0]->SenateDistrict)) { ?>
                                            <strong>Senate District</strong>
                                            <p><?php echo $results[0]->SenateDistrict ?></p>
                                        <?php } ?>

                                        <?php if (!empty($results[0]->District)) { ?>
                                            <strong>US Congressional District</strong>
                                            <p><?php echo $results[0]->District ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="group-col">
                                        <h4 class="has-primary-1-color is-style-medium">Meetings</h4>

                                        <?php if (!empty($results[0]->Meetings)) { ?>
                                            <strong>Meetings</strong>
                                            <p><?php echo $results[0]->Meetings ?></p>
                                        <?php } ?>

                                        <?php if (!empty($results[0]->MeetingTime)) { ?>
                                            <strong>Meeting time*</strong>
                                            <p><?php echo $results[0]->MeetingTime ?></p>
                                        <?php } ?>

                                        <strong>Meeting Location*</strong>
                                        <p>
                                            <?php
                                            echo $results[0]->Street1 . ' ' . $results[0]->Street2 . '<br>';
                                            echo $results[0]->Organization . ', ' . $results[0]->State . ' ' . $results[0]->ZipCode . '<br>United States';
                                            ?>
                                        </p>

                                        <p class="fz-20"><i>* Meeting location and time subject to change.</i></p>


                                    </div>

                                    <?php if (!empty($persons[0]->FirstName)) { ?>
                                        <div class="group-col">
                                            <h4 class="has-primary-1-color is-style-medium">City Official</h4>

                                            <?php if (!empty($persons[0]->FirstName)) { ?>
                                                <strong>Name</strong>
                                                <p><?php echo $persons[0]->FirstName . ' ' . $persons[0]->MiddleName . ' ' . $persons[0]->LastName ?></p>
                                            <?php } ?>

                                            <?php if (!empty($persons[0]->TITLE)) { ?>
                                                <strong>Position</strong>
                                                <p><?php echo $persons[0]->TITLE ?></p>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($persons[1]->FirstName)) { ?>
                                        <div class="group-col">
                                            <h4 class="has-primary-1-color is-style-medium">City Official</h4>

                                            <?php if (!empty($persons[1]->FirstName)) { ?>
                                                <strong>Name</strong>
                                                <p><?php echo $persons[1]->FirstName . ' ' . $persons[1]->MiddleName . ' ' . $persons[1]->LastName ?></p>
                                            <?php } ?>

                                            <?php if (!empty($persons[1]->TITLE)) { ?>
                                                <strong>Position</strong>
                                                <p><?php echo $persons[1]->TITLE ?></p>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

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
                            // var_dump( $options);
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
                                                <a class="btn-link btn-arrow mt-auto" href="<?php echo $link['link']['url'] ?>" <?php if ($link['link']['target']) echo ' target="' . $link['link']['target'] . '"' ?>>
                                                    <?php echo $link['link']['title']; ?>
                                                </a>
                                            <?php }} ?>

                                        </div>
                                    </div>
                                <?php }
                                ?>
                                </div>
                        </div>
                        <!-- <div class="wp-block-button aligncenter is-style-tertiary section-top-pad-half">
                            <a class="btn-tertiary" href="<?php //echo get_site_url() . '/service-directory'; ?>">
                                View Service Directory
                            </a>
                        </div> -->
                            <?php
                        } ?>

                        </div>
                    </div>
                </div>
            </div>

        </article>
        <?php //endwhile;
        } else {
            echo '<main class="main-content"><div class="container"><br><br><br><h1>City not found</h1>';
            ?>
                <a class="btn-back btn-dark" href="<?php echo get_site_url() . '/cities-in-iowa'; ?>">
                    <?php echo iconSvg('arrow-left');?>
                    Back to Cities In Iowa
                </a>
                <br><br><br><br>
                </div></main>
            <?php
        }
        ?>
        <?php //endif; ?>
    </main>
    <?php get_footer(); ?>

