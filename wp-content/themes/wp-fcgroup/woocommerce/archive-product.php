<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$woo_column = $woo_secord_col = $woo_layout = '';

$woo_layout = wp_fcgroup_get_theme_option('woo_layout');

if( is_active_sidebar( 'sidebar-woocommerce' ) ){

    $woo_column = 'col-xs-12 col-sm-9 col-md-9 col-lg-9';
    $woo_secord_col = 'col-xs-12 col-sm-3 col-md-3 col-lg-3';

    if ($woo_layout == 'full-width') {
        $woo_column = 'col-md-12  ';
        $woo_secord_col = 'hidden-xs hidden-sm hidden-md hidden-lg';
    }
}
else{

    $woo_column = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
    $woo_secord_col = 'hidden-xs hidden-sm hidden-md hidden-lg';
}

get_header( 'shop' ); ?>
<div id="primary" class="container">
	<div class="row">
		<div class="woo-product-list">
			<?php if($woo_layout == 'left-sidebar'){ ?>

	            <div class="<?php echo esc_attr($woo_secord_col);?> sidebar-col">
	                <?php
						/**
						 * woocommerce_sidebar hook.
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						do_action( 'woocommerce_sidebar' );
					?>
	            </div><!-- #sidebar left-->

        <?php }?>
		 <div class="<?php echo esc_attr($woo_column); ?>">
			<?php
				/**
				 * woocommerce_before_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
			?>

				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

				<?php endif; ?>

				<?php
					/**
					 * woocommerce_archive_description hook.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action( 'woocommerce_archive_description' );
				?>

				<?php if ( have_posts() ) : ?>

					<?php
						/**
						 * woocommerce_before_shop_loop hook.
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>

					<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<!-- add row product-->
						<?php $select_columns = wp_fcgroup_get_theme_option('woo_column'); ?>
						<?php
							$i = 0;
							echo '<div class="row">';
							while ( have_posts() ) : the_post();
							if ( $i > 0 && $i%$select_columns == 0) {
								echo '</div><div class="row">';
							}
						?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php
							$i++;
							endwhile; // end of the loop. 
							echo '</div>';
						?>

					<?php woocommerce_product_loop_end(); ?>

					<?php
						/**
						 * woocommerce_after_shop_loop hook.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>

				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>

			<?php
				/**
				 * woocommerce_after_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>

		</div>
		<?php if($woo_layout == 'right-sidebar'){ ?>

            <div class="<?php echo esc_attr($woo_secord_col);?> sidebar-col">
                <?php
					/**
					 * woocommerce_sidebar hook.
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
				?>
            </div><!-- #sidebar right-->

        <?php }?>
		</div>
	</div>
</div>
<?php get_footer( 'shop' ); ?>
