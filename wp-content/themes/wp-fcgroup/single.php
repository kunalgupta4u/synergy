<?php
/**
 * The Template for displaying all single posts
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

get_header();
wp_fcgroup_set_post_views(get_the_ID());

$blog_column_single = $blog_secord_col_single = $single_layout = '';

$single_layout = wp_fcgroup_get_theme_option('single_layout');

if( is_active_sidebar( 'sidebar-1' ) ){

    $blog_column_single = 'col-xs-12 col-sm-12 col-md-9 col-lg-9';
    $blog_secord_col_single = 'col-xs-12 col-sm-12 col-md-3 col-lg-3';
    
     if ($single_layout == 'full-width') {
        $blog_column_single = 'col-md-12';
        $blog_secord_col_single = 'hidden-xs hidden-sm hidden-md hidden-lg';
    }
}
else{

    $blog_column_single = 'col-md-12';
    $blog_secord_col_single = 'hidden-xs hidden-sm hidden-md hidden-lg';


}
$push ='';
$pull='';
if ($single_layout == 'left-sidebar') {
    $push = 'col-md-push-3';
    $pull = 'col-md-pull-9';
}
?>

<div id="primary" class="container">
    <div class="row">

        <div class="<?php echo esc_attr($blog_column_single); ?> <?php echo esc_attr($push); ?>">
            <main id="main" class="site-main">

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the single content template.
                    get_template_part( 'single-templates/single/content', get_post_format() );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                    // End the loop.
                endwhile;
                ?>

            </main>
        </div><!-- #main -->


        <?php if($single_layout == 'left-sidebar'){ ?>

            <div class="<?php echo esc_attr($blog_secord_col_single);?> fcgroup-sidebar-wrap <?php echo esc_attr($pull); ?>">
                <?php get_sidebar(); ?>
            </div><!-- #sidebar left-->

        <?php }?>


        <?php if($single_layout == 'right-sidebar'){ ?>
            
            <div class="<?php echo esc_attr($blog_secord_col_single);?> fcgroup-sidebar-wrap" >
                <?php get_sidebar(); ?>
            </div><!-- #sidebar right-->

        <?php }?>
    </div>
</div><!-- #primary -->

<?php get_footer(); ?>