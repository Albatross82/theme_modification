<?php

if (!defined('ABSPATH')) {
	exit;
}
/**function register_printing_status() {
    register_post_status( 'wc-printing', array(
        'label'                     => 'Отправлен в печать',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Отправлено в печать <span class="count">(%s)</span>', 'Ожидает печати <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_printing_status' );
*/
function register_processed_status() {
    register_post_status( 'wc-processed', array(
        'label'                     => 'Готов к отправке',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Готов <span class="count">(%s)</span>', 'Готов <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_processed_status' );

function register_shipped_status() {
    register_post_status( 'wc-shipped', array(
        'label'                     => 'Отправлен клиенту',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Отправлено клиенту <span class="count">(%s)</span>', 'Отправлено клиенту <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_shipped_status' );

function add_printing_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
  /*      if ( 'wc-on-hold' === $key ) {
            $new_order_statuses['wc-printing'] = 'Отправлен в печать';
        } */
    	if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-processed'] = 'Готов';
        }
    	elseif ( 'wc-completed' === $key ) {
           $new_order_statuses['wc-shipped'] = 'Отправлен клиенту';
        }
    }
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_printing_statuses' );

function so_39252649_remove_processing_status( $statuses ){
    // Refunded
    if( isset( $statuses['wc-refunded'] ) ){
        unset( $statuses['wc-refunded'] );
    }
    // Failed
	elseif( isset( $statuses['wc-failed'] ) ){
			unset( $statuses['wc-failed'] );
	}
    return $statuses;
}
add_filter( 'wc_order_statuses', 'so_39252649_remove_processing_status' );

function change_statuses_order( $wc_statuses_arr ){
	$new_statuses_arr = array(
		'wc-pending' => $wc_statuses_arr['wc-pending'], // 1
		'wc-on-hold' => $wc_statuses_arr['wc-on-hold'], // 2
//		'wc-processing' => $wc_statuses_arr['wc-processing'], // 4
		'wc-printing' => $wc_statuses_arr['wc-printing'], // 3
		'wc-processed' => $wc_statuses_arr['wc-processed'], // 5
		'wc-shipped' => $wc_statuses_arr['wc-shipped'], // 6
		'wc-completed' => $wc_statuses_arr['wc-completed'], // 7
		'wc-cancelled' => $wc_statuses_arr['wc-cancelled'] // 8
	);
	return $new_statuses_arr;
}
add_filter( 'wc_order_statuses', 'change_statuses_order' );

function wc_renaming_order_status( $order_statuses ) {
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-pending' === $key ) {
            $order_statuses['wc-pending'] = _x( 'Ожидание электронной оплаты', 'Order status', 'woocommerce' );
        }
        elseif ( 'wc-on-hold' === $key ) {
            $order_statuses['wc-on-hold'] = _x( 'Ожидание оплаты', 'Order status', 'woocommerce' );
        }
        elseif ( 'wc-processing' === $key ) {
            $order_statuses['wc-processing'] = _x( 'Препресс', 'Order status', 'woocommerce' );
        } 
    }
    return $order_statuses;
}
add_filter( 'wc_order_statuses', 'wc_renaming_order_status' );

function add_custom_order_status_actions_button( $actions, $order ) {
    // Display the button for all orders that have a 'processing' status
/**    if ( $order->has_status( array( 'processing' ) ) ) {
        $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
        $actions['printing'] = array(
            'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=printing&order_id=' . $order_id ), 'woocommerce-mark-order-status' ),
            'name'      => __( 'Отправлен в печать', 'woocommerce' ),
            'action'    => "view printing", // keep "view" class for a clean button CSS
        );
    } */
    if ( $order->has_status( array( 'printing' ) ) ) {
        $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
        $actions['processed'] = array(
            'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=processed&order_id=' . $order_id ), 'woocommerce-mark-order-status' ),
            'name'      => __( 'Готов', 'woocommerce' ),
            'action'    => "view processed", // keep "view" class for a clean button CSS
        );
    }
    elseif ( $order->has_status( array( 'processed' ) ) ) {
        $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
        $actions['shipped'] = array(
            'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=shipped&order_id=' . $order_id ), 'woocommerce-mark-order-status' ),
            'name'      => __( 'Отправлен клиенту', 'woocommerce' ),
            'action'    => "view shipped", // keep "view" class for a clean button CSS
        );
    }
    elseif ( $order->has_status( array( 'shipped' ) ) ) {
        $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
        $actions['completed'] = array(
            'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=completed&order_id=' . $order_id ), 'woocommerce-mark-order-status' ),
            'name'      => __( 'Выполнен', 'woocommerce' ),
            'action'    => "view completed", // keep "view" class for a clean button CSS
        );
    }
    return $actions;
}
function add_custom_order_status_actions_button_css() {
    echo '<style>.view.printing::after { font-family: woocommerce; content: "\e005" !important; }</style>';
    echo '<style>.view.processed::after { font-family: woocommerce; content: "\e005" !important; }</style>';
    echo '<style>.view.shipped::after { font-family: woocommerce; content: "\e005" !important; }</style>';
	echo '<style>.view.completed::after { font-family: woocommerce; content: "\f147" !important; }</style>';
}
add_filter( 'woocommerce_admin_order_actions', 'add_custom_order_status_actions_button', 100, 2 );
add_action( 'admin_head', 'add_custom_order_status_actions_button_css' );

function misha_register_bulk_action( $bulk_actions ) {
	$bulk_actions['mark_shipped'] = 'Отправлен Клиенту';
	$bulk_actions['mark_processed'] = 'Готов';
//	$bulk_actions['mark_printing'] = 'В печать';
	return $bulk_actions;
}
function misha_bulk_process_custom_status() {
	if( !isset( $_REQUEST['post'] ) && !is_array( $_REQUEST['post'] ) )
		return;
	foreach( $_REQUEST['post'] as $order_id ) {
		$order = new WC_Order( $order_id );
		$order_note = 'That\'s what happened by bulk edit:';
		$order->update_status( 'shipped', $order_note, true ); // "misha-shipment" is the order status name (do not use wc-misha-shipment)
	}
	$location = add_query_arg( array(
   		'post_type' => 'shop_order',
		'marked_shipped' => 1, // markED_awaiting_shipment=1 is just the $_GET variable for notices
		'changed' => count( $_REQUEST['post'] ), // number of changed orders
		'ids' => join( $_REQUEST['post'], ',' ),
		'post_status' => 'all'
	), 'edit.php' );
	wp_redirect( admin_url( $location ) );
	exit;
}
function misha_bulk_process_custom_status2() {
	if( !isset( $_REQUEST['post'] ) && !is_array( $_REQUEST['post'] ) )
		return;
	foreach( $_REQUEST['post'] as $order_id ) {
		$order = new WC_Order( $order_id );
		$order_note = 'That\'s what happened by bulk edit:';
		$order->update_status( 'processed', $order_note, true ); // "misha-shipment" is the order status name (do not use wc-misha-shipment)
	}
	$location = add_query_arg( array(
   		'post_type' => 'shop_order',
		'marked_processed' => 1, // markED_awaiting_shipment=1 is just the $_GET variable for notices
		'changed' => count( $_REQUEST['post'] ), // number of changed orders
		'ids' => join( $_REQUEST['post'], ',' ),
		'post_status' => 'all'
	), 'edit.php' );
	wp_redirect( admin_url( $location ) );
	exit;
}
/**function misha_bulk_process_custom_status3() {
	if( !isset( $_REQUEST['post'] ) && !is_array( $_REQUEST['post'] ) )
		return;
	foreach( $_REQUEST['post'] as $order_id ) {
		$order = new WC_Order( $order_id );
		$order_note = 'That\'s what happened by bulk edit:';
		$order->update_status( 'printing', $order_note, true ); // "misha-shipment" is the order status name (do not use wc-misha-shipment)
	}
	$location = add_query_arg( array(
   		'post_type' => 'shop_order',
		'marked_printing' => 1, // markED_awaiting_shipment=1 is just the $_GET variable for notices
		'changed' => count( $_REQUEST['post'] ), // number of changed orders
		'ids' => join( $_REQUEST['post'], ',' ),
		'post_status' => 'all'
	), 'edit.php' );
	wp_redirect( admin_url( $location ) );
	exit;
}*/
function misha_custom_order_status_notices() {
	global $pagenow, $typenow;
	if( $typenow == 'shop_order' 
	 && $pagenow == 'edit.php'
	 && isset( $_REQUEST['marked_shipped'] )
	 && $_REQUEST['marked_shipped'] == 1
	 && isset( $_REQUEST['changed'] ) ) {
		$message = sprintf( _n( 'Order status changed.', '%s order statuses changed.', $_REQUEST['changed'] ), number_format_i18n( $_REQUEST['changed'] ) );
		echo "<div class=\"updated\"><p>{$message}</p></div>";
	}
}
function misha_custom_order_status_notices2() {
	global $pagenow, $typenow;
	if( $typenow == 'shop_order' 
	 && $pagenow == 'edit.php'
	 && isset( $_REQUEST['marked_processed'] )
	 && $_REQUEST['marked_processed'] == 1
	 && isset( $_REQUEST['changed'] ) ) {
		$message = sprintf( _n( 'Order status changed.', '%s order statuses changed.', $_REQUEST['changed'] ), number_format_i18n( $_REQUEST['changed'] ) );
		echo "<div class=\"updated\"><p>{$message}</p></div>";
	}
}
/**function misha_custom_order_status_notices3() {
	global $pagenow, $typenow;
	if( $typenow == 'shop_order' 
	 && $pagenow == 'edit.php'
	 && isset( $_REQUEST['marked_printing'] )
	 && $_REQUEST['marked_printing'] == 1
	 && isset( $_REQUEST['changed'] ) ) {
		$message = sprintf( _n( 'Order status changed.', '%s order statuses changed.', $_REQUEST['changed'] ), number_format_i18n( $_REQUEST['changed'] ) );
		echo "<div class=\"updated\"><p>{$message}</p></div>";
	}
}*/
add_filter( 'bulk_actions-edit-shop_order', 'misha_register_bulk_action' ); // edit-shop_order is the screen ID of the orders page
add_action( 'admin_action_mark_awaiting_shipment', 'misha_bulk_process_custom_status' ); // admin_action_{action name}
add_action( 'admin_action_mark_awaiting_shipment', 'misha_bulk_process_custom_status2' ); // admin_action_{action name}
//add_action( 'admin_action_mark_awaiting_shipment', 'misha_bulk_process_custom_status3' ); // admin_action_{action name}
add_action('admin_notices', 'misha_custom_order_status_notices');
add_action('admin_notices', 'misha_custom_order_status_notices2');
//add_action('admin_notices', 'misha_custom_order_status_notices3');

function wc_renaming_bulk_status( $translated_text, $untranslated_text, $domain ) {
    if( is_admin()) {
        if( $untranslated_text == 'Change status to processing' ) $translated_text = __( 'Препресс','theme_text_domain' );
        elseif( $untranslated_text == 'Change status to on-hold' ) $translated_text = __( 'Ожидание электронной оплаты','theme_text_domain' );
        elseif( $untranslated_text == 'Change status to completed' ) $translated_text = __( 'Выполнен','theme_text_domain' );
 //       elseif( $untranslated_text == 'PDF Packing Slip' ) $translated_text = __( 'Распечать бланк заказа','theme_text_domain' );
        elseif( $untranslated_text == 'Move to Trash' ) $translated_text = __( 'Удалить заказ','theme_text_domain' );
    }
    return $translated_text;
}
add_filter('gettext', 'wc_renaming_bulk_status', 20, 3);

function wc_reports_get_order_custom_report_data_args( $args ) {
    $args['order_status'] = array( 'completed', 'processed', 'shipped', 'printing' );  
    return $args;
};
add_filter( 'woocommerce_reports_get_order_report_data_args', 'wc_reports_get_order_custom_report_data_args');
?>