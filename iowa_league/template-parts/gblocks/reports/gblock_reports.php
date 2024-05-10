<?php

/**
 * GBlock: Report List Section
 *
 */

$page_fields = get_fields();
$title = $page_fields['title'];
$content = $page_fields['content'];
$cta = $page_fields['cta'];
$settings = $page_fields['settings'];
$h_title = $settings['highlighted_title'];
$list_item_limit = $settings['list_item_limit'];
$select_reports = get_field('report_item', 'option');

?>

<div class="blck-report">
  <div class="container">
    <div class="report-head">
      <?php if ( isset($title) && ! empty($title) ): ?>
        <h2 class="title <?php if($h_title):?> mod-highlight<?php endif;?>"><?php echo do_shortcode($title); ?></h2>
      <?php endif; ?>
      <?php if($cta):
              $link_url = $page_fields['cta']['url'];
              $link_title = $page_fields['cta']['title'];
              $link_target = $page_fields['cta']['target'] ? $page_fields['cta']['target'] : '_self';
              ?>
              <div class="text-center"><a href="<?php echo esc_url( $link_url ); ?>" class="simple-link" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?></span></a></div>
        <?php endif; ?>
    </div> 
    <?php if ( isset($content) && ! empty($content) ): ?>          
    <div class="report-content">     
      <?php echo do_shortcode($content); ?>
    </div>
    <?php endif; ?> 
    <?php

    $j = $list_item_limit;
    if( $select_reports ):
      $i=1; 
      if($j == 0) {
        $j = 9999;
      }
    ?>
    <div class="report-list">
      
        <?php foreach( $select_reports as $report ): 
            $r_year = $report['year'];
            $quaters = $report['quaters'];
            $annual_report = $report['annual_report_'];
            $financial_statement = $report['financial_statement'];
            $form_990 = $report['form_990'];
            ?>
            <?php  ?>
            <div class="report-list--item">

                  <div class="col">
                    <strong><?php echo $r_year; ?></strong>
                  </div>
                  <div class="col">
                    <?php if($quaters): ?>
                    <ul>
                      <?php foreach( $quaters as $quater ): 
                        $file = $quater['file'];
                        $label = $quater['label'];
                      ?>
                    <?php if($file): ?>
                      <li>
                        <a href="<?php echo $file['url']; ?>">
                          <?php if($label): ?><?php echo $label; ?><?php else: ?><?php echo $file['title']; ?><?php endif; ?>
                        </a>
                      </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                  </div>
                  <div class="col">
                  <?php if($annual_report): ?>
                    <?php
                      $file = $annual_report['file'];
                      $label = $annual_report['label'];
                    ?>
                    <?php if($file): ?>                     
                        <a href="<?php echo $file['url']; ?>">
                          <?php if($label): ?><?php echo $label; ?><?php else: ?><?php echo $file['title']; ?><?php endif; ?>
                        </a>                      
                    <?php endif; ?>                    
                  <?php endif; ?>
                  </div>    
                  <div class="col">
                  <?php if($financial_statement): ?>
                    <?php
                      $file = $financial_statement['file'];
                      $label = $financial_statement['label'];
                    ?>
                    <?php if($file): ?>                     
                        <a href="<?php echo $file['url']; ?>">
                          <?php if($label): ?><?php echo $label; ?><?php else: ?><?php echo $file['title']; ?><?php endif; ?>
                        </a>                      
                    <?php endif; ?>                    
                  <?php endif; ?>
                  </div>    
                  <div class="col">
                  <?php if($form_990): ?>
                    <?php
                      $file = $form_990['file'];
                      $label = $form_990['label'];
                    ?>
                    <?php if($file): ?>                     
                        <a href="<?php echo $file['url']; ?>">
                          <?php if($label): ?><?php echo $label; ?><?php else: ?><?php echo $file['title']; ?><?php endif; ?>
                        </a>                      
                    <?php endif; ?>                    
                 <?php endif; ?>                                            
                </div>    
            </div> 
            
        <?php if ($i++ == $j) { break; } endforeach; ?>

    </div>
    <?php endif; ?>     
  </div>
</div>