<?php

/**
 * GBlock: Feaured Section
 *
 */
if (get_field('is_example')) :
    echo '<img src="'.get_template_directory_uri() . '/template-parts/gblocks/featured/preview.jpg">';
else:

$page_fields = get_fields();
//settings
$settings = isset($page_fields['settings']) ? $page_fields['settings'] : '';
$background = isset($settings['background']) ? $settings['background'] : '';
$left_side_image = isset($settings['left_side_image']) ? $settings['left_side_image'] : '';
$layout = isset($settings['layout']) ? $settings['layout'] : '';
// $highlighted_title = $settings['highlighted_title'];
// $highlighted_title2 = $settings['highlighted_title_horizontal'];
$cta_button_style = isset($settings['cta_button_style']) ? $settings['cta_button_style'] : '';
$cta_button_style != 'link-simple' ? $cta_button_style .= ' btn' : '';

$cta_button_size = isset($settings['cta_button_size']) ? $settings['cta_button_size'] : '';
$cta_button_style != 'link-simple' ? $cta_button_style .= ' ' . $cta_button_size : '';

if (isset($settings['cta_button_icon']) && !empty($settings['cta_button_icon'])) {
  $icon = $settings['cta_button_icon'];
  $cta_button_icon = $icon['sizes'][ 'large' ];
}
$use_container = isset($settings['use_container']) ? $settings['use_container'] : '';
$title_type = isset($settings['title_type']) ? $settings['title_type'] : '';
$left_side_image = isset($settings['left_side_image']) ? $settings['left_side_image'] : '';
$imageHeight = isset($settings['image_height']) ? $settings['image_height'] : '';

$title = isset($page_fields['title']) ? $page_fields['title'] : '';
$subtitle = isset($page_fields['subtitle']) ? $page_fields['subtitle'] : '';
$pretitle = isset($page_fields['pretitle']) ? $page_fields['pretitle'] : '';
$content = isset($page_fields['content']) ? $page_fields['content'] : '';
$image = isset($page_fields['image']) ? $page_fields['image'] : '';
$image_mobile = isset($page_fields['image_mobile']) ? $page_fields['image_mobile'] : '';
$cta = isset($page_fields['cta']) ? $page_fields['cta'] : '';

$use_carousel = isset($settings['use_carousel']) ? $settings['use_carousel'] : '';
$use_content_instead_of_image = isset($settings['use_content_instead_of_image']) ? $settings['use_content_instead_of_image'] : '';
$content_instead_image = isset($page_fields['content_instead_image']) ? $page_fields['content_instead_image'] : '';
$use_numbers = isset($settings['use_numbers']) ? $settings['use_numbers'] : '';
$use_list_items = isset($settings['use_list_items']) ? $settings['use_list_items'] : '';

$carousel_items = isset($page_fields['carousel_items']) ? $page_fields['carousel_items'] : '';

if($cta){
  $link_url = $page_fields['cta']['url'];
  $link_title = $page_fields['cta']['title'];
  $link_target = $page_fields['cta']['target'] ? $page_fields['cta']['target'] : '_self';
}

$titleClass = 'title';
if($subtitle):
    $titleClass .= ' with-subtitle';
endif;
// if($highlighted_title):
//     $titleClass .= ' mod-highlight-left';
// endif;
// if($highlighted_title2):
//     $titleClass .= ' mod-highlight-center';
// endif;


// Create id attribute allowing for custom "anchor" value.
$id = 'featured-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blck-featured';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( !empty($use_numbers) ) {
    $className .= ' use_numbers';
}
if( !empty($use_list_items) ) {
    $className .= ' use_list_items';
}

if(isset($page_fields['font_size']) && $page_fields['font_size'] != 'default'){
  $className .= ' has-' . $page_fields['font_size'].'-font-size';
}

if(isset($page_fields['section_padding']) && $page_fields['section_padding']){
  // if($page_fields['section_padding']['top'] != 'default'){
      $className .= ' section-top-pad-'.($page_fields['section_padding']['top']);
  // }
  // if($page_fields['section_padding']['bottom'] != 'default'){
      $className .= ' section-bot-pad-'.$page_fields['section_padding']['bottom'];
  // }
}
?>

  <style type="text/css">
    
    <?php if(isset($page_fields['bg_color']) && $page_fields['bg_color']){ ?>
      #<?php echo $id?> .block-featured {
          <?php
          echo isset($page_fields['bg_color']) && $page_fields['bg_color'] ? 'background-color:'.$page_fields['bg_color'].';' : '';
          // echo isset($page_fields['text_color']) && $page_fields['text_color'] ? 'color: '.$page_fields['text_color'].';' : '';
          ?>
      }
      <?php } ?>  
      #<?php echo $id?> .block-numbers-txt {
          <?php
          echo isset($page_fields['text_color']) && $page_fields['text_color'] ? 'color: '.$page_fields['text_color'].';' : '';
          ?>
      } 
      #<?php echo $id?> .block-numbers-txt a {
          <?php
          echo isset($page_fields['text_color']) && $page_fields['text_color'] ? 'color: '.$page_fields['text_color'].';' : '';
          ?>
      }
      <?php if(isset($settings['title_color']) && $settings['title_color']){ ?>
      #<?php echo $id?> .title {
        <?php
        echo isset($settings['title_color']) && $settings['title_color'] ? 'color: '.$settings['title_color'].';' : '';
          ?>
      }

        <?php } ?>

  </style>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <?php if($use_container): ?>
  <div class="block-featured-container container">
  <?php endif; ?>
  <div class="block-featured mod-<?php echo $layout; ?><?php if($left_side_image):?> mod-l-img<?php endif;?><?php /* if($highlighted_title2){ echo ' js-mouse-enter'; } */ ?><?php if($imageHeight != 'normal' && !empty($image)){ echo ' image-'.$imageHeight; } ?><?php if($use_container != true){ echo ' alignfull';} ?>" <?php if( !empty( $background ) ): ?>style="background: <?php echo $background; ?>;"<?php endif; ?>>
    <div class="block-featured-col">
      <div class="block-featured--content <?php /* if($use_container): ?>no-paddings<?php endif; */?>">

        <?php if ( isset($pretitle) && ! empty($pretitle) ): ?>          
            <p class="pretitle"><?php echo $pretitle; ?></p>
          <?php endif; ?>

          <?php if ( isset($title) && ! empty($title) ): ?>

            <?php if($cta): ?>
              <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" >
            <?php endif; ?> 

            <?php if ($title_type): ?>
              <?php if($title_type == 'h1'): ?>
                <h1 class="h1 <?php echo $titleClass; ?>">
              <?php elseif($title_type == 'display1'): ?>
                <h1 class="display1 <?php echo $titleClass; ?>">
              <?php elseif($title_type == 'display2'): ?>
                <h1 class="display2 <?php echo $titleClass; ?>">
              <?php elseif($title_type == 'display3'): ?>
                <h1 class="display3 <?php echo $titleClass; ?>">
              <?php elseif($title_type == 'h2'): ?>
                <h2 class="h2 <?php echo $titleClass; ?>">
              <?php elseif($title_type == 'h4'): ?>
                <h4 class="h4 <?php echo $titleClass; ?>">
              <?php elseif($title_type == 'h5'): ?>
                <h5 class="h5 <?php echo $titleClass; ?>">
                <?php elseif($title_type == 'strong'): ?>
                <strong class=" <?php echo $titleClass; ?>">
              <?php else: ?>
                <h3 class="h3 <?php echo $titleClass; ?>">
              <?php endif; ?>
                <?php echo do_shortcode($title); ?>
              <?php if($title_type == 'h1' || $title_type == 'display2' || $title_type == 'display2' || $title_type == 'display3'): ?>
                </h1>
              <?php elseif($title_type == 'h2'): ?>
                </h2>
              <?php elseif($title_type == 'h2'): ?>
                </h2>
              <?php elseif($title_type == 'h2'): ?>
                </h2>
              <?php elseif($title_type == 'h4'): ?>
                </h4>
              <?php elseif($title_type == 'h5'): ?>
                </h5>
              <?php elseif($title_type == 'strong'): ?>
              </strong>
              <?php else: ?>
                </h3>
              <?php endif; ?>
            <?php endif; ?>

            <?php if($cta): ?>
              </a>
            <?php endif; ?> 

          <?php endif; ?>        
          <?php if ( isset($subtitle) && ! empty($subtitle) ): ?>          
            <p class="subtitle"><strong><?php echo $subtitle; ?></strong></p>
          <?php endif; ?>
          <?php if ($use_numbers) { 
            $numbers_items = isset($page_fields['numbers_items']) ? $page_fields['numbers_items'] : '';
          ?>
            <div id="circles">
              <?php 
                foreach ($numbers_items as $item) { 
                  
                  $percentage = isset($item['percentage']) ? $item['percentage'] : '';
                  $text = isset($item['text']) ? $item['text'] : '';
                  $item_link = isset($item['link']) ? $item['link'] : '';
                  $item_link_url = isset($item['link']['url']) ? $item['link']['url'] : '';
                  $item_link_title = isset($item['link']['title']) ? $item['link']['title'] : '';
                  $item_link_target = isset($item['link']['target']) ? $item['link']['target'] : '';

                  $per = ((100 - $percentage) * 2.15);
              ?>
                <div class="item">
                  <div class="col col--circle">
                    <div class="percent"><span data-purecounter-start="0" data-purecounter-end="<?php echo $percentage; ?>" class="purecounter">0</span><sup>%</sup></div>
                    <svg class="circle" width="160" height="160" viewPort="0 0 160 160" version="1.1" xmlns="http://www.w3.org/2000/svg">
                      <circle class="circle__in" r="72" cx="80" cy="80"  stroke-dashoffset="<?php echo $per?>%"></circle>
                    </svg>
                  </div>
                  <div class="col">
                  <?php echo $text; ?>
                  <?php 
                    echo '<a class="btn-link btn-arrow" href="' . $item_link_url . '" title="' . $item_link_title . '" target="' . $item_link_target . '">' . $item_link_title . '</a>';
                    ?>

                  </div>
                </div>
              <?php } ?>
            </div>
          <?php } elseif ($use_list_items) { 
            $list_items = isset($page_fields['list_items']) ? $page_fields['list_items'] : '';
          ?>
            <div class="list-items">
              <?php 
                foreach ($list_items as $item) { 
                  
                  $title = isset($item['title']) ? $item['title'] : '';
                  $text = isset($item['text']) ? $item['text'] : '';
                  $item_link = isset($item['link']) ? $item['link'] : '';
                  $item_link_url = isset($item['link']['url']) ? $item['link']['url'] : '';
                  $item_link_title = isset($item['link']['title']) ? $item['link']['title'] : '';
                  $item_link_target = isset($item['link']['target']) ? $item['link']['target'] : '';

              ?>
                <div class="item">
                  <h6 class="item__title"><?php echo $title; ?></h6>
                  <div class="item__txt">
                    <?php echo $text; ?>
                  </div>
                  <?php 
                    echo '<a class="btn-link btn-arrow" href="' . $item_link_url . '" title="' . $item_link_title . '" target="' . $item_link_target . '">' . $item_link_title . '</a>';
                    ?>
                </div>
              <?php } ?>
            </div>
          <?php } else { ?>
            <?php if ( isset($content) && ! empty($content) ): ?>          
              <?php echo do_shortcode($content); ?>
            <?php endif; ?>
          <?php } ?>
          <?php if($cta && !$use_content_instead_of_image ): ?>
                  <a href="<?php echo esc_url( $link_url ); ?>" title="<?php echo esc_attr( $link_title ); ?>" class="link <?php if ( isset($cta_button_style) && ! empty($cta_button_style) ): ?><?php echo $cta_button_style; ?><?php endif;?> <?php if ( isset($cta_button_icon) && ! empty($cta_button_icon) ): ?><?php echo ' with-icon' ?><?php endif;?>" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?> <?php if ( isset($cta_button_icon) && ! empty($cta_button_icon) ): ?><img src="<?php echo $cta_button_icon; ?>" alt=""><?php endif;?></span></a>
            <?php endif; ?> 
      </div>
    </div>
    <?php if( $use_carousel ) { ?>
    <div class="block-featured-col">
      <div class="carousel-featured js-carousel-featured">
      <?php 
      foreach ($carousel_items as $item) { ?>
          <?php 
            echo('<div><img src="' . $item['image']['url'] . '" alt="' . $item['image']['alt'] . '" /></span>');
          ?>
        </div>
      <?php } ?>
      
    <?php } elseif ($use_content_instead_of_image) { ?>
      <div class="block-featured-col">
        <div class="block-numbers-txt">
          <?php echo ($content_instead_image); ?>
          <?php if($cta && $use_content_instead_of_image ): ?>
                <a href="<?php echo esc_url( $link_url ); ?>" title="<?php echo esc_attr( $link_title ); ?>" class="link <?php if ( isset($cta_button_style) && ! empty($cta_button_style) ): ?><?php echo $cta_button_style; ?><?php endif;?> <?php if ( isset($cta_button_icon) && ! empty($cta_button_icon) ): ?><?php echo ' with-icon' ?><?php endif;?>" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?> <?php if ( isset($cta_button_icon) && ! empty($cta_button_icon) ): ?><img src="<?php echo $cta_button_icon; ?>" alt=""><?php endif;?></span></a>
          <?php endif; ?> 
        </div>
      </div>
    <?php } else { ?>
      <?php if( !empty( $image ) ): ?>
        <div class="block-featured-col">
          <div class="desktop">
            <?php if($cta): ?>
            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" >
            <?php endif; ?> 
              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php if($cta): ?>
            </a>
            <?php endif; ?>
          </div>
          <?php 
          if ($image_mobile) {
            $url = $image_mobile['url'] ? $image_mobile['url'] : $image['url'];
            $alt = $image_mobile['alt'] ? $image_mobile['alt'] : $image['alt'];
          ?>
          <div class="mobile">
            <?php if($cta): ?>
            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" >
            <?php endif; ?> 
              <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>" />
            <?php if($cta): ?>
            </a>
            <?php endif; ?>
          </div>
          <?php } ?>
        </div>
      <?php endif; ?>
    <?php } ?>
    </div>
    <!-- </div> -->
  <?php if($use_container): ?>
  </div> 
  <?php endif; ?>
</div>
    <?php endif; ?>