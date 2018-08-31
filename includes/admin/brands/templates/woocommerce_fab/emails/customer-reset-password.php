<?php
/**
 * Customer Reset Password email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<h1 align="center" style="font-size:22px; font-weight:400">Сброс пароля<br>на сайте COUTURE BOOK</h1>
<?php printf( __( 'Username: %s', 'woocommerce' ), $user_login ); ?>, вы запрашивали восстановление пароля к сайту COUTURE BOOK.<br><br>
Ваш пароль восстановлен.<br>
Перейдите по ссылке <a class="link" href="<?php echo esc_url( add_query_arg( array( 'key' => $reset_key, 'login' => rawurlencode( $user_login ) ), wc_get_endpoint_url( '/sign-in/reset_password', '', wc_get_page_permalink( 'sign-in' ) ) ) ); ?>">
			<?php _e( 'Click here to reset your password', 'woocommerce' ); ?></a> для того, чтобы изменить пароль на новый.
<br><br>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
