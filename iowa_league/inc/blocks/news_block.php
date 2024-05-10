<?php
add_action('acf/init', 'my_acf_init_news_block');
function my_acf_init_news_block()
{

    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name' => 'news_search',
            'title' => __('News Search', 'iowa_league-admin'),
            'description' => __('News Search', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/news/search/search.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/news/search/search.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/news/search/search.svg' ),
            'category' => 'glibrary_sub_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
        ));
        acf_register_block_type(array(
            'name' => 'news_listing',
            'title' => __('News Articles', 'iowa_league-admin'),
            'description' => __('News Articles', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/news/listing/listing.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/news/listing/listing.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/news/listing/listing.svg' ),
            'category' => 'glibrary_sub_blocks',
            'keywords' => array(),
            'supports' => array(
                'align' => false,
                'anchor' => false
            ),
        ));

        acf_register_block_type(array(
            'name' => 'news_style1',
            'title' => __('News Block', 'iowa_league-admin'),
            'description' => __('GBlock - News Block', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/news/style1/style1.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/news/style1/style1.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/news/style1/style1.svg' ),
            'category' => 'glibrary_archive_blocks',
            'keywords' => array('news','informer','archive'),
            'post_types' => array('page'),
            'supports' => array(
                'align' => true,
                'jsx' => true
            ),
            'example'  => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => ['is_example' => true]
                ]
            ]
        ));
    }
}
