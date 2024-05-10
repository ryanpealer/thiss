<?php $fields = get_fields('option'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <?php wp_head(); ?>
    <?php if(isset($fields['code_before_header'])) { echo $fields['code_before_header']; } ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><span><?php _e('Skip to content', 'iowa_league'); ?></span></a>
<?php if (isset($fields['header_alert']['enable']) && $fields['header_alert']['enable']) {  ?>
        <div class="alert-banner">
            <div class="container">
                <a href="#" class="btn-alert-close">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                
                </a>
                <?php if($fields['header_alert']['content']): ?>
                    <div class="alert-copy"><?php echo $fields['header_alert']['content']; ?></div>
                <?php endif; ?>
            </div>
        </div>
    <?php } ?>
<div class="wrapper">
    <header class="site-header" id="header" role="banner">
        <div class="site-header-box js-header-box">
            <div class="site-header-top">
                <div class="container">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'top-menu-left',
                        'container' => 'nav',
                        'container_class' => ''
                    ));
                    if (is_active_sidebar('header_top')) :
                        dynamic_sidebar('header_top');
                    endif;
                    ?>
                    
                    <nav class="sign-nav">
                        <!-- <ul>
                            <li><a href="#" target="_blank"><?php _e('Member Login','iowa_league');?></a></li>
                        </ul> -->
                        <?php wp_nav_menu(array(
                                'theme_location' => 'login-menu',
                                'container' => 'nav',
                                'container_class' => 'login-menu'
                            )); ?>
                    </nav>
                </div>
            </div>
            <div class="site-header-middle">
                <div class="container">
                    <button class="mobile-menu-toggle"><?php _e('Menu', 'iowa_league') ?></button>
                    <div class="site-logo">
                        <div id="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>"
                            title="<?php echo esc_html(get_bloginfo('name')); ?>"
                            rel="home">
                                <?php if (isset($fields['header_desktop_logo'])) { ?>
                                    <img src="<?php echo $fields['header_desktop_logo']['url'] ?>" width="116"
                                        class="desktop-logo"
                                        alt="<?php echo esc_html(get_bloginfo('name')); ?>">
                                    <img src="<?php echo $fields['header_mobile_logo']['url'] ?>" width="80"
                                        class="mobile-logo"
                                        alt="<?php echo esc_html(get_bloginfo('name')); ?>">
                                <?php } else {
                                    echo esc_html(get_bloginfo('name'));
                                } ?>
                            </a>
                        </div>
                    </div>
                    <div class="text-right">

                        <div class="site-navigation">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'middle-menu',
                                'container' => 'nav',
                                'container_class' => 'menu-middle'
                            )); ?>
                        </div>

                        <button class="mobile-search-toggle"><em class="screen-reader-text"><?php _e('Search', 'iowa_league') ?></em></button>
                        <div class="site-search">
                            <button class="mobile-search-toggle"><em class="screen-reader-text"><?php _e('Close Search', 'iowa_league') ?></em></button>
                            <?php echo get_search_form(); ?>
                        </div>
                    
                        <div class="site-header-bottom">

                            <div class="top-mobile">

                            <button class="mobile-menu-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M18 6L6 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </button>

                                <a href="<?php echo esc_url(home_url('/')); ?>"
                                title="<?php echo esc_html(get_bloginfo('name')); ?>"
                                rel="home">
                                    <?php if (isset($fields['header_mobile_logo_menu'])) { ?>
                                        
                                        <img src="<?php echo $fields['header_mobile_logo_menu']['url'] ?>" width="81"
                                            class="mobile-logo"
                                            alt="<?php echo esc_html(get_bloginfo('name')); ?>">
                                    <?php } ?>
                                </a>
                            <?php /*wp_nav_menu(array(
                                    'theme_location' => 'top-menu-mobile',
                                    'container' => 'nav',
                                    'container_class' => ''
                                )); */?>
                            </div>

                            <div class="site-navigation">
                                <?php wp_nav_menu(array(
                                    'theme_location' => 'main-menu',
                                    'container' => 'nav',
                                    // 'container_class' => 'menu-mob menu-mob-main'
                                )); ?>

                                <?php wp_nav_menu(array(
                                    'theme_location' => 'middle-menu',
                                    'container' => 'nav',
                                    'container_class' => 'menu-mob menu-mob-middle'
                                )); ?>

                                <nav class="menu-mob menu-mob-signup">
                                    <ul class="menu">
                                        <li>
                                            <a href="<?php echo esc_url(home_url('/')); ?>/get-involved/newsletter-signup/"><?php _e('Sign Up To Our Newsletter','iowa_league'); ?></a>
                                        </li>
                                    </ul>
                                </nav>
                                <?php wp_nav_menu(array(
                                    'theme_location' => 'top-menu-left',
                                    'container' => 'nav',
                                    'container_class' => 'menu-mob menu-mob-contacts'
                                )); ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="main">
