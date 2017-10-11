<?php
/**
 * Theme Framework functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;
	
/**
 * CMS Theme setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * CMS Theme supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0.0
 */
function wp_fcgroup_setup() {

	// load language.
	load_theme_textdomain( 'wp-fcgroup' , get_template_directory() . '/languages' );

	// Adds title tag
	add_theme_support( "title-tag" );
	
	// Add woocommerce
	add_theme_support('woocommerce');

	// Adds custom header
	add_theme_support( 'custom-header' );
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'video', 'audio' , 'gallery', 'quote') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'wp-fcgroup' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array('default-color' => 'e6e6e6',) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 870, 9999 ); // Unlimited height, soft crop

	add_image_size('fcgroup-thumb-large', 1200, 290, true);
	add_image_size('fcgroup-thumb-medium', 533, 350, true);
	add_image_size('fcgroup-thumb-port', 550, 280, true);
	add_image_size('fcgroup-thumb-recent', 70, 60, true);
	add_image_size('fcgroup-thumb-team', 262, 345, true);
	add_image_size('fcgroup-thumb-latest', 430, 200, true);
	/*add_image_size('fcgroup-thumb-testimonial', 73, 73, true);*/

	/*/ WooCommerce Thumbnail /*/
	$catalog = array(
        'width'     => '400',
        'height'    => '520',
        'crop'      => 1
    );
    $single = array(
        'width'     => '470',
        'height'    => '600',
        'crop'      => 1 
    );
    $thumbnail = array(
        'width'     => '200',
        'height'    => '255',
        'crop'      => 1
    );
   /* / Image sizes /*/
    update_option( 'shop_catalog_image_size', $catalog );
    update_option( 'shop_single_image_size', $single );
    update_option( 'shop_thumbnail_image_size', $thumbnail );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}

add_action( 'after_setup_theme', 'wp_fcgroup_setup' );

/**
 * Add new elements for VC
 */
add_action('vc_before_init', 'wp_fcgroup_vc_before');
function wp_fcgroup_vc_before() {
    
    if(!class_exists('CmsShortCode'))
        return ;
    require( get_template_directory() . '/inc/elements/cms-callout.php' );
    require( get_template_directory() . '/inc/elements/cms-typography-carousel.php' );
    require( get_template_directory() . '/inc/elements/cms_bgimage.php' );
    require( get_template_directory() . '/inc/elements/cms_clients.php' );
    /*
    require( get_template_directory() . '/inc/elements/cms_dropcaps.php' );
    require( get_template_directory() . '/inc/elements/cms_modals.php' );
    require( get_template_directory() . '/inc/elements/cms_lightboxmap.php' );
    require( get_template_directory() . '/inc/elements/cms_newsletter.php' );
    require( get_template_directory() . '/inc/elements/cms_latest_blog.php' );
    require( get_template_directory() . '/inc/elements/cms_bgimage.php' );
    require( get_template_directory() . '/inc/elements/cms_progress.php' );
    require( get_template_directory() . '/inc/elements/cms_countdown.php' );*/
}

/**
 * Custom params & remove VC Elements.
 */
add_action('vc_after_init', 'wp_fcgroup_vc_after');
function wp_fcgroup_vc_after() {
    require( get_template_directory() . '/vc_params/vc_custom_heading.php' );
    require( get_template_directory() . '/vc_params/vc_single_image.php' );
    require( get_template_directory() . '/vc_params/vc_btn.php' );
    require( get_template_directory() . '/vc_params/vc_message.php' );
    require( get_template_directory() . '/vc_params/vc_pie.php' );
    require( get_template_directory() . '/vc_params/vc_tta_accordion.php' );
    require( get_template_directory() . '/vc_params/vc_column_text.php' );
    require( get_template_directory() . '/vc_params/vc_row.php' );
    require( get_template_directory() . '/vc_params/vc_column.php' );
    require( get_template_directory() . '/vc_params/cms_fancybox_single.php' );
    require( get_template_directory() . '/vc_params/cms_grid.php' );

    /*  Riquire font icon */
	//require( get_template_directory() . '/inc/libs/font-icons/glyphicons.php' );
}

/**
 * Add theme elements
 */
function wp_fcgroup_vc_elements() {
	if(class_exists('CmsShortCode')){

		/* Include CMS shortcode */
		add_filter('cms-shorcode-list', 'wp_fcgroup_shortcodes_list');
    }

}
add_action('vc_before_init', 'wp_fcgroup_vc_elements');

function wp_fcgroup_shortcodes_list() {
	$fcgroup_shortcodes_list = array(
		'cms_carousel',
		'cms_grid',
		'cms_fancybox_single',
		'cms_counter_single',
		'cms_progressbar'
	);
	return $fcgroup_shortcodes_list;
}

/**
 * Load custom widget
 */
require( get_template_directory() . '/inc/widgets/cms-tweets.php' );
require( get_template_directory() . '/inc/widgets/cms-recentposts.php' );

/* Add Function Woo*/
/*/ Include woocommerce /*/
if (class_exists('Woocommerce')) {
	require_once( get_template_directory() . '/woocommerce/wc-function-hooks.php' );
	require_once( get_template_directory() . '/woocommerce/wc_template_hook.php' );
}
/* Add Quote Editer */
require( get_template_directory() . '/inc/tinymce/button.php' );

/**
 * Include Roboto google font
 */
function wp_fcgroup_roboto() {
    $fonts_url = '';
    $roboto = _x( 'on', 'Roboto font: on or off', 'wp-fcgroup' );
    if ( 'off' !== $roboto ) {
        $query_args = array(
	        'family' =>  'Roboto:300,300i,400,400italic,500,500italic,700,700italic,300,300italic,100,100italic', 
	        'subset' => urlencode( 'latin,latin-ext' )
        );
    }  
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    return esc_url_raw( $fonts_url );
}
function wp_fcgroup_lato() {
    $fonts_url = '';
    $lato= _x( 'on', 'Lato font: on or off', 'wp-fcgroup' );
    if ( 'off' !== $lato ) {
        $query_args = array(
	        'family' =>  'Lato:100thin,100italic,300light,300italic,400normal,400italic,700bold,700italic,900ultra-bold,900ultra-bold italic', 
	        'subset' => urlencode( 'latin,latin-ext' )
        );
    }  
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    return esc_url_raw( $fonts_url );
}

/**
 * Include Play fair Display google font
 * @return [type] [description]
 */
function wp_fcgroup_playfair() {
    $fonts_url = '';
    $playfair = _x( 'on', 'Playfair font: on or off', 'wp-fcgroup' );
    if ( 'off' !== $playfair ) {
        $query_args = array(
	        'family' =>  'Playfair+Display:400,400italic,700,700italic,900,900italic', 
	        'subset' => urlencode( 'latin,latin-ext' )
        );
    }  
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles for front-end.
 * @author Fox
 * @since CMS SuperHeroes 1.0
 */
function wp_fcgroup_front_end_scripts() {
    
	global $wp_styles , $opt_meta_options;
	/* Adds JavaScript Bootstrap. */
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.2' , true);
	wp_enqueue_script('fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true);
	wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), '1.1.2', true);
	if ( !wp_script_is('', 'owl-carousel')) {
		wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '2.0.0', true);
	}
	/*/ one page. /*/
	if(is_page() && isset($opt_meta_options['page_one_page']) && $opt_meta_options['page_one_page']) {
		wp_register_script('jquery.singlePageNav', get_template_directory_uri() . '/assets/js/jquery.singlePageNav.js', array('jquery'), '1.2.0');
		wp_localize_script('jquery.singlePageNav', 'one_page_options', array('filter' => '.is-one-page', 'speed' => $opt_meta_options['page_one_page_speed']));
		wp_enqueue_script('jquery.singlePageNav');
	}

	/* Add pie.js */
	wp_enqueue_script( 'waypoints' );
	wp_enqueue_script('wp_fcgroup-process-cycle', get_template_directory_uri() . '/assets/js/process_cycle.js', array(), '1.0.0', true);
	wp_enqueue_script('wp_fcgroup-pie-custom', get_template_directory_uri() . '/assets/js/vc_pie_custom.js', array(), '1.0.0', true);

	wp_enqueue_script('wp_fcgroup-menu-sticky', get_template_directory_uri() . '/assets/js/jquery.sticky.js', array(), '1.0.0', true);

	/* Add main.js */
	wp_enqueue_script('wp_fcgroup-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
	/* Add menu.js */
	wp_enqueue_script('wp_fcgroup-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), '1.0.0', true);
	
	/* Comment */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/** ----------------------------------------------------------------------------------- */
	wp_enqueue_style( 'wp-fcgroup-roboto-font', wp_fcgroup_roboto(), array(), null );
	wp_enqueue_style( 'wp-fcgroup-lato-font',wp_fcgroup_lato() , array(), null );
	wp_enqueue_style( 'wp-fcgroup-playfair-font', wp_fcgroup_playfair(), array(), null );
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.2');
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');
	wp_enqueue_style('wp-fcgroup-animate', get_template_directory_uri() . '/assets/css/animate.min.css', '', '1.0.0');
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', '', '2.0.0');
	wp_enqueue_style('animation', get_template_directory_uri() . '/assets/css/animation.css', '', '2.0.0');
	/*css*/
	wp_enqueue_style('robotoblack', get_template_directory_uri() . '/assets/css/fonts.css', '', '2.0.0');

	/* Loads our main stylesheet. */
	wp_enqueue_style( 'wp-fcgroup-style', get_stylesheet_uri(), array( 'bootstrap' ));

	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'wp-fcgroup-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'wp-fcgroup-style' ), '20121010' );
	
	/* ie */
	$wp_styles->add_data( 'wp-fcgroup-ie', 'conditional', 'lt IE 9' );
	
	/* Load static css*/
	wp_enqueue_style('wp-fcgroup-static', get_template_directory_uri() . '/assets/css/static.css', array( 'wp-fcgroup-style' ), '1.0.0');

	if ( !class_exists('EF3_Framework') ) {
		wp_enqueue_style('wp-fcgroup-theme-option', get_template_directory_uri() . '/assets/css/theme-options.css', '', '1.0.0');
	}
}

add_action( 'wp_enqueue_scripts', 'wp_fcgroup_front_end_scripts' );

/*----------------Call css VC admin------------------*/
function wpfcgroup_register_scripts(){
  
    wp_enqueue_style('fcgroup-admin-css', get_template_directory_uri() . '/assets/css/vc-admin.css', array(), '1.0.0');
}

add_action('init', 'wpfcgroup_register_scripts');
/**
 * load admin scripts.
 * 
 * @author FOX
 */
function wp_fcgroup_admin_scripts(){

	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');

	$screen = get_current_screen();

	/* load js for edit post. */
	if($screen->post_type == 'post'){
		/* post format select. */
		wp_enqueue_script('post-format', get_template_directory_uri() . '/assets/js/post-format.js', array(), '1.0.0', true);
	}
	//admin script
	wp_enqueue_script('page-script', get_template_directory_uri().'/assets/js/page-script.js', array('jquery'), '1.0.0', true);
}

add_action( 'admin_enqueue_scripts', 'wp_fcgroup_admin_scripts' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */
function wp_fcgroup_widgets_init() {

	global $opt_theme_options;

	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'wp-fcgroup' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'wp-fcgroup' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	/* footer-top */
	if(!empty($opt_theme_options['footer-bottom-column'])) {

		for($i = 1 ; $i <= $opt_theme_options['footer-bottom-column'] ; $i++){
			register_sidebar(array(
				'name' => sprintf(esc_html__('Footer Bottom %s', 'wp-fcgroup'), $i),
				'id' => 'sidebar-footer-bottom-' . $i,
				'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'wp-fcgroup'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="wg-title">',
				'after_title' => '</h3>',
			));
		}
	}

	register_sidebar( array(
		'name' => esc_html__( 'Left sidebar demo', 'wp-fcgroup' ),
		'id' => 'sidebar-demo',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );	

	register_sidebar( array(
		'name' => esc_html__( 'Left sidebar typography', 'wp-fcgroup' ),
		'id' => 'sidebar-typo',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Main Banner', 'wp-fcgroup' ),
		'id' => 'sidebar-main-banner',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Woocommerce Sidebar', 'wp-fcgroup' ),
		'id' => 'sidebar-woocommerce',
		'description' => esc_html__( 'Appears on pages except the optional Shop Page template, which has its own widgets', 'wp-fcgroup' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'wp_fcgroup_widgets_init' );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0.0
 */
function wp_fcgroup_page_menu_args( $args ) {
    if ( ! isset( $args['show_home'] ) )
        $args['show_home'] = true;
    return $args;
}

add_filter( 'wp_page_menu_args', 'wp_fcgroup_page_menu_args' );

/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since 1.0.0
 */
function wp_fcgroup_comment_nav() {
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wp-fcgroup' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'wp-fcgroup' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'wp-fcgroup' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 */
function wp_fcgroup_paging_nav() {
    // Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	// Set up paginated links.
	$links = paginate_links( array(
			'base'     => $pagenum_link,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation clearfix">
			<div class="pagination loop-pagination">
				<?php echo wp_kses_post($links); ?>
			</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}

/**
* Display navigation to next/previous post when applicable.
*
* @since 1.0.0
*/
function wp_fcgroup_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
	<nav class="navigation post-navigation">
		<div class="nav-links clearfix">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
			  <a class="btn btn-default post-prev left" href="<?php echo get_permalink( $prev_post->ID ); ?>"><i class="fa fa-angle-left"></i><?php echo esc_attr($prev_post->post_title); ?></a>
			<?php endif; ?>
			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) { ?>
			  <a class="btn btn-default post-next right" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_title( $next_post->ID ); ?><i class="fa fa-angle-right"></i></a>
			<?php } ?>

			</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/* Add Custom Comment */
function wp_fcgroup_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
    ?>
    <<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
    <?php endif; ?>
    <div class="comment-author-image vcard">
    	<?php echo get_avatar( $comment, 70 ); ?>
    </div>
    <div class="comment-main">
    	<div class="comment-content">
    		<h5 class="comment-author"><?php echo get_comment_author_link(); ?></h5>
    		<?php if ( $comment->comment_approved == '0' ) : ?>
		    	<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'wp-fcgroup'); ?></em>
		    <?php endif; ?>
    		<?php comment_text(); ?>
    		<div class="reply">
    			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    		</div>
    	</div>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}

/**
 * get header layout.
 */
function wp_fcgroup_header(){
    global $opt_theme_options, $opt_meta_options;

    if(!isset($opt_theme_options)){
        get_template_part('inc/header/header', 'default');
        return;
    }

    if(is_page() && !empty($opt_meta_options['header_layout']))
        $opt_theme_options['header_layout'] = $opt_meta_options['header_layout'];

    /* load custom header template. */
    get_template_part('inc/header/header', $opt_theme_options['header_layout']);
}

/**
 * footer layout
 */
function wp_fcgroup_footer_top() {
    global $opt_theme_options, $opt_meta_options;
    $cta_text = $cta_btn_url = $cta_btn_text = '';
    $cta_text_page = $cta_btn_url_page = $cta_btn_text_page = '';

    /* footer-top */
    if( isset($opt_theme_options['show-cta-footer'])) { 
    	if (is_page() && isset($opt_meta_options['show-cta-footer-page'])) {
			$cta_text_page = !empty($opt_meta_options['cta-text-page'])?$opt_meta_options['cta-text-page']:'';
			$cta_btn_url_page = !empty($opt_meta_options['cta-button-page'])?$opt_meta_options['cta-button-page']:'';
			$cta_btn_text_page = !empty($opt_meta_options['cta-button-text-page'])?$opt_meta_options['cta-button-text-page']:'';
	    	if (!empty($cta_text_page) || !empty($cta_btn_url_page) || !empty($cta_btn_text_page)) {
	    	?>
	    		<div class="footer-cta-wrap">
	    			<div class="container">
	    				<div class="footer-cta-inner row">
	    					<div class="cms-callout-wrap">
		    					
		    					<div class="callout-heading pull-left"><?php echo esc_html($cta_text_page); ?></div>	
		    					
	    						<div class="callout-act pull-right">
	    							<a class="cms-button large" href="<?php echo esc_html($cta_btn_url_page); ?>" title="<?php echo esc_html($cta_btn_text_page); ?>" target="_blank"><?php echo esc_html($cta_btn_text_page); ?></a>	
	    						</div>
		    				</div>
	    				</div>
	    			</div>
	    		</div>
	    	<?php
			}
			
    	}
    	else {
				$cta_text = $opt_theme_options['cta-text'];
	    		$cta_btn_url = $opt_theme_options['cta-button'];
	    		$cta_btn_text = $opt_theme_options['cta-button-text'];
		    	if (!empty($cta_text) || !empty($cta_btn_url) || !empty($cta_btn_text)) {
		    	?>
		    		<div class="footer-cta-wrap">
		    			<div class="container">
		    				<div class="footer-cta-inner row">
		    					<div class="cms-callout-wrap">
			    					<div class="callout-heading pull-left"><?php echo esc_html($cta_text); ?></div>	
			    					
			    					<div class="callout-act pull-right">
			    						<a class="cms-button large" href="<?php echo esc_html($cta_btn_url); ?>" title="<?php echo esc_html($cta_btn_text); ?>" target="_blank"><?php echo esc_html($cta_btn_text); ?></a>	
			    					</div>
		    					</div>
		    				</div>
		    			</div>
		    		</div>
		    	<?php
			}
		
			
    	}
    }
}

function wp_fcgroup_footer_bottom(){
    global $opt_theme_options;

    if(empty($opt_theme_options['footer-bottom-column'])) {
        
    	echo '<p class="text-center">Copyright © FC Group 2016. All rights reserved.</p>';

    } else {
    	$_class = "";
    	$cclass = array('','','','');
    	$custom_class = $opt_theme_options['show_custom_columns'];
    	if(!$custom_class){
    		switch ($opt_theme_options['footer-bottom-column']){
		        case '2':
		            $_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
		            break;
		        case '3':
		            $_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
		            break;
		        case '4':
		            $_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
		            break;
		    }
    	}else{
    		$cclass[0] = $opt_theme_options['col1'];
    		$cclass[1] = $opt_theme_options['col2'];
    		$cclass[2] = $opt_theme_options['col3'];
    		$cclass[3] = $opt_theme_options['col4'];
    	}

	    $col_position = (!empty($opt_theme_options['footer-bottom-pos'])) ? $opt_theme_options['footer-bottom-pos'] : 4;

	    
	    	//if ( is_active_sidebar( 'sidebar-footer-bottom-1' ) ) {
	            echo '<div class="' . esc_html($_class) . ' ' . esc_html($cclass[0]) . '">';
	                ?>	
	                	<?php if ($col_position == 1) : ?>
		                	<div class="copyright-wrap">
		                		<div class="logo-footer-wrap">
		                			<a href="<?php echo esc_url( home_url( '/'  ) );?>"><img src="<?php echo esc_url($opt_theme_options['footer-logo']['url']); ?>" alt="" /></a>
		                		</div>
		                		<div class="copyright-inner">
		                			<?php echo wp_kses( $opt_theme_options['footer-bottom-copyright'], array('a' => array('href' => array(), 'title' => array() ), 'br' => array(), 'em' => array(), 'strong' => array() ) ); ?>
		                		</div>
		                	</div>
		                	<?php wp_fcgroup_social_from_themeoption('footer'); ?>
		                <?php endif; ?>

	                <?php
	                dynamic_sidebar( 'sidebar-footer-bottom-1' );
	            echo "</div>";
	        //}
	   

	    for($i = 2 ; $i < $opt_theme_options['footer-bottom-column'] ; $i++){
	        if ( is_active_sidebar( 'sidebar-footer-bottom-' . $i ) ){
	            echo '<div class="' . esc_html($_class) . ' ' . esc_html($cclass[$i-1]) . '">';
	                dynamic_sidebar( 'sidebar-footer-bottom-' . $i );
	            echo "</div>";
	        }
	    }

    
    	//if ( is_active_sidebar( 'sidebar-footer-bottom-4' ) ) {
            echo '<div class="' . esc_html($_class) . ' ' . esc_html($cclass[3]) . '">';
                ?>
		<!--<h3 class="wg-title" style="color:#fff">Connect with us</h3>-->
                	<?php if ($col_position == 4) : ?>
				<h3 class="wg-title" style="color:#fff;margin-top:-8px;font-size:16px;">Connect with us</h3>
	                	<!--<div class="copyright-wrap">
					<h3 class="wg-title">Connect with us</h3>
	                		<div class="logo-footer-wrap">
	                			<a href="<?php //echo esc_url( home_url( '/'  ) );?>"><img src="<?php echo esc_url($opt_theme_options['footer_logo']['url']); ?>" alt="" /></a>
	                		</div>
	                		<div class="copyright-inner">
	                			<?php //echo wp_kses( $opt_theme_options['footer-bottom-copyright'], array('a' => array('href' => array(), 'title' => array() ), 'br' => array(), 'em' => array(), 'strong' => array() ) ); ?>
	                		</div>
	                	</div>-->
	                	<?php 
				//echo '<h3 class="wg-title" style="color:#fff">Connect with us</h3>';
	                	if (!empty($opt_theme_options['show_social_footer']) && ($opt_theme_options['show_social_footer'] == 1 )):
		                	wp_fcgroup_social_from_themeoption('footer'); 
		                endif;
	                	?>
	                <?php endif; ?>
                <?php
                dynamic_sidebar( 'sidebar-footer-bottom-4' );
            echo "</div>";
        //}
    }
    
}
/**
 * Background position
 */
function wp_fcgroup_background_position() {
    $animate = array(
        esc_html__( 'Default', 'wp-fcgroup' ) => 'center center',
        esc_html__( 'Left Top', 'wp-fcgroup' ) => 'left top',
        esc_html__( 'Left Center', 'wp-fcgroup' ) => 'left center',
        esc_html__( 'Left Bottom', 'wp-fcgroup' ) => 'left bottom',
        esc_html__( 'Right Top', 'wp-fcgroup' ) => 'right top',
        esc_html__( 'Right Center', 'wp-fcgroup' ) => 'right center',
        esc_html__( 'Right Bottom', 'wp-fcgroup' ) => 'right bottom',
    );

    return $animate;
}

/**
 * Animation lib
 */
function wp_fcgroup_animate_lib() {
    $animate = array(
        esc_html__( 'None', 'wp-fcgroup' ) => 'cms_animate',
        esc_html__( 'Fade In Left', 'wp-fcgroup' ) => 'cms_animate fadeInLeft wow',
        esc_html__( 'Fade In Rightt', 'wp-fcgroup' ) => 'cms_animate fadeInRight wow',
        esc_html__( 'Fade In Up', 'wp-fcgroup' ) => 'cms_animate fadeInUp wow',
        esc_html__( 'Effect helix', 'wp-fcgroup' ) => 'cms_animate wow effect_helix',
        esc_html__( 'Zoom In', 'wp-fcgroup' ) => 'cms_animate zoomIn wow',
        esc_html__( 'Zoom Out', 'wp-fcgroup' ) => 'cms_animate zoomOut wow',
        esc_html__( 'Effect Pop', 'wp-fcgroup' ) => 'cms_animate wow effect-pop',
        esc_html__( 'Fade In Down', 'wp-fcgroup' ) => 'cms_animate wow fadeInDown',
        esc_html__( 'Fade In', 'wp-fcgroup' ) => 'cms_animate wow fadeIn',
        esc_html__( 'Fade Out', 'wp-fcgroup' ) => 'cms_animate wow fadeOut',
        esc_html__( 'Effect Fall', 'wp-fcgroup' ) => 'cms_animate wow effect-fall'
    );

    return $animate;
}

/**
 * Animation time delay lib
 */
function wp_fcgroup_animate_time_delay_lib() {
    $animate_time = array(
        esc_html__( 'None', 'wp-fcgroup' ) => '',
        esc_html__( '100ms', 'wp-fcgroup' ) => '100ms',
        esc_html__( '200ms', 'wp-fcgroup' ) => '200ms',
        esc_html__( '300ms', 'wp-fcgroup' ) => '300ms',
        esc_html__( '400ms', 'wp-fcgroup' ) => '400ms',
        esc_html__( '500ms', 'wp-fcgroup' ) => '500ms',
        esc_html__( '600ms', 'wp-fcgroup' ) => '600ms',
        esc_html__( '700ms', 'wp-fcgroup' ) => '700ms',
        esc_html__( '800ms', 'wp-fcgroup' ) => '800ms',
        esc_html__( '900ms', 'wp-fcgroup' ) => '900ms',
        esc_html__( '1s', 'wp-fcgroup' ) => '1s',
        esc_html__( '1.1s', 'wp-fcgroup' ) => '1.1s',
        esc_html__( '1.2s', 'wp-fcgroup' ) => '1.2s',
        esc_html__( '1.3s', 'wp-fcgroup' ) => '1.3s',
        esc_html__( '1.4s', 'wp-fcgroup' ) => '1.4s',
        esc_html__( '1.5s', 'wp-fcgroup' ) => '1.5s',
    );

    return $animate_time;
}
/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpfcgroup_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpfcgroup_custom_excerpt_length', 999 );




/* core functions. */
require_once( get_template_directory() . '/inc/functions.php' );

// ajax get sliders on meta option


add_action( 'wp_ajax_get_sliders_meta_page', 'sliders_meta_page' );

function sliders_meta_page() {
	//get current page id
	$id = $_POST['post'];
	$header_banner_slider = get_post_meta($id, 'ef3-header_banner', true);

	$terms = get_terms( 'category-slider' );
    $return = array('<option></option>');
    foreach ($terms as $key => $term) {
    	$selected = ($header_banner_slider == $term->slug)?' selected = "true" ':'';
        $return[] = '<option value="'.$term->slug.'" '.$selected.'>'.$term->name.'</option>';
    }
    echo implode('', $return);
}
/*/ RevSlider -- Get Slider show meta option/*/
function wp_fcgroup_get_list_rev_slider() {
    if (class_exists('RevSlider')) {

        $slider = new RevSlider();
        $arrSliders = $slider->getArrSliders();

        $revsliders = array(''=>'');
        if ($arrSliders) {
            foreach ($arrSliders as $slider) {
                $revsliders[$slider->getAlias()] = $slider->getTitle();
            }
        } else {
            $revsliders[esc_html__('No sliders found', 'wp-fcgroup' )] = 0;
        }
    return $revsliders;
    }
}