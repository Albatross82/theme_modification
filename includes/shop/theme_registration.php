<?php

if (!defined('ABSPATH')) {
	exit;
}

//44015

function result_add_endpoint() {
	global $wp_rewrite;
    //add_rewrite_endpoint('sso', EP_ROOT | EP_PAGES );
    //add_rewrite_endpoint('prepare-checkout', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint('logout', EP_ROOT );
    //add_rewrite_endpoint('sign-in', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint('sign-in/reset_password', EP_ROOT  );
    add_rewrite_endpoint('sign-in/lost_password', EP_ROOT  );
    add_rewrite_endpoint('sign-in/reg', EP_ROOT);
    add_rewrite_endpoint('sign-in/thank-you', EP_ROOT  );
    $wp_rewrite->flush_rules();
}
add_action( 'init', 'result_add_endpoint');

function plugin_myown_content($template) {
	global $wp_query;
    if ( array_key_exists( 'logout', $wp_query->query_vars ) ) {
		echo do_shortcode("[tpxig_force_logout]");
		$result = get_query_var('logout');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/auth/checkout.php';
		return $new_template;
    } 
    elseif ( array_key_exists( 'sign-in/reset_password', $wp_query->query_vars ) ) {
		$result = get_query_var('sign-in/reset_password');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/auth/reset-password.php';
		return $new_template;
    } 
    elseif ( array_key_exists( 'sign-in/lost_password', $wp_query->query_vars ) ) {
		$result = get_query_var('sign-in/lost_password');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/auth/lost-password.php';
		return $new_template;
    }
    elseif( array_key_exists( 'sign-in/reg', $wp_query->query_vars ) ) {
		$result = get_query_var('sign-in/reg');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/auth/register.php';
		return $new_template;
    } 
    elseif ( array_key_exists( 'sign-in/thank-you', $wp_query->query_vars ) ) {
		$result = get_query_var('sign-in/thank-you');
		$new_template = plugin_dir_path(__FILE__) . '../../themplates/auth/thank-you.php';
		return $new_template;
    }
    else {
        return $template;
    }
}
add_filter('template_include','plugin_myown_content');

function wc_custom_registration_form2( $atts ) {
 return wc_get_template( '../../../plugins/theme-modifications/themplates/auth/login.php', array( 'form' => 'login_form' ) );
    }
add_shortcode( 'log_account_in', 'wc_custom_registration_form2' );

function wooc_save_extra_register_fields( $customer_id ) {
      if ( isset( $_POST['billing_first_name'] ) ) {
             update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
             update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
      }
      if ( isset( $_POST['billing_last_name'] ) ) {
             update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
             update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
      }
} 
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );

function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: Имя - обязательное поле.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Фамилия - обязательное поле.', 'woocommerce' ) );
    }
}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

add_filter( 'woocommerce_new_customer_data', function( $data ) {
    $data['user_login'] = $data['user_email'];
        return $data;
        } );
add_action( 'woocommerce_customer_save_address','isa_customer_save_address', 10, 1);

function ps_wc_registration_redirect( $redirect_to ) {
     $redirect_to = '/sign-in/thank-you';
     return $redirect_to;
}
add_filter('woocommerce_registration_redirect', 'ps_wc_registration_redirect');

function my_custom_flush_rewrite_rules() {
    flush_rewrite_rules();
}

add_action( 'wp_loaded', 'my_custom_flush_rewrite_rules' );
?>