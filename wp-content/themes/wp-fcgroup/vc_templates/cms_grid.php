<?php 
    /* get categories */
        $taxo = 'category';
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
<div class="cms-grid-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['filter']=="true" and $atts['layout']=='masonry'):?>
        <div class="cms-grid-filter cms-filter-wrap">
            <div class="cms-grid-filter-inphone hidden">
                <a href="#" class="active"><span>Select Filter</span></a>
            </div>
            <ul class="cms-filter-category list-unstyled list-inline">
                <li><a class="active" href="#" data-group="all"><?php echo esc_html('All'); ?></a></li>
                <?php 
                if(is_array($atts['categories']))
                foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, $taxo );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo esc_html($term->name);?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <div class="row cms-grid <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            $format = get_post_format() ? : 'standard';
            ?>
            <div class="cms-grid-item fcgroup-loop-entry fadeIn wow mb-30 <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]' >
                <div class="cms-grid-item-inner" style="background-color:<?php echo esc_attr($bg_color_item_grid); ?>">

                <?php 
                    switch ($format) {
                        case 'video':
                            wp_fcgroup_post_video();
                            break;
                        case 'quote':
                            wp_fcgroup_post_quote();
                            break;
                        case 'gallery':
                            wp_fcgroup_post_gallery();
                            break;
                        case 'audio':
                            wp_fcgroup_post_audio();
                            break;
                        
                        default:
                            wp_fcgroup_post_thumbnail('fcgroup-thumb-port');
                            
                            break;
                    }
                 ?>
                
              
                <div class="entry-container">
                    <div class="entry-meta clearfix">
                        <div class="pull-left">
                            <?php wp_fcgroup_post_detail(); ?>  
                        </div>
                        <div class="pull-right">
                            <?php wp_fcgroup_article_social_share(); ?>
                        </div>
                        <?php  ?>
                    </div><!-- .entry-meta -->

                    <header class="entry-header">
                        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                    </header><!-- .entry-header -->
                    <div class="entry-content">
                        <?php
                        /* translators: %s: Name of current post */
                        the_excerpt();

                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wp-fcgroup' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span class="active">',
                            'link_after'  => '</span>',
                        ) );
                        ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <a class="blog-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'wp-fcgroup') ?></a>
                    </footer><!-- .entry-footer -->
                </div>
                <?php
                    if(is_sticky()) {
                        echo '<span class="sticky-post"><i class="fa fa-thumb-tack"></i></span>';
                    }
                ?>
            </div>
            <?php
        }
        ?>
        
        </div>
    </div>
     <?php
        if (!empty($atts['checkbox_grid_nav'])) {
        wp_fcgroup_paging_nav();
    }
    ?>
</div>