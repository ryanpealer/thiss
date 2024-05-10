<?php

function register_query_vars($vars)
{
    $vars[] .= ''; /* set a filter parameter for filtering*/
    $vars[] .= 'video-cat';
    $vars[] .= 'news_cat';
    $vars[] .= 'sort_by';
    return $vars;
}

add_filter('query_vars', 'register_query_vars');