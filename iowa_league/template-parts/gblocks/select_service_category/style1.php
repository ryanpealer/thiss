<?php

/**
 * Example - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/select_service_category/preview.jpg">';
else:
// Create id attribute allowing for custom "anchor" value.
$id = 'select-service-category-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-select-service-category';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values.
$data = get_fields();

if(isset($data['font_size']) && $data['font_size'] != 'default'){
    $className .= ' has-' . $data['font_size'].'-font-size';
}

$allowed_blocks = array( 'core/image', 'core/heading', 'core/paragraph', 'core/buttons' );
$template = array(
    array( 'core/paragraph', array(
        'placeholder' => 'Add a paragraph',
    ) )
);
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <style type="text/css">
        <?php if(isset($data['bg_color']) && $data['bg_color']){ ?>
      #<?php echo $id?> {
          <?php
          echo isset($data['bg_color']) && $data['bg_color'] ? 'background-color:'.$data['bg_color'].';' : '';
          echo isset($data['text_color']) && $data['text_color'] ? 'color: '.$data['text_color'].';' : '';
          ?>
      }
        <?php } ?>
    <?php if(isset($data['bg_image']['id']) && $data['bg_image']['id']){ ?>
      #<?php echo $id?> img {
          <?php
            echo isset($data['bg_size']) && $data['bg_size'] ? 'object-fit:'.$data['bg_size'].';' : '';
            echo isset($data['bg_position']) && $data['bg_position'] ? 'object-position:'.$data['bg_position'].';' : '';
           ?>
      }
      <?php } ?>
    </style>

    <?php echo isset($data['bg_image']['id']) && $data['bg_image']['id'] ? wp_get_attachment_image($data['bg_image']['id'],'full') : ''; ?>
    <div class="<?php echo isset($data['content_width']) && $data['content_width'] != 'default' ? ' '.$data['content_width'] :'' ?>">
    
    <div class="collaps open">
        <div class="collaps-header">
            <a href="#">Select a Service Category</a>
        </div>
        <div class="collaps-content">
            <div class="services-list">
            <?php 
                $terms = array(
                    'Aquatic Facility Design',
                    'Architectural Services',
                    'Building Code Consultants',
                    'Building Products & Services',
                    'Codification',
                    'Computer Systems & Software',
                    'Construction Management',
                    'Economic Development',
                    'Education',
                    'Emergency Management',
                    'Energy Services',
                    'Engineering',
                    'Financial Services',
                    'Geographical Information Services',
                    'Housing Assistance',
                    'Human Resources & Benefit Plans',
                    'Internet Services',
                    'Land Planning & Development',
                    'Land/ROW Acquisition',
                    'Legal Services',
                    'Marketing/Comm/Fundraising',
                    'Medical Case Management',
                    'Office Products',
                    'Printing',
                    'Public Planning/Grant Writing',
                    'Recreation & Beautification',
                    'Recycling',
                    'Risk Management',
                    'Safety Programs',
                    'Sewer & Sanitation Services',
                    'Street Improvements',
                    'Surveyors',
                    'Telecommunications Services',
                    'Transportation',
                    'Underground Equipment',
                    'Vehicles & Equipment',
                    'Water Services',
                );

                foreach ($terms as $term) {
                    echo '<a class="services-list__item" href=" '. get_site_url() . '/service-directory?wdt_column_filter[3]='.urlencode($term).'#table__wrapper">';
                    echo $term;
                    echo '</a>';
                }
            ?>

        </div>
        </div>
    </div>
        <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ) ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ) ?>" />
    </div>
</div>


<script type="text/javascript">
jQuery(document).on('ready',function ($) {
// jQuery(window).load(function(){
    setTimeout(function(){
    // if (jQuery('.wpDataTables').length > 0) {
    //     if (wpDataTables.table_1) {
    //         wpDataTables.table_1.addOnDrawCallback(
    //             function(){
                    jQuery('.dataTables_filter input').attr("placeholder", "Type your search here...");
                    jQuery('.DTTT_button_print span').text('Print friendly list'); 
    //             }
    //         )
    //     }
    // }
}, 1000);
// });
});
</script>
<?php endif; ?>
