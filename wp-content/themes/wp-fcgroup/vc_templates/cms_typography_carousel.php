<?php  
/**
 * Shortcode attributes
 * @var $atts
 * @var $image
 * @var $effect_slide
 * @var $desc
 * @var $color_button
 * @var $button_text
 * @var $button_link
 * @var $link_readmore
 * @var $caption_align
 * @var $overlay_caption
 * @var $auto
 * @var $nav
 * @var $overlay_nav
 * @var $position_nav
 * @var $dots
 * @var $has_border
 * @var $has_border_radius
 * @var $max_height
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Button
 */

$values = $image = $show_description = $desc = $show_button_link = $color_button = $button_text = $button_link =$link_readmore = $caption_align = $overlay_caption = $auto = $nav = $overlay_nav = $position_nav = $dots = $has_border = $has_border_radius = $max_height = $a_target = $effect_slide = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$values = (array) vc_param_group_parse_atts($values);

$effect_slide = isset($atts['effect_slide'])?$atts['effect_slide']:$atts['effect_slide'];
?> 

<div  class="cms-carousel-wrapper <?php echo esc_attr($effect_slide); ?>">
  <div id="fcgroup-carousel-slide-<?php echo rand(0, 999); ?>" class="fcgroup-slider-wrap owl-carousel"
        data-autoplay = "<?php echo esc_attr($auto); ?>" 
        data-nav = "<?php echo esc_attr($nav); ?>" 
        data-per-view = "1" 
        data-loop="true"
        data-dots = "<?php echo esc_attr($dots); ?>"
        data-effect-slider = "<?php echo esc_attr($effect_slide); ?>" >
    <?php foreach($values as $value) : 
        if(!empty($value['image'])):
        $image = wp_get_attachment_image_src($value['image'],'full');
        $title = isset($value['title'])?$value['title']:$value['title'];
        $desc = isset($value['desc'])?$value['desc']:'';
        $caption_align = isset ($value['caption_align'])?$value['caption_align']:$value['caption_align'];
        $overlay_caption = isset ($value['overlay_caption'])?$value['overlay_caption']:'';
        $color_button = isset ($value['color_button'])?$value['color_button']:'';
        $show_button = isset ($value['show_button'])?$value['show_button']:'';

        $link = (isset($value['link_readmore'])) ? $value['link_readmore'] : '';
        $link = vc_build_link( $link );
        if ( strlen( $link['url'] ) > 0 ) {
            $button_link = $link['url'];
            $button_text = $link['title'];
            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
        }
    ?>
      <div class="slide " >
        <div class="img"> <img src="<?php echo esc_url($image[0]); ?>" alt="" /></div>
           
        <div class="cms-caption <?php echo esc_attr($caption_align);?> " style="background-color: <?php echo esc_attr($overlay_caption); ?>">
            <h4><?php echo esc_attr($title); ?></h4>
            <?php   if (!empty($desc)) : ?>
                <div class="desc"><?php echo esc_attr($desc); ?></div>
            <?php endif; ?>
            <?php if (!empty($show_button)) : ?>
                <a class="cms-button sm <?php echo esc_attr($color_button); ?>" href="<?php echo esc_url($button_link); ?>" title="<?php echo esc_attr($button_text) ?>" target="<?php echo esc_attr($a_target); ?>" ><?php echo esc_html($button_text) ?></a>
            <?php endif; ?>
        </div>
      </div>
    <?php endif; endforeach; ?>
  </div>
</div>