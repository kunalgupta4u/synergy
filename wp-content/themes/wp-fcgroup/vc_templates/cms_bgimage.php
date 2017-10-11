<?php
$image = $css_animation =  $bg_image_position = $cms_layout = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$bg_image_position = (!empty($bg_image_position)) ? $bg_image_position : 'center center';
$image_url = '';
if (!empty($image)) {
    $attachment_image = wp_get_attachment_image_src($image, 'full');
    $image_url = $attachment_image[0];
}

?>

<div class="cms-bgimage-wrap <?php echo esc_attr($css_animation); ?>">
	<div class="cms-bgimage-inner">
		<div class="pos-abs clearfix">
			<div class="cms-bgimage" style="background-image: url(<?php echo balanceTags($image_url); ?>); background-position: <?php echo esc_attr($bg_image_position); ?>;"></div>
		</div>
	</div>
</div>