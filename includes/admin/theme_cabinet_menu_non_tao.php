<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
function wk_new_menu_items( $items ) {
    $items = array(
    'dashboard' => __( 'Кабинет', 'woocommerce' ),
//    'orders' => __( 'История заказов', 'woocommerce' ),
//    'wc-smart-coupons' => __( 'Подарочные сертификаты', 'woocommerce' ),
    'edit-account' => __( 'Персональные данные', 'woocommerce' ),
    'customer-logout' => __( 'Выход', 'woocommerce' ),
    );
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'wk_new_menu_items');

///make and rename menu 
function my_custom_insert_after_helper( $items, $new_items, $after ) {
	// Search for the item position and +1 since is after the selected item key.
	$position = array_search( $after, array_keys( $items ) ) + 1;
	// Insert the new item.
	$array = array_slice( $items, 0, $position, true );
	$array += $new_items;
	$array += array_slice( $items, $position, count( $items ) - $position, true );
    return $array;
}
function my_custom_my_account_menu_items( $items ) {
	$new_items = array();
	$new_items['non_order'] = __( 'Незавершенные заказы', 'woocommerce' );
	$new_items['work_orders'] = __( 'Заказы в работе', 'woocommerce' );
	$new_items['deliver22'] = __( 'Заказы в доставке', 'woocommerce' );
	$new_items['all_orders'] = __( 'История заказов', 'woocommerce' );	
	// Add the new item after `orders`.
	return my_custom_insert_after_helper( $items, $new_items, 'dashboard' );
}

function my_custom_my_account_menu_items2( $items ) {
	$new_items = array();
	$new_items['balans'] = __( 'Баланс счета', 'woocommerce' );
	// Add the new item after `orders`.
	return my_custom_insert_after_helper( $items, $new_items, 'orders' );
}

function remove_my_account_links( $menu_links ){
	unset( $menu_links['edit-address'] ); // Addresses
 	unset( $menu_links['payment-methods'] ); // Payment Methods
	unset( $menu_links['downloads'] ); // Downloads
	//unset( $menu_links['edit-account'] ); / Account details
	return $menu_links;
}
add_filter( 'woocommerce_account_menu_items', 'my_custom_my_account_menu_items' );
add_filter( 'woocommerce_account_menu_items', 'my_custom_my_account_menu_items2' );
add_filter ( 'woocommerce_account_menu_items', 'remove_my_account_links' );

//make endpoins
function wk_custom_endpoint() {
  add_rewrite_endpoint( 'non_order', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'work_orders', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'deliver22', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'all_orders', EP_ROOT | EP_PAGES );
  add_rewrite_endpoint( 'balans', EP_ROOT | EP_PAGES );
  flush_rewrite_rules();
}
add_action( 'init', 'wk_custom_endpoint' );
 
function plugin_myown_content2($template) {
	global $wp_query;
    elseif ( array_key_exists( 'non_order', $wp_query->query_vars ) ) {
		$result = get_query_var('non_order');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/myaccount/my-orders_non.php';
		return $new_template;
    } 
    elseif ( array_key_exists( 'work_orders', $wp_query->query_vars ) ) {
		$result = get_query_var('work_orders');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/myaccount/my-orders_work.php';
		return $new_template;
    }
    elseif ( array_key_exists( 'deliver22', $wp_query->query_vars ) ) {
		$result = get_query_var('deliver22');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/myaccount/my-orders_deliver.php';
		return $new_template;
    }
    elseif ( array_key_exists( 'all_orders', $wp_query->query_vars ) ) {
		$result = get_query_var('all_orders');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/myaccount/my-orders_all.php';
		return $new_template;
    }
    elseif ( array_key_exists( 'balans', $wp_query->query_vars ) ) {
		$result = get_query_var('balans');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/myaccount/yith_fund.php';
		return $new_template;
    } 
    else {
        return $template;
    }
}
add_filter('template_include','plugin_myown_content2');

function my_non_order_endpoint_content() {
}
function my_work_orders_endpoint_content() {
}
function my_deliver22_endpoint_content() {
}
function my_all_orders_endpoint_content() {
}
function my_balans_endpoint_content() {
}
add_action( 'woocommerce_account_non_order_endpoint', 'my_non_order_endpoint_content' );
add_action( 'woocommerce_account_work_orders_endpoint', 'my_work_orders_endpoint_content' );
add_action( 'woocommerce_account_deliver22_endpoint', 'my_deliver22_endpoint_content' );
add_action( 'woocommerce_account_all_orders_endpoint', 'my_all_orders_endpoint_content' );
add_action( 'woocommerce_account_balans_endpoint', 'my_balans_endpoint_content' );

function cma_get_template( $located, $template_name, $args, $template_path, $default_path ) {    
    if ( 'myaccount/form-edit-account.php' == $template_name ) {
        $located = plugin_dir_path( __FILE__ ) . '../../themplates/myaccount/edit-personal.php';
    }
    elseif ( 'myaccount/dashboard.php' == $template_name ) {
        $located = plugin_dir_path( __FILE__ ) . '../../themplates/myaccount/dashboard.php';
    }
    return $located;
}
add_filter( 'wc_get_template', 'cma_get_template', 10, 5 );
*/
?>