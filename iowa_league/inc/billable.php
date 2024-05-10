<?php
/**  */
add_action( 'save_post_classified_list', 'billable_send_email', 999, 2 );
add_action( 'save_post', 'billable_send_email', 999, 2 );

/**  */
function billable_send_email( $post_ID, $post ) {
    /**  */
    if ( ( ! in_array( $post->post_status, [ 'publish', 'future' ] ) )
    || wp_is_post_autosave( $post_ID )
    || wp_is_post_revision( $post_ID )
    || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    || ( defined( 'REST_REQUEST' ) && REST_REQUEST )
    ) {
        return;
    }
    
    ////////// Make sure this is a billable classified
    error_log("Billable.php #1 PostID: ".$post_ID,0);
    $billabletoggle = implode(get_post_meta($post_ID, 'billable' ));
    error_log($billabletoggle, 0);
    if($billabletoggle == 0) return;


    ////////// Prevent multiple emails and added tracking of billable processed date
    $today = date("Y-m-d H:i:s");
    error_log("Billable.php #2 PostID: ".$post_ID,0);
    $prev_billable = strlen(implode(get_post_meta($post_ID, 'billable_processed_date' ))) > 0;
    if($prev_billable) return;
    error_log("Billable Processed");
    update_post_meta($post_ID, 'billable_processed_date', $today );


    require_once get_stylesheet_directory() . '/vendor/autoload.php';

    //////////

    $post_status = $post->post_status;
    $post_type = get_post_type($post_ID);
    $post_title = get_the_title( $post_ID );
    $billable = get_field( "billable" );
    $notification_will_send = get_field( 'notification_will_send' );
    $post_url = get_edit_post_link( $post_ID, '' );

    $table = 
        "<table width='99%' border='0' cellpadding='1' cellspacing='0' bgcolor='#EAEAEA'><tbody><tr><td>
            <table width='100%' border='0' cellpadding='5' cellspacing='0' bgcolor='#FFFFFF'>
                <tbody>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>First Name</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'>".get_field( "first_name", $post_ID )."</font>
                        </td>
                    </tr>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>Last Name</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'>".get_field( "last_name", $post_ID )."</font>
                        </td>
                    </tr>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>Company Name</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'>".get_field( "company_name", $post_ID )."</font>
                        </td>
                    </tr>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>Email</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'><a href='mailto:".get_field( "email", $post_ID )."' target='_blank'>".get_field( "email", $post_ID )."</a></font>
                        </td>
                    </tr>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>Phone</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'>".get_field( "phone", $post_ID )."</font>
                        </td>
                    </tr>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>What type of posting is this?</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'>".get_field( "listing_type", $post_ID )."</font>
                        </td>
                    </tr>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>Post Title</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'>".$post_title."</font>
                        </td>
                    </tr>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>Posted on behalf of...</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'>".get_field( "posting_for", $post_ID )."</font>
                        </td>
                    </tr>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>Date posting to begin</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'>".get_field( "posting_start_date", $post_ID )."</font>
                        </td>
                    </tr>
                    <tr bgcolor='#EAF2FA'>
                        <td colspan='2'>
                            <font style='font-family:sans-serif;font-size:12px'><strong>Date posting to end</strong></font>
                        </td>
                    </tr>
                    <tr bgcolor='#FFFFFF'>
                        <td width='20'>&nbsp;</td>
                        <td>
                            <font style='font-family:sans-serif;font-size:12px'>".get_field( "posting_end_dates", $post_ID )."</font>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td></tr></tbody></table><br>";
    
    $subject = 'Billable Iowa League Classified Posting [' . $post_title . ']';

    $body     = \get_field( '_billable/email_notification/body', 'option' );
    $sender   = \get_field( '_billable/email_notification/sender', 'option' );
    $receiver = \get_field( '_billable/email_notification/receiver', 'option' );
    $message  = \str_replace( 
        array( 
            '%%ENTRY_TABLE%%', 
            '%%POST_TITLE%%', 
            '%%POST_URL%%' 
        ), 
        array( 
            $table, 
            $post_title, 
            $post_url 
        ), $body );


    if ( ! $sender )
        return;

    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $sender,
    ];

    //////////

    if ($_POST['acf']['field_615ef1ecf488c'] == 1 && $_POST['acf']['field_615f05262601c'] == 1) {
        wp_mail( $receiver, $subject, $message, $headers);
    }
}

/**  */
\add_action( 'acf/init', function ()
{
    /**  */
    \acf_add_options_sub_page( [
        'page_title'  => __('ILOC :: Billable'),
        'menu_title'  => __('ILOC :: Billable'),
        'menu_slug'   => 'acf-options-iloc-billable',
        'parent_slug' => 'options-general.php',
        'capability'  => 'edit_posts',
        'redirect'    => false,
    ] );

    /**  */
    \acf_add_local_field_group( [
        'key' => 'group_iloc_billable_email_notification',
        'title' => 'Email Notification Settings',
        'fields' => [
            [
                'key'      => 'field_iloc_billable_email_notification_sender',
                'label'    => 'Sender',
                'name'     => '_billable/email_notification/sender',
                'type'     => 'text',
                'required' => 1,
                'instructions' => 'no-reply <leaguewebadmin@iowaleague.org>',
                'default_value' => 'no-reply <leaguewebadmin@iowaleague.org>',
            ], [
                'key' => 'field_iloc_billable_email_notification_receiver',
                'label' => 'Receiver',
                'name' => '_billable/email_notification/receiver',
                'type' => 'text',
                'instructions' => 'Multiple email addresses can be used, separated by commas.',
                'required' => 1,
                'default_value' => 'leaguewebadmin@iowaleague.org',
            ], [
                'key' => 'field_iloc_billable_email_notification_body',
                'label' => 'Body',
                'name' => '_billable/email_notification/body',
                'type' => 'textarea',
                'instructions' => 
                    'Use %%ENTRY_TABLE%% to insert Entry Table <br>
                    Use %%POST_TITLE%% to insert Post Title <br>
                    Use %%POST_URL%% to insert Post URL',
                'required' => 0,
                'default_value' => 'Please follow the link to view a classified post that is billable <strong>[%%POST_TITLE%%]</strong>:<br> %%POST_URL%%<br><br>%%ENTRY_TABLE%%',
                'rows' => '10',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-iloc-billable',
                ],
            ],
        ],
        'active' => true,
    ] );
} );
