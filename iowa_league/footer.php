<?php
$fields = get_fields('option');
?>
</div>
<!-- <div class="info-bar">
    <div class="container">
        <div class="info-bar-col">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               title="<?php echo esc_html(get_bloginfo('name')); ?>"
               rel="home">
                <?php if (isset($fields['footer_logo'])) { ?>
                    <img src="<?php echo $fields['footer_logo']['url'] ?>" width="312"
                         class="desktop-logo"
                         alt="<?php echo esc_html(get_bloginfo('name')); ?>">
                <?php } else {
                    echo esc_html(get_bloginfo('name'));
                } ?>
            </a>
        </div>
        <?php /*
        if (is_active_sidebar('footer_info')) :
            echo '<div class="info-bar-col">';
            dynamic_sidebar('footer_info');
            echo '</div>';
        endif;*/
        ?>         
    </div>    
</div> -->
<?php if (!is_singular('resource') && !is_singular('events')):
    if (is_active_sidebar('footer_top')) :
        echo '<div class="site-footer-top">';
        dynamic_sidebar('footer_top');
        echo '</div>';
    endif;
endif; ?>
<footer class="site-footer">
    <div class="container">
                


        

        <div class="site-footer-middle">
           
            <div class="col-left">
                <?php wp_nav_menu(array(
                    'theme_location' => 'middle-menu',
                    'container' => 'nav',
                    'container_class' => ''
                ));?>
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container' => 'div',
                    'container_class' => 'footer-menu'
                )); ?>
            </div>

            <div class="col-right">
            <?php if (is_active_sidebar('footer_middle_col1') || is_active_sidebar('footer_middle_col2') || is_active_sidebar('footer_middle_col3') || is_active_sidebar('footer_middle_col4')) { ?>
            <div class="site-footer-columns">
                <?php
                if (is_active_sidebar('footer_middle_col1')) :
                    echo '<div class="footer-col">';
                    dynamic_sidebar('footer_middle_col1');
                    echo '</div>';
                endif;
                if (is_active_sidebar('footer_middle_col2')) :
                    echo '<div class="footer-col">';
                    dynamic_sidebar('footer_middle_col2');
                    echo '</div>';
                endif;
                if (is_active_sidebar('footer_middle_col3')) :
                    echo '<div class="footer-col">';
                    dynamic_sidebar('footer_middle_col3');
                    echo '</div>';
                endif;
                if (is_active_sidebar('footer_middle_col4')) :
                    echo '<div class="footer-col">';
                    dynamic_sidebar('footer_middle_col4');
                    echo '</div>';
                endif;            
                ?>
            </div>
        <?php } ?>
            </div>
           
        </div>
        
        <div class="site-footer-bottom">
            
            <?php wp_nav_menu(array(
                'theme_location' => 'privacy-menu',
                'container' => 'nav',
                'container_class' => 'menu-privacy nonprint'
            ));?>

            <div class="info-bar-col nonprint">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                title="<?php echo esc_html(get_bloginfo('name')); ?>"
                rel="home">
                    <?php if (isset($fields['footer_logo'])) { ?>
                        <img src="<?php echo $fields['footer_logo']['url'] ?>" width="80"
                            class="desktop-logo"
                            alt="<?php echo esc_html(get_bloginfo('name')); ?>">
                    <?php } else {
                        echo esc_html(get_bloginfo('name'));
                    } ?>
                </a>
            </div>

            <?php if (isset($fields['copyright_text'])) { ?>
                <div id="copyright" class="footer-bottom-col site-footer-copyright">
                    <?php echo $fields['copyright_text']; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</footer>
</div>
<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank" style="display: none"></iframe>
<?php wp_footer(); ?>
<?php if(isset($fields['code_before_header'])){echo $fields['code_before_header'];} ?>
</body>
</html>