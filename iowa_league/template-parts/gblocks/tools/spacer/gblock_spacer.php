<?php

/**
 * GBlock: Spacer
 *
 */

$data = get_fields();
$desktop_height = !empty($data['desktop_height']) ? $data['desktop_height'] : '';
$mobile_height = !empty($data['mobile_height']) ? $data['mobile_height'] : '';
?>
<div class="gtool-spacer" <?php if($desktop_height ||$mobile_height):?>style="height: <?php echo $desktop_height; ?>px;"<?php endif;?>><span class="gtool-spacer-mobile"<?php if($mobile_height ||$mobile_height):?>style="height: <?php echo $mobile_height; ?>px;"<?php endif;?>></span>
</div>