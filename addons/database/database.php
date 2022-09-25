<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
* Pre Populate Classs
*/
class UACF7_DATABASE {
    
    /*
    * Construct function
    */
    public function __construct() {
        
        // add_action( 'wp_enqueue_scripts', array($this, 'wp_enqueue_script' ) );  
        add_action( 'admin_enqueue_scripts', array($this, 'wp_enqueue_admin_script' ) );       
        add_action( 'wpcf7_before_send_mail', array($this, 'uacf7_save_to_database' ) );     
        add_action( 'admin_menu', array( $this, 'uacf7_add_db_menu' ) );   
        add_action( 'wp_ajax_uacf7_ajax_database_popup', array( $this, 'uacf7_ajax_database_popup' ) ); 
       
    } 
     
    /*
    * Enqueue script Backend
    */
    
    public function wp_enqueue_admin_script() {
        wp_enqueue_style( 'database-admin-style', UACF7_ADDONS . '/database/assets/css/database-admin.css' );
		wp_enqueue_script( 'database-admin', UACF7_ADDONS . '/database/assets/js/database-admin.js', array('jquery'), null, true ); 
        wp_localize_script( 'database-admin', 'database_admin_url',
        array( 
                'admin_url' => get_admin_url().'/admin.php',
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'plugin_dir_url' => plugin_dir_url( __FILE__ ),
            )
         );
    }

    /*
    * Database menu 
    */

    public function uacf7_add_db_menu(){
        add_submenu_page(
            'wpcf7', //parent slug
			__('Ultimate DB','ultimate-addons-cf7'), // page_title
			__('Ultimate DB','ultimate-addons-cf7'), // menu_title
			'manage_options', // capability
			'ultimate-addons-db', // menu_slug
			array( $this, 'uacf7_create_database_page' ) // function
		);
    }

    /*
    * Database Admin Page 
    */

    public function uacf7_create_database_page(){
        ob_start();
        $form_id  = empty($_GET['form_id']) ? 0 : (int) $_GET['form_id']; 
        if( !empty($form_id)){
            $uacf7_ListTable = new uacf7_form_List_Table();
            $uacf7_ListTable->prepare_items(); 
        ?> 
            <div class="wrap">
                <div id="icon-users" class="icon32"></div> 
                <h2>Ultimate Database</h2> 
                <form method="post" action="">
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" /> 
                    <?php $uacf7_ListTable->search_box('Search', 'search'); ?>
                    <?php $uacf7_ListTable->display(); ?>
                </form>
            </div>
            <section class="uacf7_popup_preview">
                <div class="uacf7_popup_preview_content">
                     <div class="close" title="Exit Full Screen">╳</div> 
                    <div id="uacf7_popup_wrap"></div>
                </div>
            </section>
        <?php 
        }else{
            
            global $wpdb; 
            $list_forms = get_posts(array(
                'post_type'     => 'wpcf7_contact_form',
                'posts_per_page'   => -1
            )); 
            ?>
            
            <div class="wrap uacf7-admin-cont">
                <h1><?php echo esc_html__( 'Ultimate Addons Database', 'ultimate-addons-cf7' ); ?></h1> 
                <br>
                <?php settings_errors(); ?>
 
                <!--Tab buttons start-->
                <div class="uacf7-tab">
                <a class="tablinks active" onclick="uacf7_settings_tab(event, 'uacf7_addons')">Ultimate Database</a>  
                </div>
                <!--Tab buttons end-->
    
                <!--Tab Addons start-->
                <div id="uacf7_addons" class="uacf7-tabcontent" style="display:block"> 
                    <table>
                        <tr>
                            <td><h3>Select Form : </h4></td>
                            <td>
                                <select name="form-id" id="form-id">
                                    <option value="0">Select Form</option>
                                    <?php 
                                        foreach ($list_forms as $form) { 
                                            $count = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."uacf7_form WHERE form_id = $form->ID");  // count number of data
                                            echo '<option value="' . esc_attr($form->ID) . '">' . esc_attr($form->post_title) . ' ( '.$count.' )</option>'; 
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>  
                                <button type="submit" class="button-primary" id="database_submit"> Submit</button>
                            </td>
                        </tr>
                    </table> 
                </div>
                <!--Tab Addons end-->   
            </div>
            <?php
            
        }
        echo ob_get_clean();
    } 

    /*
    * Ultimate form save into the database
    */

    public function uacf7_save_to_database($form){ 
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        global $wpdb; 
        $table_name = $wpdb->prefix.'uacf7_form'; 

        $submission   = WPCF7_Submission::get_instance();

        $contact_form = $submission->get_contact_form();
        $contact_form_data = $submission->get_posted_data();
        $files            = $submission->uploaded_files();
        $upload_dir    = wp_upload_dir();
        $dir = $upload_dir['basedir'];
        $uploaded_files = [];
        $time_now      = time();
        $data_file      = []; 

        foreach ($_FILES as $file_key => $file) {
            array_push($uploaded_files, $file_key);
        }
      
   
        foreach ($files as $file_key => $file) {
            if(!empty($file)){
                if(in_array($file_key, $uploaded_files)){ 
                    $file = is_array( $file ) ? reset( $file ) : $file; 
                    $dir_link = '/uacf7-uploads/'.$time_now.'-'.$file_key.'-'.basename($file);
                    copy($file, $dir.$dir_link); 
                    array_push($data_file, [$file_key=> $dir_link]);
                }  
            }
            
        } 
        foreach($contact_form_data as $key => $value){
            
            if(in_array($key, $uploaded_files)){
                $contact_form_data[$key] = $data_file[0][$file_key];
            }
        }
        $data = [
            'status' => 'unread', 
        ];
        
        $data = json_encode(array_merge($data, $contact_form_data)) ; 
 
        $wpdb->insert($table_name, array(
            'form_id' => $form->id(),
            'form_value' =>  $data, 
            'form_date' => current_time('Y-m-d H:i:s'), 
        )); 
    } 
   
    /*
    * Ultimate form save into the database
    */

    public function uacf7_ajax_database_popup(){ 
        global $wpdb; 
        $id = $_POST['id']; // data id
        $upload_dir    = wp_upload_dir();
        $dir = $upload_dir['baseurl'];
        $replace_dir = '/uacf7-uploads/';
        $form_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."uacf7_form WHERE id = $id"); 
        $data = json_decode($form_data->form_value);
        $html = '<div class="db-view-wrap"> 
                    <h3>'.get_the_title( $form_data->form_id ).'</h3>
                    <span>'.$form_data->form_date.'</span>
                    <table class="wp-list-table widefat fixed striped table-view-list">';
        $html .= '<tr> <th><strong>Fields</strong></th><th><strong>Values</strong> </th> </tr>';   
        foreach($data as $key => $value){  
            if($key !='status'){
                if(is_array($value)){ 
                    $value = implode(", ",$value);
                } 
                if (strstr($value, $replace_dir)) { 
                    $value = str_replace($replace_dir,"",$value);
                    $html .= '<tr> <td><strong>'.$key.'</strong></td> <td><a href="'.$dir.$replace_dir.$value.'" target="_blank">'.$value.'</a></td> </tr>';
                }else{ 
                    $html .= '<tr> <td><strong>'.$key.'</strong></td> <td>'.$value.'</td> </tr>';
                }
            }  
        }
        $html .=  '</table></div>';

        // Update data as read
        if($data->status == 'unread'){
            $data->status = 'read'; 
            $data = json_encode($data);
            $update = $wpdb->query("UPDATE ".$wpdb->prefix."uacf7_form SET form_value='".$data."' WHERE id=$id"); 
        } 

        echo $html; // return all data
        
        wp_die();
    }
}

    /*
    * WP_List_Table Class Call
    */

    if( ! class_exists( 'WP_List_Table' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
    }

/*
* extends uacf7_form_List_Table class will create the page to load the table
*/

class uacf7_form_List_Table extends WP_List_Table{ 

    /**
     * Prepare the items for the table to process
     *
     * @return $columns
     */

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns(); 
        $data = $this->table_data(); 
        $this->process_bulk_action();
        $perPage = 10;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden);
        $this->items = $data;
    } 

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */

    public function get_columns()
    {
       
        $form_id  = empty($_GET['form_id']) ? 0 : (int) $_GET['form_id']; 
      
        $ContactForm = WPCF7_ContactForm::get_instance( $form_id );
        $form_fields = $ContactForm->scan_form_tags();
        $columns = [];
        $columns['cb']      = '<input type="checkbox" />'; 
        for ($x = 0; $x <= 4; $x++) { 
          if($form_fields[$x]['type'] != 'submit'){
            $columns[$form_fields[$x]['name']] = $form_fields[$x]['name'];
          }
        }  
        $columns['action'] = 'Action';
        return $columns;
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */

    public function get_hidden_columns()
    {
            return array();
    }

    /**
     * Get the table data
     *
     * @return Array
     */

    private function table_data()
    {
        global $wpdb; 
        $form_id  = empty($_GET['form_id']) ? 0 : (int) $_GET['form_id']; 
        $search       = empty( $_REQUEST['s'] ) ? false :  esc_sql( $_REQUEST['s'] ); 
        $upload_dir    = wp_upload_dir();
        $dir = $upload_dir['baseurl'];
        $replace_dir = '/uacf7-uploads/';
        $data = [];
        if(isset($search) && !empty($search)){
            
            $form_data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uacf7_form  WHERE form_value LIKE '%$search%' AND form_id = $form_id");  
        }else{  
            $form_data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."uacf7_form WHERE form_id = $form_id");  
        }
        
        foreach($form_data as $fdata){ 
           $field_data =  json_decode($fdata->form_value); 
          
           foreach($field_data as $key => $value){
                if(is_array($value)){ 
                    $value = implode(", ",$value);
                } 
                if (strstr($value, $replace_dir)) { 
                    $value = str_replace($replace_dir,"",$value);
                    $f_data[$key] = '<a href="'.$dir.$replace_dir.$value.'" target="_blank">'.$value.'</a>';
                }else{
                    $f_data[$key] =$value;
                }
             
           }
           $f_data['id']      = $fdata->id; 
           $f_data['action'] = "<button data-id='".$fdata->id."' data-value='".$fdata->form_value."' class='button-primary uacf7-db-view'>View</button>";
           $data[] = $f_data;    
        }  
        return $data;
    }

    /**
    * Define what data to show on each column of the table 
    */

    public function column_default( $item, $column_name ){
        return $item[ $column_name ];
    }


    /**
     * Single row add css class for unread data
     * 
     */

    public function single_row( $item ) { 
        $cssClass = ($item['status'] == 'unread') ? 'unread' : 'read';
        echo '<tr class="'.$cssClass.'">';
        $this->single_row_columns( $item );
        echo '</tr>';
    }

    /**
     * Culumn checkbox for data filter
     * 
     */

    public function column_cb($item){  
        return sprintf(
             '<input type="checkbox" name="uacf7_db_id[]" value="%1$s" />', 
             $item['id']
        );
    }

    /**
     * Bulk action
     * 
     */
 
    function get_bulk_actions() {
        $actions = array(
            'delete' => __( 'Delete' , 'visual-form-builder'),  
        ); 
        return $actions;
    }
    
    /**
     * Bulk action Filter
     * 
     */

    function process_bulk_action() {       
        global $wpdb;   

        if ( 'delete' === $this->current_action() ) { 
            $ids = isset( $_POST['uacf7_db_id'] ) ? $_POST['uacf7_db_id'] : array();
            foreach ( $ids as $id ) {
                $id = absint( $id ); 
                $wpdb->query( "DELETE FROM ".$wpdb->prefix."uacf7_form WHERE id = $id" );
            }
        }
    } 

}
new UACF7_DATABASE();