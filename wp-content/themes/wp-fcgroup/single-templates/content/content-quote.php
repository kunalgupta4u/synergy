<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('fcgroup-loop-entry fadeIn wow mb-30'); ?>>
	<?php wp_fcgroup_post_quote(); ?>
	
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
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			/* translators: %s: Name of current post */
			the_excerpt();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wp-fcgroup' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<a class="blog-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'wp-fcgroup') ?></a>
		</footer><!-- .entry-footer -->
	</div>
	<?php
		if(is_sticky()) {
            echo '<span class="sticky-post"><i class="fa fa-thumb-tack"></i></span>';
        }
	?>
</article><!-- #post-## -->