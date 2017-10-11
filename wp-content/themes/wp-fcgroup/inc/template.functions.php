<?php
/**
 * get option from meta option
 */
function wp_fcgroup_get_meta_option($param_name) {
    global $opt_meta_options;

    if ($opt_meta_options[$param_name]) {
        return $opt_meta_options[$param_name];
    } else {
        return '';
    }
}

/**
 * get theme logo.
 */
function wp_fcgroup_header_logo(){
    global $opt_theme_options;

    if(isset($opt_theme_options)) {
        echo '<a href="' . esc_url(home_url('/')) . '"><img alt="' . esc_html__('Logo', 'wp-fcgroup') . '" src="' . esc_url($opt_theme_options['main_logo']['url']) . '"></a>';
    } else {
        echo '<a class="home-text" href="' . esc_url( home_url( '/' )) . '" rel="home">';
            bloginfo( 'name' );
        echo '</a>';
    }
}

/**
 * get header class.
 */
function wp_fcgroup_header_class($class = ''){
    global $opt_theme_options;

    if(!isset($opt_theme_options)){
        echo esc_attr($class);
        return;
    }

    if(!empty($opt_theme_options['menu_sticky'])){
        $class .= ' sticky-desktop';
    }
    else {
        $class .= ' none-sticky-desktop';
    }

    echo esc_attr($class);
}

/**
 * main navigation.
 */
function wp_fcgroup_header_navigation(){

    global $opt_theme_options, $opt_meta_options;

    $attr = array(
        'menu_class' => 'nav-menu menu-main-menu clearfix',
        'menu_id' => 'menu-main-menu',
        'theme_location' => 'primary',
    );

    $menu_locations = get_nav_menu_locations();
                            
    if(!empty($menu_locations['primary'])){
        $attr['theme_location'] = 'primary';
    }

    if(is_page() && !empty($opt_meta_options['header_menu']))
        $attr['menu'] = $opt_meta_options['header_menu'];

    /* enable mega menu. */
    if(class_exists('HeroMenuWalker') && (!empty($opt_theme_options['mega_menu']) && $opt_theme_options['mega_menu'] != 0)) { 
        $attr['walker'] = new HeroMenuWalker(); 
    }

    /* main nav. */
    wp_nav_menu( $attr );
}

/**
 * get page title layout
 */
function wp_fcgroup_page_title(){
    global $opt_theme_options, $opt_meta_options;

    /* default. */
    $layout = $page_align = '';

    /* get theme options */
    if(isset($opt_theme_options['page_title_layout']))
        $layout = $opt_theme_options['page_title_layout'];

    /* custom layout from page. */
    if(is_page() && !empty($opt_meta_options['button_set_pagetitle']) && $opt_meta_options['button_set_pagetitle'] == '2' && !empty($opt_meta_options['page_title_layout']))
        $layout = $opt_meta_options['page_title_layout'];

    if(isset($opt_theme_options['page-title-align']))
        $page_align = $opt_theme_options['page-title-align'];

    /* custom layout from page. */
    if(is_page() && !empty($opt_meta_options['button_set_pagetitle']) && $opt_meta_options['button_set_pagetitle'] == '2' && !empty($opt_meta_options['page-title-align']))
        $page_align = $opt_meta_options['page-title-align'];

    ?>
    <div id="page-title" class="page-title-wrap <?php echo esc_attr('layout-'.$layout);?>">
        <?php switch ($layout) {
            case '1':
                ?>
                <div class="container">
                    <div class="page-title-inner <?php echo esc_attr($page_align);?>">
                        <div class="text-left clearfix">
                            <div id="page-title-text" class="page-title-text">
                                <div class="page-title-text-inner">
                                    <h1><?php wp_fcgroup_get_page_title(); ?></h1>
                                    <p class="sub-title"><?php wp_fcgroup_get_sub_pagetitle(); ?></p>
                                </div>
                            </div>
                            <div id="breadcrumb-text" class="breadcrumb-text">
                                <?php wp_fcgroup_get_bread_crumb(); ?>
                            </div>    
                        </div>
                    </div>
                </div>
                <?php
                break;
            case '2':
                ?>
                <div class="page-titile-bg-wrap col-md-6">
                    <div class="page-title-bg">
                        
                    </div>
                </div> 
                <div class="container">
                    <div class="page-title-inner">
                        <div class="text-left col-md-5">
                            <div id="page-title-text" class="page-title-text">
                                <div class="page-title-text-inner">
                                    <h1><?php wp_fcgroup_get_page_title(); ?></h1>
                                    <p class="sub-title"><?php wp_fcgroup_get_sub_pagetitle(); ?></p>
                                </div>
                            </div>
                            <div id="breadcrumb-text" class="breadcrumb-text">
                                <?php wp_fcgroup_get_bread_crumb(); ?>
                            </div>    
                        </div>
                    </div>
                </div>
                <?php
                break;
            default : ?>
                <div class="container">
                    <div class="page-title-inner">
                        <div class="text-left clearfix">
                            <div id="page-title-text" class="page-title-text">
                                <h1><?php wp_fcgroup_get_page_title(); ?></h1>
                            </div>
                            <div id="breadcrumb-text" class="breadcrumb-text">
                                <?php wp_fcgroup_get_bread_crumb(); ?>
                            </div>    
                        </div>
                    </div>
                </div>
            <?php
            break;
        } ?>
    </div><!-- #page-title -->
    <?php
}

/**
 * page title
 */
function wp_fcgroup_get_page_title(){

    global $opt_meta_options;

    if (!is_archive()){
        /* page. */
        if(is_page()) :
            /* custom title. */
            if(!empty($opt_meta_options['page_title_text'])):
                echo esc_html($opt_meta_options['page_title_text']);
            else :
                the_title();
            endif;
        elseif (is_front_page()):
            esc_html_e('Blog', 'wp-fcgroup');
        /* search */
        elseif (is_search()):
            printf( esc_html__( 'Search Results for: %s', 'wp-fcgroup' ), '<span>' . get_search_query() . '</span>' );
        /* 404 */
        elseif (is_404()):
            esc_html_e( '404', 'wp-fcgroup');
        elseif (is_single()) :
            esc_html_e('Blog', 'wp-fcgroup');
        /* other */
        else :
            the_title();
        endif;
    } else {
        /* category. */
        if ( is_category() ) :
            single_cat_title();
        elseif ( is_tag() ) :
            /* tag. */
            single_tag_title();
        /* author. */
        elseif ( is_author() ) :
            printf( esc_html__( 'Author: %s', 'wp-fcgroup' ), '<span class="vcard">' . get_the_author() . '</span>' );
        /* date */
        elseif ( is_day() ) :
            printf( esc_html__( 'Day: %s', 'wp-fcgroup' ), '<span>' . get_the_date() . '</span>' );
        elseif ( is_month() ) :
            printf( esc_html__( 'Month: %s', 'wp-fcgroup' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'wp-fcgroup' ) ) . '</span>' );
        elseif ( is_year() ) :
            printf( esc_html__( 'Year: %s', 'wp-fcgroup' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'wp-fcgroup' ) ) . '</span>' );
        /* post format */
        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            esc_html_e( 'Asides', 'wp-fcgroup' );
        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            esc_html_e( 'Galleries', 'wp-fcgroup');
        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            esc_html_e( 'Images', 'wp-fcgroup');
        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            esc_html_e( 'Videos', 'wp-fcgroup' );
        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            esc_html_e( 'Quotes', 'wp-fcgroup' );
        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            esc_html_e( 'Links', 'wp-fcgroup' );
        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            esc_html_e( 'Statuses', 'wp-fcgroup' );
        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            esc_html_e( 'Audios', 'wp-fcgroup' );
        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            esc_html_e( 'Chats', 'wp-fcgroup' );
        /* woocommerce */
        elseif (function_exists('is_woocommerce') && is_woocommerce()):
            woocommerce_page_title();
        else :
            /* other */
            the_title();
        endif;
    }
}

/**
 * Breadcrumb
 *
 * @since 1.0.0
 */
function wp_fcgroup_get_bread_crumb($separator = '') {
    global $opt_theme_options, $post;

    echo '<ul class="breadcrumbs">';
    /* not front_page */
    if ( !is_front_page() ) {
        echo '<li><a href="';
        echo esc_url(home_url('/'));
        echo '">';
        echo isset($opt_theme_options['breacrumb_home_prefix']) ? esc_html($opt_theme_options['breacrumb_home_prefix']) : esc_html__('Home', 'wp-fcgroup');
        echo "</a></li>";
    }

    $params['link_none'] = '';

    /* category */
    if (is_category()) {
        $category = get_the_category();
        $ID = $category[0]->cat_ID;
        echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ? '' : '<li>'.wp_kses_post($cat_parents).'</li>';
    }
    /* tax */
    if (is_tax()) {
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $link = get_term_link( $term );

        if ( is_wp_error( $link ) ) {
            echo sprintf('<li>%s</li>', $term->name );
        } else {
            echo sprintf('<li><a href="%s" title="%s">%s</a></li>', $link, $term->name, $term->name );
        }
    }
    /* home */

    /* page not front_page */
    if(is_page() && !is_front_page()) {
        $parents = array();
        $parent_id = $post->post_parent;
        while ( $parent_id ) :
            $page = get_page( $parent_id );
            if ( $params["link_none"] )
                $parents[]  = get_the_title( $page->ID );
            else
                $parents[]  = '<li><a href="' . esc_url(get_permalink( $page->ID )) . '" title="' . esc_attr(get_the_title( $page->ID )) . '">' . esc_html(get_the_title( $page->ID )) . '</a></li>' . $separator;
            $parent_id  = $page->post_parent;
        endwhile;
        $parents = array_reverse( $parents );
        echo join( '', $parents );
        echo '<li>'.esc_html(get_the_title()).'</li>';
    }
    /* single */
    if(is_single()) {
        $categories_1 = get_the_category($post->ID);
        if($categories_1):
            foreach($categories_1 as $cat_1):
                $cat_1_ids[] = $cat_1->term_id;
            endforeach;
            $cat_1_line = implode(',', $cat_1_ids);
        endif;
        if( isset( $cat_1_line ) && $cat_1_line ) {
            $categories = get_categories(array(
                'include' => $cat_1_line,
                'orderby' => 'id'
            ));
            if ( $categories ) :
                foreach ( $categories as $cat ) :
                    $cats[] = '<li><a href="' . esc_url(get_category_link( $cat->term_id )) . '" title="' . esc_attr($cat->name) . '">' . esc_html($cat->name) . '</a></li>';
                endforeach;
                echo join( '', $cats );
            endif;
        }
        echo '<li>'.get_the_title().'</li>';
    }
    /* tag */
    if( is_tag() ){ echo '<li>'."Tag: ".single_tag_title('',FALSE).'</li>'; }
    /* search */
    if( is_search() ){ echo '<li>'.esc_html__("Search", 'wp-fcgroup').'</li>'; }
    /* date */
    if( is_year() ){ echo '<li>'.get_the_time('Y').'</li>'; }
    /* 404 */
    if( is_404() ) {
        echo '<li>'.esc_html__("404 - Page not Found", 'wp-fcgroup').'</li>';
    }
    /* archive */
    if( is_archive() && is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
        echo '<li>'. esc_html($title) .'</li>';
    }
    echo "</ul>";
}

function wp_fcgroup_get_sub_pagetitle() {
    global $opt_theme_options, $opt_meta_options;

    $sub_title = $blog_sub_title = '';

    if (!empty($opt_theme_options['enable-sub-pagetitle']) && !empty($opt_theme_options['sub-pagetitle-text'])) {
        $sub_title = $opt_theme_options['sub-pagetitle-text'];
    }
    if (!empty($opt_meta_options['button_set_pagetitle']) && $opt_meta_options['button_set_pagetitle'] == '2' && !empty($opt_meta_options['sub-pagetitle-text'])) {
        $sub_title = $opt_meta_options['sub-pagetitle-text'];
    }

    echo wp_kses( $sub_title, array('br' => array()) );
}

/**
 * Display an optional post detail.
 */
function wp_fcgroup_post_detail() {
    global $opt_theme_options;
    ?>
    <ul class="entry-meta-inner">
        <?php if(!isset($opt_theme_options['single_author_post']) || (isset($opt_theme_options['single_author_post']) && $opt_theme_options['single_author_post'])): ?>
        <li class="entry-author">
            <i class="fa fa-user"></i>
            <?php the_author_posts_link(); ?>
        </li>
        <?php endif; ?>

        <?php if(!isset($opt_theme_options['single_comment_post']) || (isset($opt_theme_options['single_comment_post']) && $opt_theme_options['single_comment_post'])): ?>
        <li class="entry-comment">
            <i class="fa fa-comment"></i>
            <a href="<?php the_permalink(); ?>">
                <?php echo esc_html(comments_number('0','1','%')); ?> <?php esc_html_e('Comments', 'wp-fcgroup'); ?>   
            </a>
        </li>
        <?php endif; ?>

        <?php if(!isset($opt_theme_options['single_view_post']) || (isset($opt_theme_options['single_view_post']) && $opt_theme_options['single_view_post'])): ?>
        <li class="entry-views">
            <i class="fa fa-eye"></i>
            <a href="<?php the_permalink(); ?>">
                <?php echo wp_fcgroup_get_post_views(get_the_ID()); ?> <?php esc_html_e('Views', 'wp-fcgroup') ?>
            </a>
        </li>
        <?php endif; ?>
       

        <?php if(has_category() && (!isset($opt_theme_options['single_categories_post']) || (isset($opt_theme_options['single_categories_post']) && $opt_theme_options['single_categories_post']))): ?>

            <li class="detail-terms"><?php the_terms( get_the_ID(), 'category', '<i class="fa fa-sitemap"></i>', ' / ' ); ?></li>

        <?php endif; ?>
        <?php if(has_tag() && (!isset($opt_theme_options['single_tag_post']) || (isset($opt_theme_options['single_tag_post']) && $opt_theme_options['single_tag_post']))): ?>

            <li class="detail-tags"><?php the_tags('<i class="fa fa-tags"></i>', ', ' ); ?></li>

        <?php endif; ?>
    </ul>
    <?php
}

/**
 * Show tag in single post
 * @return [type] [description]
 */
function wp_fcgroup_single_post_tag() {
    global $opt_theme_options;

    if ( !empty($opt_theme_options['show_tags_post']) ) {
        the_tags(esc_html__('Tags: ', 'wp-fcgroup'), ', ', '' );
    }
}

/**
 * Article social share
 */
function wp_fcgroup_article_social_share() {
    global $opt_theme_options;
    $url = get_the_permalink();

   if(has_tag() && (!isset($opt_theme_options['show_social_post']) || (isset($opt_theme_options['show_social_post']) && $opt_theme_options['show_social_post']))): 

    ?>
        <ul class="social-share-wrap">
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="https://twitter.com/home?status=<?php esc_html_e('Check out this article', 'wp-fcgroup');?>:%20<?php echo get_the_title();?>%20-%20<?php the_permalink();?>">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode($url);?>&amp;title=<?php echo urlencode(get_the_title());?>">
                    <i class="fa fa-linkedin"></i>
                </a>
            </li>
            <li>
                <a href="https://plus.google.com/share?url=<?php the_permalink();?>">
                    <i class="fa fa-google-plus"></i>
                </a>
            </li>
        </ul>
    <?php
    endif;
}

/**
 * Get post views
 *
 * @param $postID
 * @author Duong Tung
 * @since 1.0.0
 */
if (!function_exists('wp_fcgroup_get_post_views')) {
    function wp_fcgroup_get_post_views($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return 0;
        }
        return $count;
    }
}

/**
 * Function to count views.
 *
 * @param $postID
 * @author Duong Tung
 * @since 1.0.0
 */
if (!function_exists('wp_fcgroup_set_post_views')) {
    function wp_fcgroup_set_post_views($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}

/**
 * Display an optional post video.
 */
function wp_fcgroup_post_video() {

    global $opt_meta_options, $wp_embed;

    /* no video. */
    if(empty($opt_meta_options['opt-video-type'])) {
        wp_fcgroup_post_thumbnail();
        return;
    }

    if($opt_meta_options['opt-video-type'] == 'local' && !empty($opt_meta_options['otp-video-local']['id'])){

        $video = wp_get_attachment_metadata($opt_meta_options['otp-video-local']['id']);

        echo do_shortcode('[video width="'.esc_attr($opt_meta_options['otp-video-local']['width']).'" height="'.esc_attr($opt_meta_options['otp-video-local']['height']).'" '.$video['fileformat'].'="'.esc_url($opt_meta_options['otp-video-local']['url']).'" poster="'.esc_url($opt_meta_options['otp-video-thumb']['url']).'"][/video]');

    } elseif($opt_meta_options['opt-video-type'] == 'youtube' && !empty($opt_meta_options['opt-video-youtube'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt-video-youtube']).'[/embed]'));

    } elseif($opt_meta_options['opt-video-type'] == 'vimeo' && !empty($opt_meta_options['opt-video-vimeo'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt-video-vimeo']).'[/embed]'));

    }
}

/**
 * Display an optional post audio.
 */
function wp_fcgroup_post_audio() {
    global $opt_meta_options;

    /* no audio. */
    if(empty($opt_meta_options['otp-audio']['id'])) {
        wp_fcgroup_post_thumbnail();
        return;
    }

    $audio = wp_get_attachment_metadata($opt_meta_options['otp-audio']['id']);

    echo do_shortcode('[audio '.$audio['fileformat'].'="'.esc_url($opt_meta_options['otp-audio']['url']).'"][/audio]');
}

/**
 * Display an optional post gallery.
 */
function wp_fcgroup_post_gallery(){
    global $opt_meta_options;

    /* no audio. */
    if(empty($opt_meta_options['opt-gallery'])) {
        wp_fcgroup_post_thumbnail();
        return;
    }

    $array_id = explode(",", $opt_meta_options['opt-gallery']);

    ?>
        <div id="entry-gallery-<?php echo uniqid(); ?>" class="cms-carousel-wrapper owl-images-wrap">
            <div class="cms-owl-carousel owl-carousel owl-drag" data-loop="false" data-nav="true" data-margin="0" data-pagination="true" data-per-view="1">
                <?php $i = 0; ?>
                <?php foreach ($array_id as $image_id): ?>
                    <?php
                    $attachment_image = wp_get_attachment_image_src($image_id, 'fcgroup-thumb-large', false);
                    if($attachment_image[0] != ''):?>
                        <div class="item">
                            <img src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php
}

/**
 * Display an optional post quote.
 */
function wp_fcgroup_post_quote() {
    global $opt_meta_options;

    if(empty($opt_meta_options['opt-quote-content'])){
        wp_fcgroup_post_thumbnail();
        return;
    }

    $opt_meta_options['opt-quote-title'] = !empty($opt_meta_options['opt-quote-title']) ? '<small>'.esc_html($opt_meta_options['opt-quote-title']).'</small>' : '' ;
    echo '<blockquote>'.esc_html($opt_meta_options['opt-quote-content']).wp_kses_post($opt_meta_options['opt-quote-title']).'</blockquote>';
}

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
function wp_fcgroup_post_thumbnail( $thumb = '') {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }
    $thumb = (!empty($thumb)) ? $thumb : 'fcgroup-thumb-large';
    ?>
    <div class="post-thumbnail">
        <?php the_post_thumbnail($thumb); ?>

        <div class="meta-date wow fadeInUp">
            <span><?php echo get_the_time('j'); ?></span>
            <span><?php echo get_the_time('M'); ?></span>
        </div>
    </div>
    <?php
}

/**
 * General margin top, bottom of primary menu levl 1 item
 */
function wp_fcgroup_general_margin_menu() {
    global $opt_theme_options;

    $mgtb = $mr_ul_t = '';
    $header_height_id = ( !empty($opt_theme_options['header_height_id']['height']) ) ? $opt_theme_options['header_height_id']['height'] : 105;
    $header_height_fixed = ( !empty($opt_theme_options['header_height_fixed']['height']) ) ? $opt_theme_options['header_height_fixed']['height'] : 71;

    $mgtb = ($header_height_id - 41) / 2 ;
    $mr_ul_t = ($header_height_id - 41) / 2 - 2;

    $mgtb_fixed = ($header_height_fixed - 41) / 2 ;
    $mr_ul_t_fixed = ($header_height_fixed - 41) / 2 - 2;

    echo '<style type="text/css"> .main-navigation .menu-main-menu > li > a, .main-navigation .menu-main-menu > ul > li > a
            {margin-top: '.$mgtb.'px; margin-bottom: '.$mgtb.'px;}

            .main-navigation .menu-main-menu > li > ul, .main-navigation .menu-main-menu > ul > li > ul {
                margin-top: -'.$mr_ul_t.'px;
            }
          </style>';  

    echo '<style type="text/css"> .is-sticky .sticky-desktop .main-navigation .menu-main-menu > li > a, .is-sticky .sticky-desktop .main-navigation .menu-main-menu > ul > li > a
            {margin-top: '.$mgtb_fixed.'px; margin-bottom: '.$mgtb_fixed.'px;}

             .is-sticky .sticky-desktop .main-navigation .menu-main-menu > li > ul, .is-sticky .sticky-desktop .main-navigation .menu-main-menu > ul > li > ul {
                margin-top: -'.$mr_ul_t_fixed.'px;
            }
          </style>';
}
add_action('wp_head', 'wp_fcgroup_general_margin_menu');

/**
 * Search icon
 */
function wp_fcgroup_search_icon() {
    global $opt_theme_options;

    if ( !empty($opt_theme_options['search-icon']) ) :
    ?>
        <div class="cshero-cart-search-area">
            <a href="#" class="icon-search cd-search-trigger"><i class="fa fa-search"></i></a>
        </div> 
    <?php
    endif;
}
add_action('wp_fcgroup_search_icon', 'wp_fcgroup_search_icon');

/**
 * add class for #content
 */
function wp_fcgroup_set_padding_class() {
    global $opt_meta_options;
    $main_content_class = array();
    $main_content_class[] = 'p-70-cont';

    $main_content_class[] = (!empty($opt_meta_options['page_general_padding_top'])) ? 'pt-0' : '';
    $main_content_class[] = (!empty($opt_meta_options['page_general_padding_bottom'])) ? 'pb-0' : '';

    return implode(' ', $main_content_class);
}

/**
 * Show social list from theme option
 */
function wp_fcgroup_social_from_themeoption($layout = '') {
    global $opt_theme_options;
    $lists = '';
    if (!empty($layout ) && $layout == 'header') {
        $lists = ( !empty($opt_theme_options['individual_social_on_header']['enabled']) ) ? $opt_theme_options['individual_social_on_header']['enabled'] : '';
    } elseif (!empty($layout ) && $layout == 'footer') {
        $lists = ( !empty($opt_theme_options['individual_social_on_footer']['enabled']) ) ? $opt_theme_options['individual_social_on_footer']['enabled'] : '';
    }
    
    if ( $lists ) {
        echo '<div class="social-indiv-wrap layout-'.$layout.'"><ul class="social-indiv-inner">';
        foreach ($lists as $key => $value) {
            switch ($key) {
                case 'facebook':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'"><i class="fa fa-facebook"></i></a></li>';
                    break;
                case 'twitter':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'"><i class="fa fa-twitter"></i></a></li>';
                    break;
                case 'rss':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-rss"></i></a></li>';
                    break;
                case 'instagram':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
                    break;
                case 'google':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
                    break;
                case 'skype':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-skype"></i></a></li>';
                    break;
                case 'pinterest':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
                    break;
                case 'vimeo':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-vimeo"></i></a></li>';
                    break;
                case 'youtube':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-youtube"></i></a></li>';
                    break;
                case 'yelp':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-yelp"></i></a></li>';
                    break;
                case 'tublr':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-tublr"></i></a></li>';
                    break;
                case 'linkedin':
                    echo '<li class="'.esc_attr($key).'"><a href="'.(!empty($opt_theme_options[$key])?esc_url($opt_theme_options[$key]):'#').'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
                    break;
            }
        }
        echo '</ul></div>';
    }
        
}

/**
 * General 404 page
 * @return html layout
 */
function wp_fcgroup_404_site_info() {
    global $opt_theme_options;

    if ( !empty($opt_theme_options['404-phone']) && !empty($opt_theme_options['404-email']) ) :
        ?>
            <ul>
                <?php if (!empty($opt_theme_options['404-phone'])) : ?>
                    <li>
                        <i class="fa fa-phone"></i>
                        <?php echo esc_html($opt_theme_options['404-phone']); ?>
                    </li>
                <?php endif; ?>
                <?php if (!empty($opt_theme_options['404-email'])) : ?>
                    <li>
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:info@financegroup.com"><?php echo esc_html($opt_theme_options['404-email']); ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php
    endif;
}

/**
 * [wp_fcgroup_get_theme_option description]
 * @param  string $param param name in theme option
 * @return string
 */
function wp_fcgroup_get_theme_option($param) {
    global $opt_theme_options;

    if ( isset($opt_theme_options[$param]) ) {
        return $opt_theme_options[$param];
    } else {
        return '';
    }
}

/**
 * Move comment field to bottom of Comment form
 */
function wp_fcgroup_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;

    return $fields;
}
add_filter( 'comment_form_fields', 'wp_fcgroup_move_comment_field_to_bottom' );

/**
 * Remove dotted of excerpt more
 * 
 * @param  [type] $more [description]
 * @return [type]       [description]
 */
function wp_fcgroup_new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'wp_fcgroup_new_excerpt_more');



/**
 * Added prefix class to body
 */
add_filter( 'body_class', 'wp_fcgroup_prefix_bodyclass' );
function wp_fcgroup_prefix_bodyclass( $classes ) {
    global $opt_meta_options, $opt_theme_options;
    if ( basename( get_page_template() ) == '404.php' ) {
        $classes[] = 'error404';    
    }
    if ( basename( get_page_template() ) == 'login.php' ) {
        $classes[] = 'login';    
    }
    if ( basename( get_page_template() ) == 'login-page.php' ) {
        $classes[] = 'login-page';    
    }

    // return the $classes array
    return $classes;
}

add_filter( 'body_class', 'wp_fcgroup_prefix_page_title_body' );
function wp_fcgroup_prefix_page_title_body( $classes ) {
    global $post;
    if(isset($post->post_name)){
        $slug = $post->post_name;
        $classes[] = $slug;
    }

    // return the $classes array
    return $classes;
}

/**
 * print favicon
 * 
 * @return void
 */
function wp_fcgroup_favicon() {
    global $opt_theme_options;
    if ( empty($opt_theme_options) )
        return;

    $fav_icon = $opt_theme_options['favicon_icon'];
    if ((!function_exists( 'has_site_icon' ) || ! has_site_icon()) && !empty($fav_icon) ) {
        echo '<link rel="icon" type="image/png" href="'.esc_url($fav_icon['url']).'"/>';
    }
}
add_action('wp_head', 'wp_fcgroup_favicon');

/**
 * get meta option list category slider.
 * @return array
 */
function wp_fcgroup_get_meta_option_slider() {
    global $opt_meta_options;

    $header_banner_bg_color = !empty($opt_meta_options['header_banner_bg_color'])? $opt_meta_options['header_banner_bg_color']: '#0f1923';
    $header_banner_bg_color_phone = !empty($opt_meta_options['header_banner_bg_color_phone']['rgba'])? $opt_meta_options['header_banner_bg_color_phone']['rgba']: 'rgba(15, 25, 35, 0.6)';
    $slider_show_nav=!empty($opt_meta_options['slider_show_nav'])?'true':''; 
    $slider_show_dots=!empty($opt_meta_options['slider_show_dots'])?'true':'';

    if (!isset($opt_meta_options['button_set_slider']) || $opt_meta_options['button_set_slider'] == '3') {
        return;
    }
    if($opt_meta_options['button_set_slider'] == '1'):
        $term = isset($opt_meta_options['header_banner'])?$opt_meta_options['header_banner']:0;
        $args = array(
            'post_type'=>'slider',
            'tax_query' => array(
                'taxonomy' => 'category-slider',
                'field' => 'slug',
                'terms' => $term
            )
        );
        $postlist = get_posts( $args );
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-top" id="main-banner">
            <div class="row">
                <div  class="cms-carousel-wrapper slide-carousel">
                    <div id="fcgroup-carousel-slide-<?php echo rand(0, 999); ?>" class="fcgroup-slider-wrap owl-carousel"
                        data-autoplay = "true" 
                        data-nav = "<?php echo esc_attr($slider_show_nav); ?>" 
                        data-per-view = "1" 
                        data-dots = "<?php echo esc_attr($slider_show_dots); ?>" 
                        data-loop="true" 
                        data-effect-slider="slide-carousel"  >
                        <?php
                        foreach ( $postlist as $post ) :
                            $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail_size');
                            $image_url = $attachment_image[0];
                            ?>
                            <div class="slide" >
                                <div class="hidden-xs hidden-sm visible-lg visible-md">
                                    <div class="banner-outer banner-outer col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                         <div class="row">
                                            <div class="banner-text text-center col-md-12  col-xs-12" style="background-color:<?php echo esc_attr($header_banner_bg_color) ;?>" >
                                                <div class="banner-text-inner">
                                                    <div class="banner-text-in">
                                                        <?php echo apply_filters('the_content', $post->post_content); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="banner-img col-lg-7 col-md-7 col-sm-12 col-xs-12" style="background-image: url(<?php echo esc_attr($image_url) ;?>); background-position: center center; background-repeat: no-repeat; background-size: cover;"> 
                                        
                                        <!--banner-img--> 
                                    </div>
                                </div>
                                <div class="visible-xs visible-sm hidden-lg hidden-md">
                                    <div class="banner-outer banner-outer" style="background-image: url(<?php echo esc_attr($image_url) ;?>); background-position: center center; background-repeat: no-repeat; background-size: cover;">
                                        <div class="banner-text text-center" style="background-color:<?php echo esc_attr($header_banner_bg_color_phone) ;?>" >
                                            <div class="banner-text-inner">
                                                <div class="banner-text-in">
                                                    <?php echo apply_filters('the_content', $post->post_content); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php $target = (!empty($opt_meta_options['opt_explore_target']))?$opt_meta_options['opt_explore_target']:'#services'; ?>
                                
                            </div>
                            
                            <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
            
        <?php
    else:
        if($opt_meta_options['button_set_slider'] == '2'){
            ?>
            <div class="mainbanner_rev_wrap indent-header main-top">
                <?php echo do_shortcode('[rev_slider_vc alias="'.$opt_meta_options['select_rev_slider'].'"]'); ?>
                 <?php $target = (!empty($opt_meta_options['opt_explore_target']))?$opt_meta_options['opt_explore_target']:'#services'; ?>
                <div class="explore-services arrow-in-home hidden-xs" data-target="<?php echo esc_attr($target); ?>">
                    <figure class="bounce"><a href="<?php echo esc_attr($target); ?>"><img alt="arrow" src="<?php echo get_template_directory_uri() ?>/assets/images/arrow-down.png"></a></figure>
                </div>
            </div>
            <?php
        }
    endif;
}
