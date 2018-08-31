<?php
if (!defined('ABSPATH')) {
	exit;
}
function nn_deregister_styles2() {
			wp_enqueue_style('theme_styles5', plugin_dir_url(__FILE__) . 'css/theme_styles_cout.css');
		}
add_action( 'wp_print_styles', 'nn_deregister_styles2', 100 );

function pp_deregister_style33() {
	$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
    if (in_array('?projectref', explode('=', $uri_parts[3]))) {
	    wp_enqueue_style('projects_styles33', plugin_dir_url(__FILE__) . 'css/shop_styles_cout.css');	
	    }
    else {
    }
}
add_action( 'wp_print_styles', 'pp_deregister_style33', 99 );

/**echo "<pre>";
    $uri_parts = explode('/', $_SERVER['REQUEST_URI']);
   print_r(explode('_', $uri_parts[2]));
echo "</pre>";*/

function nn_deregister_styles999() {
	$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
    if (in_array('pack', explode('_', $uri_parts[2]))) {
	     wp_enqueue_style('projects_styles2', plugin_dir_url(__FILE__) . 'css/shop_styles_cout.css');	
	     }
    else {
    }
}
add_action( 'wp_print_styles', 'nn_deregister_styles999', 100 );

function myplugin_plugin_path() {                     
  return untrailingslashit( plugin_dir_path( __FILE__ ) );
}
function myplugin_woocommerce_locate_template( $template, $template_name, $template_path ) {
  global $woocommerce;
  $_template = $template;
  if ( ! $template_path ) $template_path = $woocommerce->template_url;
  $plugin_path  = myplugin_plugin_path() . '/templates/woocommerce_cout/';
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
function my_custom_notification($order_id, $checkout=null) {
   global $woocommerce;
   $order = new WC_Order( $order_id );
   if($order->status === 'processed' ) {
      // Create a mailer
      $mailer = $woocommerce->mailer();
      $message_body = __( '<table border="0" cellpadding="0" cellspacing="0" style="font-family:arial;margin:0;padding:0" width="100%"><tr><td>    
<table style="border:1px solid #d6d6d6" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td align="center"><img src="https://couturebook.ru/img/mail/logo.jpg">
                        <div align="left" style="padding-left:30px;padding-right:30px">
 <h3 style="background:#000;color:#fff;padding-top:10px;padding-bottom:10px;text-align:center">Здравствуйте!</h3>
 <h1 align="center" style="font-size:22px;font-weight:400">Ваш заказ выполнен и готовится к передаче в службу доставки</h1>                       
Если вы оформляли доставку через транспортную компанию, Ваш заказ в ближайшее время будет передан курьеру DHL и через 1-5 рабочих дня будет доставлен Вам на указанный адрес.<br><br>
Если вы оформляли доставку курьером по Москве, Ваш заказ в ближайшее время будет передан нашему курьеру. Предварительно курьер с Вами созвонится и договорится об удобном для вас времени доставки заказа на указанный адрес.<br><br>
Если вы указывали при оформлении заказа самовывоз из офиса, Ваш заказ в ближайшее время будет доставлен в пункт выдачи готовых заказов по адресу: Москва, метро Октябрьское поле, 3-я Хорошевская ул., 19, корп. 3, строение 7/1 (территория автобазы «Связь»).<br><br>
Если вы неправильно указали адрес или хотите сменить адрес доставки, просим вас оперативно поставить в известность сотрудников CoutureBook по E-mail или по телефону.' );
      $message = $mailer->wrap_message(
        // Message head and message body.
        sprintf( __( 'Здраствуйте ваш заказ %s готов' ), $order->get_order_number() ), $message_body );
      // Cliente email, email subject and message.
     $mailer->send( $order->billing_email, sprintf( __( 'Здраствуйте ваш заказ %s готов' ), $order->get_order_number() ), $message );
     }
   }
add_action("woocommerce_order_status_changed", "my_custom_notification");
function my_admin_logo() {
   echo '
    <style type="text/css">
        #header-logo { background:url(https://couturebook.ru/favicon.ico) no-repeat 0 0 !important; }
    </style>';
}
add_action('admin_head', 'my_admin_logo');
function my_login_logo(){
   echo '
   <style type="text/css">
        #login h1 a { background: url(https://couturebook.ru/wp-content/uploads/2017/11/logo-1.png) no-repeat 0 0 !important; width: 150px; }
    </style>';
}
add_action('login_head', 'my_login_logo');
?>