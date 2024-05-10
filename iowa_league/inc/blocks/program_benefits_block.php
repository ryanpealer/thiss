<?php
add_action('acf/init', 'my_acf_init_program_benefits_block');
function my_acf_init_program_benefits_block() {

    if (function_exists('acf_register_block_type')) {

        // register a post slider block.
        acf_register_block_type(array(
            'name' => 'program_benefits_block',
            'title' => __('Program Benefits block', 'iowa_league-admin'),
            'description' => __('GBlock - Program Benefits', 'iowa_league-admin'),
            'render_template' => 'template-parts/gblocks/program_benefits/program_benefits.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/gblocks/program_benefits/program_benefits.js',
            'icon'  => file_get_contents( get_template_directory() . '/template-parts/gblocks/program_benefits/program_benefits.svg' ),
            'category' => 'glibrary_other_blocks',
            'keywords' => array('program_benefits'),
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
