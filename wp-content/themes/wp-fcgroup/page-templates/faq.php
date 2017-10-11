<?php
/**
 * Template Name: FAQ
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 * @author DieuLinh
 */

$blog_column = $blog_secord_col = $blog_layout = '';

$blog_layout = wp_fcgroup_get_theme_option('blog_layout');

if( is_active_sidebar( 'sidebar-1' ) ){

    $blog_column = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
    $blog_secord_col = 'col-lg-3 col-md-3 col-sm-12 col-xs-12';
    
     if ($blog_layout == 'full-width') {
        $blog_column = 'col-md-12 ';
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
              <main id="main" class="site-main" >
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the page content template.
                    get_template_part( 'single-templates/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    // End the loop.
                endwhile;
                ?>
            </main><!-- .site-main -->
        </div>

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
</section><!-- #primary -->

<?php get_footer(); ?>