<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

get_header(); 
$blog_column = $blog_secord_col = $blog_layout = '';

$blog_layout = wp_fcgroup_get_theme_option('blog_layout');

if( is_active_sidebar( 'sidebar-1' ) ){

    $blog_column = 'col-xs-12 col-sm-12 col-md-9  col-lg-9 ';
    $blog_secord_col = 'col-xs-12 col-sm-12 col-md-3  col-lg-3 ';
    
     if ($blog_layout == 'full-width') {
        $blog_column = 'col-md-12  ';
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
?>

<section id="primary" class="container">
	<div class="row">

		<div class="<?php echo esc_attr($blog_column); ?> <?php echo esc_attr($push); ?>">
            <main id="main" class="site-main">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                        get_template_part( 'single-templates/content/content', get_post_format() );

                    endwhile; // end of the loop.

                    /* blog nav. */
                    wp_fcgroup_paging_nav();

                else :
                    /* content none. */
                    get_template_part( 'single-templates/content', 'none' );
                endif; ?>
            </main><!-- #content -->
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