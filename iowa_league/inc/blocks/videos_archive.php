<?php
add_action('acf/init', 'my_acf_init_videos_archive');
function my_acf_init_videos_archive(){

    if (function_exists('acf_register_block_type')) {

        // register a hero banner block.
        acf_register_block_type(array(
            'name' => 'videos_archive',
            'title' => __('Videos Archive', 'imwca-admin'),
            'description' => __('GBlock - Videos Archive', 'imwca-admin'),
            'render_template' => 'template-parts/gblocks/videos/archive.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/videos/archive.js',
            'icon' => file_get_contents(get_template_directory() . '/template-parts/gblocks/videos/archive.svg'),
            'category' => 'glibrary_archive_blocks',
            'keywords' => array('video','archive'),
            'post_types' => array('page'),
            'align' => 'full',
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