<?php


class footerBar{
	private $_menu_slug         = 'newwave';

	public function __construct(){
		add_action('admin_menu', array($this, 'init'), 11);
	}

	public function init(){
		add_submenu_page($this->_menu_slug, __('Footer Bar', NEWWAVE_DOMAIN), __('Footer Bar', NEWWAVE_DOMAIN), 'manage_options',
        $this->_menu_slug . "-footer-bar", array($this, 'edit'));

    }

	public function edit(){
        $footerBar = get_option("nws_footer_bar", "");
		$data = $this->update_edit();
        include 'view/edit.phtml';
    }

    public function update_edit(){

    	if(isset($_POST['submit'])){
    		$content = $_POST['content'];
            update_option("nws_footer_bar", $content);
        
            ?>
                <script>window.location='<?php echo "?page=" . $_GET['page']; ?>'</script>
            <?php
        }
    }

}

?>