<?php

/**
 * Gravity Wiz // Gravity Forms // Disable Auto-complete
 *
 * Disable browser auto-complete.
 *
 * @version 0.3
 * @license GPL-2.0+
 * @link    http://gravitywiz.com
 */
// Disable auto-complete on form.
add_filter( 'gform_form_tag', function( $form_tag ) {
	// $autocomplete = gw_get_browser_name( $_SERVER['HTTP_USER_AGENT'] ) === 'Chrome' ? 'password' : 'off';
	return str_replace( '>', ' autocomplete="off">', $form_tag );
}, 11 );

// Diable auto-complete on each field.
add_filter( 'gform_field_content', function( $input ) {
	// $autocomplete = gw_get_browser_name( $_SERVER['HTTP_USER_AGENT'] ) === 'Chrome' ? 'password' : 'off';
	return preg_replace( '/<(input|textarea)/', '<${1} autocomplete="off" ', $input );
}, 11 );

// if ( ! function_exists( 'gw_get_browser_name' ) ) {
// 	function gw_get_browser_name( $user_agent ) {
// 		if ( strpos( $user_agent, 'Opera' ) || strpos( $user_agent, 'OPR/' ) ) {
// 			return 'Opera';
// 		} elseif ( strpos( $user_agent, 'Edge' ) ) {
// 			return 'Edge';
// 		} elseif ( strpos( $user_agent, 'Chrome' ) ) {
// 			return 'Chrome';
// 		} elseif ( strpos( $user_agent, 'Safari' ) ) {
// 			return 'Safari';
// 		} elseif ( strpos( $user_agent, 'Firefox' ) ) {
// 			return 'Firefox';
// 		} elseif ( strpos( $user_agent, 'MSIE' ) || strpos( $user_agent, 'Trident/7' ) ) {
// 			return 'Internet Explorer';
// 		}

// 		return 'Other';
// 	}
// }








// Add Participant
// Adjust your form ID
add_filter( 'gform_form_post_get_meta_10', 'add_participant_field' );
function add_participant_field( $form ) {
 

    // Create a Single Line text field for the item name
    $name = GF_Fields::create( array(
        'type'   => 'text',
        'id'     => 1002, // The Field ID must be unique on the form
        'formId' => $form['id'],
        'label'  => 'Name and Dietary needs',
        'pageNumber'  => 1, // Ensure this is correct
    ) );
 
    // Create an email field for the item email address
    // $email = GF_Fields::create( array(
    //     'type'   => 'email',
    //     'id'     => 1001, // The Field ID must be unique on the form
    //     'formId' => $form['id'],
    //     'label'  => 'Email',
    //     'pageNumber'  => 1, // Ensure this is correct
    // ) );
 
    // Create a repeater for the item and add the name and email fields as the fields to display inside the repeater.
    $participant = GF_Fields::create( array(
        'type'             => 'repeater',
        // 'description'      => 'Maximum of 3 item  - set by the maxItems property',
        'id'               => 1000, // The Field ID must be unique on the form
        'formId'           => $form['id'],
        'label'            => 'Participants',
        'addButtonText'    => 'Add Participant', // Optional
        'removeButtonText' => 'Remove', // Optional
        // 'maxItems'         => 3, // Optional
        'pageNumber'       => 1, // Ensure this is correct
        'fields'           => array( $name ), // Add the fields here.
    ) );
    
    array_splice( $form['fields'], 6, 0, array( $participant ) );
    
    return $form;
}
 
// Remove the field before the form is saved. Adjust your form ID
add_filter( 'gform_form_update_meta_10', 'remove_participant_field', 10, 3 );
function remove_participant_field( $form_meta, $form_id, $meta_name ) {
    if ( $meta_name == 'display_meta' ) {
        $form_meta['fields'] = wp_list_filter( $form_meta['fields'], array( 'id' => 1000 ), 'NOT' );
    }
    return $form_meta;
}



// Step 3: Suggested Speaker(s)
// Adjust your form ID
add_filter( 'gform_form_post_get_meta_11', 'add_speaker_field' );
function add_speaker_field( $form ) {
 
    $name = GF_Fields::create( array(
        'type'   => 'name',
        'id'     => 2001,
        'formId' => $form['id'],
        'label'  => '',
        'pageNumber'  => 1,
        'customLabel' => 'fistttt',
        'first' => 'first name',
        'last' => 'last name',
        'subLabelPlacement' => 'above',
        'inputs' => array(
            array(
                'id'          => '2001.3',
                'customLabel' => 'First Name',
              ),
            array(
                'id'          => '2001.6',
                'customLabel' => 'Last Name',
              ),
            )
        ) );

    $organization = GF_Fields::create( array(
        'type'   => 'text',
        'id'     => 2002,
        'formId' => $form['id'],
        'label'  => 'Organization',
        'pageNumber'  => 1,
    ) );
 
    $email = GF_Fields::create( array(
        'type'   => 'email',
        'id'     => 2003,
        'formId' => $form['id'],
        'label'  => 'Email',
        'pageNumber'  => 1,
    ) );
    
    $phone = GF_Fields::create( array(
        'type'   => 'phone',
        'id'     => 2004,
        'formId' => $form['id'],
        'label'  => 'Phone Number',
        'pageNumber'  => 1,
        'placeholder' => '(_ _ _) _ _ _ - _ _ _ _',
        'cssClass' => 'input-phone',
        'phoneFormat' => 'international',

    ) );
 
    $speaker = GF_Fields::create( array(
        'type'             => 'repeater',
        // 'description'      => 'Maximum of 3 item  - set by the maxItems property',
        'id'               => 2000, // The Field ID must be unique on the form
        'formId'           => $form['id'],
        'label'            => 'Speakers',
        'addButtonText'    => 'Add another speaker', // Optional
        'removeButtonText' => 'Remove', // Optional
        // 'maxItems'         => 3, // Optional
        'pageNumber'       => 1, // Ensure this is correct
        'fields'           => array( $name, $organization, $email, $phone ), // Add the fields here.
        'conditionalLogic' => array(
            'actionType' => 'show',
            'logicType'  => 'all',
            'rules'      => array(
                array(
                    'fieldId'  => 73,
                    'operator' => 'is',
                    'value'    => 'Yes',
                ),
            )
        ),
    ) );
 
    $form['fields'][] = $speaker;
    
    // array_splice( $form['fields'], 6, 0, array( $participant ) );
    
    return $form;
}
 
// Remove the field before the form is saved. Adjust your form ID
add_filter( 'gform_form_update_meta_11', 'remove_speaker_field', 10, 3 );
function remove_speaker_field( $form_meta, $form_id, $meta_name ) {
    if ( $meta_name == 'display_meta' ) {
        $form_meta['fields'] = wp_list_filter( $form_meta['fields'], array( 'id' => 2000 ), 'NOT' );
    }
    return $form_meta;
}



// Step 3: Local Caterers
// Adjust your form ID
add_filter( 'gform_form_post_get_meta_12', 'add_caterers_field' );
function add_caterers_field( $form ) {

    $choices = array(
        array(
            'text' => 'Iowa',
            'value' => 'Iowa',
            'isSelected' => true
        ),
        array(
            'text' => '──────────',
            'value' => '--',
            'isSelected' => false,
        ),
        array(
            'text' => 'Alabama',
            'value' => 'Alabama',
            'isSelected' => false,
        ),
        array(
            'text' => 'Alaska',
            'value' => 'Alaska',
            'isSelected' => false,
        ),
        array(
            'text' => 'Arizona',
            'value' => 'Arizona',
            'isSelected' => false,
        ),
        array(
            'text' => 'Arkansas',
            'value' => 'Arkansas',
            'isSelected' => false,
        ),
        array(
            'text' => 'California',
            'value' => 'California',
            'isSelected' => false,
        ),
        array(
            'text' => 'Colorado',
            'value' => 'Colorado',
            'isSelected' => false,
        ),
        array(
            'text' => 'Connecticut',
            'value' => 'Connecticut',
            'isSelected' => false,
        ),
        array(
            'text' => 'Delaware',
            'value' => 'Delaware',
            'isSelected' => false,
        ),
        array(
            'text' => 'District of Columbia',
            'value' => 'District of Columbia',
            'isSelected' => false,
        ),
        array(
            'text' => 'Florida',
            'value' => 'Florida',
            'isSelected' => false,
        ),
        array(
            'text' => 'Georgia',
            'value' => 'Georgia',
            'isSelected' => false,
        ),
        array(
            'text' => 'Hawaii',
            'value' => 'Hawaii',
            'isSelected' => false,
        ),
        array(
            'text' => 'Idaho',
            'value' => 'Idaho',
            'isSelected' => false,
        ),
        array(
            'text' => 'Illinois',
            'value' => 'Illinois',
            'isSelected' => false,
        ),
        array(
            'text' => 'Indiana',
            'value' => 'Indiana',
            'isSelected' => false,
        ),
        
        array(
            'text' => 'Kansas',
            'value' => 'Kansas',
            'isSelected' => false,
        ),
        array(
            'text' => 'Kentucky',
            'value' => 'Kentucky',
            'isSelected' => false,
        ),
        array(
            'text' => 'Louisiana',
            'value' => 'Louisiana',
            'isSelected' => false,
        ),
        array(
            'text' => 'Maine',
            'value' => 'Maine',
            'isSelected' => false,
        ),
        array(
            'text' => 'Maryland',
            'value' => 'Maryland',
            'isSelected' => false,
        ),
        array(
            'text' => 'Massachusetts',
            'value' => 'Massachusetts',
            'isSelected' => false,
        ),
        array(
            'text' => 'Michigan',
            'value' => 'Michigan',
            'isSelected' => false,
        ),
        array(
            'text' => 'Minnesota',
            'value' => 'Minnesota',
            'isSelected' => false,
        ),
        array(
            'text' => 'Mississippi',
            'value' => 'Mississippi',
            'isSelected' => false,
        ),
        array(
            'text' => 'Missouri',
            'value' => 'Missouri',
            'isSelected' => false,
        ),
        array(
            'text' => 'Montana',
            'value' => 'Montana',
            'isSelected' => false,
        ),
        array(
            'text' => 'Nebraska',
            'value' => 'Nebraska',
            'isSelected' => false,
        ),
        array(
            'text' => 'Nevada',
            'value' => 'Nevada',
            'isSelected' => false,
        ),
        array(
            'text' => 'New Hampshire',
            'value' => 'New Hampshire',
            'isSelected' => false,
        ),
        array(
            'text' => 'New Jersey',
            'value' => 'New Jersey',
            'isSelected' => false,
        ),
        array(
            'text' => 'New Mexico',
            'value' => 'New Mexico',
            'isSelected' => false,
        ),
        array(
            'text' => 'New York',
            'value' => 'New York',
            'isSelected' => false,
        ),
        array(
            'text' => 'North Carolina',
            'value' => 'North Carolina',
            'isSelected' => false,
        ),
        array(
            'text' => 'North Dakota',
            'value' => 'North Dakota',
            'isSelected' => false,
        ),
        array(
            'text' => 'Ohio',
            'value' => 'Ohio',
            'isSelected' => false,
        ),
        array(
            'text' => 'Oklahoma',
            'value' => 'Oklahoma',
            'isSelected' => false,
        ),
        array(
            'text' => 'Oregon',
            'value' => 'Oregon',
            'isSelected' => false,
        ),
        array(
            'text' => 'Pennsylvania',
            'value' => 'Pennsylvania',
            'isSelected' => false,
        ),
        array(
            'text' => 'Rhode Island',
            'value' => 'Rhode Island',
            'isSelected' => false,
        ),
        array(
            'text' => 'South Carolina',
            'value' => 'South Carolina',
            'isSelected' => false,
        ),
        array(
            'text' => 'South Dakota',
            'value' => 'South Dakota',
            'isSelected' => false,
        ),
        array(
            'text' => 'Tennessee',
            'value' => 'Tennessee',
            'isSelected' => false,
        ),
        array(
            'text' => 'Texas',
            'value' => 'Texas',
            'isSelected' => false,
        ),
        array(
            'text' => 'Utah',
            'value' => 'Utah',
            'isSelected' => false,
        ),
        array(
            'text' => 'Vermont',
            'value' => 'Vermont',
            'isSelected' => false,
        ),
        array(
            'text' => 'Virginia',
            'value' => 'Virginia',
            'isSelected' => false,
        ),
        array(
            'text' => 'Washington',
            'value' => 'Washington',
            'isSelected' => false,
        ),
        array(
            'text' => 'West Virginia',
            'value' => 'West Virginia',
            'isSelected' => false,
        ),
        array(
            'text' => 'Wisconsin',
            'value' => 'Wisconsin',
            'isSelected' => false,
        ),
        array(
            'text' => 'Wyoming',
            'value' => 'Wyoming',
            'isSelected' => false,
        ),
        array(
            'text' => 'Armed Forces Americas',
            'value' => 'Armed Forces Americas',
            'isSelected' => false,
        ),
        array(
            'text' => 'Armed Forces Europe',
            'value' => 'Armed Forces Europe',
            'isSelected' => false,
        ),
        array(
            'text' => 'Armed Forces Pacific',
            'value' => 'Armed Forces Pacific',
            'isSelected' => false,
        ),
    );

    $organization = GF_Fields::create( array(
        'type'   => 'text',
        'id'     => 3002,
        'formId' => $form['id'],
        'label'  => 'Organization',
        'pageNumber'  => 1,
    ) );
 
    $name = GF_Fields::create( array(
        'type'   => 'text',
        'id'     => 3003,
        'formId' => $form['id'],
        'label'  => 'Contact Name',
        'pageNumber'  => 1,
    ) );

    $email = GF_Fields::create( array(
        'type'   => 'email',
        'id'     => 3004,
        'formId' => $form['id'],
        'label'  => 'Email',
        'pageNumber'  => 1,
    ) );
    
    $phone = GF_Fields::create( array(
        'type'   => 'phone',
        'id'     => 3005,
        'formId' => $form['id'],
        'label'  => 'Phone Number',
        'pageNumber'  => 1,
        'placeholder' => '(_ _ _) _ _ _ - _ _ _ _',
        'cssClass' => 'input-phone',
        'phoneFormat' => 'international',
    ) );

    $address1 = GF_Fields::create( array(
        'type'   => 'text',
        'id'     => 3006,
        'formId' => $form['id'],
        'label'  => 'Address 1',
        'pageNumber'  => 1,
    ) );

    $address2 = GF_Fields::create( array(
        'type'   => 'text',
        'id'     => 3007,
        'formId' => $form['id'],
        'label'  => 'Address 2',
        'pageNumber'  => 1,
    ) );

    $city = GF_Fields::create( array(
        'type'   => 'text',
        'id'     => 3008,
        'formId' => $form['id'],
        'label'  => 'City',
        'pageNumber'  => 1,
        'cssClass' => 'input-3 input-city',
    ) );

    $state = GF_Fields::create( array(
        'type'   => 'select',
        'id'     => 3009,
        'formId' => $form['id'],
        'label'  => 'State',
        'pageNumber'  => 1,
        'cssClass' => 'input-3 input-state',
        'choices'  => $choices,
    ) );

    $zip = GF_Fields::create( array(
        'type'   => 'text',
        'id'     => 3010,
        'formId' => $form['id'],
        'label'  => 'Zip Code',
        'pageNumber'  => 1,
        'cssClass' => 'input-3 input-zip',
    ) );
 
    $caterers = GF_Fields::create( array(
        'type'             => 'repeater',
        // 'description'      => 'Maximum of 3 item  - set by the maxItems property',
        'id'               => 3000, // The Field ID must be unique on the form
        'formId'           => $form['id'],
        'label'            => 'Local catering service',
        'addButtonText'    => 'Add another local catering service (up to 3)', // Optional
        'removeButtonText' => 'Remove', // Optional
        'maxItems'         => 3, // Optional
        'pageNumber'       => 1, // Ensure this is correct
        'fields'           => array( $organization, $name, $email, $phone, $address1, $address2, $city, $state, $zip), // Add the fields here.
    ) );
 
    $form['fields'][] = $caterers;

    // array_splice( $form['fields'], 6, 0, array( $participant ) );
    
    return $form;
}
 
// Remove the field before the form is saved. Adjust your form ID
add_filter( 'gform_form_update_meta_12', 'remove_caterers_field', 10, 3 );
function remove_caterers_field( $form_meta, $form_id, $meta_name ) {
    if ( $meta_name == 'display_meta' ) {
        $form_meta['fields'] = wp_list_filter( $form_meta['fields'], array( 'id' => 3000 ), 'NOT' );
    }
    return $form_meta;
}




add_action('acf/render_field_settings/type=text', 'add_readonly_and_disabled_to_text_field');
add_action('acf/render_field_settings/type=date_picker', 'add_readonly_and_disabled_to_text_field');
  function add_readonly_and_disabled_to_text_field($field) {
    acf_render_field_setting( $field, array(
      'label'      => __('Read Only?','acf'),
      'instructions'  => '',
      'type'      => 'true_false',
      'name'      => 'readonly',
	  'ui'			=> 1,
	  'class'	  => 'acf-field-object-true-false-ui'
    ));
	  
    acf_render_field_setting( $field, array(
      'label'      => __('Disabled?','acf'),
      'instructions'  => '',
      'type'      => 'true_false',
      'name'      => 'disabled',
	  'ui'			=> 1,
	  'class'	  => 'acf-field-object-true-false-ui',
    ));
		
  }





function my_acf_prepare_field( $field ) {
    $user = wp_get_current_user();
    global $post;
    $status = get_post_status( $post->ID );
    if ( !in_array( 'administrator', (array) $user->roles ) || $status === 'publish' ) {
        $field['disabled'] = true;
    }
    return $field;
}

add_filter('acf/prepare_field/name=listing_type', 'my_acf_prepare_field');
add_filter('acf/prepare_field/name=posting_for', 'my_acf_prepare_field');
add_filter('acf/prepare_field/name=posting_start_date', 'my_acf_prepare_field');
add_filter('acf/prepare_field/name=posting_end_dates', 'my_acf_prepare_field');
add_filter('acf/prepare_field/name=posting_dates', 'my_acf_prepare_field');
add_filter('acf/prepare_field/name=pdf', 'my_acf_prepare_field');




// Add another month
// Adjust your form ID
add_filter( 'gform_form_post_get_meta_13', 'add_another_month_field' );
function add_another_month_field( $form ) {

    $choices_month = array(
        array(
            'text' => '- - Please select - -',
            'value' => '',
        ),
        array(
            'text' => 'January',
            'value' => 'January',
        ),
        array(
            'text' => 'February',
            'value' => 'February',
        ),
        array(
            'text' => 'March',
            'value' => 'March',
        ),
        array(
            'text' => 'April',
            'value' => 'April',
        ),
        array(
            'text' => 'May',
            'value' => 'May',
        ),
        array(
            'text' => 'June',
            'value' => 'June',
        ),
        array(
            'text' => 'July',
            'value' => 'July',
        ),
        array(
            'text' => 'August',
            'value' => 'August',
        ),
        array(
            'text' => 'September',
            'value' => 'September',
        ),
        array(
            'text' => 'October',
            'value' => 'October',
        ),
        array(
            'text' => 'November',
            'value' => 'November',
        ),
        array(
            'text' => 'December',
            'value' => 'December',
        ),
    );
    
    $choices_size = array(
        array(
            'text' => '- - Please select - -',
            'value' => '',
        ),
        array(
            'text' => 'Full Page - $965',
            'value' => '965',
        ),
        array(
            'text' => 'Half Page - $555',
            'value' => '555',
        ),
        array(
            'text' => 'Third Page - horizontal - $440',
            'value' => '440',
        ),
        array(
            'text' => 'Third Page - vertical - $375',
            'value' => '375',
        ),
        array(
            'text' => 'Sixth Page - $240',
            'value' => '240',
        ),
        array(
            'text' => 'Professional Square - $165',
            'value' => '165',
        ),
    );
    
    $month = GF_Fields::create( array(
        'type'   => 'select',
        'id'     => 4001,
        'formId' => $form['id'],
        'label'  => 'Insertion Month',
        'pageNumber'  => 1,
        'cssClass' => 'gf_left_half',
        'isRequired' => true,
        'noDuplicates' => true,
        'duplicate_setting' => true,
        'choices'  => $choices_month,
    ) );

    $size = GF_Fields::create( array(
        'type'   => 'select',
        'id'     => 4002,
        'formId' => $form['id'],
        'label'  => 'Ad Size',
        'pageNumber'  => 1,
        'cssClass' => 'gf_right_half',
        'isRequired' => true,
        'choices'  => $choices_size,
    ) );
    
    $hide = GF_Fields::create( array(
        'type'   => 'hidden',
        'id'     => 4100,
        'formId' => $form['id'],
        'label'  => '',
        'pageNumber'  => 1,
        'cssClass' => '',
        'defaultValue'  => '',
    ) );
    
    $add_whole = GF_Fields::create( array(
        'type'   => 'checkbox',
        'id'     => 4003,
        'formId' => $form['id'],
        'label'  => 'Add Whole Ad Link in ePub',
        'pageNumber'  => 1,
        'cssClass' => 'custom-checkbox',
        'choices' => array (
            array(
                'id'          => '4003.1',
                'text' => 'Add Whole Ad Link in ePub - $75 per insertion',
                'value' => '75',
              ),
        ),
    ) );

    // Create a repeater for the item and add the name and email fields as the fields to display inside the repeater.
    $another_month = GF_Fields::create( array(
        'type'             => 'repeater',
        // 'description'      => 'Maximum of 3 item  - set by the maxItems property',
        'id'               => 4000, // The Field ID must be unique on the form
        'formId'           => $form['id'],
        'label'            => 'Months and advertisement size',
        'addButtonText'    => 'Add another month', // Optional
        'removeButtonText' => 'Remove', // Optional
        'maxItems'         => 12, // Optional
        'pageNumber'       => 1, // Ensure this is correct
        'isRequired' => true,
        'fields'           => array( $month, $size, $add_whole, $hide ), // Add the fields here.
    ) );
    
    array_splice( $form['fields'], 7, 0, array( $another_month ) );
    
    return $form;
}

add_action("gform_after_submission_13", "acf_post_submission", 10, 2);

function acf_post_submission ($entry, $form)
{
    // var_dump('<pre>',$form['fields']);
//    $post_id = $entry["post_id"];
//    $values = get_post_custom_values("YOUR_CUSTOM_FIELD", $post_id);
//    update_field("ACF_FIELD_KEY", $values, $post_id);
}
 
// Remove the field before the form is saved. Adjust your form ID
add_filter( 'gform_form_update_meta_13', 'remove_another_month_field', 10, 3 );
function remove_another_month_field( $form_meta, $form_id, $meta_name ) {
    if ( $meta_name == 'display_meta' ) {
        $form_meta['fields'] = wp_list_filter( $form_meta['fields'], array( 'id' => 4000 ), 'NOT' );
    }
    return $form_meta;
}


// Add another cross-reference listing
// Adjust your form ID
add_filter( 'gform_form_post_get_meta_15', 'add_another_listing_field' );
function add_another_listing_field( $form ) {

    $choices = array(
        array(
            'text' => '- - Please select - -',
            'value' => ' ',
        ),
        array(
            'text' => 'Aquatic Facility Design',
            'value' => 'Aquatic Facility Design',
        ),
        array(
            'text' => 'Architectural Services',
            'value' => 'Architectural Services',
        ),
        array(
            'text' => 'Building Code Consultants',
            'value' => 'Building Code Consultants',
        ),
        array(
            'text' => 'Building Products & Services',
            'value' => 'Building Products & Services',
        ),
        array(
            'text' => 'Codification',
            'value' => 'Codification',
        ),
        array(
            'text' => 'Computer Systems & Software',
            'value' => 'Computer Systems & Software',
        ),
        array(
            'text' => 'Construction Management',
            'value' => 'Construction Management',
        ),
        array(
            'text' => 'Economic Development',
            'value' => 'Economic Development',
        ),
        array(
            'text' => 'Emergency Management',
            'value' => 'Emergency Management',
        ),
        array(
            'text' => 'Energy Services',
            'value' => 'Energy Services',
        ),
        array(
            'text' => 'Engineering',
            'value' => 'Engineering',
        ),
        array(
            'text' => 'Financial Services',
            'value' => 'Financial Services',
        ),
        array(
            'text' => 'Geographical Information Services',
            'value' => 'Geographical Information Services',
        ),
        array(
            'text' => 'Housing Assistance',
            'value' => 'Housing Assistance',
        ),
        array(
            'text' => 'Human Resources & Benefit Plans',
            'value' => 'Human Resources & Benefit Plans',
        ),
        array(
            'text' => 'Internet Services',
            'value' => 'Internet Services',
        ),
        array(
            'text' => 'Land Planning & Development',
            'value' => 'Land Planning & Development',
        ),
        array(
            'text' => 'Land/ROW Aquisition',
            'value' => 'Land/ROW Aquisition',
        ),
        array(
            'text' => 'Legal Services',
            'value' => 'Legal Services',
        ),
        array(
            'text' => 'Marketing/Comm/Fundraising',
            'value' => 'Marketing/Comm/Fundraising',
        ),
        array(
            'text' => 'Medical Case Management',
            'value' => 'Medical Case Management',
        ),
        array(
            'text' => 'Office Products',
            'value' => 'Office Products',
        ),
        array(
            'text' => 'Printing',
            'value' => 'Printing',
        ),
        array(
            'text' => 'Public Planning/Grant Writing',
            'value' => 'Public Planning/Grant Writing',
        ),
        array(
            'text' => 'Recreation & Beautification',
            'value' => 'Recreation & Beautification',
        ),
        array(
            'text' => 'Recycling',
            'value' => 'Recycling',
        ),
        array(
            'text' => 'Risk Management',
            'value' => 'Risk Management',
        ),
        array(
            'text' => 'Safety Programs',
            'value' => 'Safety Programs',
        ),
        array(
            'text' => 'Sewer & Sanitation Services',
            'value' => 'Sewer & Sanitation Services',
        ),
        array(
            'text' => 'Street Improvements',
            'value' => 'Street Improvements',
        ),
        array(
            'text' => 'Surveyors',
            'value' => 'Surveyors',
        ),
        array(
            'text' => 'Telecommunications Services',
            'value' => 'Telecommunications Services',
        ),
        array(
            'text' => 'Transportation',
            'value' => 'Transportation',
        ),
        array(
            'text' => 'Underground Equipment',
            'value' => 'Underground Equipment',
        ),
        array(
            'text' => 'Vehicles & Equipment',
            'value' => 'Vehicles & Equipment',
        ),
        array(
            'text' => 'Water Services',
            'value' => 'Water Services',
        ),
    );
    
    $listing = GF_Fields::create( array(
        'type'   => 'select',
        'id'     => 5001,
        'formId' => $form['id'],
        'label'  => 'Additional Cross-Reference LIsting',
        'pageNumber'  => 1,
        'cssClass' => '',
        'noDuplicates' => true,
        'duplicate_setting' => true,
        // 'isRequired' => true,
        'choices'  => $choices,
    ) );

    // Create a repeater for the item and add the name and email fields as the fields to display inside the repeater.
    $another_listing = GF_Fields::create( array(
        'type'             => 'repeater',
        // 'description'      => 'Maximum of 3 item  - set by the maxItems property',
        'id'               => 5000, // The Field ID must be unique on the form
        'formId'           => $form['id'],
        'label'            => 'Additional cross-reference listing',
        'addButtonText'    => 'Add another cross-reference listing', // Optional
        'removeButtonText' => 'Remove', // Optional
        // 'maxItems'         => 12, // Optional
        'pageNumber'       => 1, // Ensure this is correct
        // 'isRequired' => true,
        'fields'           => array( $listing ), // Add the fields here.
        'label_setting' => true,
    ) );
    
    array_splice( $form['fields'], 25, 0, array( $another_listing ) );
    
    return $form;
}
 
// Remove the field before the form is saved. Adjust your form ID
add_filter( 'gform_form_update_meta_15', 'remove_another_listing_field', 10, 3 );
function remove_another_listing_field( $form_meta, $form_id, $meta_name ) {
    if ( $meta_name == 'display_meta' ) {
        $form_meta['fields'] = wp_list_filter( $form_meta['fields'], array( 'id' => 5000 ), 'NOT' );
    }
    return $form_meta;
}
