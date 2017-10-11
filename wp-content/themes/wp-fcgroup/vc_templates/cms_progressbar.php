<?php 
    $icon_name = "icon_" . $atts['icon_type'];
    $iconClass = isset($atts[$icon_name])?$atts[$icon_name]:'';
?>
<div class="cms-progress-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class=" cms-progress-body">
        <?php
            $item_class = 'cms-progress-item-wrap';
            $item_title     = $atts['item_title'];
            $show_value     = ($atts['show_value']=='true')?true:false;
            $value          = $atts['value'];
            $value_suffix   = $atts['value_suffix'];
            $bg_color       = $atts['bg_color'];
            $color          = $atts['color'];
            $width          = $atts['width'];
            $height         = $atts['height'];
            $border_radius  = $atts['border_radius'];
            $vertical       = ($atts['mode']=='vertical')?true:false;
            $striped        = ($atts['striped']=='yes')?true:false;
            ?>
            <div class="<?php echo esc_attr($item_class);?>">
               
                <div class="cms-progress-title" style="color:<?php echo esc_attr($color);?>;">
                     <?php if($iconClass):?>
                    <i class="<?php echo esc_attr($iconClass);?>"></i>
                    <?php endif;?>
                    <?php if($item_title):?>
                        <?php echo apply_filters('the_title',$item_title);?>
                    <?php endif;?>
                </div>
                <div class="cms-progress progress<?php if($vertical){ echo ' vertical bottom'; } ?> <?php if($striped){echo ' progress-striped';}?>" 
                    style="background-color:<?php echo esc_attr($bg_color);?>;
                    width:<?php echo esc_attr($width);?>;
                    height:<?php echo esc_attr($height);?>;
                    border-radius:<?php echo esc_attr($border_radius);?>;
                    " >
                    <div id="item-<?php echo esc_attr($atts['html_id']); ?>" 
                        class="progress-bar" 
                        data-valuetransitiongoal="<?php echo esc_attr($value); ?>" 
                        style="background-color:<?php echo esc_attr($color);?>;"
                        >
                        <span class="progress_value">
                            <?php if($show_value): ?>
                                <?php echo esc_attr($value);?>
                            <?php endif; ?>
                            <span class="progress_value_suffix"> 
                                <?php if($value_suffix): ?>
                                    <?php echo esc_attr($value_suffix);?>
                                <?php endif; ?>
                            </span>
                        </span>
                    </div>
                </div>
			</div>
    </div>
</div>