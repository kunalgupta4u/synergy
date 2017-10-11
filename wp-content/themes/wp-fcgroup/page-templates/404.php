<?php
/**
 * Template Name: 404 Page
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 * @author DieuLinh
 */

get_header(); ?>
<div id="primary" class="404-page-wrap  col-xs-12 col-md-12 ">
	<div class="row">
		<div class="error-outer-box col-lg-5 col-md-5 col-sm-12 col-xs-12">
			<div class="row">
				<div class="error-box text-center col-xs-12 col-md-12">
					<div class="error-box-inner">
						<div class="error-box-in">
							<div class="logo-wrap">
								<?php $logo = wp_fcgroup_get_theme_option('404-img-logo'); ?>
								<a href="<?php echo esc_url( home_url( '/'  ) );?>">
									<img src="<?php echo esc_url($logo['url']); ?>" alt="">
								</a>
							</div>
							<h2><?php esc_html_e('404', 'wp-fcgroup'); ?></h2>
							<h3><?php esc_html_e('This Page you Requested Could Not be Found!', 'wp-fcgroup'); ?></h3>
							<?php get_search_form(); ?>
							<div class="clearfix"></div>
							<?php wp_fcgroup_404_site_info(); ?>
							<div class="copyright-inner">
	                			<?php echo 'Copyright © Finance Group 2016. All rights reserved.'; ?>
	                		</div>
							<?php wp_fcgroup_social_from_themeoption('footer'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="error-banner-img col-lg-7 col-md-7 hidden-sm hidden-xs">
		</div>
	</div>
</div><!-- .content-area -->

<?php get_footer(); ?>
