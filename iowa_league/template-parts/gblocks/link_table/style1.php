<?php

/**
 * link_table - Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'link_table-style1-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-link_table-style1';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values.
$data = get_fields();

if(isset($data['section_padding']) && $data['section_padding']){
    $className .= ' section-top-pad-'.($data['section_padding']['top']);
    $className .= ' section-bot-pad-'.$data['section_padding']['bottom'];
}

if(isset($data['font_size']) && $data['font_size'] != 'default'){
    $className .= ' has-' . $data['font_size'].'-font-size';
}

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
    <div class=" <?php echo isset($data['content_width']) && $data['content_width'] != 'default' ? ' '.$data['content_width'] :'' ?>">
        
    <?php
    $table = get_fields(maybe_editor_post_id());
    
    // var_dump('<pre>',$table);
    // var_dump('<pre>',maybe_editor_post_id());
    if ( function_exists( 'get_field' ) ) {
        
        $pid = get_post(get_the_ID());
        if ( has_blocks( $pid->post_content ) ) {
            $blocks = parse_blocks( $pid->post_content );
            foreach ( $blocks as $block ) {
                if ( $block['blockName'] === 'acf/gblock-link-table' ) {
                    // Access to block data
                } elseif ( $block['blockName'] === 'core/block' ) {
                    $block_content = parse_blocks( get_post( $block['attrs']['ref'] )->post_content );
                    if ( $block_content[0]['blockName'] === 'acf/gblock-link-table' ) {
                        // Access to "some" block data
                        var_dump('adad',get_the_ID());
                    }
                }
            }
        }
    }
    
    if (!empty($table)) {
    ?>
                
        <figure class="wp-block-table is-style-stripes">
            <table>
                <thead>
                    <tr>
                        <th class="has-text-align-left" data-align="left"><?php echo !empty($table['table_header']) ? $table['table_header'] : ''; ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $links = !empty($table['add_links']) ? $table['add_links'] : '';
                    if(!empty($links)) {
                    foreach ($links as $link) {
                        ?>
                        <tr>
                            <td>
                                <?php if(!empty($link['link_text'])) { ?>
                                    <?php echo $link['link_text']?>
                                <?php } ?>
                            </td>
                            <td class="has-text-align-right">
                                <?php if(!empty($link['url'])) { ?>
                                    <a target="_blank" href="<?php echo $link['url']?>"><?php echo $link['button_label']?></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </figure>
        <?php } ?>
    </div>
</div>
