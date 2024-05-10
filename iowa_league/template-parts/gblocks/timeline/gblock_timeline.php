<?php

/**
 * GBlock: Story Section
 *
 */

$data = get_fields();
$title = $data['title'];
$content = $data['content'];
?>
<div class="blck-story alignfull">
    <div class="container">
        <div class="blck-story-content">
            <?php if ( isset($title) && ! empty($title) ): ?>
                <h2 class="title"><?php echo do_shortcode($title); ?></h2>
            <?php endif; ?>   
            <?php if ( isset($content) && ! empty($content) ): ?>          
              <?php echo do_shortcode($content); ?>
            <?php endif; ?>
        </div>      
        <?php if($data['timeline']):?>
        <div class="timeline">
            <?php foreach($data['timeline'] as $item){ ?>
            <div class="item">
                <div class="item-holder">
                    <?php if($item['date']):?>
                        <div class="date"><?php echo $item['date'] ?></div>
                    <?php endif; ?>
                    <?php if($item['description']):?>
                        <div class="description"><?php echo $item['description'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php endif; ?> 
    </div>
</div>