<?php
if (!defined('ABSPATH')) {
	exit;
}
function myphotopages_get_additional_price_html()
{
  global $product;
  $price_html = '';
  $price_data = get_post_meta($product->id, 'custom_price', true);
  if ($price_data)
  {
    $price_array = explode('|', $price_data);
    if (count($price_array) >= 2)
    {
      $price_html .= '<label for="additional_price">';
      $price_html .= $price_array[0];
      $price_html .= ':</label>';
      
      $price_html .= '<span id="additional_price">&nbsp;';
      $price_html .= $price_array[1];
      $price_html .= '</span>';
    }
  }
  return $price_html;
}

// Регистрация областей
if(function_exists('register_sidebar')){
register_sidebar(array('name' => 'header1'));
}
//no current page link
function no_link_current_page( $p ) {
return preg_replace( '%((current_page_item|current-menu-item)[^<]+)[^>]+>([^<]+)</a>%', '$1<a class="mega-menu-link">$3</a>', $p, 1 );
}
function mayak_category_no_link($no_link){
    $gg_mk = '!<li class="cat-item (.*?) current-cat"><a (.*?)>(.*?)</a>!si';
    $dd_mk = '<li class="cat-item \\1 current-cat"><a>\\3</a>';
    return preg_replace($gg_mk, $dd_mk, $no_link );
}
add_filter ('wp_nav_menu', 'no_link_current_page');
add_filter('wp_list_categories', 'mayak_category_no_link');

add_action( 'phpmailer_init', 'my_phpmailer_dkim_cleanup' );
function my_phpmailer_dkim_cleanup( $phpmailer ) {
    if ( '' == $phpmailer->Sender ) {
        $phpmailer->Sender = $phpmailer->From;
        $phpmailer->AddReplyTo( $phpmailer->From );
    }
}
add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );
/**
function remove_msg_filter($msg, $msg_code, $this){
	if ( ! is_shop() && ! is_account_page() ) {
   		 return "";
	}
	return $msg;
}
add_filter('woocommerce_coupon_message','remove_msg_filter',10,3);
function my_woocommerce_add_error( $error ) {
	if( 'Coupon code already applied!' == $error ) {
		$error = '';
	}
	return $error;
}
add_filter( 'woocommerce_add_error', 'my_woocommerce_add_error' );*/

add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );
add_filter( 'login_headertitle', create_function('', 'return false;') );

remove_action( 'template_redirect', 'wp_shortlink_header', 11 ); 
remove_action ( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
add_filter('rest_enabled', '__return_false');
remove_action( 'xmlrpc_rsd_apis',            'rest_output_rsd' );
remove_action( 'wp_head',                    'rest_output_link_wp_head', 10, 0 );
remove_action( 'template_redirect',          'rest_output_link_header', 11, 0 );
remove_action( 'auth_cookie_malformed',      'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired',        'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username',   'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash',       'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid',          'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
remove_action( 'rest_api_init',          'wp_oembed_register_route'              );
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action('wp_head','wp_shortlink_wp_head');
remove_action( 'template_redirect', 'wp_shortlink_header', 11 ); 
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action('wp_head','feed_links_extra', 3);
remove_action('wp_head','feed_links', 2);
remove_action('wp_head','rsd_link');
add_filter( 'wpseo_xml_sitemap_img', '__return_false' );

?>