<?php
class StoreLocal{
	private $_menu_slug         = 'newwave';

	public function __construct(){
		add_action('admin_menu', array($this, 'init'), 11);
	}

	public function init(){
		add_submenu_page($this->_menu_slug, __('Store local', NEWWAVE_DOMAIN), __('Store local', NEWWAVE_DOMAIN), 'manage_options',
        $this->_menu_slug , array($this, 'edit'));
        
	}

	public function edit(){
		$data = $this->update_edit();
        include 'view/edit.phtml';
	}

    public function update_edit(){
		$data = [];
    	if(isset($_POST['submit'])){
    		$data['message'] = 'Update successful';
            if(abs($_POST['time']) >= 2){
                update_option('nws_old_update_time_storelocal', time());
                update_option('nws_time_update_storelocal', abs($_POST['time']));
            }

            if($_POST['api'] != ""){
                update_option('nws_api_storelocal', $_POST['api']);
                $this->auto_update(true);
            }
        }
        $data['api'] = get_option('nws_api_storelocal', "");
    	$data['time'] = get_option('nws_time_update_storelocal', 12);
		return $data;
    }

    public function auto_update($action = false){
 		$timeDelay 	= get_option('nws_time_update_storelocal', 12);
        $timeDelay = $timeDelay  * 60 * 60;
		$timeUpdate = get_option('nws_old_update_time_storelocal', time()) + $timeDelay;
        
        if(time() > $timeUpdate || $action){
            update_option('nws_old_update_time_storelocal', time());
			$url        = get_option('nws_api_storelocal', "");
			$idWp 		= $this->get_id_parent();
			$idLar 		= $this->get_data_api($url, true);
			$dataLar 	= $this->get_data_api($url);
            $meta_keys 	= $this->get_meta_keys();
            if(is_array($dataLar)){
    			foreach ($idWp as $value) {
    				if( in_array($value['parent'], $idLar) ){
    					// Update
    					$this->update_post($value['post'], $meta_keys, $dataLar['key-'.$value['parent']]);
    					$key = array_search($value['parent'], $idLar);
    					unset($idLar[$key]);
    				}else{
    					// delete
    					$this->delete_post($value['post'], $meta_keys);
    				}
    			}

    			if(count($idLar) > 0){
    				foreach ($idLar as $key) {
    					$this->insert_post($meta_keys, $dataLar['key-'.$key]);
    				}
    			}
            }
		}
    }

    public function insert_post($meta_keys, $data){
		$post = array (
            'post_type'    => 'wpsl_stores',
            'post_status'  => 'publish',
            'post_title'   => $data['name'],
            'post_content' => $data['description']                 
    	);

    	$post_id = wp_insert_post( $post );

		if ( $post_id ) {
			$address = $data['address'] . ' ,' . $data['city'] . ' ,' . $data['country'];
			$coordinates = $this->get_coordinates($address);

			$dataMeta = [];
	    	$dataMeta['email'] 		= $data['email'];
	    	$dataMeta['address'] 	= $data['address'];
	    	$dataMeta['city'] 		= $data['city'];
	    	$dataMeta['country'] 	= $data['country'];
	    	$dataMeta['lat'] 		= $coordinates['lat'];
    		$dataMeta['lng'] 		= $coordinates['lng'];
	    	$dataMeta['id_parent'] 	= $data['id'];
	    	

            // Save the data from the wpsl_stores db table as post meta data.
            foreach ( $meta_keys as $meta_key ) {
            	if(isset($dataMeta[$meta_key])){
            		update_post_meta( $post_id, 'wpsl_' . $meta_key, $dataMeta[$meta_key] );
            	}else{
            		update_post_meta( $post_id, 'wpsl_' . $meta_key, '' );
            	}
                
            }
        }
    }

    
	public function update_post($idPost, $meta_keys, $data){
        $post = array(
            'ID' => esc_sql($idPost),
            'post_content' => $data['description'],
            'post_title' => $data['name']
        );
        wp_update_post($post, true);

		$address = $data['address'] . ' ,' . $data['city'] . ' ,' . $data['country'];
		$coordinates = $this->get_coordinates($address);
		$dataMeta = [];
    	$dataMeta['email'] 		= $data['email'];
    	$dataMeta['address'] 	= $data['address'];
    	$dataMeta['city'] 		= $data['city'];
    	$dataMeta['country'] 	= $data['country'];
    	$dataMeta['lat'] 		= $coordinates['lat'];
    	$dataMeta['lng'] 		= $coordinates['lng'];
    	$dataMeta['id_parent'] 	= $data['id'];


        // Save the data from the wpsl_stores db table as post meta data.
        foreach ( $meta_keys as $meta_key ) {
        	if(isset($dataMeta[$meta_key])){
        		update_post_meta( $idPost, 'wpsl_' . $meta_key, $dataMeta[$meta_key] );
        	}else{
        		update_post_meta( $idPost, 'wpsl_' . $meta_key, '' );
        	}
            
        }

    }

    public function get_meta_keys(){
    	$meta_keys  = array( 'address', 'address2', 'city', 'state', 'zip', 'country', 'country_iso', 'lat', 'lng', 'phone', 'fax', 'url', 'email', 'hours', 'id_parent');
    	return $meta_keys;
    }

    public function get_data_api($url, $id = false){
        $dataApi = json_decode(file_get_contents($url), true);
        
        if(is_array($dataApi)){
            $ids    = [];
            $data   = [];
            if($id){
                foreach ($dataApi['data'] as $value) {
                    $ids[] = $value['id'];
                }
                return $ids;
            }else{
                foreach ($dataApi['data'] as $value) {
                    $data['key-' . $value['id']] = $value;
                }
                return $data;
            }
        }
        return false;
    }

    public function get_ids(){
    	global $wpdb; 
		$table = $wpdb->prefix . "posts";
        $sql = "SELECT `id` FROM `$table` WHERE `post_type` = 'wpsl_stores' AND `post_status` = 'publish'";

        $post_ids  = $wpdb->get_results($sql, 'ARRAY_A');
        $ids = [];
        foreach ($post_ids as  $value) {
        	$ids[] = $value['id'];
        }
        return $ids;
    }

    public function get_id_parent(){
    	$ids = [];
    	$postIds = $this->get_ids();
    	foreach($postIds as $key =>  $value){
    		$ids[$key]['parent'] = get_post_meta($value, 'wpsl_id_parent', true);
    		$ids[$key]['post'] = $value;
    	}
    	return $ids;
    }

    public function delete_post($id, $meta_keys){
		foreach ( $meta_keys as $meta_key ) {
            wp_delete_post( $post_id, 'wpsl_' . $meta_key);
        }
		wp_delete_post($id);
    }

    public function get_coordinates($address){
    	 $address = urlencode ($address);
	    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    $response = curl_exec($ch);
	    curl_close($ch);
	    $response_a = json_decode($response);

	    $data = [];
	    $data['lat'] = $response_a->results[0]->geometry->location->lat;
	    $data['lng'] = $response_a->results[0]->geometry->location->lng;
	    return $data;
    }
}