<?php
/**
 * Slides model
 **/
class wplab_recover_slider extends wplab_recover_database {    
	
	/**
	 * Get Revolution Slider slideshows
	 **/
	function get_sliders() {
		
		$table = $this->tables['revslider_sliders'];

		return $this->wpdb->get_results(
			"SELECT *
				FROM $table
				WHERE 1"
		);
		
	}
              
}