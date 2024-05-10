<?php

class __affidavit
{
    /** @var array */
    static protected $fields = [];

    /**  */
    public function __construct()
    {
        \add_action( 'acf/init', [ $this, 'acf_init' ] );
        \add_action( 'publish_classified_list', [ $this, 'publish_classified_list' ], 10, 2 );
        \add_action( 'save_post', [ $this, 'save_post' ], 10, 2 );
    }
    
    public function save_post($post_id, $post){
        /** Skip extra call if Gutenberg editor used  */
        if (defined( 'REST_REQUEST' ) && REST_REQUEST ) return;
        
        /* Fix for classifieds that are missing the attachment link for staff */
        global $wpdb;
        $attachment_id = $wpdb->get_var("SELECT DISTINCT ID FROM $wpdb->posts WHERE (post_type = 'attachment' AND post_parent = '". $post_id ."')");
        error_log("Attachement ID: ".$attachment_id, 0);
        update_post_meta($post_id, '_affidavit/notification/certificate', $attachment_id );

        /** Skip if already notified and not forced */
        $forced = implode(get_post_meta($post_id, '_affidavit/notification/force_notify' ));
        $notified = strlen(implode(get_post_meta($post_id, '_affidavit/notification/notified_date' ))) > 0;
        if($notified && $forced == 0) return;
        if($forced == 1) $this->send_notify( $post );
    }

    /**  */
    public function acf_init()
    {
        /**  */
        \acf_add_options_sub_page( [
            'page_title'  => __('ILOC :: Affidavit'),
            'menu_title'  => __('ILOC :: Affidavit'),
            'menu_slug'   => 'acf-options-iloc-affidavit',
            'parent_slug' => 'options-general.php',
            'capability'  => 'edit_posts',
            'redirect'    => false,
        ] );

        /**  */
        \acf_add_local_field_group( [
            'key' => 'group_iloc_affidavit_email_notification',
            'title' => 'Email Notification Settings',
            'fields' => [
                [
                    'key'      => 'field_iloc_affidavit_email_notification_sender',
                    'label'    => 'Sender',
                    'name'     => '_affidavit/email_notification/sender',
                    'type'     => 'text',
                    'required' => 1,
                    'placeholder' => 'no-reply <no-reply@example.com>',
                ], [
                    'key' => 'field_iloc_affidavit_email_notification_body',
                    'label' => 'Body Affidavit',
                    'name' => '_affidavit/email_notification/body',
                    'type' => 'textarea',
                    'instructions' => 'Use %%PUBLIC_URL%% to insert attached document public url',
                    'required' => 0,
                    'default_value' => 'Thank you for posting with the Iowa League of Cities. Public URL: %%PUBLIC_URL%%',
                    'rows' => '10',
                ], [
                    'key' => 'field_iloc_standard_email_notification_body',
                    'label' => 'Body Standard',
                    'name' => '_standard/email_notification/body',
                    'type' => 'textarea',
                    'instructions' => 'Use %%PUBLIC_URL%% to insert attached document public url',
                    'required' => 0,
                    'default_value' => 'Thank you for posting with the Iowa League of Cities. Public URL: %%PUBLIC_URL%%',
                    'rows' => '10',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-iloc-affidavit',
                    ],
                ],
            ],
            'active' => true,
        ] );

        /**  */
        \acf_add_local_field_group( [
            'key' => 'group_iloc_affidavit_certificate',
            'title' => 'Certificate (PDF) Settings',
            'fields' => [
                [
                    'key' => 'field_61604cd1709dd',
                    'label' => 'LOGO',
                    'name' => '_affidavit/certificate/logo',
                    'type' => 'image',
                    'required' => 1,
                    'return_format' => 'id',
                    'preview_size' => 'thumbnail',
                    'library' => 'uploadedTo',
                    'min_width' => 150,
                    'min_height' => 150,
                    'max_width' => 150,
                    'max_height' => 150,
                ], [
                    'key' => 'field_61604d01709de',
                    'label' => 'Signature',
                    'name' => '_affidavit/certificate/sign',
                    'type' => 'image',
                    'required' => 1,
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                    'library' => 'uploadedTo',
                    'min_width' => 350,
                    'min_height' => 100,
                    'max_width' => 350,
                    'max_height' => 100,
                ], [
                    'key' => 'field_61604d27709df',
                    'label' => 'Name & Title',
                    'name' => '_affidavit/certificate/name_and_title',
                    'type' => 'text',
                    'required' => 1,
                    'placeholder' => 'John Doe, Head of Department',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-iloc-affidavit',
                    ],
                ],
            ],
            'active' => true,
        ] );

        /**  */
        \acf_add_local_field_group( [
            'key' => 'group_iloc_classified',
            'title' => 'Classified',
            'fields' => [
                [
                    'key' => 'field_iloc_classified_info',
                    'label' => 'Info',
                    'name' => '',
                    'type' => 'tab',
                    'required' => 0,
                ], [
                    'key' => 'field_iloc_classified_email',
                    'label' => 'Email',
                    'name' => '_classified/email',
                    'type'  => 'text',
                ], [
                    'key' => 'field_iloc_classified_unique_id',
                    'label' => 'Unique ID',
                    'name' => 'post_id', // naming for legacy reasons
                    'type' => 'text',
                    'readonly' => 1,
                ], [
                    'key' => 'field_iloc_classified_affidavit',
                    'label' => 'Affidavit',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'listing_type',
                                'operator' => '==',
                                'value' => 'Notices',
                            ]
                        ]
                    ],
                ], [
                    'key' => 'field_affidavit_notification_certificate',
                    'label' => 'Certificate (PDF)',
                    'name' => '_affidavit/notification/certificate',
                    'type' => 'file',
                    'return_format' => 'id',
                    'library' => 'uploadedTo',
                ], [
                    'key'   => 'field_affidavit_notification_notified',
                    'label' => 'Notified ',
                    'name'  => '_affidavit/notification/notified',
                    'type'  => 'text',
                    'readonly' => 1,
                ], [
                    'key'  => 'field_affidavit_notification_force_notify',
                    'label' => 'Force Notify',
                    'name'  => '_affidavit/notification/force_notify',
                    'type'  => 'true_false',
                    'instructions' => 'Send "Email Notification" each time when classified post updated with publish status',
                    'ui' => 1,
                ]
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'classified_list',
                    ],
                ],
            ],
            'active' => true,
        ] );
    }

    /**  */
    public function publish_classified_list( $post_id, $post )
    {

        //////////
        error_log("Affidavit.php Publish Classified Triggered PostID: ".$post_id, 0);
        /** Skip extra call if Gutenberg editor used  */
        if (defined( 'REST_REQUEST' ) && REST_REQUEST ) return;

        /** Skip if already notified and not forced */
        $notified = strlen(implode(get_post_meta($post_id, '_affidavit/notification/notified_date' ))) > 0;
        if($notified) return;
        $this->send_notify( $post );
    }

    /**  */
    public function send_notify( $post )
    {
        $post_title         = $post->post_title;
        $posting_start_date = get_field( "posting_start_date", $post->ID );
        $custom_post_id     = get_field( "post_id", $post->ID);
        $pdf                = get_field( 'pdf', $post->ID );
        $listing_type       = get_field( 'listing_type', $post->ID );
        $email              = get_field( '_classified/email', $post->ID );

        //////////
        error_log("Affidavit.php Title: ".$post_title, 0);

        $sender = \get_field( '_affidavit/email_notification/sender', 'option' );

        if ( 'Notices' == \trim( $listing_type ) ) {
            $body = \get_field( '_affidavit/email_notification/body', 'option' );
        } else {
            $body = \get_field( '_standard/email_notification/body', 'option' );
        }

        if ( ! $sender )
            return;

        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $sender,
        ];

        $subject = 'Your Classified Post "'.$post_title.'" Published' /* . ( ( 'future' == $old_status ) ? ' (scheduled)' : '' ) */;
        $message = \str_replace( '%%PUBLIC_URL%%', $pdf, $body );
        //////////
        error_log("affidavit.php Message: ".$message, 0);
        $attachments = [];

        if ( 'Notices' == \trim( $listing_type ) ) {
            //////////
            error_log("Affidavit.php Type = Notice PostID: ".$post->ID, 0);
            $attachment_id = get_field( '_affidavit/notification/certificate', $post->ID );

            if ( ! $attachment_id ) {

                $mpdf = $this->_generate_pdf( [
                    'title'      => $post_title,
                    'id'         => $custom_post_id,
                    'start_date' => $posting_start_date
                ] );

                //////////

                $upload_dir = \wp_upload_dir(null, 'pdf', true);
                $filename   = $custom_post_id . 'Certificate.pdf';
                $filepath   = $upload_dir['path'] . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $filename;

                $mpdf->Output($filepath, 'F');

                $attachment_id = \wp_insert_attachment( [], $filepath, $post->ID );

                \update_field( '_affidavit/notification/certificate', $attachment_id, $post->ID );

            }

            $attachments[] = \get_attached_file( $attachment_id );
            ////////// Get the attachment for ones that need affidavit
            error_log("PDF: ".$pdf,0);
            if ( $pdf ) {

                $filename = basename( $pdf );
                $tmp = \sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename;

                if ( false !== \file_put_contents( $tmp, \file_get_contents( $pdf ) ) ) {
                    $attachments[] = $tmp;
                }

            }

        } else {

            ////////// Get the attachment for ones that don't need an affidavit AJC 02/02/2022
            error_log("Affidavit.php Type = Standard PostID: ".$post->ID, 0);
            error_log("PDF: ".$pdf,0);
            if ( $pdf ) {

                $filename = \basename( $pdf );
                $tmp = \sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename;

                if ( false !== \file_put_contents( $tmp, \file_get_contents( $pdf ) ) ) {
                    $attachments[] = $tmp;
                }

            }
         }

        if ( \wp_mail( $email, $subject, $message, $headers, $attachments ) ) {
            //////////
            error_log("Classified Email Sent",0);
            $today = date("Y-m-d H:i:s");
            update_post_meta($post->ID, '_affidavit/notification/notified_date', $today );
            update_field( '_affidavit/notification/notified', $today, $post->ID );
            isset( $tmp ) && unlink( $tmp );
        }
    }

    /**
     *
     * @param array $args
     * @return \Mpdf\Mpdf
     * @throws \Mpdf\MpdfException
     */
    protected function _generate_pdf( array $args ): \Mpdf\Mpdf
    {
        require_once get_stylesheet_directory() . '/vendor/autoload.php';

        //////////

        /** @var array $args */
        $args = \array_merge( [
            'title' => 'Undefined title',
            'id'    => '0',
            'start_date' => \date( 'm/d/Y', 0 ),
        ], $args );

        $today = \date( "m/d/Y" );

        $logo_id        = \get_field( '_affidavit/certificate/logo', 'option' );
        $sign_id        = \get_field( '_affidavit/certificate/sign', 'option' );
        $name_and_title = \get_field( '_affidavit/certificate/name_and_title', 'option' );

        //////////

        $mpdf = new \Mpdf\Mpdf();
        //$mpdf->debug = true;

        $mpdf->imageVars['logo'] = \file_get_contents(
            $logo_id ? \get_attached_file( $logo_id ) : __DIR__ . '/affidavit-logo.png' );
        $mpdf->imageVars['sign'] = \file_get_contents(
            $sign_id ? \get_attached_file( $sign_id ) : __DIR__ . '/affidavit-sign.png' );

        $mpdf->WriteHTML( '<img src="var:logo" />');
        $mpdf->WriteHTML( '<h2 style="text-align: center">CERTIFICATE</h2>' );
        $mpdf->WriteHTML( '<p>The Iowa League of Cities an entity organized under the laws of Iowa as an instrumentality of its member cities, with its principal place of business in Des Moines, Polk County, Iowa, does hereby certify that I am now and was at the time hereinafter mentioned, the duly qualified and acting Executive Director of the Iowa League of Cities, and that as such Executive Director of the League and by full authority from the Executive Board, I have caused a</p>' );
        $mpdf->WriteHTML( '<br />' );
        $mpdf->WriteHTML( '<h2 style="text-align: center">NOTICE TO BIDDERS</h2>' );
        $mpdf->WriteHTML( '<p style="text-align: center">'.$args['title'].'</p>' );
        $mpdf->WriteHTML( '<p style="text-align: center">Classified ID: '.$args['id'].'</p>' );
        $mpdf->WriteHTML( '<br />' );
        $mpdf->WriteHTML( '<p >A printed copy of which is attached and made part of this certificate, provided on '.$today.' to be posted on the Iowa League of Cities internet site on the following date:</p>' );
        $mpdf->WriteHTML( '<br />' );
        $mpdf->WriteHTML( '<p style="text-align: center"><span style="border-bottom: 1px solid black;">'.$args['start_date'].'</span></p>' );
        $mpdf->WriteHTML( '<br />' );
        $mpdf->WriteHTML( '<p>I certify under penalty of perjury and pursuant to the laws of the State of Iowa that the preceding is true and correct.</p>' );
        $mpdf->WriteHTML( '<br />' );
        $mpdf->WriteHTML( '<p><span style="border-bottom: 1px solid black;">'.$today.'</span></p>' );
        $mpdf->WriteHTML( '<img src="var:sign" />');
        $mpdf->WriteHTML( '<p>'.$name_and_title.'</p>' );

        return $mpdf;
    }
}

new __affidavit();
