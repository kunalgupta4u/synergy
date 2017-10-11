<?php
$images = $external_img_size = $custom_links = $columns = $el_class = $css  =  $title ='';
$link_start = $link_end = $col_class = '';
$gal_images = array();
$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $attributes );

$el_class = $this->getExtraClass( $el_class );

$custom_links = vc_value_from_safe( $custom_links );
$custom_links = explode( ',', $custom_links );

$images = explode( ',', $images );
foreach ( $images as $i => $image ) {
	if ( $image > 0 ) {
		$img = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $external_img_size ) );
		$thumbnail = $img['thumbnail'];
		$large_img_src = $img['p_img_large'][0];
	}

	if ( ! empty( $custom_links[ $i ] ) ) {
		$link_start = '<a href="' . $custom_links[ $i ] . '" >';
		$link_end = '</a>';
	}

	$gal_images[] = !empty($custom_links) ? $link_start.$thumbnail.$link_end : $thumbnail;
}

switch ($columns) {
	case 2:
		$col_class = 'col-md-6 col-sm-6 col-xs-6 cms-client-item';
		break;
	case 3:
		$col_class = 'col-md-4 col-sm-6 col-xs-6 cms-client-item';
		break;
	case 6:
		$col_class = 'col-md-2 col-sm-6 col-xs-6 cms-client-item';
		break;
	default:
		$col_class = 'col-md-3 col-sm-6 col-xs-12 cms-client-item';
		break;
}
?>

<div class="cms-clients-wrap">
	<div class="row">
		<div class="partner-heading col-lg-2 col-md-2 col-sm-12 col-xs-12">
			<!-- title-->
	         <?php if($title):?>
	            <?php echo esc_html($title);?>
	        <?php endif;?>
		</div>
		<div class="partners col-lg-10 col-md-10 col-sm-12 col-xs-12">
			<?php
				foreach ($gal_images as $image) { ?>
				
				<div class="<?php echo esc_attr($col_class); ?>">
					<div class="partner-logos col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="box grayscale">
							<?php echo balancetags($image); ?>
						</div>
					</div>
				</div>
			<?php	}
			?>
		</div>
	</div>
</div>
