<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

/**
 * My Account navigation.
 * @since 2.6.0
 */
 ?>
<p><br>
</p>
 <style>
.button, input[type="button"], input[type="reset"], input[type="submit"] {
    min-width: 15px !important;
    color: #000 !important;
    background: #fff !important;
    border: 1px solid #000 !important;
    border-radius: 3px !important;
    font-size: 14px !important;
}
.ywf_fund_av {
    font-size: 20px;
    padding-bottom: 20px;
}
 </style>
<?php do_action( 'woocommerce_account_navigation' ); ?>

<div class="woocommerce-MyAccount-content">
	<h4>Ваш баланс</h4>
<?php
global $wp_query;
echo do_shortcode("[yith_ywf_show_user_fund]");
 ?>	
		<!--<h4>Пополнить баланс</h4>-->
<?php
global $wp_query;
echo do_shortcode("[yith_ywf_make_a_deposit_form]");
 ?>	
</div>
