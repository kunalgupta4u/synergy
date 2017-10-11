<?php

/**
 * Auto create css from Meta Options.
 * 
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_DynamicCss
{

    function __construct()
    {
        add_action('wp_head', array($this, 'generate_css'));
    }

    /**
     * generate css inline.
     *
     * @since 1.0.0
     */
    public function generate_css()
    {
        echo '<style type="text/css" data-type="custom-css">'.$this->css_render().'</style>';
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $opt_theme_options, $opt_meta_options;

        ob_start();

        /* custom css. */
        if(!empty($opt_theme_options['custom_css']))
            echo esc_html($opt_theme_options['custom_css']);

        /* 404 page */
        echo '.error-outer-box {
            background-color: '. $opt_theme_options['404-img-bg']['background-color'] .';
        } 
        .error-banner-img, .error-outer-box {
            background-position: '. $opt_theme_options['404-img-bg']['background-position'] .';  
            background-size: '. $opt_theme_options['404-img-bg']['background-size'] .';  
            background-repeat: '. $opt_theme_options['404-img-bg']['background-repeat'] .';
            background-image: url('. $opt_theme_options['404-img-bg']['background-image'] .');
        }';
        

        if ( is_page() && !is_search() && !empty($opt_meta_options['page_general_color'])) {
            echo '#content {background-color: '. $opt_meta_options['page_general_color'] .'}';
        }
         /* custom css. */

         /*Page Title
         ----------------------------*/
        
          if (isset($opt_meta_options['button_set_pagetitle']) && $opt_meta_options['button_set_pagetitle'] == '2') { 
            if( isset($opt_meta_options['page_title_background'])) {
                 echo '.page-title-wrap .page-titile-bg-wrap .page-title-bg {
                    background-color: '. $opt_meta_options['page_title_background']['background-color'] .';
                    background-position: '. $opt_meta_options['page_title_background']['background-position'] .';  
                    background-size: '. $opt_meta_options['page_title_background']['background-size'] .';  
                    background-repeat: '. $opt_meta_options['page_title_background']['background-repeat'] .';
                    background-image: url('. $opt_meta_options['page_title_background']['background-image'] .');
                }' ;
            }
            if( isset($opt_meta_options['page_title_color'])) {
                 echo '.page-title-wrap .page-title-text h1, .page-title-wrap .breadcrumb-text li a{
                    color: '. $opt_meta_options['page_title_color'].';
                }' ;
            }
            /*if( isset($opt_meta_options['breadcrumb_color'])) {
                 echo '.page-title-wrap .page-title-text h1, .page-title-wrap .breadcrumb-text li a{
                    color: '. $opt_meta_options['breadcrumb_color'].';
                }' ;
            }*/
            if( isset($opt_meta_options['breadcrumb_color_hover'])) {
                 echo '.page-title-wrap breadcrumb-text li a:hover,.page-title-wrap .breadcrumb-text li a:focus,.page-title-wrap .breadcrumb-text li{
                    color: '. $opt_meta_options['breadcrumb_color_hover'].';
                }' ;
            }
        }  
        if (!empty($opt_meta_options['button_set_pagetitle']) && $opt_meta_options['button_set_pagetitle'] == '3' && is_page()) {
             echo '.page-title-wrap {display:none;}';
        }
         /*footer
         ----------------------------*/
        if (isset($opt_meta_options['show-cta-footer-page']) && $opt_meta_options['show-cta-footer-page']) { 
            if( isset($opt_meta_options['footer-cta-bg-page'])) {
                 echo '.site-footer .footer-cta-wrap {
                    background-color: '. $opt_meta_options['footer-cta-bg-page']['background-color'] .';
                    background-position: '. $opt_meta_options['footer-cta-bg-page']['background-position'] .';  
                    background-size: '. $opt_meta_options['footer-cta-bg-page']['background-size'] .';  
                    background-repeat: '. $opt_meta_options['footer-cta-bg-page']['background-repeat'] .';
                    background-image: url('. $opt_meta_options['footer-cta-bg-page']['background-image'] .');
                }' ;
            }
        }  

        if (isset($opt_meta_options['show-cta-footer-page']) && $opt_meta_options['show-cta-footer-page']) { 
            if( isset($opt_meta_options['footer-cta-padding-page'])) {
                 echo '.site-footer .footer-cta-inner {
                    padding-top: '. $opt_meta_options['footer-cta-padding-page']['padding-top'] .';
                    padding-bottom: '. $opt_meta_options['footer-cta-padding-page']['padding-bottom'] .'; 
                }' ;
            }
        }
        

        
        return ob_get_clean();
    }
}

new CMSSuperHeroes_DynamicCss();