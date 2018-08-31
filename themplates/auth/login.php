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
@media (min-width:750px) {.registration1 {margin-top: 30px; background: url("/wp-content/plugins/theme-modifications/img/book.jpg") no-repeat 50% 0;}h2{padding-top: 30px;padding-left: 60px;text-align: center;}.login {margin-left: 60px;height: 450px;}.reg-and-login{padding-left:1px;  padding-top: 160px; left: -30px;position: relative;}.reg-and-login2{left: -30px;position: relative;}}
@media (max-width:750px) {.registration1 {text-align:center; margin-top: 30px;}.reg-and-login{padding-top: 30px;}.login {width: 95%; padding-left: 20px;}}
input {width:100%;}
::-moz-placeholder {color: #0009;}
.woocommerce .col2-set, .woocommerce-page .col2-set {border-bottom: 1px solid #fff !important;}</style>
<div class="row registration1">
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-md-offset-3" id="customer_login">
		<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input placeholder="Email" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input placeholder="Password" class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="/sign-in/lost_password/">Забыли пароль?</a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</form>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <h2 class="reg-and-login">Нужен аккаунт?</h2>
                <p class="reg-and-login2"><a href="/sign-in/reg/" id="lnk-login">Войти</a></p>
        </div>
</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
