<?php
/**
 * Customer refunded order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-refunded-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see      http://docs.woothemes.com/document/template-structure/
 * @author   WooThemes
 * @package  WooCommerce/Templates/Emails
 * @version  2.5.0
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
                        <h1 align="center" style="font-size:22px; font-weight:400">Ошибка загрузки заказа<br>с сайта COUTURE BOOK</h1>
 <h3 style="display:block; background:#000; color:#fff; padding-top:10px; padding-bottom:10px; text-align:center;"><?php printf( __( 'Username: %s', 'woocommerce' ), $user_login ); ?>, рекомендации по загрузке</h3>                       
При оформлении заказа у Вас прервалась сессия и заказ не получилось оплатить и загрузить.
<br><br>
Вам необходимо вернуться в корзину и продолжить оформление заказа.
Оплата заказа должна быть произведена в течение (!) 10-15 минут!
После чего Вам необходимо загрузить Ваш заказ на сервер.
<br><br>
Подтверждением загрузки заказа служит письмо с номером Вашего заказа,
которое придет Вам на указанный при регистрации email.
<br><br>
<span style="font-style:italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Если проект уже сделан, но не загружается через интернет – выберите
пункт «отправка почтой». Укажите путь сохранения проекта на ваш компьютер. После этого заархивируйте проект и выложите его на любой репозиторий
(google диск) и пришлите нам ссылку на почту <a href="mailto:order@couturebook.ru">order@couturebook.ru</a></span>
<br><br>

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
