<?php
function rsaacpptelx_wc_check()
{

    if (class_exists('woocommerce')) {
        global $sat_wc_active;
        $sat_wc_active = 'yes';
    } else {
        global  $sat_wc_active;
        $sat_wc_active = 'no';
    }
}
add_action('admin_init', 'rsaacpptelx_wc_check');
// show admin notice if WooCommerce is not activated
function rsaacpptelx_show_admin_notice()
{
    global  $sat_wc_active;
    //check condition if WooCommerce installed and active otherwise show message for install WooCommerce 
    if ($sat_wc_active == 'no') {
?>
        <div class="notice notice-error is-dismissible">
            <p><strong>Sales POPUP Plugin requires the WooCommerce plugin to be installed and active. You can download <a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> here.</strong></p>
        </div>
    <?php

    }
}
add_action('admin_notices', 'rsaacpptelx_show_admin_notice');
function rsaacpptelx_success_message()
{

    if ($_GET['page'] == 'sat-test' && $_GET['status'] == 1) { ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e('Updated Successfully!'); ?></p>
        </div>
<?php }
}
function rsaacpptelx_email_invalid_error()
{
    $class = 'notice notice-error';
    $message = __('Please enter a valid email address', 'sample-text-domain');
    if ($_GET['page'] == 'sat-test' && $_GET['error'] == 1) {
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }
}
// function for show plugin name in left sidebar menu in admin
function rsaacpptelx_add_custom_admin_menu()
{
    $slug = 'sat-test';
    add_menu_page('Sales POPUP', 'Sales POPUP', 'level_10', $slug, 'view_order_form');
}
add_action('admin_menu', 'rsaacpptelx_add_custom_admin_menu');

/*
@description: include js css for admin header for plugin
*/
function cg_admin_header_script()
{
    $page = isset($_REQUEST['page']) ? wp_unslash(sanitize_text_field($_REQUEST['page'])) : '';
    if ($page == 'sat-test') {
        wp_register_style('cg_jquery-ui', plugins_url('../assets/css/jquery-ui.css', __FILE__));
        wp_enqueue_style('cg_jquery-ui');

         wp_enqueue_script( 'jquery' );
         wp_enqueue_script( 'jquery-ui-core' );


        wp_register_script( 'cg_customjsfile', plugins_url( '../assets/js/cg_admin_custom.js', __FILE__ ), array( 'jquery-ui-tabs' ) );

        wp_enqueue_script( 'cg_customjsfile' );

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('iris', admin_url('js/iris.min.js'), array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false, 1);

        wp_register_style('custom_sat_test', plugins_url('../assets/css/custom_sat_test.css', __FILE__));
        wp_enqueue_style('custom_sat_test');

        wp_register_style('cg_sales_notification_super', plugins_url('../assets/css/cg_sales_notification_admin.css', __FILE__));
        wp_enqueue_style('cg_sales_notification_super');

        

        wp_enqueue_script('momentjs.12', plugins_url('../assets/js/moment.min.js', __FILE__));
        wp_enqueue_script('momentjs.12');

        wp_enqueue_script('datetimepicker.12', plugins_url('../assets/js/daterangepicker.min.js', __FILE__));
        wp_enqueue_script('datetimepicker.12');

        wp_enqueue_style('datetimepicker.12', plugins_url('../assets/css/daterangepicker.css', __FILE__));
        wp_enqueue_style('datetimepicker.12');

        wp_enqueue_script('reportdatetimepicker', plugins_url('../assets/js/jquery.datetimepicker.full.min.js', __FILE__));
        wp_enqueue_script('reportdatetimepicker');

        wp_enqueue_style('reportdatetimepickercss', plugins_url('../assets/css/jquery.datetimepicker.min.css', __FILE__));
        wp_enqueue_style('reportdatetimepickercss');
    
        $salesfcolor_code = "#333";
        if (get_option('salesfcolor_code') != null) {
            $salesfcolor_code = get_option('salesfcolor_code');
        }
    
    
        $sales_size = "20px";
        if (get_option('salesf_size') != null) {
            $sales_size = get_option('salesf_size');
        }
    
        $sales_pos = "br";
        if (get_option('sales_pos') != null) {
            $sales_pos = get_option('sales_pos');
        }
    
        $cf_color = "#222";
        if (get_option('cf_color') != null) {
            $cf_color = get_option('cf_color');
        }
    
        $cf_size = "11px";
        if (get_option('cf_size') != null) {
            $cf_size = get_option('cf_size');
        }
    
        $popup_template = "";
        if (get_option('popup_template') != null) {
            $popup_template = get_option('popup_template');
        }
    
        $salesbcolor_shadow = "0 0 5px #ccc";
        if ($popup_template != "") {
            $salesbcolor_code = "none";
            $salesbcolor_shadow = "none";
        }
    
        $icon_color_code = "#000000";
        if (get_option('icon_color_code') != null) {
            $icon_color_code = get_option('icon_color_code');
        }
    
        $rounded_corner = "off";
        if (get_option('rounded_corner') != null) {
            $rounded_corner = get_option('rounded_corner');
        }
        $popup_custom_css = "";
        if (get_option('popup_custom_css') != null) {
            $popup_custom_css = get_option('popup_custom_css');
        }
    
    
        if ($sales_pos === 'tl') {
            $custom_css = ".popupMain{
                top: 20px;
                bottom: auto;
                right: auto;
                left: 20px;
                margin-left: 0;
                margin-top: 0;
                width: 392px;
                height: 100px;
                position: fixed;
                z-index: 9999999999999;
                border-radius: 4px;
                box-shadow:" . $salesbcolor_shadow . ";
                background:" . $salesbcolor_code . ";}";
        } else if ($sales_pos === 'br') {
            $custom_css = ".popupMain{
                top: auto;
                bottom: 20px;
                right: 20px;
                left: auto;
                margin-left: 0;
                margin-top: 0;
                width: 392px;
                height: 100px;
                position: fixed;
                z-index: 9999999999999;
                border-radius: 4px;
                box-shadow:" . $salesbcolor_shadow . ";
                background:" . $salesbcolor_code . ";}";
        }
        else if ($sales_pos === 'tr') {
            $custom_css = ".popupMain{
                top: 20px;
                bottom: auto;
                right: 20px;
                left: auto;
                margin-left: 0;
                margin-top: 0;
                width: 392px;
                height: 100px;
                position: fixed;
                z-index: 9999999999999;
                border-radius: 4px;
                box-shadow:" . $salesbcolor_shadow . ";
                background:" . $salesbcolor_code . ";}";
        }
        else if ($sales_pos === 'bl') {
            $custom_css = ".popupMain{
                top: auto;
                bottom: 20px;
                right: auto;
                left: 20px;
                margin-left: 0;
                margin-top: 0;
                width: 392px;
                height: 100px;
                position: fixed;
                z-index: 9999999999999;
                border-radius: 4px;
                box-shadow:" . $salesbcolor_shadow . ";
                background:" . $salesbcolor_code . ";}";
        }
    
        
        $custom_css.= " 
                        .text002 h5{font-size:".$cf_size.";color:".$cf_color.";}
                        .text002 h4{font-size:".$sales_size.";color:".$salesfcolor_code.";}
                        .popupMain .cancelBTN{color:".$icon_color_code.";}";
    
        if ($rounded_corner === 'on') {      
            
            $custom_css.= " 
            .product_image {
                border-radius: 14px 0px 0px 14px;
            }    
            .template_image {
                border-radius: 0px 14px 14px 0px;
            }";
    
        }
        $custom_css.= $popup_custom_css;
    
        
    
        wp_add_inline_style('cg_sales_notification_super', $custom_css);
    }
}
add_action('admin_enqueue_scripts', 'cg_admin_header_script');

function cg_frontend_script()
{
    wp_register_style('custom_sat_test', plugins_url('../assets/css/custom_sat_test.css', __FILE__));
    wp_enqueue_style('custom_sat_test');
    wp_enqueue_script('cg_customjsfront', plugins_url('../assets/js/cg_frontend_custom.js', __FILE__));
    wp_enqueue_script('cg_customjsfront');

    wp_register_style('cg_sales_notification', plugins_url('../assets/css/cg_sales_notification.css', __FILE__));
    wp_enqueue_style('cg_sales_notification');

    $salesfcolor_code = "#333";
    if (get_option('salesfcolor_code') != null) {
        $salesfcolor_code = get_option('salesfcolor_code');
    }


    $sales_size = "20px";
    if (get_option('salesf_size') != null) {
        $sales_size = get_option('salesf_size');
    }

    $sales_pos = "br";
    if (get_option('sales_pos') != null) {
        $sales_pos = get_option('sales_pos');
    }

    $cf_color = "#222";
    if (get_option('cf_color') != null) {
        $cf_color = get_option('cf_color');
    }

    $cf_size = "11px";
    if (get_option('cf_size') != null) {
        $cf_size = get_option('cf_size');
    }

    $popup_template = "";
    if (get_option('popup_template') != null) {
        $popup_template = get_option('popup_template');
    }

    $salesbcolor_shadow = "0 0 5px #ccc";
    if ($popup_template != "") {
        $salesbcolor_code = "none";
        $salesbcolor_shadow = "none";
    }

    $icon_color_code = "#000000";
    if (get_option('icon_color_code') != null) {
        $icon_color_code = get_option('icon_color_code');
    }

    $rounded_corner = "off";
    if (get_option('rounded_corner') != null) {
        $rounded_corner = get_option('rounded_corner');
    }
    $popup_custom_css = "";
    if (get_option('popup_custom_css') != null) {
        $popup_custom_css = get_option('popup_custom_css');
    }


    if ($sales_pos === 'tl') {
        $custom_css = ".popupMain{
            visibility: none;
            opacity: 0;
            top: 20px;
            bottom: auto;
            right: auto;
            left: 20px;
            margin-left: 0;
            margin-top: 0;
            width: 392px;
            height: 88px;
            position: fixed;
            z-index: 9999999999999;
            border-radius: 4px;
            box-shadow:" . $salesbcolor_shadow . ";
            background:" . $salesbcolor_code . ";}";
    } else if ($sales_pos === 'br') {
        $custom_css = ".popupMain{
            visibility: none;
            opacity: 0;
            top: auto;
            bottom: 20px;
            right: 20px;
            left: auto;
            margin-left: 0;
            margin-top: 0;
            width: 392px;
            height: 88px;
            position: fixed;
            z-index: 9999999999999;
            border-radius: 4px;
            box-shadow:" . $salesbcolor_shadow . ";
            background:" . $salesbcolor_code . ";}";
    }
    else if ($sales_pos === 'tr') {
        $custom_css = ".popupMain{
            visibility: none;
            opacity: 0;
            top: 20px;
            bottom: auto;
            right: 20px;
            left: auto;
            margin-left: 0;
            margin-top: 0;
            width: 392px;
            height: 88px;
            position: fixed;
            z-index: 9999999999999;
            border-radius: 4px;
            box-shadow:" . $salesbcolor_shadow . ";
            background:" . $salesbcolor_code . ";}";
    }
    else if ($sales_pos === 'bl') {
        $custom_css = ".popupMain{
            visibility: none;
            opacity: 0;
            top: auto;
            bottom: 20px;
            right: auto;
            left: 20px;
            margin-left: 0;
            margin-top: 0;
            width: 392px;
            height: 88px;
            position: fixed;
            z-index: 9999999999999;
            border-radius: 4px;
            box-shadow:" . $salesbcolor_shadow . ";
            background:" . $salesbcolor_code . ";}";
    }

    
    $custom_css.= " 
                    .text002 h5{font-size:".$cf_size.";color:".$cf_color.";}
                    .text002 h4{font-size:".$sales_size.";color:".$salesfcolor_code.";}
                    .popupMain .cancelBTN{color:".$icon_color_code.";}";

    if ($rounded_corner === 'on') {      
        
        $custom_css.= " 
        .product_image {
            border-radius: 14px 0px 0px 14px;
        }    
        .template_image {
            border-radius: 0px 14px 14px 0px;
        }";

    }
    $custom_css.= $popup_custom_css;

    

    wp_add_inline_style('cg_sales_notification', $custom_css);
}

add_action('wp_enqueue_scripts', 'cg_frontend_script');

//function for show popup notification in front end
function view_order_form()
{
    if (!current_user_can('manage_options')) {
        return false;
    }
    $page = isset($_REQUEST['page']) ? wp_unslash(sanitize_text_field($_REQUEST['page'])) : '';
    if ($page == 'sat-test') {
        include(sprintf("%s/templates/view.php", rsaacpptelx_plugin_dir));
    }
}


add_action('init', 'rsaacpptelx_showpopup_initshowpopup');

function rsaacpptelx_showpopup_initshowpopup()
{
    add_shortcode('dspopup', 'rsaacpptelx_showpopup');
}

add_action('wp_head', 'rsaacpptelx_showpopup');

function rsaacpptelx_showpopup($atts)
{


    $page_id = get_queried_object_id();
    cg_update_product_view($page_id);
    cg_create_reportdb();


    //check page condition where needs to be show notification popup on specific pages or all pages
    $condition_array = array();
    if (get_option('pages_contidion') != null) {
        $popup_address_show = get_option('pages_contidion');
        $condition_array = explode(",", $popup_address_show);
    }


    if (empty($condition_array)) {


        //include plugin css file for admin and front end both

        $atts = shortcode_atts(array(
            'foo' => 'no foo',
            'baz' => 'default baz'
        ), $atts, 'bartag');
        if (get_option('salespopup') == "active") { //check plugin is active or not
            return include(sprintf("%s/templates/popup.php", rsaacpptelx_plugin_dir));
        } else {
            return false;
        }
    } else if (!empty($condition_array) && in_array($page_id, $condition_array)) {

        $atts = shortcode_atts(array(
            'foo' => 'no foo',
            'baz' => 'default baz'
        ), $atts, 'bartag');
        if (get_option('salespopup') == "active") {
            return include(sprintf("%s/templates/popup.php", rsaacpptelx_plugin_dir));
        } else {
            return false;
        }
    }
}

//function for create plugin report related tables into database when plugin is installed and activate 
function cg_create_reportdb()
{
    global $wpdb;
    //below table is track popup count click by usre
    $db_table_name = $wpdb->prefix . 'cg_sales_report_popup_count';  // table name
    //below pluign is track product view count on popup with IP address based 
    $db_table_name2 = $wpdb->prefix . 'cg_sales_report_popup_product_count';  // table name
    $charset_collate = $wpdb->get_charset_collate(); //get DB char set

    //Check to see if the table exists already, if not, then create it
    if ($wpdb->get_var("show tables like '$db_table_name'") != $db_table_name) {
        $sql = "CREATE TABLE `$db_table_name` (
                `id` int(11) NOT NULL auto_increment,
                `ip` varchar(15) NOT NULL,
                `popup_name` varchar(60) NOT NULL,
                UNIQUE KEY id (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    //Check to see if the table exists already, if not, then create it
    if ($wpdb->get_var("show tables like '$db_table_name2'") != $db_table_name2) {
        $sql2 = "CREATE TABLE `$db_table_name2` (
                `id` int(11) NOT NULL auto_increment,
                `ip` varchar(15) NOT NULL,
                `popup_name` varchar(60) NOT NULL,
                `product_id` int(11) NOT NULL,
                UNIQUE KEY id (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql2);
    }


    // $wpdb->query($wpdb->prepare("UPDATE $db_table_name SET movement='2021-10-14'"));
    // $wpdb->query($wpdb->prepare("UPDATE $db_table_name2 SET movement='2021-10-14'"));

    // $wpdb->query("ALTER TABLE `$db_table_name` ADD movement DATE NULL");
    // $wpdb->query("ALTER TABLE `$db_table_name2` ADD movement DATE NULL");
}
/*
    function for track user click on popup how many times
*/
function cg_track_popup_product_click($popup_name, $product_id)
{
    global $wpdb; //define db global variable 
    $user_ip = getenv('REMOTE_ADDR'); //get user ip
    //tables name
    $table_name = $wpdb->prefix . 'cg_sales_report_popup_count';
    $table_name2 = $wpdb->prefix . 'cg_sales_report_popup_product_count';

    //below query for check unique user click for unique popup
    $rawsql = "
    SELECT * FROM {$wpdb->prefix}cg_sales_report_popup_count
    WHERE popup_name = %s
    AND ip = %s";

    $sql = $wpdb->prepare($rawsql, $popup_name, $user_ip);
    $results = $wpdb->get_results($sql, ARRAY_A);

    //check data is exist or not with same info
    if (count($results) == 0) {
        $wpdb->insert($table_name, array('id' => NULL, 'ip' => $user_ip, 'popup_name' => $popup_name, 'movement' => date('Y-m-d')));
    }

    //below query for check unique user click for unique popup and product
    $product_count_sql = "
    SELECT * FROM {$wpdb->prefix}cg_sales_report_popup_product_count
    WHERE popup_name = %s
    AND ip = %s
    AND product_id = %s ";

    $peoductsql = $wpdb->prepare($product_count_sql, $popup_name, $user_ip, $product_id);
    $pro_countresults = $wpdb->get_results($peoductsql, ARRAY_A);

    if (count($pro_countresults) == 0) {
        $wpdb->insert($table_name2, array('ip' => $user_ip, 'popup_name' => $popup_name, 'product_id' => $product_id, 'movement' => date('Y-m-d')));
    }
}
function cg_get_track_popup_view()
{
    global $wpdb;
    $results = $wpdb->get_results("SELECT popup_name,count(popup_name) as popup_count FROM {$wpdb->prefix}cg_sales_report_popup_count GROUP BY popup_name");
    return $results;
}
function cg_get_most_view_popup_product($start_date,$end_date)
{
    global $wpdb;
    $wherecondition = "";
    // if ($filter != "") {


    //     switch ($filter) {
    //         case 'all':
    //             $wherecondition = "";
    //             break;
    //         case 'today':
    //             $wherecondition = " WHERE movement='" . $wpdb->esc_like(date('Y-m-d')) . "'";
    //             break;
    //         case 'weekly':
    //             $previoud_week = date("Y-m-d", strtotime("-1 week"));
    //             $today_date = date('Y-m-d');
    //             $wherecondition = " WHERE movement >='" . $wpdb->esc_like($previoud_week) . "' AND movement <='" . $wpdb->esc_like($today_date) . "'";
    //             break;
    //         case 'monthly':
    //             $previoud_month = date("Y-m-d", strtotime("-1 month"));
    //             $today_date = date('Y-m-d');
    //             $wherecondition = " WHERE movement >='" . $wpdb->esc_like($previoud_month) . "' AND movement <='" . $wpdb->esc_like($today_date) . "'";
    //             break;
    //         case 'custom':
    //             $wherecondition = " WHERE movement >='" . $wpdb->esc_like($from_date) . "' AND movement <='" . $wpdb->esc_like($todate) . "'";
    //             break;
    //         default:
    //             $wherecondition = '';
    //     }
    // }

    $wherecondition = " WHERE movement >='" . $wpdb->esc_like($start_date) . "' AND movement <='" . $wpdb->esc_like($end_date) . "'";

    // echo "SELECT product_id,popup_name,count(popup_name) as popup_count FROM {$wpdb->prefix}cg_sales_report_popup_product_count " . $wherecondition . " GROUP BY popup_name,product_id";

    $get_popup_results = $wpdb->get_results("SELECT product_id,popup_name,count(popup_name) as popup_count FROM {$wpdb->prefix}cg_sales_report_popup_product_count " . $wherecondition . " GROUP BY popup_name,product_id");
    
   // print_r($get_popup_results);

    $returnArray = array();
    foreach ($get_popup_results as $get_project) {
        $returnArray[$get_project->popup_name][] = array("product_id" => $get_project->product_id, "product_count" => $get_project->popup_count);
    }

    return $returnArray;
}

function get_last_order_id()
{
    global $wpdb;
    $statuses = array_keys(wc_get_order_statuses());
    $statuses = implode("','", $statuses);

    // Getting last Order ID (max value)
    $results = $wpdb->get_col("
        SELECT MAX(ID) FROM {$wpdb->prefix}posts
        WHERE post_type LIKE 'shop_order'
        AND post_status IN ('$statuses')
    ");
    return reset($results);
}
/*
*@Description : Update view count to product
*@Param: product id
*@return : null
*/
function cg_update_product_view($productid)
{
    $product_id = $productid;
    $product = wc_get_product($product_id);
    $get_val = get_post_meta('_total_views_count');

    if (!empty($product)) {
        cg_product_view_counter($product_id);
    } else {
    }
}

/*
*@Description : Update view count to product based on ip
*@Param: product id
*@return : null
*/
function cg_product_view_counter($product_id)
{

    $userip = $_SERVER['REMOTE_ADDR'];
    $meta = get_post_meta($product_id, '_total_views_count', TRUE);
    $meta = (!$meta) ? array() : explode(',', $meta);
    $meta = array_filter(array_unique($meta));
    if (!in_array($userip, $meta)) {
        array_push($meta, $userip);
        update_post_meta($product_id, '_total_views_count', implode(',', $meta));
    }
}

/*
*@Description : fetch view count of product
*@Param: product id
*@return : number of view count
*/

function cg_show_product_view_counter_on_product_page($product_id)
{


    $id = $product_id;
    $meta = get_post_meta($id, '_total_views_count', true);
    if (!$meta) {
        $count = 0;
    } else {
        $count = count(explode(',', $meta));
    }

    return $count;
}
/*
*@Description : get recent orders products
*@Param: number value, days or min or hours
*@return : product id array
*/
function cg_get_customer_recent_order($beforenum = "", $beforedays = "", $excludearray = array(), $ordersts = array())
{

    $putaray = array();

    if (!empty($ordersts)) {
        $putaray = $ordersts;
    } else {
        $putaray[] = 'wc-completed';
    }
    $customer_orders = get_posts(array(
        'numberposts' => -1,
        'post_type'   => array('shop_order'),
        'post_status' => $putaray,
        'date_query' => array(
            'after' => date('Y-m-d h:i:s', strtotime('-' . $beforenum . ' ' . $beforedays)),
            'before' => date('Y-m-d h:i:s', strtotime('today'))
        )

    ));

    $productid = array();
    foreach ($customer_orders as $customer_order) {
        $order = wc_get_order($customer_order);

        $order = new WC_Order($order->get_id());
        $order_items = $order->get_items();
        foreach ($order_items as $items_key => $items_value) {

            if (!empty($excludearray)) {
                if (in_array($items_value['product_id'], $excludearray)) {
                } else {
                    $productid[] = $items_value['product_id'];
                }
            } else {

                $productid[] = $items_value['product_id'];
            }
        }
    }



    return $productid;
}
/*
*@Description : get products ids which viewed by user
*@Param: null
*@return : product id array
*/
function cg_get_mostviwed_product()
{

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1
    );

    // $args = array(
    //     'post_type'      => 'product',
    //     'posts_per_page' => -1,
    //     'meta_query'     => array(
    //         array(
    //             'key'     => '_stock_status',
    //             'value'   => 'instock',
    //             'compare' => '='
    //         )
    //     )
    // );

    // if ( $outofstock =='yes') {
    //     unset( $args['meta_query'] );
    // }

    // $args = array(
    //     'post_type'      => 'product',
    //     //'terms'    => array('outofstock','instock'),
    //     //'terms'    => array('instock'),
    //     //'operator' => 'IN',
    //     'posts_per_page' => -1,
    //     'tax_query' => array( array(
    //         'taxonomy' => 'product_visibility',
    //         'field'    => 'name',
    //         'terms'    => array('instock'),
    //         'operator' => 'IN',
    //     ) ),
    // );

    $loop = new WP_Query($args);
    $mostvieproductwarray = array();
    while ($loop->have_posts()) : $loop->the_post();
        global $product;
        // echo get_the_id().'**************';

        $mostview = cg_show_product_view_counter_on_product_page(get_the_id());
        if ($mostview > 0) {
            $mostvieproductwarray[] = get_the_id();
        }

    endwhile;

    wp_reset_query();
    // print_r($mostvieproductwarray);
    return $mostvieproductwarray;
}


function cg_get_orders_status()
{
    $ordersts = array(
        "wc-pending" => 'Pending payment',
        "wc-processing" => 'Processing',
        "wc-on-hold" => 'On hold',
        "wc-completed" => 'Completed',
        "wc-cancelled" => 'Cancelled',
        "wc-refunded" => 'Refunded',
        "wc-failed" => 'Failed'
    );
    return $ordersts;
}

function cg_get_back_images()
{
    $images_url = array(
        "autumn_ffffff" => 'autumn.png',
        "black_ffffff" => 'black.png',
        "blue_ffffff" => 'blue.png',
        "christmas_6bbeaa" => 'christmas.png',
        "red_ffffff" => 'red.png',
        "pink_ffffff" => 'pink.png',
        "yellow_000000" => 'yellow.png',
        "violet_ffffff" => 'violet.png',
        "grey_000000" => 'grey.png'
    );
    return $images_url;
}
/*
*@Description : get user location
*@Param: null
*@return : location array
*/
function cg_get_location_detais()
{
    $user_ip = getenv('REMOTE_ADDR');
    $getresposne = wp_remote_get("https://freegeoip.app/json/".$user_ip."");
    $details = json_decode($getresposne['body']);
    
    return $details;
}
/*
*@Description : update options value
*@Param: post data
*@retun: null
*/
function cg_update_popup_option($post_data)
{



    $pages_data = implode(",", $post_data['pages_contidion']);
    if (isset($post_data['salesproduct'])) {
        if (!empty($post_data['salesproduct'])) {
            $salesproduct = implode(",", $post_data['salesproduct']);
        } else {
            $salesproduct = "";
        }
    } else {
        $salesproduct = "";
    }
    if (isset($post_data['get_orders_sts'])) {
        if (!is_array($post_data['get_orders_sts']) && $post_data['get_orders_sts'] == 'all') {
            $orders_sts = "";
        } else {
            $orders_sts = implode(",", $post_data['get_orders_sts']);
        }
    } else {
        $orders_sts = "";
    }

    if (isset($post_data['exclude_product'])) {
        if (!is_array($post_data['exclude_product']) && $post_data['exclude_product'] == 'none') {
            $exclude_product_sts = "";
        } else {

            $exclude_product_sts = implode(",", $post_data['exclude_product']);
        }
    } else {
        $exclude_product_sts = "";
    }

    if ($post_data['get_product_type'] == 'get_products') {
        $exclude_product_sts = "";
        $orders_sts = "";
    } else if ($post_data['get_product_type'] == 'get_billing') {
        $salesproduct = "";
    } else if ($post_data['get_product_type'] == 'recent_viewed') {
        $exclude_product_sts = "";
        $orders_sts = "";
        $salesproduct = "";
    }


    update_option('salesbcolor_code', $post_data['bcolor_code'], '', 'yes');
    update_option('salesfcolor_code', $post_data['fcolor_code'], '', 'yes');
    update_option('salesf_size', $post_data['f_size'], '', 'yes');
    update_option('sales_pos', $post_data['poposition'], '', 'yes');
    update_option('cf_color', $post_data['cf_color'], '', 'yes');
    update_option('cf_size', $post_data['cf_size'], '', 'yes');
    update_option('messagetext', $post_data['messagetext'], '', 'yes');
    update_option('salesproduct', $salesproduct, '', 'yes');
    update_option('virtual_name', $post_data['virtual_name'], '', 'yes');
    update_option('virtual_city_name', $post_data['virtual_city_name'], '', 'yes');
    update_option('sales_popup_type', $post_data['sales_popup_type'], '', 'yes');
    update_option('popup_two_msg', $post_data['popup_two_msg'], '', 'yes');
    update_option('popup_one_heading', $post_data['popup_one_heading'], '', 'yes');
    update_option('popup_two_heading', $post_data['popup_two_heading'], '', 'yes');
    update_option('virtual_time', $post_data['virtual_time'], '', 'yes');
    update_option('delay_time', $post_data['delay_time'], '', 'yes');
    update_option('popup_template', $post_data['popup_template'], '', 'yes');
    update_option('rounded_corner', $post_data['rounded_corner'], '', 'yes');
    update_option('icon_color_code', $post_data['icon_color_code'], '', 'yes');
    update_option('popup_custom_css', $post_data['popup_custom_css'], '', 'yes');
    update_option('message_display_effect', $post_data['message_display_effect'], '', 'yes');
    update_option('message_hide_effect', $post_data['message_hide_effect'], '', 'yes');
    update_option('image_redirect', $post_data['image_redirect'], '', 'yes');
    update_option('pro_link_target', $post_data['pro_link_target'], '', 'yes');
    update_option('p_hide_time', $post_data['p_hide_time'], '', 'yes');
    update_option('popup_address_show', $post_data['popup_address_show'], '', 'yes');
    update_option('pages_contidion', $pages_data, '', 'yes');
    update_option('get_product_type', $post_data['get_product_type'], '', 'yes');
    update_option('orders_sts', $orders_sts, '', 'yes');
    update_option('order_time', $post_data['order_time'], '', 'yes');
    update_option('product_order_time_exact', $post_data['product_order_time_exact'], '', 'yes');
    update_option('exclude_product_sts', $exclude_product_sts, '', 'yes');
    update_option('custom_msg_popup', $post_data['custom_msg_popup'], '', 'yes');
    update_option('min_num_people', $post_data['min_num_people'], '', 'yes');
    update_option('max_num_people', $post_data['max_num_people'], '', 'yes');
    update_option('virtual_state_name', $post_data['virtual_state_name'], '', 'yes');
    update_option('virtual_country', $post_data['virtual_country'], '', 'yes');
    // update_option('out_stock_products', $post_data['out_stock_products'], '', 'yes');
}
/*
*@Description : get all options values
*@Param: null
*@retun: values array
*/
function cg_get_sales_option_values()
{
    $respose_array = array();

    $salesbcolor_code = "#ffffff";
    if (get_option('salesbcolor_code') != null) {
        $salesbcolor_code = get_option('salesbcolor_code');
    }
    $respose_array['salesbcolor_code'] = $salesbcolor_code;
    $checked = " ";
    if (get_option('salespopup') == "active") {
        $checked = "checked";
    }
    $respose_array['checked'] = $checked;
    $salesfcolor_code = "#333";
    if (get_option('salesfcolor_code') != null) {
        $salesfcolor_code = get_option('salesfcolor_code');
    }
    $respose_array['salesfcolor_code'] = $salesfcolor_code;

    $sales_size = "20px";
    if (get_option('salesf_size') != null) {
        $sales_size = get_option('salesf_size');
    }
    $respose_array['sales_size'] = $sales_size;
    $sales_pos = "br";
    if (get_option('sales_pos') != null) {
        $sales_pos = get_option('sales_pos');
    }
    $respose_array['sales_pos'] = $sales_pos;
    $cf_color = "#222";
    if (get_option('cf_color') != null) {
        $cf_color = get_option('cf_color');
    }
    $respose_array['cf_color'] = $cf_color;
    $cf_size = "11px";
    if (get_option('cf_size') != null) {
        $cf_size = get_option('cf_size');
    }
    $respose_array['cf_size'] = $cf_size;

    $virtual_name = "John";
    if (get_option('virtual_name') != null) {
        $virtual_name = get_option('virtual_name');
    }
    $respose_array['virtual_name'] = $virtual_name;

    $virtual_city_name = "Delhi";
    if (get_option('virtual_city_name') != null) {
        $virtual_city_name = get_option('virtual_city_name');
    }
    $respose_array['virtual_city_name'] = $virtual_city_name;


    $salesproduct = "Mens Product";
    if (get_option('salesproduct') != null) {
        $salesproduct = get_option('salesproduct');
    }
    $respose_array['salesproduct'] = $salesproduct;

    $messagetext = "John recently bought the Mens Product";
    if (get_option('messagetext') != null) {
        $messagetext = get_option('messagetext');
    }
    $respose_array['messagetext'] = $messagetext;

    $sales_popup_type_val = "";
    if (get_option('sales_popup_type') != null) {
        $sales_popup_type_val = get_option('sales_popup_type');
    }
    $respose_array['sales_popup_type_val'] = $sales_popup_type_val;

    $popup_two_msg = "";
    if (get_option('popup_two_msg') != null) {
        $popup_two_msg = get_option('popup_two_msg');
    }
    $respose_array['popup_two_msg'] = $popup_two_msg;

    $popup_one_heading = "";
    if (get_option('popup_one_heading') != null) {
        $popup_one_heading = get_option('popup_one_heading');
    }
    $respose_array['popup_one_heading'] = $popup_one_heading;

    $popup_two_heading = "";
    if (get_option('popup_two_heading') != null) {
        $popup_two_heading = get_option('popup_two_heading');
    }
    $respose_array['popup_two_heading'] = $popup_two_heading;

    $virtual_time = "";
    if (get_option('virtual_time') != null) {
        $virtual_time = get_option('virtual_time');
    }
    $respose_array['virtual_time'] = $virtual_time;

    $delay_time = "";
    if (get_option('delay_time') != null) {
        $delay_time = get_option('delay_time');
    }
    $respose_array['delay_time'] = $delay_time;


    $popup_one_heading = "";
    if (get_option('popup_one_heading') != null) {
        $popup_one_heading = get_option('popup_one_heading');
    }
    $respose_array['popup_one_heading'] = $popup_one_heading;

    $popup_two_heading = "";
    if (get_option('popup_two_heading') != null) {
        $popup_two_heading = get_option('popup_two_heading');
    }
    $respose_array['popup_two_heading'] = $popup_two_heading;

    $popup_template = "";
    if (get_option('popup_template') != null) {
        $popup_template = get_option('popup_template');
    }
    $respose_array['popup_template'] = $popup_template;

    $rounded_corner = "off";
    if (get_option('rounded_corner') != null) {
        $rounded_corner = get_option('rounded_corner');
    }
    $respose_array['rounded_corner'] = $rounded_corner;

    $icon_color_code = "#000000";
    if (get_option('icon_color_code') != null) {
        $icon_color_code = get_option('icon_color_code');
    }
    $respose_array['icon_color_code'] = $icon_color_code;

    $popup_custom_css = "";
    if (get_option('popup_custom_css') != null) {
        $popup_custom_css = get_option('popup_custom_css');
    }
    $respose_array['popup_custom_css'] = $popup_custom_css;

    $message_display_effect = "";
    if (get_option('message_display_effect') != null) {
        $message_display_effect = get_option('message_display_effect');
    }

    $respose_array['message_display_effect'] = $message_display_effect;

    $message_hide_effect = "";
    if (get_option('message_hide_effect') != null) {
        $message_hide_effect = get_option('message_hide_effect');
    }
    $respose_array['message_hide_effect'] = $message_hide_effect;




    $salesbcolor_shadow = "0 0 5px #ccc";
    if ($popup_template != "") {
        $salesbcolor_code = "none";
        $salesbcolor_shadow = "none";
    }
    $respose_array['salesbcolor_shadow'] = $salesbcolor_shadow;
    $respose_array['salesbcolor_code'] = $salesbcolor_code;

    $image_redirect = "";
    if (get_option('image_redirect') != null) {
        $image_redirect = get_option('image_redirect');
    }
    $respose_array['image_redirect'] = $image_redirect;


    $pro_link_target = "";
    if (get_option('pro_link_target') != null) {
        $pro_link_target = get_option('pro_link_target');
    }
    $respose_array['pro_link_target'] = $pro_link_target;


    $popup_close_icon = "";
    if (get_option('popup_close_icon') != null) {
        $popup_close_icon = get_option('popup_close_icon');
    }
    $respose_array['popup_close_icon'] = $popup_close_icon;

    $p_hide_time = "";
    if (get_option('p_hide_time') != null) {
        $p_hide_time = get_option('p_hide_time');
    }
    $respose_array['p_hide_time'] = $p_hide_time;


    $popup_address_show = "";
    if (get_option('popup_address_show') != null) {
        $popup_address_show = get_option('popup_address_show');
    }
    $respose_array['popup_address_show'] = $popup_address_show;



    //get selected pages array
    $condition_array = array();
    if (get_option('pages_contidion') != null) {
        $popup_address_show = get_option('pages_contidion');
        $condition_array = explode(",", $popup_address_show);
    }
    $respose_array['condition_array'] = $condition_array;





    //get show product type
    $get_product_type = "";
    if (get_option('get_product_type') != null) {
        $get_product_type = get_option('get_product_type');
    }
    $respose_array['get_product_type'] = $get_product_type;

    $order_time = "";
    if (get_option('order_time') != null) {
        $order_time = get_option('order_time');
    }
    $respose_array['order_time'] = $order_time;

    $product_order_time_exact = "";
    if (get_option('product_order_time_exact') != null) {
        $product_order_time_exact = get_option('product_order_time_exact');
    }
    $respose_array['product_order_time_exact'] = $product_order_time_exact;


    //get exclude array
    $exclude_condition_array = array();
    if (get_option('exclude_product_sts') != null) {
        $exclude_product_show = get_option('exclude_product_sts');
        $exclude_condition_array = explode(",", $exclude_product_show);
    }
    $respose_array['exclude_condition_array'] = $exclude_condition_array;

    //get order status
    $sts_condition_array = array();
    if (get_option('orders_sts') != null) {
        $orders_sts_show = get_option('orders_sts');
        $sts_condition_array = explode(",", $orders_sts_show);
    }
    $respose_array['sts_condition_array'] = $sts_condition_array;

    $custom_msg_popup = "";
    if (get_option('custom_msg_popup') != null) {
        $custom_msg_popup = get_option('custom_msg_popup');
    }
    $respose_array['custom_msg_popup'] = $custom_msg_popup;

    $min_num_people = "";
    if (get_option('min_num_people') != null) {
        $min_num_people = get_option('min_num_people');
    }
    $respose_array['min_num_people'] = $min_num_people;

    $max_num_people = "";
    if (get_option('max_num_people') != null) {
        $max_num_people = get_option('max_num_people');
    }
    $respose_array['max_num_people'] = $max_num_people;



    $virtual_state_name = "";
    if (get_option('virtual_state_name') != null) {
        $virtual_state_name = get_option('virtual_state_name');
    }
    $respose_array['virtual_state_name'] = $virtual_state_name;


    $virtual_country = "";
    if (get_option('virtual_country') != null) {
        $virtual_country = get_option('virtual_country');
    }
    $respose_array['virtual_country'] = $virtual_country;


    // $out_stock_products = "";
    // if (get_option('out_stock_products') != null) {
    //     $out_stock_products = get_option('out_stock_products');
    // }
    // $respose_array['out_stock_products'] = $out_stock_products;

    return $respose_array;
}
