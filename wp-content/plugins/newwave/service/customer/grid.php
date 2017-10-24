<?php
 require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

 class gird extends  \WP_List_Table{
    private $_per_page = 15;
    private $_total_customer;
    protected $_template ;
    
    public function __construct(){
        $this->items            = $this->getCustomer();
        $this->_total_customer     = $this->totalCustomer();
        
        $this->_template = 'view/grid.phtml';
        $args = array(
            'plural' 	=> 'newwave-customer-grid',
			'singular' 	=> 'newwave-customer-grid'
        );
        
        parent::__construct($args);
        $this->toHtml();
    }

    public function toHtml(){
        include_once $this->_template;
    }

    /* Get Data customer */
    public function getCustomer(){
        $data           = array();
        $paged          = isset($_GET['paged']) ? $_GET['paged'] : 1;
        $offset         = ($paged - 1) * $this->_per_page;

        global $wpdb;
        $sqlData = "SELECT * FROM " . NEWWAVE_CUSTOMER . " LIMIT $offset, " . $this->_per_page;


        $customers = $wpdb->get_results( $sqlData, 'ARRAY_A');

        if(is_array($customers)){
            $i = $offset + 1;
            foreach($customers as $key => $value){
                $customers[$key]['stt']       = $i++;
            }
        }
        return $customers;
    }

    
    /* Count Customer */
    public function totalCustomer(){
        global $wpdb;
        $sqlData = "SELECT * FROM " . NEWWAVE_CUSTOMER ;

        $customers = $wpdb->get_results( $sqlData, 'ARRAY_A');
        $total = count($customers);
        return $total;
    }  
    
    
    
    /* return columns header */
    public function get_columns(){
        $columnHeader = array(
            'stt'               => 'STT',
            'service'           => __( 'Dịch vụ', NEWWAVE_DOMAIN ),
            'store'             => __( 'Cửa hàng', NEWWAVE_DOMAIN ),
            'total'             => __( 'Tổng tiền', NEWWAVE_DOMAIN ),
            'name'              => __( 'Tên', NEWWAVE_DOMAIN ),
            'phone_number'      => __( 'Số điện thoại', NEWWAVE_DOMAIN ),
            'time'              => __( 'Thời gian', NEWWAVE_DOMAIN ),
            'category'          => __( 'Category', NEWWAVE_DOMAIN ),
            'email'             => __( 'Email', NEWWAVE_DOMAIN ),
        );
        return $columnHeader;
    }
    
    /* return columns hidden */
    public function get_hidden_columns(){
        return array('email', 'category');
    }
    
    /* return columns sortable */
    public function get_sortable_columns(){
        return array(
            'id' => array('id' => true)
        );
    }
   
    public function prepare_items(){
        $columnsHeader  = $this->get_columns();
        $columnsHidden  = $this->get_hidden_columns();
        $columnSortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columnsHeader, $columnsHidden, $columnSortable);
        
        $totalPages = ceil($this->_total_customer/$this->_per_page);
        $this->set_pagination_args(array(
                                        'total_items' => $this->_total_customer,
                                        'per_page'    => $this->_per_page,
                                        'total_pages' => $totalPages
                                    ));
    }
    
    public function column_stt($item){
        return $item['stt'];
    }

    public function column_service($item){
        return $item['service'];
    }

    public function column_store($item){
        if($item['store'] != "0"){
            return $item['store'];
        }
        return '';
    }

    public function column_total($item){
        return $item['total'];
    }

    public function column_name($item){
        return $item['name_customer'];
    }

    public function column_phone_number($item){
        return $item['phone_number'];
    }

    public function column_time($item){
        $time   = strtotime($item['time']);
        $hours  = $item['hours'];
        if($hours != "0"){
            return date('d/m/Y', $time) . " <br /> " . $hours;
        }
        return date('d/m/Y', $time);
    }
}