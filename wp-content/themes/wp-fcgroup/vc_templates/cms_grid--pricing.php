<?php 
    /* get categories */
    $taxo = 'category-pricing';
    $_category = array();
    if(!isset($atts['cat']) || $atts['cat']==''){
        $terms = get_terms($taxo);
        foreach ($terms as $cat){
            $_category[] = $cat->term_id;
        }
    } else {
        $_category  = explode(',', $atts['cat']);
    }
    $atts['categories'] = $_category;
$bg_color_item_grid = !empty($atts['bg_color_item_grid'])?$atts['bg_color_item_grid']:'#fff';
   
?>
<div class="cms-grid-wraper cms-grid-pricing clearfix " id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="cms-grid <?php echo esc_attr($atts['grid_class']);?> cms-pricing-item-wrap row">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()) {
            $posts->the_post();
            $pricing_doller = wp_fcgroup_get_meta_option('opt-pricing-doller');
            $pricing_numeric = wp_fcgroup_get_meta_option('opt-pricing-numeric');
            $pricing_blur = wp_fcgroup_get_meta_option('opt-pricing-blur');
            $pricing_time = wp_fcgroup_get_meta_option('opt-pricing-time');
            $pricing_button_link = wp_fcgroup_get_meta_option('opt-pricing-button-link');
            $pricing_button_text = wp_fcgroup_get_meta_option('opt-pricing-button-text');
            $pricing_is_feature = wp_fcgroup_get_meta_option('opt-pricing-feature');

            ?>
            <div class="cms-grid-item cms-grid-item-pricing <?php echo esc_attr($atts['item_class']);?>">
                <div class="cms-pricing-item-inner <?php echo ( $pricing_is_feature == 1 ) ? ' pricing-feature-item' : '' ?>" style="background-color:<?php echo esc_attr($bg_color_item_grid); ?>">
                    <h3 class="cms-pricing-title <?php echo ( $pricing_is_feature == 1 ) ? ' pr-feature' : '' ?>">
                        <?php the_title();?>
                    </h3>

                    <div class="price-heading <?php echo ( $pricing_is_feature == 1 ) ? ' pr-feature' : '' ?>">
                            <span class="doller"><?php echo esc_html($pricing_doller) ?></span><span class="numeric"><?php echo esc_html($pricing_numeric) ?></span><span class="blue">.<?php echo esc_html($pricing_blur) ?></span><span class="time">/<?php echo esc_html($pricing_time) ?></span>
    				</div>
    				<div class="price-content <?php echo ( $pricing_is_feature == 1 ) ? ' pr-feature' : '' ?>">		
    					<?php the_content(); ?>
    				</div>
    				<div class="price-button <?php echo ( $pricing_is_feature == 1 ) ? ' pr-feature' : '' ?>">
                        <a class="cms-button md cms-pricing cms-shape-rounded" href="<?php echo esc_url($pricing_button_link);?>"> <?php echo esc_html($pricing_button_text);?></a>
    				</div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>