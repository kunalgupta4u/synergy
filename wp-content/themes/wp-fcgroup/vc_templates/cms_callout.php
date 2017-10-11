<?php
$callout_heading = '';
$use_link = false;

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$link = (isset($atts['link'])) ? $atts['link'] : '';
$link = vc_build_link( $link );
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $link['url'];
    $a_title = $link['title'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}
?>

<div class="cms-callout-wrap">
	<div class="clearfix">
		<div class="callout-heading pull-left">
			<?php echo esc_html($callout_heading); ?>
		</div>
		<div class="callout-act pull-right">
			<?php if ($use_link == true) : ?>
				<a class="cms-button large" href="<?php echo esc_url($a_href); ?>" title="<?php echo esc_attr($a_title) ?>" target="<?php echo esc_attr($a_target); ?>"><?php echo esc_html($a_title) ?></a>
			<?php endif; ?>
		</div>	
	</div>
</div>