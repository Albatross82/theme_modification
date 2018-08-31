<?php
if (!defined('ABSPATH')) {
	exit;
}
//css
require_once('theme_includes.php');

//shop
require_once('shop/theme_shop.php');
require_once('shop/theme_account_func.php');
require_once('shop/theme_registration.php');

//admin page
require_once('admin/theme_admin_lang_trans.php');
require_once('admin/theme_admin_menu.php');
require_once('admin/theme_roles.php');

//coupon
//require_once('coupons/theme_admin_coupon.php');
require_once('coupons/woocommerce-delete-expired-coupons.php');

?>