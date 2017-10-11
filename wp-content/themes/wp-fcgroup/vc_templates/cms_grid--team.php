<?php 
    /* get categories */
        $taxo = 'category-team';
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
             <!--<div class="cms-grid-filter-inphone hidden">
                <a href="#" class="active"><span>Select Filter</span></a>
            </div>-->
            <ul class="cms-filter-category list-unstyled list-inline">
                <!--<li><a class="active" href="#" data-group="all"><?php //echo esc_html('All'); ?></a></li>-->
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
    <div class="row cms-grid cms_teams <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        global $opt_meta_options;
        $posts = $atts['posts'];
        $size = 'fcgroup-thumb-team';
        $index = 0;
        while($posts->have_posts()) {
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            ?>
            <div class="cms-grid-item  wow fadeIn <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]' data-wow-delay="<?php echo $index*200; ?>ms">
                <div class="cms_team_item" style="background-color:<?php echo esc_attr($bg_color_item_grid); ?>">
                <div class="cms-grid-desc">
                     <h3>
                        <?php the_title();?>
                        <?php if(!empty($opt_meta_options['role']))  { ?>
                            <span class="role">
                                <?php echo ($opt_meta_options['role']); ?>
                            </span>
                        <?php } ?>
                </h3>
                    
                    <?php the_content();?>
                </div> 
            </div>
            </div>
            <?php
            $index ++;
        }
        ?>
    </div>
</div>