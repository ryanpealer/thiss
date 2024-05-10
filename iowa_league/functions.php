<?php
remove_action('wp_head', 'wp_generator');


/* Function which displays your post date in time ago format */
function meks_time_ago()
{
    return human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('ago', 'iowa_league');
}

function seo_friendly_url($string)
{
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
    return strtolower(trim($string, '-'));
}

/**
 * Helper function for prettying up errors.
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$compat_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Theme &rsaquo; Error', 'iowa_league-admin');
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p>";
    wp_die($message, $title);
};

/**
 * The file's list that need to be loaded.
 */
$include_file_list = array(
    'setup',    // General Settings
    'acf_block',    // Setup options page
    'acf_options_page',    // Setup options page
    'blocks/calendar_block', //Register calendar block for gutenberg
    'blocks/categories', //Register blocks categories for gutenberg
    'blocks/category_listing_block', //Register blocks category_listing for gutenberg
    'blocks/program_benefits_block', //Register blocks program_benefits for gutenberg
    'blocks/hero_block', //Register hero blocks for gutenberg
    'blocks/post_slider_block', //Register post slider blocks for gutenberg
//    'blocks/endorsement_slider_block', //Register endorsement blocks for gutenberg
    'blocks/research_slider_block', //Register research blocks for gutenberg
    'blocks/team_block', //Register team block for gutenberg
//    'blocks/reports_block', //Register reports block for gutenberg
    'blocks/impact_block', //Register impact block for gutenberg
    'blocks/spacer_block', //Register spacer block for gutenberg
//    'blocks/timeline_block', //Register impact block for gutenberg
    'blocks/multi_column_block', //Register reports block for gutenberg
//    'blocks/gmap_block', //Register google map block for gutenberg
    'blocks/sidebar_block_widget', //Register sidebar block widget for gutenberg
//    'blocks/services_block', //Register services block for gutenberg
//    'blocks/secondary_nav_block', //Register journey nav block for gutenberg
    'blocks/section_heading_block', //Register section heading block for gutenberg
    'blocks/select_service_category', //Register section select service category block for gutenberg
    'blocks/featured_block', //Register featured block for gutenberg
	'blocks/news_block', //Register newsletter block for gutenberg
//	'blocks/notice_block', //Register newsletter block for gutenberg
	'blocks/image_slider', //Register block for gutenberg
	'blocks/link_table', //Register block for gutenberg
	'blocks/videos_archive', //Register video archive block for gutenberg
    'query', //Custom Query vars and rewrites
    'widgets_init', //Register widgetized areas
    'widgets/social_list', //Register widgetized areas
    'widgets/download_widget', //Register Download widget
    'widgets/upload_portal_widget', //Register Upload Portal widget
    'short_custom_functions', //Some short functions
    'post_types/team', //Add post type Team
    'post_types/awards', //Add post type Awards
    //'post_types/cities', //Add post type Cities
	'post_types/classified_list', //Add post type Classifieds
    'post_types/event', //Add post type Event
//	'post_types/news', //Add post type Newsletter
	'post_types/office', //Add post type Office
	'post_types/publication', //Add post type Publication
    'post_types/resources', //Add post type Services
    // 'post_types/services', //Add post type Services
    'post_types/video', //Add post type Video
    'functions/share', //Add share function
    'functions/icons', //Add icons function
	'functions/wp_query_pagination', //Add custom pagination function
    'image_size', //Image Size
    'shortcodes/search', //Add search shortcode
    'acf-widget-area/acf-widget-area', //Add acf widget field
    'custom-tables', // Custom tables (City, etc.)
    'yoast_updates', // Update breadcrumbs
    'affidavit', // Add affidavit function
    'billable', // Add billable function
    'gforms_fields', // Add custom gravity form fields
);

/**
 * Them required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($compat_error) {
    $file = "./inc/{$file}.php";
    if (!locate_template($file, true, true)) {
        $compat_error(
            sprintf(__('Error locating <code>%s</code> for inclusion.', 'iowa_league-admin'), $file),
            __('File not found', 'iowa_league-admin')
        );
    }
}, $include_file_list);

add_action('acf/init', 'my_acfe_modules');
function my_acfe_modules(){
    acf_update_setting('acfe/modules/author', false);
}

if(wp_is_mobile()){
    add_filter( 'show_admin_bar', '__return_false' );
}

function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="4" height="8" viewBox="0 0 4 8" fill="none">
    <path d="M4 4L-1.11273e-07 8L2.38419e-07 -1.74846e-07L4 4Z" fill="#424242"/>
    </svg>';
};
// add the filter
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);


add_filter( 'wpseo_breadcrumb_links', 'unbox_breadcrumb_link' );
function unbox_breadcrumb_link( $links ) {
    global $post;   
    // if( is_singular('services')){ 
    //     $links[1] = array('text' => 'Service Directory', 'url' => site_url() . '/service-directory/', 'allow_html' => 1);
    // }
    if( is_singular('events')){ 
        $single = $links[1];
        $links[0] = array('text' => 'Home', 'url' => site_url(), 'allow_html' => 1);
        $links[1] = array('text' => 'Workshop Calendar', 'url' => site_url() . '/news/calendar/', 'allow_html' => 1);
        $links[2] = $single;
    }
    if( is_singular('resource')){ 
        $links[1] = array('text' => 'Resources', 'url' => site_url() . '/resources/', 'allow_html' => 1);
    }
    // if( is_singular('resource')){ 
    //     $links[1] = array('text' => 'Resources', 'url' => site_url() . '/resources/', 'allow_html' => 1);
    // }
    if( is_singular('post')){ 
        $single = $links[1];
        $links[0] = array('text' => 'Home', 'url' => site_url(), 'allow_html' => 1);
        $links[1] = array('text' => 'In the News', 'url' => site_url() . '/in-the-news/', 'allow_html' => 1);
        $links[2] = $single;
    }
    return $links;
}


// function trim_custom_excerpt($excerpt) {
//     if (has_excerpt()) {
//         $excerpt = wp_trim_words(get_the_excerpt(), apply_filters("excerpt_length", 50));
//     }

//     return $excerpt;
// }

// add_filter("the_excerpt", "trim_custom_excerpt", 999);

function custom_excerpt_length( $length ) {
	return 22;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );



// add_action('init', function() {
// 	if (!function_exists('unregister_block_pattern')) {
// 		return;
// 	}
// 	unregister_block_pattern('core/two-buttons');
// 	unregister_block_pattern('core/three-buttons');
// 	unregister_block_pattern('core/text-two-columns');
// 	unregister_block_pattern('core/text-two-columns-with-images');
// 	unregister_block_pattern('core/text-three-columns-buttons');
// 	unregister_block_pattern('core/two-images');
// 	unregister_block_pattern('core/large-header');
// 	unregister_block_pattern('core/large-header-button');
// 	unregister_block_pattern('core/quote');
// 	unregister_block_pattern('core/heading-paragraph'); 
// });

// Move Yoast Meta Box to bottom
function metabox_to_bottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'metabox_to_bottom');
add_filter( 'bp_members_admin_user_metaboxes', 'metabox_to_bottom');


function maybe_editor_post_id() {
	if ( is_admin() && function_exists( 'acf_maybe_get_POST' ) ) :
		return intval( acf_maybe_get_POST( 'post_id' ) );
	else :
		global $post;
		return $post->ID;
	endif;
}


function save_id( $post_id, $post, $update ) {

$post_type = get_post_type($post_id);
    if (( "classified_list" != $post_type ) && (!empty(get_post_meta($post_id, 'post_id', true))) ) return;

    $id_un = round(microtime(true));
    update_post_meta( $post_id, 'post_id', '11'.$id_un );

}
add_action( 'wp_insert_post', 'save_id', 10, 3 );


add_filter( 'gform_require_login_pre_download', 'protect_gf_uploads', 10, 3 );

function protect_gf_uploads($require_login, $form_id, $field_id) {
	return true;
}





function true_status_custom(){
	register_post_status( 'archive', array(
		'label'                     => 'Archive',
		'label_count'               => _n_noop( 'Archive <span class="count">(%s)</span>', 'Archives <span class="count">(%s)</span>' ),
		'public'                    => true,
		'show_in_admin_status_list' => true
	) );
}
add_action( 'init', 'true_status_custom' );


function true_append_post_status_list(){
	global $post;
	$optionselected = '';
 	$statusname = '';
	// if( $post->post_type == 'classified_list' ){
		if($post->post_status == 'archive'){
			$optionselected = ' selected="selected"';
			$statusname = "$('#post-status-display').text('Archived');";
		}
		echo "<script>
		jQuery(function($){
			$('select#post_status').append('<option value=\"archive\"$optionselected>Archive</option>');
			$statusname
		});
		</script>";
	// }
}
add_action('admin_footer-post-new.php', 'true_append_post_status_list');
add_action('admin_footer-post.php', 'true_append_post_status_list');


function true_status_display( $statuses ) {
	global $post;
	if( $post && get_query_var( 'post_status' ) != 'archive' ){
		if($post->post_status == 'archive'){
			return array('Archive');
		}
	}
	return $statuses;
}
add_filter( 'display_post_states', 'true_status_display' );
add_action('admin_footer-edit.php','true_add_status');
 
function true_add_status() {
	echo "<script>
	jQuery(document).ready( function($) {
		$( 'select[name=\"_status\"]' ).append( '<option value=\"archive\">Archive</option>' );
	});
	</script>";
}





add_action( 'change_post_status_to_archive', 'cron_postStatus' );

function cron_postStatus() {

    // archive news publish posts
    $published_news_posts = new WP_Query(array(
        'posts_per_page'    => -1,
        'post_type'         => 'post',
        'meta_key'          => 'date_to_archive',
        'post_status'       => 'publish'
    ));

    // var_dump($published_news_posts);
    
    while($published_news_posts->have_posts()) {
        $published_news_posts->the_post();
        $posting_end_dates = get_post_meta(get_the_ID(), 'date_to_archive', true);
        $now = new DateTime();
        if(!empty($posting_end_dates)) {
            $dt = new DateTime($posting_end_dates);
            if($now > $dt) {
                wp_update_post( array(
                    'ID' => get_the_ID(),
                    'post_status' => 'archive'
                ));
            }
        }
    }
    wp_reset_postdata();
    
    // archive classified publish posts
    $published_posts = new WP_Query(array(
        'posts_per_page'    => -1,
        'post_type'         => 'classified_list',
        'meta_key'          => 'posting_end_dates',
        'post_status'       => 'publish'
    ));
    
    while($published_posts->have_posts()) {
        $published_posts->the_post();
        $posting_end_dates = get_post_meta(get_the_ID(), 'posting_end_dates', true);
        $now = new DateTime();
        if(!empty($posting_end_dates)) {
            $dt = new DateTime($posting_end_dates);
            if($now > $dt) {
                wp_update_post( array(
                    'ID' => get_the_ID(),
                    'post_status' => 'archive'
                ));
            }
        }
    }
    wp_reset_postdata();


    // publish classified futere posts
    $unpublished_posts = new WP_Query(array(
        'posts_per_page'    => -1,
        'post_type'         => 'classified_list',
        'meta_key'          => 'posting_start_date',
        'post_status'       => 'future'
    ));
    
    while($unpublished_posts->have_posts()) {
        $unpublished_posts->the_post();
        $posting_start_date = get_post_meta(get_the_ID(), 'posting_start_date', true);
        $now = new DateTime();
        if(!empty($posting_start_date)) {
            $dt = new DateTime($posting_start_date);
            if($now > $dt) {
                wp_update_post( array(
                    'ID' => get_the_ID(),
                    'post_status' => 'publish'
                ));
            }
        }
    }
    wp_reset_postdata();
}


// admin menu separator styles
add_action('admin_head', 'admin_css');
function admin_css() {
  echo '<style>
    #adminmenu {background-color: #032c47;}
    #adminmenu li.wp-menu-separator {
        border-top: 2px solid #02070c;
        border-bottom: 1px solid #154e79;
        height: 0;
        margin: 9px 0;
    }

    table.fixed.gf_entries {
        table-layout: auto;
    }
    .gf_entries th {
        white-space: nowrap; 
    }
    .gf_entries td[data-colname="Phone"] {
        white-space: nowrap; 
    }
    .gf_entries td[data-colname="First Name"] {
        min-width: 123px;
    }
        
  </style>';
}

// Function to change "posts" to "news" in the admin side menu
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News Articles';
    $submenu['edit.php'][5][0] = 'News Articles';
    $submenu['edit.php'][10][0] = 'Add News Article';
    $submenu['edit.php'][16][0] = 'Tags';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );
// Function to change post object labels to "news"
function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News Articles';
    $labels->singular_name = 'News Article';
    $labels->add_new = 'Add News Article';
    $labels->add_new_item = 'Add News Article';
    $labels->edit_item = 'Edit News Article';
    $labels->new_item = 'News Article';
    $labels->view_item = 'View News Article';
    $labels->search_items = 'Search News Articles';
    $labels->not_found = 'No News Articles found';
    $labels->not_found_in_trash = 'No News Articles found in Trash';
}
add_action( 'init', 'change_post_object_label' );


/**
 * Activates the 'menu_order' filter and then hooks into 'menu_order'
 */
add_filter('custom_menu_order', function() { return true; });
add_filter('menu_order', 'my_new_admin_menu_order');
/**
 * Filters WordPress' default menu order
 */
function my_new_admin_menu_order( $menu_order ) {
  // define your new desired menu positions here
  // for example, move 'upload.php' to position #9 and built-in pages to position #1
  $new_positions = array(
    'separator' => 3,
    'edit.php?post_type=page' => 4,
    'edit.php' => 4,
    'separator2' => 16,
    'options-general.php' => 17,
    'upload.php' => 18,
    'edit-comments.php' => 18,
    'separator-last' => 28,
    'wsal-auditlog' => 99,
    'jetpack' => 99,
  );
  // helper function to move an element inside an array
  function move_element(&$array, $a, $b) {
    $out = array_splice($array, $a, 1);
    array_splice($array, $b, 0, $out);
  }
  // traverse through the new positions and move 
  // the items if found in the original menu_positions
  foreach( $new_positions as $value => $new_index ) {
    if( $current_index = array_search( $value, $menu_order ) ) {
      move_element($menu_order, $current_index, $new_index);
    }
  }
  return $menu_order;
};

add_filter( 'gform_menu_position', 'my_gform_menu_position' );
function my_gform_menu_position( $position ) {
    return 51;
}



// exclude archive posts from global query

function custom_get_posts( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;
        
    if ( $query->is_main_query() && !$query->is_page() ) {
        $query->set( 'post_status', array('publish') );
    }
}
add_action( 'pre_get_posts', 'custom_get_posts', 1 );


function custom_wp_check_filetype_and_ext($filetype_and_ext, $file, $filename) {
    if(!$filetype_and_ext['ext'] || !$filetype_and_ext['type'] || !$filetype_and_ext['proper_filename']) {
         $extension = pathinfo($filename)['extension'];
         $mime_type = mime_content_type($file);
         $allowed_ext = array(
             'eps' => array('application/postscript', 'image/x-eps'),
             'ai' => array('application/postscript'),
         );
         if($allowed_ext[$extension]) {
             if(in_array($mime_type, $allowed_ext[$extension])) {
                 $filetype_and_ext['ext'] = $extension;
                 $filetype_and_ext['type'] = $mime_type;
                 $filetype_and_ext['proper_filename'] = $filename;
             }
         }
     }
     return $filetype_and_ext;
 }
 
 /** **/
 add_filter('wp_check_filetype_and_ext', 'custom_wp_check_filetype_and_ext', 5, 5);


 add_filter( 'admin_bar_menu', 'replace_wordpress_howdy', 25 );
function replace_wordpress_howdy( $wp_admin_bar ) {
    $my_account = $wp_admin_bar->get_node('my-account');
    $newtext = str_replace( 'Howdy,', 'Welcome,', $my_account->title );
    $wp_admin_bar->add_node( array(
    'id' => 'my-account',
    'title' => $newtext,
    ) );
}

function add_footer_txt () {
    echo '©2021 Iowa League of Cities';
}
add_filter('admin_footer_text', 'add_footer_txt');

add_filter( 'gform_submit_button', 'add_onclick', 10, 2 );
function add_onclick( $button, $form ) {
    $dom = new DOMDocument();
    $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $onclick = $input->getAttribute( 'onclick' );
    $onclick .= "jQuery(this).val('Sending'); jQuery(this).addClass('loader'); jQuery(this).submit();";
    $input->setAttribute( 'onclick', $onclick );
    return $dom->saveHtml( $input );
}


/* Meta Titles of Services and Cities */
function change_wp_title( $title_parts ) {
    $service = get_query_var( 'service' );
    $city = get_query_var( 'city' );
    $org = '';

    if ( $service ) { 
        global $wpdb;
        $services = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}service_new WHERE `ID` = {$service}", OBJECT );
        $org = $services[0]->Organization;
    }
    if ( $city ) { 
        global $wpdb;
        $city = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}city WHERE `ID` = {$city}", OBJECT );
        $org = $city[0]->Organization;
    }

    $title_parts['title'] = $org . " Details page";

    return $title_parts;
}

add_filter('document_title_parts', 'change_wp_title', 10);
