<?php
/**
 * @name : Default Header
 * @package : CMSSuperHeroes
 * @author : Fox
 */
?>
<div id="cshero-header" class="<?php wp_fcgroup_header_class('cshero-main-header'); ?>">
    <div class="container">
        <div id="cshero-header-logo" class="cshero-header-logo pull-left">
            <?php wp_fcgroup_header_logo(); ?>
        </div><!-- #site-logo -->
        <div id="cshero-menu-mobile" class=" navbar-collapse visible-xs visible-sm ">
            <button class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target="#cshero-header-navigation">
                <span class="icon-bar"></span>
            </button>
        </div><!-- #menu-mobile -->
        <div id="cshero-header-navigation" class="cshero-header-navigation collapse pull-right">
            <nav id="site-navigation" class="main-navigation clearfix" >
                <?php wp_fcgroup_header_navigation(); ?>
            </nav><!-- #site-navigation -->
            <?php do_action('wp_fcgroup_search_icon'); ?>
        </div>
        
    </div>
</div><!-- #site-navigation -->