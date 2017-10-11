<div class="cms-carousel owl-carousel cms_carousel_testimonial <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    $size ='thumbnail';
    $posts = $atts['posts'];
    while($posts->have_posts()){
        $posts->the_post();

        $name_testimonial = wp_fcgroup_get_meta_option('name_testimonial');
        $link_testi = wp_fcgroup_get_meta_option('link_testi');
        ?>
        <div class="cms-carousel-item" style="border:#ccc 1px solid;">
            <div class="cms-carousel-des" style="min-height:260px !important;"><span class="title"><?php the_title();?></span> <?php the_excerpt(); ?></div>
            <div class="cms-carousel-inner">
                <?php
                    if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                        $class = ' has-thumbnail';
                        $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
                    else:
                        $class = ' no-image';
                        $thumbnail = '';
                    endif;
                    echo '<div class="cms-grid-media '.esc_attr($class).'">'.$thumbnail.'</div>';
                ?>
                <div class="cms-carousel-title" style="padding:10px !important;">
                    <?php  if (!empty($name_testimonial)): ?>
                        <span class="name"><?php echo esc_html($name_testimonial) ; ?></span>
                    <?php endif; ?>
                    <?php  if (!empty($link_testi) && $link_testi != '#' ): ?>
                        <a class="link" href="<?php esc_url($link_testi); ?>"><?php echo esc_html($link_testi); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
