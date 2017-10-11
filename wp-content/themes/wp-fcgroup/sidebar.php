<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="widget-area" class="widget-area">

		<?php dynamic_sidebar( 'sidebar-1' ); ?>

	</div><!-- .widget-area -->
<?php endif; ?>