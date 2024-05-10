<?php

/**  */
function setup_city()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'city';
    $collate    = $wpdb->collate;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( "
        CREATE TABLE IF NOT EXISTS {$table_name} (
            Organization varchar(255) NULL,
            ZipCode varchar(255) NULL,
            Street1 varchar(255) NULL,
            Street2 varchar(255) NULL,
            CITY varchar(255) NOT NULL,
            `State` varchar(2) NOT NULL,
            BusinessPhone varchar(255) NULL,
            BusinessFax varchar(255) NULL,
            OfficeHours varchar(255) NULL,
            Meetings varchar(255) NULL,
            Government varchar(255) NULL,
            Population int unsigned NULL,
            County varchar(255) NULL,
            WEBSITE varchar(255) NULL,
            ID bigint(20) unsigned NOT NULL,
            CouncilSize int unsigned NULL,
            District varchar(255) NULL,
            HouseDistrict varchar(255) NULL,
            SenateDistrict varchar(255) NULL,
            PRIMARY KEY (ID)
        ) COLLATE {$collate}
    " );
}

 /**  */
function setup_person()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'person';
    $collate    = $wpdb->collate;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( "
        CREATE TABLE IF NOT EXISTS {$table_name} (
            ID bigint(20) unsigned NOT NULL,
            Person_ID bigint(20) unsigned NOT NULL,
            `Role` varchar(255) NULL,
            FirstName varchar(255) NULL,
            MiddleName varchar(255) NULL,
            LastName varchar(255) NULL,
            TITLE varchar(255) NULL,
            EMAIL varchar(255) NULL,
            Phone varchar(255) NULL,
            FAX varchar(255) NULL,
            Street1 varchar(255) NULL,
            Street2 varchar(255) NULL,
            CITY varchar(255) NULL,
            `State` varchar(255) NULL,
            Zipcode varchar(255) NULL,
            DirectoryDisplay tinyint unsigned NULL,
            PRIMARY KEY (ID, Person_ID)
        ) COLLATE {$collate}
    " );
}

function setup_service()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'service';
    $collate    = $wpdb->collate;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( "
        CREATE TABLE {$table_name} (
            ID bigint(20) unsigned NOT NULL,
            Organization varchar(255) NULL,
            Category varchar(255) NULL,
            AssociateSecondaryCatgPrint varchar(255) NULL,
            RoleID int unsigned NULL,
            PersonRole varchar(255) NULL,
            GroupType varchar(255) NULL,
            FullName varchar(255) NULL,
            Street1 varchar(255) NULL,
            Street2 varchar(255) NULL,
            City varchar(255) NULL,
            `State` varchar(255) NULL,
            ZipCode varchar(255) NULL,
            BusinessPhone varchar(255) NULL,
            BusinessFax varchar(255) NULL,
            WebSite varchar(255) NULL,
            Description varchar(255) NULL,
            Email varchar(255) NULL,
            PRIMARY KEY (`ID`)
        ) COLLATE {$collate};
    " );

}

add_action( 'init', 'setup_city' );
add_action( 'init', 'setup_person' );
add_action( 'init', 'setup_service' );

/** Add Rewrite Rule */
add_action( 'init', function () {
    add_rewrite_rule( '^cities/([\d]+)$', 'index.php?city=$matches[1]', 'top' );
    add_rewrite_rule( '^services/([\d]+)$', 'index.php?service=$matches[1]', 'top' );
    flush_rewrite_rules();
} );

/** Register Variables */
add_filter( 'query_vars', function ( $vars ) {
    return \array_merge($vars, ['city', 'service']);
} );


/** Rewrite Template */
add_action( 'template_redirect', function () {

    if ( get_query_var( 'city' ) ) {
        \add_filter( 'template_include', function() {
            return get_template_directory() . '/city.php';
        });
    }

    if ( get_query_var( 'service' ) ) {
        \add_filter( 'template_include', function() {
            return get_template_directory() . '/service.php';
        });
    }

} );

