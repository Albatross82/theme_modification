<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>


 <table style="border:1px solid #d6d6d6" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0" width="100%">
                  <tr>
                     <td align="center">
                        <img src="https://couturebook.ru/img/mail/logo.jpg">
                        <div align="left" style="padding-left:30px; padding-right:30px;">
                        <h1 align="center" style="font-size:22px; font-weight:400">Ваш заказ передан<br>в офис самовывоза</h1>
 <h3 style="display:block; background:#000; color:#fff; padding-top:10px; padding-bottom:10px; text-align:center;"<?php printf( __( 'Username: %s', 'woocommerce' ), $user_login ); ?>, здравствуйте!</h3>                       
Вы указывали при оформлении заказа самовывоз из офиса, Ваш заказ доставлен в
пункт выдачи готовых заказов по адресу:
<br><br>
Москва, Метро Октябрьское поле, 3-я Хорошевская ул., 19, корп. 3, строение 7/1 (территория автобазы «Связь»).
<br><br>
Вы можете забрать готовый заказ в любой день с 9:00 до 21:00.
Подробности уточняйте у менеджеров по телефону +7 (495) 215 0418
<br><br>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
