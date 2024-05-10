<?php
function customButton($btn,$class){
if( $btn ):
    $link_url = $btn['url'];
    $link_title = $btn['title'];
    $link_target = $btn['target'] ? $btn['target'] : '_self';
    ?>
    <div class="btn-row"><a href="<?php echo esc_url( $link_url ); ?>" class="<?php echo $class ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
<?php endif;
}
/* Add lang switcher for mobile nav */
function icl_post_languages() {
    if ( function_exists('icl_get_languages') ) {
        $languages = icl_get_languages('skip_missing=1');
        $lang = '';
        if (1 < count($languages)) {
            foreach ($languages as $l) {
//                var_dump($l);
                if (!$l['active']) $langs[] = '<a href="' . $l['url'] . '">' . $l['translated_name'] . '</a>';
            }
            $lang = join(', ', $langs);
        }
        return $lang;
    }
}

/* Add items to the end of mobile nav*/
add_filter('wp_nav_menu_items', 'mobile_add_menu_item', 10, 2);
function mobile_add_menu_item($items, $args) {
    if ($args->theme_location == 'top-menu-mobile') {
        $items .= '<li class="menu-item"><a href="#" class="btn-secondary">'. iconSvg('file') .''. __('Send Us Files','iowa_league') .'</a></li>';
        $items .= icl_post_languages();
        $items .= '<li class="menu-item"><a href="https://iowa_leagueapps.iowa_league.org/iowa_league_Member_Access/" class="btn-primary" target="_blank">'. __('Login','iowa_league').'</a></li>';
    }
    return $items;
}