<?php 
$page_fields = get_fields();
get_header();
?>
    <?php if(isset($page_fields['show_breadcrumbs']) && $page_fields['show_breadcrumbs'] == true){ ?>
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<div class="container"><div id="breadcrumbs" class="breadcrumbs">','</div></div>' );
            }
        ?>
    <?php } ?>
    <main id="content" role="main" class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post();
            $fields = get_fields(); ?>
            <div class="container">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if($fields['hide_page_title'] != true){ ?>
                        <header class="header">
                            <h1 class="title"><?php the_title(); ?></h1>
                            <?php edit_post_link(null,'<div class="post-edit-wrapper">','</div>'); ?>
                        </header>
                    <?php } ?>
                    <div class="entry-content">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail();
                        } ?>
                        <?php the_content(); ?>
                        <div class="entry-links"><?php wp_link_pages(); ?></div>
                    </div>
                </article>
            </div>
        <?php endwhile; endif; ?>
    </main>
<?php get_footer(); ?>