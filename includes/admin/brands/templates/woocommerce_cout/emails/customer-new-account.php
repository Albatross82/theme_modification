<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
    <table style="border:1px solid #d6d6d6" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0" width="100%">
                  <tr>
                     <td align="center">
                        <img src="https://couturebook.ru/img/mail/logo.jpg"><br><img src="https://couturebook.ru/img/mail/mail2.jpg">
                        <div align="left" style="padding-left:30px; padding-right:30px;">
                        <h1 align="center" style="font-size:22px; font-weight:400">Подтверждение авторизации<br>на сайте COUTURE BOOK</h1>
<?php printf( __( 'Username: %s', 'woocommerce' ), $user_login ); ?> Добро пожаловать! Вы в команде COUTURE BOOK
<br><br>
Вы можете использовать свою учетную запись для создания фотопродукции с
программным обеспечением COUTURE BOOK | PRO.
<div style="padding-left:30px; padding-top:20px; padding-bottom:20px;">
Ваш логин: <?php printf( __( "<strong>%s</strong>.", 'woocommerce' ), esc_html( $user_login ) ); ?><br>
<span style="font-style:italic; font-size:11px;">(Вы ввели адрес электронной почты в качестве контактного адреса для Вашей учетной записи.
Логин сгенерен автоматически. Смена логина в системе не возможна)</span><br><p>
</div>
Чтобы изменить личные данные, связанные с Вашим аккаунтом, зайдите на
сайт в личный кабинет <a href="http://couturebook.ru/log-in/my-account/?edit-account">http://couturebook.ru/log-in/?edit-account</a> используя свой логин и
пароль.</br>
Вы можете получить доступ к вашей учетной записи, чтобы просматривать заказы и изменить пароль, здесь:<a href="http://couturebook.ru/log-in/">http://couturebook.ru/log-in/</a>

<br><br>

            
<?php do_action( 'woocommerce_email_footer', $email ); ?>