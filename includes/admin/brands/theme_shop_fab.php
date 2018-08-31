<?php
if (!defined('ABSPATH')) {
	exit;
}
function nn_deregister_styles999() {
	$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
    if (in_array('projects', explode('_', $uri_parts[1]))) {
	    wp_enqueue_style('theme_styles303', plugin_dir_url(__FILE__) . 'css/theme_styles_fab.css');	}
    else {
    	wp_enqueue_style('theme_styles304', plugin_dir_url(__FILE__) . 'css/theme_styles_fab_prt.css');
    }
}
add_action( 'wp_print_styles', 'nn_deregister_styles999', 100 );

function pp_deregister_style2() {
	$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
    if (in_array('?projectref', explode('=', $uri_parts[3]))) {
	    wp_enqueue_style('projects_styles2', plugin_dir_url(__FILE__) . 'css/shop_styles_fab.css');	}
    else {
    }
}
add_action( 'wp_print_styles', 'pp_deregister_style2', 99 );

function myplugin_plugin_path() {                     
  return untrailingslashit( plugin_dir_path( __FILE__ ) );
}
function myplugin_woocommerce_locate_template( $template, $template_name, $template_path ) {
  global $woocommerce;
  $_template = $template;
  if ( ! $template_path ) $template_path = $woocommerce->template_url;
  $plugin_path  = myplugin_plugin_path() . '/templates/woocommerce_fab/';
  $template = locate_template(
    array(
      $template_path . $template_name,
      $template_name
    )
  );
  if ( ! $template && file_exists( $plugin_path . $template_name ) )
    $template = $plugin_path . $template_name;
  if ( ! $template )
    $template = $_template;
  return $template;
}
add_filter( 'woocommerce_locate_template', 'myplugin_woocommerce_locate_template', 10, 3 );

function myphotopages_before_add_to_cart_button()
{
  global $product;
  if ($product->product_type == 'external')
  {
    echo '<div class="price">' . $product->get_price_html() . '</div>';
  }  
}
add_action('woocommerce_before_add_to_cart_button', 'myphotopages_before_add_to_cart_button');
add_action('woocommerce_template_loop_price', 'myphotopages_before_add_to_cart_button');

function myphotopages_single_variation()
{
  global $product;  
  $show_price = true;
  $price = $product->get_price();
  foreach($product->get_children() as $var_id)
  {
    $var = new WC_Product_Variation($var_id);
    if ($price != $var->get_price())
    {
      $show_price = false;
      break;
    }
  }
	if  ($product->product_type == 'variable' && (count($product->get_children()) == 1  || $show_price))
  {
    echo '<div class="price">' . $product->get_price_html() . '</div>';
  }
  if ($product->product_type == 'variable')
  {
    echo myphotopages_get_additional_price_html();
  }
}
add_action('woocommerce_single_variation', 'myphotopages_single_variation');
add_action('woocommerce_template_loop_price', 'myphotopages_single_variation');

function change_graphic_lib($array) {
  return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}
add_filter( 'wp_image_editors', 'change_graphic_lib' );

function my_custom_notification($order_id, $checkout=null) {
   global $woocommerce;
   $order = new WC_Order( $order_id );
   if($order->status === 'processed' ) {
      // Create a mailer
      $mailer = $woocommerce->mailer();
      $message_body = __( '<table border="0" cellpadding="0" cellspacing="0" style="font-family:arial;margin:0;padding:0" width="100%"><tr><td>    
<table style="border:1px solid #d6d6d6" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td align="center"> <img src="http://picsprint.ru/wp-content/uploads/2017/03/picsprint_logo_h80px.png">
                        <div align="left" style="padding-left:30px;padding-right:30px">
 <h3 style="background:#000;color:#fff;padding-top:10px;padding-bottom:10px;text-align:center">Здравствуйте!</h3>
 <h1 align="center" style="font-size:22px;font-weight:400">Ваш заказ выполнен и готовится к передаче в службу доставки</h1>                       
Если вы оформляли доставку через транспортную компанию, Ваш заказ в ближайшее время будет передан курьеру.<br><br>
Если вы оформляли доставку курьером по Москве, Ваш заказ в ближайшее время будет передан нашему курьеру. Предварительно курьер с Вами созвонится и договорится об удобном для вас времени доставки заказа на указанный адрес.<br><br>
Если вы указывали при оформлении заказа самовывоз из офиса, Ваш заказ в ближайшее время будет доставлен в пункт выдачи готовых заказов по адресу: г. Москва, проспект Маршала Жукова, дом 2, кор. 2, стр. 1, этаж 4, офис 403.<br><br>
Если вы неправильно указали адрес или хотите сменить адрес доставки, просим вас оперативно поставить в известность сотрудников PicsPrint по E-mail или по телефону.' );
      $message = $mailer->wrap_message(
        // Message head and message body.
        sprintf( __( 'Здраствуйте ваш заказ %s готов' ), $order->get_order_number() ), $message_body );
      // Cliente email, email subject and message.
     $mailer->send( $order->billing_email, sprintf( __( 'Здраствуйте ваш заказ %s готов' ), $order->get_order_number() ), $message );
     }
   }
add_action("woocommerce_order_status_changed", "my_custom_notification");
add_filter('woocommerce_login_redirect', 'bryce_wc_login_redirect');
function bryce_wc_login_redirect( $redirect ) {
     $redirect = 'http://fineartbox.ru/cabinet/';
     return $redirect;
}
function my_admin_logo() {
   echo '
    <style type="text/css">
        #header-logo { background:url(https://fineartbox.ru/favicon.ico) no-repeat 0 0 !important; }
    </style>';
}
add_action('admin_head', 'my_admin_logo');
function my_login_logo(){
   echo '
   <style type="text/css">
        #login h1 a { background: url(http://fineartbox.ru/wp-content/uploads/2017/04/fineARTbox_logo_mini.jpg) no-repeat 0 0 !important; width: 350px; }
    </style>';
}
add_action('login_head', 'my_login_logo');
?>