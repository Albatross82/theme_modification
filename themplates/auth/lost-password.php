<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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
#sidebar {display: none !important;}
.col-lg-push-3 {left: 15%;}
@media (min-width:750px) {.registration1 {margin-top: 30px; background: url("/wp-content/plugins/theme-modifications/img/book.jpg") no-repeat 50% 0;}
                        h2{padding-top: 30px;padding-left: 0px;text-align: center;}
                        .lost_reset_password {margin-left: 0px;height: 550px;}
                        .reg-and-login{padding-left:1px;  padding-top: 160px; left: -30px;position: relative;}
                        .reg-and-login2{left: -30px;position: relative;}
                        #customer_login {position: relative;left: -30px;}
}
@media (max-width:750px) {.registration1 {text-align:center; margin-top: 30px;}
                        .reg-and-login{padding-top: 30px;}
                        .lost_reset_password {width: 95%; padding-left: 20px;}
}
input {width:100%;}
::-moz-placeholder {color: #0009;}
.woocommerce .col2-set, .woocommerce-page .col2-set {border-bottom: 1px solid #fff !important;}</style>
<div class="row registration1">
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-md-offset-3" id="customer_login">
<form method="post" class="woocommerce-ResetPassword lost_reset_password">
			<h2>Забыли свой <br> пароль?</h2>
	<p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Укажите свой Email. Ссылку на создание нового пароля вы получите по электронной почте.', 'woocommerce' ) ); ?></p>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<input placeholder="Email" class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" />
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<input type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>" />
	</p>

	<?php wp_nonce_field( 'lost_password' ); ?>

</form>
</div></div>
