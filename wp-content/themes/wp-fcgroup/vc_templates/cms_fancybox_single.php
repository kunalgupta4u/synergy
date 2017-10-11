<?php
    $fancy_style = '';
    $css_animation_delay = (!empty($atts['css_animation_delay'])) ? 'data-wow-delay="'.esc_attr($atts['css_animation_delay']).'"' : '';

    if (!empty($atts['fancy_style']) ) {

        $fancy_style = $atts['fancy_style']; 
    }
        switch ($fancy_style){
            case 'style1': ?>
            <?php   $icon_name = "icon_" . $atts['icon_type'];
                    $iconClass = isset($atts[$icon_name])?$atts[$icon_name]:''; ?>
                <div class="cms-fancyboxes-wraper cms-fancyboxes-style-1 wow fadeIn <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>" <?php echo $css_animation_delay; ?> >
                    
                    <div class="row cms-fancyboxes-body">
                        <div class="cms-fancybox-item">
                            <div class="cms-fancybox-item-inner">
                                <div class="contact-info">
                                    <i class="<?php echo esc_attr($iconClass) ?>"></i>
                                    <!-- content -->
                                    <?php if($content): ?>
                                    <div class="fancy-box-content">
                                        <div class="contact-link">
                                            <?php  echo wp_kses( $content, array(
                                                        'a' => array(
                                                            'href' => array(), 
                                                            'title' => array() 
                                                        ), 
                                                        'br' => array(), 
                                                        'em' => array(), 
                                                        'strong' => array() 
                                                    ) 
                                                ); 
                                            ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            break;
            case 'style2':?>
                

                <div class="cms-fancyboxes-wraper cms-fancyboxes-style-2 wow fadeIn  <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>"  <?php echo $css_animation_delay; ?> >
                    <div class=" cms-fancyboxes-body">
                        <div class="cms-fancybox-item">
                            <!-- Image-->
                            <?php 
                            $image_url = '';
                            if (!empty($atts['image'])) {
                                $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
                                $image_url = $attachment_image[0];
                            }
                            ?>
                            <?php if($image_url):?>
                                <div class="fancy-box-image">
                                    <img src="<?php echo esc_attr($image_url);?>" alt=""/>
                                </div>
                            <?php endif;?>
                               
                            <div class="cms_fancybox_item_inner greyBg">
                                <!-- Image Icon -->
                                <?php 
                                    $image_url_icon = '';
                                    if (!empty($atts['image_icon'])) {
                                        $attachment_image_icon = wp_get_attachment_image_src($atts['image_icon'], 'full');
                                        $image_url_icon = $attachment_image_icon[0];
                                    }
                                ?>
                                <?php if($image_url_icon):?> 
                                    <div class="fancy-box-image-icon">
                                        <img src="<?php echo esc_attr($image_url_icon);?>" alt=""/>
                                    </div>
                                <?php endif;?>
                                <!-- title-->
                                <?php if($atts['title_item']):?>
                                    <h4 class="title"><?php echo esc_attr($atts['title_item']);?></h4>
                                <?php endif;?>

                                <!-- description-->
                                <?php if($content): ?>
                                <div class="fancy-box-content">
                                    <?php  echo wp_kses( $content, array(
                                                        'a' => array(
                                                            'href' => array(), 
                                                            'title' => array() 
                                                        ), 
                                                        'br' => array(), 
                                                        'em' => array(), 
                                                        'strong' => array() 
                                                    ) 
                                                ); 
                                            ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            break;     
            case 'style3':?>
               
                <?php 
                    $button_text = $button_link = $a_target = '';
                    $link = (isset($atts['link_fancy'])) ? $atts['link_fancy'] : '';
                    $link = vc_build_link( $link );
                    if ( strlen( $link['url'] ) > 0 ) {
                        $button_link = $link['url'];
                        $button_text = $link['title'];
                        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                    }
                 ?>
                <div class="cms-fancyboxes-wraper cms-fancyboxes-style-3 wow fadeIn <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>" <?php echo $css_animation_delay; ?> >
                    <div class=" cms-fancyboxes-body" >
                        <div class="cms-fancybox-item">
                            <div class="cms_fancybox_item_head">
                                <!-- Image-->
                                <?php 
                                $image_url = '';
                                if (!empty($atts['image'])) {
                                    $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
                                    $image_url = $attachment_image[0];
                                }
                                ?>
                                <?php if($image_url):?>
                                    <div class="fancy-box-image">
                                        <img src="<?php echo esc_attr($image_url);?>" alt=""/>
                                    </div>
                                <?php endif;?>
                                 <!-- title 1-->
                                <?php if($atts['title_item']):?>
                                    <h3 class="title1"><?php echo esc_attr($atts['title_item']);?></h3>
                                <?php endif;?>
                            </div>
                            <div class="cms_fancybox_item_inner">
                                <div class="cms_fancybox_text">
                                    <!-- title 2-->
                                    <?php if($atts['title_item']):?>
                                        <h3 class="title2"><?php echo esc_attr($atts['title_item']);?></h3>
                                    <?php endif;?>

                                    <!-- description-->
                                    <?php if($content): ?>
                                        <div class="fancy-box-content">
                                            <?php  echo wp_kses( $content, array(
                                                        'a' => array(
                                                            'href' => array(), 
                                                            'title' => array() 
                                                        ), 
                                                        'br' => array(), 
                                                        'em' => array(), 
                                                        'strong' => array() 
                                                    ) 
                                                ); 
                                            ?>
                                        </div>
                                    <?php endif; ?> 

                                    <!-- readmore -->
                                    <div class="cms-fancyboxes-foot">
                                        <a class="cms-button transparent-readmore" href="<?php echo esc_url($button_link); ?>" title="<?php echo esc_attr($button_text) ?>" target="<?php echo esc_attr($a_target); ?>" ><?php echo esc_html($button_text) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            break;
            case 'style4':?>
               
                <?php 
                    $button_text = $button_link = $a_target = '';
                    $link = (isset($atts['link_fancy'])) ? $atts['link_fancy'] : '';
                    $link = vc_build_link( $link );
                    if ( strlen( $link['url'] ) > 0 ) {
                        $button_link = $link['url'];
                        $button_text = $link['title'];
                        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                    }
                 ?>
                <div class="cms-fancyboxes-wraper cms-fancyboxes-style-4 wow fadeIn <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>"  <?php echo $css_animation_delay; ?> >
                    <div class=" cms-fancyboxes-body greyBg " onclick ="">
                        <div class="cms-fancybox-item">
                            
                                <!-- Image Icon-->
                                <?php 
                                $image_url = '';
                                if (!empty($atts['image_icon'])) {
                                    $attachment_image = wp_get_attachment_image_src($atts['image_icon'], 'full');
                                    $image_url = $attachment_image[0];
                                }
                                ?>
                                <?php if($image_url):?>
                                    <div class="fancy-box-image cms_animate wow effect-pop in ">
                                        <img src="<?php echo esc_attr($image_url);?>" alt=""/>
                                    </div>
                                <?php endif;?>
                                 <!-- title 1-->
                                <?php if($atts['title_item']):?>
                                    <h4 class="black-color"><?php echo esc_attr($atts['title_item']);?></h4>
                                <?php endif;?>
                           
                            <div class="cms_fancybox_item_inner">
                                <div class="cms_fancybox_text">
                                    <div class="cms_fancybox_text_info">
                                        <div class="cms_fancybox_text_info_box">

                                            <!-- Image Icon Hover-->
                                            <?php 
                                            $image_url_hover = '';
                                            if (!empty($atts['image_icon_hover'])) {
                                                $attachment_image = wp_get_attachment_image_src($atts['image_icon_hover'], 'full');
                                                $image_url_hover = $attachment_image[0];
                                            }
                                            ?>
                                            <?php if($image_url_hover):?>
                                                <div class="fancy-box-image-hover">
                                                    <img src="<?php echo esc_attr($image_url_hover);?>" alt=""/>
                                                </div>
                                            <?php endif;?>

                                            <!-- title 2-->
                                            <?php if($atts['title_item']):?>
                                                <h4 class="white-color"><?php echo esc_attr($atts['title_item']);?></h4>
                                            <?php endif;?>

                                            <!-- description-->
                                            <?php if($content): ?>
                                                <div class="fancy-box-content">
                                                    <?php  echo wp_kses( $content, array(
                                                                'a' => array(
                                                                    'href' => array(), 
                                                                    'title' => array() 
                                                                ), 
                                                                'br' => array(), 
                                                                'em' => array(), 
                                                                'strong' => array() 
                                                            ) 
                                                        ); 
                                                    ?>
                                                </div>
                                            <?php endif; ?> 
                                            <!-- readmore -->
                                            <div class="cms-fancyboxes-foot">
                                                <a class="cms-button transparent-readmore" href="<?php echo esc_url($button_link); ?>" title="<?php echo esc_attr($button_text) ?>" target="<?php echo esc_attr($a_target); ?>" ><?php echo esc_html($button_text) ?></a>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            break;
             case 'intro':?>
               
                <?php 
                    $button_text = $button_link = $a_target = '';
                    $link = (isset($atts['link_fancy'])) ? $atts['link_fancy'] : '';
                    $link = vc_build_link( $link );
                    if ( strlen( $link['url'] ) > 0 ) {
                        $button_link = $link['url'];
                        $button_text = $link['title'];
                        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                    }
                 ?>
                <div class="cms-fancyboxes-wraper cms-fancyboxes-style-intro wow fadeIn <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>"  <?php echo $css_animation_delay; ?> >
                    <div class=" cms-fancyboxes-body  ">
                        <div class="cms-fancybox-item">
                            <!-- Image-->
                                <?php 
                                $image_url = '';
                                if (!empty($atts['image'])) {
                                    $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
                                    $image_url = $attachment_image[0];
                                }
                                ?>
                                
                                <a class="cms_version" href="<?php echo esc_url($button_link); ?>" title="<?php echo esc_attr($button_text) ?>" target="<?php echo esc_attr($a_target); ?>" >
                                        <?php if($image_url):?>
                                            <img src="<?php echo esc_attr($image_url);?>" alt=""/>
                                    <?php endif;?>
                                    <h4><?php echo esc_html($button_text) ?></h4>
                                </a>
                        </div>
                    </div>
                </div>
            <?php
            break;

    }
?>
    


