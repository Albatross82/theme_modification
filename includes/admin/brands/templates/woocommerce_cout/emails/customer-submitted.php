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
                        <h1 align="center" style="font-size:22px; font-weight:400">Благодарим Вас за регистрацию<br>на сайте COUTURE BOOK</h1>
<?php printf( __( '%s', 'woocommerce' ), $user_login ); ?>, Вы отправили заявку на регистрацию в проекте для профессиональных фотографов и дизайнеров COUTURE BOOK.
<br><br>
Логин и пароль к сервису Вы получите после проверки Вашего статуса профессионального фотографа.
<br><br>
Авторизация в нашем проекте проходит в течение 24 часов. После подтверждения Вашего аккаунта Вам на почту придет письмо с данными для входа в
личный кабинет.
<br><br>
 <div align="center" style="clear:both; padding-top:20px; padding-bottom:20px;">Нужна помощь? +7 (495) 215 0418 | <a href="mailto:support@couturebook.ru">support@couturebook.ru</a>
                           <br>Мы работаем ежедневно с 10:00 до 20:00 по московскому времени
                        </div>
                     </td>
                  </tr>
               </table>
               <table  border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0" width="100%">
                  <div style="font-size:10px; color:#000; margin-top:15px;">
                     Вы получили это письмо, так как подписались на получение рассылки при регистрации на сайт couturebook.ru
                     Откройте письмо в браузере, если оно отображается некорректно.<br><br>
                     COUTURE BOOK | Земля, Россия, г. Москва, Метро Октябрьское поле, 3-я Хорошевская ул., 19, корп. 3, строение 7/1 (территория автобазы «Связь»).
                     <br>Совет: добавьте <a href="mailto:ask@couturebook.ru">ask@couturebook.ru</a> в адресную книгу, чтобы полезные письма не попали в спам.
                     <br>Отписать <a href="mailto:admiral@myphotopages.ru">admiral@myphotopages.ru</a> от рассылки | Изменить личную информацию<br><br>
                     Copyright © 2016 | COUTURE BOOK | Все права защищены.
                     </span>
                  </div>
            </center>
            </td>
            </tr>
            </table>

   </body>
</html>