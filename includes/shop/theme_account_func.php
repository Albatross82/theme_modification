<?php

if (!defined('ABSPATH')) {
	exit;
}

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
add_filter( 'woocommerce_billing_fields' , 'custom_override_billing_fields' );
function custom_override_checkout_fields( $fields ) {
  	unset($fields['billing']['billing_address_2']);
  return $fields;
}
function custom_override_billing_fields( $fields ) {
  	unset($fields['billing_address_2']);
   return $fields;
}

function ld_wc_filter_billing_fields( $address_fields ) {
    $address_fields['billing_email']['priority'] = 22;
    $address_fields['billing_phone']['priority'] = 27;
    return $address_fields;
}
add_filter( 'woocommerce_billing_fields', 'ld_wc_filter_billing_fields', 10, 1 );
?>