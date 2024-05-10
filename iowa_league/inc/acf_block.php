<?php
/*
 * Add custom category to gutenbergs blocks
 * */


function glibrary_gutenberg_pattern() {

    $core_block_patterns = array(
        'table-of-contents',
        'hero-section',
        'featured-section',
        'featured-section-counter',
        'media-text-block',
        'media-text-block-heading',
        'multi-column',
        'multi-column-card-link',
        'single-table-contents',
        'single-download-links',
        'single-column-text',
        'single-kpi',
        'latest-events',
        'latest-news'
    );

    foreach ($core_block_patterns as $core_block_pattern) {
        register_block_pattern(
            'iowa_league/' . $core_block_pattern,
            require __DIR__ . '/block-patterns/' . $core_block_pattern . '.php'
        );
    }
    register_block_pattern_category('iowa_league', array('label' => _x('Site Patterns', 'Block pattern category')));
    register_block_pattern_category('iowa_league_header', array('label' => _x('Header Patterns', 'Block pattern category')));
    register_block_pattern_category('iowa_league_media_text', array('label' => _x('Media + Text Patterns', 'Block pattern category')));
    register_block_pattern_category('iowa_league_single', array('label' => _x('Single Posts Patterns', 'Block pattern category')));
    register_block_pattern_category('iowa_league_latest', array('label' => _x('Latest Content Patterns', 'Block pattern category')));
}

add_action('init', 'glibrary_gutenberg_pattern');

add_action('after_setup_theme', 'removeCorePatterns');

function removeCorePatterns() {
    remove_theme_support('core-block-patterns');
}