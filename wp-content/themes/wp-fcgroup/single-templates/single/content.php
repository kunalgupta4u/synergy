<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('fcgroup-single-entry mb-30 fadeIn wow'); ?>>
	<?php wp_fcgroup_post_thumbnail(); ?>
	<div class="entry-container">
		<div class="entry-meta clearfix">
			<div class="pull-left">
				<?php wp_fcgroup_post_detail(); ?>	
			</div>
			<div class="pull-right">
		        <?php wp_fcgroup_article_social_share(); ?>
		    </div>
			<?php  ?>
		</div><!-- .entry-meta -->

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			/* translators: %s: Name of current post */
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wp-fcgroup' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="active">',
				'link_after'  => '</span>',
			) );
			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php wp_fcgroup_single_post_tag(); ?>
		</footer><!-- .entry-footer -->
	</div>
	<?php
		if(is_sticky()) {
            echo '<span class="sticky-post"><i class="fa fa-thumb-tack"></i></span>';
        }
	?>
</article><!-- #post-## -->