<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php wc_print_notices(); ?>
<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<style>
.breadcrumbs {display:none;}
.registration1 {text-align:center; margin-top: 30px;}
@media (min-width:750px) {.registration1 {margin-top: 30px; background: url("/wp-content/plugins/theme-modifications/img/book.jpg") no-repeat 50% 0;}
			h1{padding-top: 30px;padding-left: 0px;text-align: center;}
			.register {margin-left: 0px;height: 450px;}
			.col-lg-push-3 {left: 15%;}
			.reg-and-login{padding-left:1px;  padding-top: 160px; left: -30px;position: relative;}
			.reg-and-login2{left: -30px;position: relative;}
			#customer_login {position: relative;}
			p {margin: 0 0 10px;}
			input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], select, textarea {padding: 10.5px 20px;}
			 .woocommerce-FormRow.form-row{margin-top: 20px;}
}
@media (max-width:750px) {.registration1 {text-align:center; margin-top: 30px;}
			.reg-and-login{padding-top: 30px;}
			.register {width: 95%; padding-left: 20px;}			
}
input {width:100%;}
::-moz-placeholder {color: #0009;}
.woocommerce .col2-set, .woocommerce-page .col2-set {border-bottom: 1px solid #fff !important;}</style> 

<div class="row registration1">
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-md-offset-3" id="customer_login">
		<h1><?php _e( 'Register', 'woocommerce' ); ?></h1>

		<form method="post" class="register">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			
			<p class="form-row form-row-first">
       				<input placeholder="Имя" type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
       			</p>
       
			<p class="form-row form-row-last">
       				<input  placeholder="Фамилия" type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
       			</p>


			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input  placeholder="Email" type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input  placeholder="Пароль" type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-FormRow form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<input  placeholder="Пароль" type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
			</p>
			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 reg_log_in">
		<h2 class="reg-and-login">Есть аккаунт?</h2>
		<p class="reg-and-login2"><a href="/sign-in/" id="lnk-login">Войти</a></p>
	</div>
</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
