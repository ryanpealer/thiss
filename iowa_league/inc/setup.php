<?php
add_action('after_setup_theme', 'theme_setup');
function theme_setup()
{
    load_theme_textdomain('iowa_league', get_template_directory() . '/languages');
    load_theme_textdomain('iowa_league-admin', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form'));

    add_theme_support('editor-styles');
    add_editor_style( '/assets/css/editor-style.css' );

    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1224;
    }
    register_nav_menus(array(
        'main-menu' => esc_html__('Main Menu', 'iowa_league-admin'),
        'top-menu-left' => esc_html__('Top Menu Left', 'iowa_league-admin'),
        'top-menu-mobile' => esc_html__('Top Menu Mobile', 'iowa_league-admin'),
        'login-menu' => esc_html__('Login Menu', 'iowa_league-admin'),
        'middle-menu' => esc_html__('Middle Menu', 'iowa_league-admin'),
        'footer-menu' => esc_html__('Footer Menu', 'iowa_league-admin'),
        'privacy-menu' => esc_html__('Privacy Menu', 'iowa_league-admin'),
    ));


    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // -- Editor Font Styles
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('small (14px)', 'iowa_league-admin'),
            'shortName' => __('S', 'iowa_league-admin'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => __('regular (16px)', 'iowa_league-admin'),
            'shortName' => __('M', 'iowa_league-admin'),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => __('large (18px)', 'iowa_league-admin'),
            'shortName' => __('L', 'iowa_league-admin'),
            'size' => 18,
            'slug' => 'large'
        ),
        array(
            'name' => __('ExtraLarge (20px)', 'iowa_league-admin'),
            'shortName' => __('XL', 'iowa_league-admin'),
            'size' => 20,
            'slug' => 'xlarge'
        ),
        array(
            'name' => __('HeroLarge (25px)', 'iowa_league-admin'),
            'shortName' => __('XXL', 'iowa_league-admin'),
            'size' => 25,
            'slug' => 'hlarge'
        ),        
    ));

    // -- Disable Custom Colors
//    add_theme_support('disable-custom-colors');

    // -- Editor Color Palette
    add_theme_support('editor-color-palette', array(

            array(
                'name' => __('Black', 'iowa_league-admin'),
                'slug' => 'black',
                'color' => '#212121',
            ),
            array(
                'name' => __('Pitch black', 'iowa_league-admin'),
                'slug' => 'pitch_black',
                'color' => '#000',
            ),
            array(
                'name' => __('Text black (#333333)', 'iowa_league-admin'),
                'slug' => 'text_black',
                'color' => '#333',
            ),            
            array(
                'name' => __('Primary 1', 'iowa_league-admin'),
                'slug' => 'primary1',
                'color' => '#005395',
            ),
            array(
                'name' => __('Primary 2', 'iowa_league-admin'),
                'slug' => 'primary2',
                'color' => '#003561',
            ),
            array(
                'name' => __('Secondary 1', 'iowa_league-admin'),
                'slug' => 'secondary1',
                'color' => '#003561',
            ),
            array(
                'name' => __('Secondary 2', 'iowa_league-admin'),
                'slug' => 'secondary2',
                'color' => '#005395',
            ),
            array(
                'name' => __('Tertiary 1', 'iowa_league-admin'),
                'slug' => 'tertiary1',
                'color' => '#93A445',
            ),
            array(
                'name' => __('Tertiary 2', 'iowa_league-admin'),
                'slug' => 'tertiary2',
                'color' => '#65751f',
            ),
            array(
                'name' => __('Dark Green', 'iowa_league-admin'),
                'slug' => 'darker-green',
                'color' => '#647119',
            ),            
            array(
                'name' => __('Gray 1', 'iowa_league-admin'),
                'slug' => 'gray1',
                'color' => '#FAFAFA',
            ),
            array(
                'name' => __('Gray 2', 'iowa_league-admin'),
                'slug' => 'gray2',
                'color' => '#E0E0E0',
            ),
            array(
                'name' => __('White', 'iowa_league-admin'),
                'slug' => 'white',
                'color' => '#ffffff',
            ),
            array(
                'name' => __('Snow white', 'iowa_league-admin'),
                'slug' => 'snow_white',
                'color' => '#FAFCFF',
            )
        )
    );

    // -- Disable Gradients
    add_theme_support( 'disable-custom-gradients' );
    add_theme_support( 'editor-gradient-presets', array() );
}
function gg_gfonts_prefetch() {
    echo '<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>';
}
add_action( 'wp_head', 'gg_gfonts_prefetch' );

add_action('wp_enqueue_scripts', 'theme_scripts');
function theme_scripts()
{
    wp_enqueue_style('googleapis_noto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', false, '1.0.0');
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/style.css'), 'all');
    wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/1e4555ce55.js', array(), true);
    wp_enqueue_script('jquery');

if (basename(get_permalink()) == 'post-a-classified') {
    wp_enqueue_script('jquery_validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js', array('jquery'), '', true);
    wp_dequeue_style( 'global-styles' );
}

    wp_enqueue_script('mask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js', array('jquery'), '1.14.10', true);
    wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery','mask'), filemtime(get_stylesheet_directory() . '/assets/js/scripts.js'), true);
}

add_action('wp_footer', 'footer_scripts');

function footer_scripts()
{
    ?>
    <script>
        jQuery(document).ready(function ($) {
            var deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass("ios");
                $("html").addClass("mobile");
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
    <?php
}


add_action('admin_enqueue_scripts', 'load_admin_styles');
function load_admin_styles()
{
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/admin-style.css', false, '1.0.0');
}

define( 'ADD_VERSION', '0.0.8' );

function myguten_enqueue() {
    wp_enqueue_script(
        'myguten-script',
        get_template_directory_uri() .'/inc/js/js-block.js',
        array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
        ADD_VERSION
    );

    wp_enqueue_style('googleapis_noto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', false, '1.0.0');
}
add_action( 'enqueue_block_editor_assets', 'myguten_enqueue' );

if (wp_is_mobile()) {
    add_filter('show_admin_bar', '__return_false');
}