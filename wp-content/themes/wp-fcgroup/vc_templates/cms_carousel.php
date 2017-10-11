<div class="cms-carousel owl-carousel <?php echo esc_attr($atts['template']);?> " id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    $size = "fcgroup-thumb-latest";
    $i = 0;
    echo '<div class="cms-carousel-item">';
    $posts = $atts['posts'];
    while($posts->have_posts()){
        $posts->the_post();
        
         if ($i > 0 && $i%2 == 0) {
            echo '</div><div class="cms-carousel-item">';
         }
        ?>
        <div class="cms_carousel_inner  col-md-12">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                <div class="row">
                    <div class="news-img col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php  
                    
                            if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                                $class = ' has-thumbnail';
                                $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
                            else:
                                $class = ' no-image';
                                $thumbnail = '<img src="'.get_template_directory().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                            endif;
                            echo '<div class="cms-grid-media '.esc_attr($class).'">'.$thumbnail.'</div>';
                        ?>  
                    </div>
                    <div class="news-info col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="date"><?php the_time('F , d, Y');?></div>
                        <?php the_title( '<h5 class="black-color"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
                        <div class="cms-carousel-desc"><?php the_excerpt();?></div>
                    </div>
                </div>
            </article>
       
        </div>
        <?php
        $i++;

    }
     echo '</div>';
    ?>
</div>