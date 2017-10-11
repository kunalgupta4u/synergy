<?php
/**
 * The template for displaying Search Results pages
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

$blog_column = $blog_secord_col = $blog_layout = '';

$blog_layout = wp_fcgroup_get_theme_option('blog_layout');

if( is_active_sidebar( 'sidebar-1' ) ){

    $blog_column = 'col-xs-12 col-lg-9';
    $blog_secord_col = 'col-xs-12 col-lg-3';
    
     if ($blog_layout == 'full-width') {
        $blog_column = 'col-md-12';
        $blog_secord_col = 'hidden-xs hidden-sm hidden-md hidden-lg';
    }
}
else{

    $blog_column = 'col-md-12';
    $blog_secord_col = 'hidden-xs hidden-sm hidden-md hidden-lg';


}
$push ='';
$pull='';
if ($blog_layout == 'left-sidebar') {
    $push = 'col-md-push-3';
    $pull = 'col-md-pull-9';
}
get_header(); ?>

<section id="primary" class="container">
    <div class="row">
        <div class="<?php echo esc_attr($blog_column); ?> <?php echo esc_attr($push); ?>">
            <main id="main" class="site-main">
            <?php if ( have_posts() ) :

                /* Start the Loop */
                while ( have_posts() ) : the_post();
                    get_template_part( 'single-templates/search', '' );
                endwhile;
                /* get paging_nav. */
                wp_fcgroup_paging_nav();
            else :
                get_template_part( 'single-templates/search', 'not-found' );
            endif; ?>
            </main><!-- #content -->
        </div><!-- #primary -->


       <?php if($blog_layout == 'left-sidebar'){ ?>

            <div class="<?php echo esc_attr($blog_secord_col);?> fcgroup-sidebar-wrap <?php echo esc_attr($pull); ?>">
                <?php get_sidebar(); ?>
            </div><!-- #sidebar left-->

        <?php }?>

        <?php if($blog_layout == 'right-sidebar'){ ?>
            
            <div class="<?php echo esc_attr($blog_secord_col);?> fcgroup-sidebar-wrap" >
                <?php get_sidebar(); ?>
            </div><!-- #sidebar right-->

        <?php }?>
    </div>
</section>
<?php get_footer(); ?>