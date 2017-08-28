<?php
class CapchaApi{
	private $_menu_slug         = 'newwave';

	public function __construct(){
		add_action('admin_menu', array($this, 'subMenu'), 111);
	}


    public function subMenu(){
        add_submenu_page('edit.php?post_type=service', __('Api Capcha', NEWWAVE_DOMAIN), __('Api Capcha', NEWWAVE_DOMAIN), 'manage_options', 
        $this->_menu_slug . "-api" , array($this, 'edit'));
    }

	public function edit(){
		$data = $this->update_edit();
        include 'view/edit.phtml';
	}

    public function update_edit(){
		$data = [];
    	if(isset($_POST['submit'])){
    		$data['message'] = 'Update successful';
            update_option('nws_site_key', $_POST['site_key']);
            update_option('nws_secret_key', $_POST['secret_key']);
        }
        $data['site_key'] = get_option('nws_site_key', "");
    	$data['secret_key'] = get_option('nws_secret_key', '');
		return $data;
    }
}