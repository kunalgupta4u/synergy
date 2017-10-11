<?php
    $image_url = '';
    if (!empty($atts['bg_image_counter'])) {
        $attachment_image = wp_get_attachment_image_src(($atts['bg_image_counter']), 'full');
        $image_url = $attachment_image[0];
    }
?>
<div class="cms-counter-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="cms-counter-body">
        <div class="cms-counter-single">
			<div id="counter_<?php echo esc_attr($atts['html_id']);?>" class="cms-counter <?php echo esc_attr(strtolower($atts['type']));?>"  data-type="<?php echo esc_attr(strtolower($atts['type']));?>" data-digit="<?php echo esc_attr($atts['digit']);?>" style="background-image: url(<?php echo balanceTags($image_url); ?>);">
			</div>
	        <?php if($atts['c_title']):?>
	            <h4><span><?php echo apply_filters('the_title',$atts['c_title']);?></span></h4>
	        <?php endif;?>
		</div>
    </div>
</div>
