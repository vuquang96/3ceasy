<?php
class customer {
    private $_menu_slug         = 'newwave';
    public $_per_page           = 5 ;
    
    public function __construct(){
        add_action('admin_menu', array($this, 'subMenu'), 111);
    }


    public function subMenu(){
        add_submenu_page('edit.php?post_type=service', __('Customer', NEWWAVE_DOMAIN), __('Customer', NEWWAVE_DOMAIN), 'manage_options', 
        $this->_menu_slug . "-customer" , array($this, 'grid'));
    }
    
    
    public function grid(){
       require_once "grid.php";
       new gird();
    }

    
}