<?php
function facebook_social_button()
{
    $url = 'http://www.facebook.com/sharer/sharer.php?s=100';
    $obj_id = get_queried_object_id();
    global $wp;

    $article_url = home_url(add_query_arg(array(), $wp->request));

    $article_url .= '#utm_source=facebook&utm_medium=social&utm_campaign=social_buttons';
    if (WPSEO_Meta::get_value('opengraph-title', $obj_id)) {
        $title = html_entity_decode(WPSEO_Meta::get_value('opengraph-title', $obj_id));
    } else {
        $title = html_entity_decode(WPSEO_Meta::get_value('title', $obj_id));
    }

    $description = html_entity_decode(WPSEO_Meta::get_value('opengraph-description', $obj_id));
    $og_image = WPSEO_Meta::get_value('opengraph-image', $obj_id);
    $url .= '&p[url]=' . urlencode($article_url);
    $url .= '&p[title]=' . urlencode($title);
    $url .= '&p[images][0]=' . urlencode($og_image);
    $url .= '&p[summary]=' . urlencode($description);
    $url .= '&u=' . urlencode($article_url);
    $url .= '&t=' . urlencode($title);

    echo esc_attr($url);
}

function shareArticle($postTitle, $postUrl, $postThumbUrl, $title = null)
{   
    // if (!function_exists('WPSEO_Meta::get_value()')) {
    //     return;
    // }

    global $post;
    global $wp;
    $obj_id = get_queried_object_id();

    $title = isset($title) ? $title : __('Share:', 'iowa_league');
    if (WPSEO_Meta::get_value('title', $obj_id)) {
        $postTitle = urlencode(WPSEO_Meta::get_value('title', $obj_id));
    } else {
        $postTitle = urlencode(get_the_title());
    }
    // $article_url = urlencode(home_url(add_query_arg(array(), $wp->request)));
    $article_url = !empty($postUrl) ? $postUrl : urlencode(home_url(add_query_arg(array(), $wp->request)));

    if (WPSEO_Meta::get_value('twitter-title', $obj_id)) {
        $twitTitle = urlencode(WPSEO_Meta::get_value('twitter-title', $obj_id));
    } else {
        $twitTitle = urlencode(WPSEO_Meta::get_value('title', $obj_id));
    }

    $tweetHref = 'https://twitter.com/intent/tweet?text=' . esc_attr($twitTitle) . '&url=' . esc_attr($article_url) . '&via=gojilabs';
    $linkedinHref = 'http://www.linkedin.com/shareArticle?mini=true&url=' . esc_attr($article_url) . '&title=' . esc_attr($postTitle);
    $mailHref = 'mailto:?body=' . __('I found this content from '.get_bloginfo('title').' website interesting and wanted to share. You can read it here: ', 'iowa_league') . '' . $article_url;


    $uniqueid = uniqid('related-link-url-');
    ?>
    <div class="share-box">
        <div class="share-box--title"><?php echo $title ?></div>
        <div class="share-box--list">
            <a rel="nofollow" onclick="window.open('<?php facebook_social_button(); ?>', '_blank', 'width=600,height=500,top=100,left=400')" href="javascript:void(0)" target="_blank">
                <em class="socicon-facebook"></em>
                <span class="screen-reader-text"><?php _e('Share with Facebook', 'iowa_league'); ?></span>
            </a>

            <a rel="nofollow" onclick="window.open('<?php echo $tweetHref; ?>', '_blank', 'width=600,height=500,top=100,left=400')" href="javascript:void(0)" target="_blank">
                <em class="socicon-twitter"></em>
                <span class="screen-reader-text"><?php _e('Share via Twitter', 'iowa_league'); ?></span>
            </a>

            <a rel="nofollow" onclick="window.open('<?php echo $linkedinHref; ?>', '_blank', 'width=600,height=500,top=100,left=400')" href="javascript:void(0)" target="_blank">
                <em class="socicon-linkedin"></em>
                <span class="screen-reader-text"><?php _e('Share via Linkedin', 'iowa_league'); ?></span>
            </a>

            <a rel="nofollow" href="<?php echo $mailHref; ?>" target="_blank"><em class="socicon-envelope"></em><span
                        class="screen-reader-text"><?php _e('Share in email', 'iowa_league'); ?></span></a>

            <input type="text" value="<?php echo $article_url; ?>" id="<?php echo $uniqueid ?>">
            <a rel="nofollow" href="javascript:void(0)" onclick="copyLink('<?php echo $uniqueid ?>')"><em class="socicon-link"></em>
                <span class="screen-reader-text"><?php _e('Copy link', 'iowa_league'); ?></span></a>
        </div>
    </div>
<?php }