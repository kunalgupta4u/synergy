<?php 
	// Change number or products per row to 3
	
	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			global $opt_theme_options;
			return $opt_theme_options['woo_column']; // 3 products per row
		}
	}
	// Display 24 products per page. Goes in functions.php
	add_filter( 'loop_shop_per_page', 'woo_item_per_page', 20 );
		if (!function_exists('woo_item_per_page')) {
		function woo_item_per_page($cols) {
			global $opt_theme_options;
			return $opt_theme_options['woo_item_per_page'];
		}
	}
 ?>