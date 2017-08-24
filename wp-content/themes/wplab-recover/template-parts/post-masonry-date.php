<?php
	/**
	 * This block will be visible only if user choose day+month style in theme settings only, 
	 * else get_option('date_format') will be used, but before post title 
	 * due to space limitation (as per design)
	 **/	
?>
<div class="post-date">
	<div class="day"><?php the_time('M d'); ?></div>
	<div class="month"><?php the_time('Y'); ?></div>
</div>