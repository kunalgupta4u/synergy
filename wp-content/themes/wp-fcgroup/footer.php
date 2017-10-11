<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

?>
    </div><!-- .site-content -->
    <footer id="colophon" class="site-footer">
        <?php wp_fcgroup_footer_top(); ?>

        <div id="footer-bottom-wrap" class="footer-bottom-wrap">
            <div class="container">
                <div class="row">
                    <?php wp_fcgroup_footer_bottom(); ?>
                </div>
            </div>
        </div><!-- #footer-bottom -->
    </footer><!-- .site-footer -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>