<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<p><?php
	/* translators: 1: user display name 2: logout url */
	printf(
		__( 'Здраствуйте, %1$s', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);
?></p>
<style>.col-xs-12.col-sm-6.col-md-6.col-lg-3.tm_always_center_on_mobile {border: 1px solid #b9b6b6;margin: 10px; padding-left: 0px; padding-right: 0px;max-width: 300px;}
@media (min-width:1026px) {.col-lg-3 {-ms-flex: 0 0 23%;flex: 0 0 23%;max-width: 23%;}.row {padding-left: 45px;}}
@media (max-width:768px) {.row {margin-left: 0px;margin-right: 0px;}}
@media (min-width:544px) {.container {max-width: 700px;}}
.botton_cab {border-top: 1px solid #E0E0E2;background-color: white;width: 100%;height: 60px;text-align: center;padding-top: 19px;color: #000000;}
.botton_a {color: black;vertical-align: middle;text-transform: uppercase !important;font-weight: 600;text-decoration: none !important;}
p {margin: 0 0 0 !important;}
.botton_cab:hover {background-color: #eee;}
.botton_cab:active {background-color: #eee;}
.woocommerce-account.logged-in .entry-content > .woocommerce .woocommerce-MyAccount-navigation {display:none;}
#woocommerce-error, .woocommerce-info, .woocommerce-message {position: absolute !important;}
.woocommerce-error {position: absolute !important;}
.woocommerce-account.logged-in .entry-content > .woocommerce .woocommerce-MyAccount-content {-moz-flex: 0 1 70%;-ms-flex: 0 1 70%;flex: 0 1 100%;max-width: 100%;padding: 30px 40px;}
@media (min-width:1026px) {.ywf_fund_av {position: absolute;top: 190px;left: 60px; font-size: 1px;} .non_order {z-index: 100;width: 100%;position: absolute;background: none;border: 1px none;font-size: 40px;color: #0088d4;border-radius: 50px;padding: 5px;margin-top: 20px;text-align: center;bottom: 0px;}.botton_cab {font-size:16px}}
@media (max-width:1024px) {.woocommerce-Price-amount.amount {font-size: 12px;} .ywf_fund_av {position: absolute;top: 100px;left: 30px; font-size: 1px;} .non_order {z-index: 100;width: 100%;position: absolute;background: none;border: 1px none;font-size: 16px;color: #0088d4;border-radius: 50px;padding: 5px;margin-top: 0px;text-align: center;bottom: 40px;}.botton_cab {font-size:12px}}
</style>

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
		<img src="/wp-content/plugins/theme-modifications/img/project-list2.png" alt=""><a class="botton_a" href="/cabinet/project-list/"><div class="botton_cab">Онлайн-проекты</div></a>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
		<img src="/wp-content/plugins/theme-modifications/img/online-basket2.png" alt=""><a class="botton_a" href="/cabinet/online-basket/"><div class="botton_cab">Готовые к заказу проекты</div></a>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
		<?php global $wp_query;
$post_status = implode("','", array('wc-pending','wc-cancelled') );
$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => -1,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => wc_get_order_types( 'view-orders' ),
	'post_status' => $post_status
) ) );
foreach ( $customer_orders as $customer_order ) :
				$order      = wc_get_order( $customer_order );
				$item_count = $order->get_item_count();
endforeach;
echo "<pre class='non_order'>"; print_r ($item_count) ; echo "</pre>";
?>	
		<img src="/wp-content/plugins/theme-modifications/img/non_order2.png" alt=""><a class="botton_a" href="/cabinet/non_order/"><div class="botton_cab">Незавершенные заказы</div></a>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
	<?php global $wp_query;
$post_status2 = implode("','", array('wc-processing','wc-printing') );
$customer_orders2 = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => -1,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => wc_get_order_types( 'view-orders' ),
	'post_status' => $post_status2
) ) );
foreach ( $customer_orders2 as $customer_order2 ) :
				$order2      = wc_get_order( $customer_order2 );
				$item_count2 = $order2->get_item_count();
endforeach;
echo "<pre class='non_order'>"; print_r ($item_count2) ; echo "</pre>";
?>	
		<img src="/wp-content/plugins/theme-modifications/img/work_orders2.png" alt=""><a class="botton_a" href="/cabinet/work_orders/"><div class="botton_cab">Заказы в работе</div></a>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
	<?php global $wp_query;
$post_status3 = implode("','", array('wc-processed','wc-shipped') );
$customer_orders3 = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => -1,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => wc_get_order_types( 'view-orders' ),
	'post_status' => $post_status3
) ) );
foreach ( $customer_orders3 as $customer_order3 ) :
				$order3      = wc_get_order( $customer_order3 );
				$item_count3 = $order3->get_item_count();
endforeach;
echo "<pre class='non_order'>"; print_r ($item_count3) ; echo "</pre>";
?>	
		<img src="/wp-content/plugins/theme-modifications/img/deliver222.png" alt=""><a class="botton_a" href="/cabinet/deliver22/"><div class="botton_cab">Заказы в доставке</div></a>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
	<?php global $wp_query;
$post_status4 = implode("','", array('wc-completed','wc-cancelled',) );
$customer_orders4 = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => -1,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => wc_get_order_types( 'view-orders' ),
	'post_status' => $post_status4
) ) );
foreach ( $customer_orders4 as $customer_order4 ) :
				$order4      = wc_get_order( $customer_order4 );
				$item_count4 = $order4->get_item_count();
endforeach;
echo "<pre class='non_order'>"; print_r ($item_count4) ; echo "</pre>";
?>	
		<img src="/wp-content/plugins/theme-modifications/img/all_orders2.png" alt=""><a class="botton_a" href="/cabinet/all_orders/"><div class="botton_cab">История заказов</div></a>
	</div>	
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">

		<img src="/wp-content/plugins/theme-modifications/img/diskount2.png" alt=""><div style="font-weight: 600; text-transform: uppercase !important;" class="botton_cab">Персональная скидка</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
		<img src="/wp-content/plugins/theme-modifications/img/gift2.png" alt=""><a class="botton_a" href="/cabinet/wc-smart-coupons/"><div class="botton_cab">Подарочные сертификаты</div></a>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
<?php
global $wp_query;
echo do_shortcode("[yith_ywf_show_user_fund]");
 ?>	
		<img src="/wp-content/plugins/theme-modifications/img/balans2.png" alt=""><a class="botton_a" href="/cabinet/balans/"><div class="botton_cab">Баланс счета</div></a>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
		<img src="/wp-content/plugins/theme-modifications/img/affilate2.png" alt=""><a class="botton_a" href="/cabinet/affilate/"><div class="botton_cab">Партнерская программа</div></a>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
		<img src="/wp-content/plugins/theme-modifications/img/edit-personal2.png" alt=""><a class="botton_a" href="/cabinet/edit-account/"><div class="botton_cab">Персональные данные</a>	</div>	
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tm_always_center_on_mobile">
		<img src="/wp-content/plugins/theme-modifications/img/exit2.png" alt=""><a class="botton_a" href="/cabinet/customer-logout/"><div class="botton_cab">Выход</a>	</div>	
	</div>
	
</div> 
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	//do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
