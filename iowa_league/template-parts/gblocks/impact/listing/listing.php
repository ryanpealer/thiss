<?php

/**
 * GBlock: Impact Section
 *
 */

$data = get_fields();
?>
<div class="blck-impact">
    <?php if(isset($data['list']) && !empty($data['list'])):?>
    <?php $cols = count($data['list']);?>
    <div class="bcolumns c<?php echo $cols;?>">
        <?php foreach($data['list'] as $item) {
            if(!empty($item['link'])) {
                $link_url = $item['link']['url'];
                $link_title = $item['link']['title'];
                $link_target = $item['link']['target'] ? $item['link']['target'] : '_self';
            }
        ?>
        <div class="item">
            <?php if($item['icon']):?>
            <figure class="icon">
                <?php echo wp_get_attachment_image($item['icon']['id'],'icons'); ?>
            </figure>
            <?php endif; ?>
            <?php if($item['number']):
            if ( is_admin()) { ?>
                <strong class="number">
                    <?php if($item['sign_before']):?><?php echo $item['sign_before'];?><?php endif; ?>
                    <span class="purecounter"><?php echo $item['number']; ?></span>
                    <?php if($item['sign_after']):?><?php echo $item['sign_after'];?><?php endif; ?></strong>
            <?php } else {?>
                <?php if ( strpos( $item['number'], "," ) !== false ) { ?>
                  <strong class="number"><?php if($item['sign_before']):?><?php echo $item['sign_before'];?><?php endif; ?><span><?php echo $item['number']; ?></span><?php if($item['sign_after']):?><?php echo $item['sign_after'];?><?php endif; ?></strong>
                <?php } else { ?>               
                  <strong class="number"><?php if($item['sign_before']):?><?php echo $item['sign_before'];?><?php endif; ?><span class="purecounter" legacy="true" <?php echo $decimal ?> data-purecounter-start="0" data-purecounter-end="<?php echo $item['number']; ?>" <?php echo $decimal ?>>0</span><?php if($item['sign_after']):?><?php echo $item['sign_after'];?><?php endif; ?></strong>
                <?php } ?>
            <?php } ?>
            <?php endif; ?>
            <?php if($item['title']):?>
                <div class="name">
                    <span><?php echo $item['title'] ?> </span>
                    <?php if($item['show_info']):?>
                        <?php if($item['info_box']):?>
                            <a href="#" class="info-box-toggle"><i class="fa fa-info-circle"></i></a>
                            <div class="info-box">
                                <?php echo $item['info_box']; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if($item['content']):?>
                <div class="rte"><?php echo $item['content'] ?></div>
            <?php endif; ?>
            <?php if(!empty($item['link'])) { ?>
            <a href="<?php echo esc_url( $link_url ) ?>" target="<?php echo esc_attr( $link_target ); ?>" class="btn-link btn-arrow"><?php echo esc_html( $link_title ); ?></a>
            <?php } ?>

        </div>
        <?php } ?>
    </div>
    <?php
    else:
        if(current_user_can('editor') || current_user_can('administrator')){
            echo '<div class="notification-editor">'.__('Please add items to the list','imwca-admin').'</div>';
        }
        endif; ?>
</div>