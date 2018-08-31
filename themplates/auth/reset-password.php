<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>
<style>
.breadcrumbs {display:none;}
.registration1 {text-align:center; margin-top: 30px;}
@media (min-width:750px) {.registration1 {margin-top: 30px; background: url("/wp-content/plugins/theme-modifications/img/book.jpg") no-repeat 50% 0;}
                        h2{padding-top: 30px;padding-left: 0px;text-align: center;}
                        .lost_reset_password {margin-left: 0px;height: 450px;}
                        .reg-and-login{padding-left:1px;  padding-top: 160px; left: -30px;position: relative;}
                        .reg-and-login2{left: -30px;position: relative;}
}
@media (max-width:750px) {.registration1 {text-align:center; margin-top: 30px;}
                        .reg-and-login{padding-top: 30px;}
                        .lost_reset_password {width: 95%; padding-left: 20px;}
}
input {width:100%;}
#sidebar {display: none !important;}
.col-lg-push-3 {left: 15%;}
::-moz-placeholder {color: #0009;}
.woocommerce .col2-set, .woocommerce-page .col2-set {border-bottom: 1px solid #fff !important;}
</style>
<div class="row registration1">
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-2" id="customer_login">
<h2>Востановление <br>  пароля</h2>
<form method="post" class="woocommerce-ResetPassword lost_reset_password">

	<p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce' ) ); ?></p>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<input placeholder="Новый пароль" type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
		<input placeholder="Повторите новый пароль" type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" />
	</p>

	<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
	<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

	<div class="clear"></div>

	<?php do_action( 'woocommerce_resetpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<input type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>" />
	</p>

	<?php wp_nonce_field( 'reset_password' ); ?>

</form>
</div>
</div>
