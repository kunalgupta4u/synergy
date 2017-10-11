<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="page-loader-wrapper page-loader-wrapper-1"> 
		<div class="loader">
			<div class="stick1"></div>
			<div class="stick2"></div>
			<div class="stick3"></div>
			<div class="stick4"></div>
        <!--loader-->    
		</div>
    <!--page-loader-wrapper-->    
	</div>

	
	
<div id="page" class="hfeed site">
	<div class="searchform-popup-wrap hidden">
	    <div class="container searchform-inner">
	        <?php get_search_form(); ?>
	    </div>
	</div>
	<header id="masthead" class="site-header" >
		<?php wp_fcgroup_header(); ?>
	</header><!-- #masthead -->
    <?php wp_fcgroup_page_title(); ?><!-- #page-title -->
	<div id="content" class="site-content">
<!--Slideshow Home--> 
	<?php wp_fcgroup_get_meta_option_slider(); ?>