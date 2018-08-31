<?php
if (!defined('ABSPATH')) {
	exit;
}
function nn_deregister_styles999() {
	$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
    if (in_array('projects', explode('_', $uri_parts[1]))) {
	    wp_enqueue_style('theme_styles303', plugin_dir_url(__FILE__) . 'css/theme_styles_fap.css');	}
    else {
    	wp_enqueue_style('theme_styles304', plugin_dir_url(__FILE__) . 'css/theme_styles_fap_prt.css');
    }
}
add_action( 'wp_print_styles', 'nn_deregister_styles999', 100 );

/**echo "<pre>";
    $uri_parts = explode('/', $_SERVER['REQUEST_URI']);
   print_r(explode('_', $uri_parts[1]));
echo "</pre>";*/

function pp_deregister_style2() {
	$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
    if (in_array('?projectref', explode('=', $uri_parts[3]))) {
	    wp_enqueue_style('projects_styles2', plugin_dir_url(__FILE__) . 'css/shop_styles_fap.css');	}
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
  $plugin_path  = myplugin_plugin_path() . '/templates/woocommerce_fap/';
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

// Атрибуты продукта (формат, фото)
function myphotopages_show_product_atts()
{
  global $product;
  $product_atts = $product->get_attributes('forceview');
  $size = $product_atts['pa_the-production-time'];
 // $photo = $product_atts['pa_photo'];
//  if ($size && $photo)
  if ($size)
  {
    $size = wc_get_product_terms($product->get_id(), $size['name'], array('fields' => 'names'));
   // $photo = wc_get_product_terms($product->get_id(), $photo['name'], array('fields' => 'names'));
   // echo '<div class="product_attr">' . $size[0] . '<br>' . $photo[0] . '</div>';
     echo '<div class="product_attr">'. 'Cрок изготовления: ' .  $size[0] . '</div>';
  }
}
add_action('woocommerce_after_shop_loop_item_title', 'myphotopages_show_product_atts', 5);

function woo_rename_tabs( $tabs ) {
	$tabs['description']['title'] = __( 'Описание' );		// Rename the description tab
	$tabs['additional_information']['title'] = __( 'Характеристики' );	// Rename the additional information tab
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );

function woocommerce_template_product_description() {
  wc_get_template( '/single-product/short-description.php' );
  wc_get_template( '/single-product/tabs/description.php' );
  wc_get_template( '/single-product/tabs/additional-information.php' );
}
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_product_description', 10 );
function removing_product_tabs(){
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );	
}
add_action( 'woocommerce_after_single_product_summary', 'removing_product_tabs', 2 );
function removing_product_tabs2(){
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}
add_action( 'woocommerce_single_product_summary', 'removing_product_tabs2', 2 );

function my_custom_notification($order_id, $checkout=null) {
   global $woocommerce;
   $order = new WC_Order( $order_id );
   if($order->status === 'processed' ) {
      // Create a mailer
      $mailer = $woocommerce->mailer();
      $message_body = __( '<table border="0" cellpadding="0" cellspacing="0" style="font-family:arial;margin:0;padding:0" width="100%"><tr><td>    
<table style="border:1px solid #d6d6d6" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td align="center"><img src="https://myphotopages.ru/img/nav-bar-brand-black@2x.png">
                        <div align="left" style="padding-left:30px;padding-right:30px">
 <h3 style="background:#000;color:#fff;padding-top:10px;padding-bottom:10px;text-align:center">Здравствуйте!</h3>
 <h1 align="center" style="font-size:22px;font-weight:400">Ваш заказ выполнен и готовится к передаче в службу доставки</h1>                       
Если вы оформляли доставку через транспортную компанию, Ваш заказ в ближайшее время будет передан курьеру DHL и через 1-5 рабочих дня будет доставлен Вам на указанный адрес.<br><br>
Если вы оформляли доставку курьером по Москве, Ваш заказ в ближайшее время будет передан нашему курьеру. Предварительно курьер с Вами созвонится и договорится об удобном для вас времени доставки заказа на указанный адрес.<br><br>
Если вы указывали при оформлении заказа самовывоз из офиса, Ваш заказ в ближайшее время будет доставлен в пункт выдачи готовых заказов по адресу: Москва, метро Октябрьское поле, 3-я Хорошевская ул., 19, корп. 3, строение 7/1 (территория автобазы «Связь»).<br><br>
Если вы неправильно указали адрес или хотите сменить адрес доставки, просим вас оперативно поставить в известность сотрудников МоиФотоСтраницы по E-mail или по телефону.' );
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
     $redirect = 'http://fineart-print.ru/cabinet/';
     return $redirect;
}
function my_admin_logo() {
   echo '
    <style type="text/css">
        #header-logo { background:url(https://fineart-print.ru/favicon.ico) no-repeat 0 0 !important; }
    </style>';
}
add_action('admin_head', 'my_admin_logo');
function my_login_logo(){
   echo '
   <style type="text/css">
        #login h1 a { background: url(http://fineart-print.ru/wp-content/uploads/2018/04/FAP_logo_new.png) no-repeat 0 0 !important; width: 250px; }
    </style>';
}
add_action('login_head', 'my_login_logo');
?>
