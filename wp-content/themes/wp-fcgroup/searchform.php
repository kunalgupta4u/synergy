<form action="<?php echo esc_url( home_url( '/'  ) );?>" class="searchform" id="searchform" method="get">
	<div>
		<input type="text" id="s" name="s" value="" placeholder="<?php esc_html_e('Search...', 'wp-fcgroup') ?>">
		<button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
	</div>
</form>