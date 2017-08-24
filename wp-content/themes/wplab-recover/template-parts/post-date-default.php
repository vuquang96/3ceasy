<?php
	/**
	 * This block will be visible before post title by defaults, or
	 * if user chooses "Default" post date style in Theme Settings, or Unyson Framework inactive
	 **/	
?>
<div class="post-date-default">
	<?php the_time( get_option('date_format') ); ?>
</div>