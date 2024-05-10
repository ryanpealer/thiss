<?php get_header(); ?>
    <main id="content" role="main" class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post();
        $fields = get_fields(); ?>
            <div class="container">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="header">
                        <h1 class="title"><?php the_title(); ?></h1>
                        <?php edit_post_link(null,'<div class="post-edit-wrapper">','</div>'); ?>
                    </header>
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