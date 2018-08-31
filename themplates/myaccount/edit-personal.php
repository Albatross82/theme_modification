<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<style>
/* скрываем чекбоксы и блоки с содержанием */
.hide,
.hide + label ~ div {
    display: none;
}
/* вид текста label */
.hide + label {
    margin: 0;
    padding: 0;
    cursor: pointer;
    display: inline-block;
}
/* вид текста label при активном переключателе */
.hide:checked + label {
    border-bottom: 0;
}
/* когда чекбокс активен показываем блоки с содержанием  */
.hide:checked + label + div {
    display: block; 
    margin-left: 20px;
    padding: 10px;
    /* чуточку анимации при появлении */
     -webkit-animation:fade ease-in 0.5s; 
     -moz-animation:fade ease-in 0.5s;
     animation:fade ease-in 0.5s; 
}
/* анимация при появлении скрытых блоков */
@-moz-keyframes fade {
    from { opacity: 0; }
to { opacity: 1 }
}
@-webkit-keyframes fade {
    from { opacity: 0; }
to { opacity: 1 }
}
@keyframes fade {
    from { opacity: 0; }
to { opacity: 1 }   
}
.hide + label:before {
    background-color: #1e90ff;
    color: #fff;
    content: "\002B";
    display: block;
    float: left;
    font-size: 14px; 
    font-weight: bold;
    height: 16px;
    line-height: 16px;
    margin: 3px 5px;
    text-align: center;
    width: 16px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}
.hide:checked + label:before {
    content: "\2212";
}
.woocommerce form .form-row {
max-width: 100%;
padding: 10px;
margin-bottom: 1px;
}
.tnp-field-email{
display: none;
}
.validate-required {
min-width: 400px;
}
.form-row-wide {
min-width: 400px;
}
.woocommerce form .form-row.validate-postcode {
margin-bottom: 0px;
}
</style>
	<h4>Персональные данные</h4>
<?php do_action( 'woocommerce_before_edit_account_form' ); ?>
<input class="hide" id="hd-1" type="checkbox" >
<label for="hd-1">Изменить персональные данные</label>
	<div class="data">
		<form class="woocommerce-EditAccountForm edit-account" action="" method="post">
		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
		<div class="row">
		<div class="col-md-12"><h6>Персональные данные</h6></div>
  		<div class="col-md-6 woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
  			<label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input placeholder="Имя" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
  		</div>
  		<div class="col-md-6 woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
  			<label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input placeholder="Фамилия" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
  		</div>
  		<div class="clear"></div>
  		<div class="col-md-6 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
  			<label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input placeholder="Email" type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</div>
		<div class="col-md-12"><h6>Изменить пароль (не заполняйте, чтобы оставить прежний пароль)</h6></div>
		<div class="col-md-12 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
  			<label for="password_current">Текущий пароль</label>
			<input placeholder="Текущий пароль"type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" />
		</div>
  		<div class="col-md-6 woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
  			<label for="password_1">Новый пароль</label>
			<input placeholder="Новый пароль" type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" />
		</div>
  		<div class="col-md-6 woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
  			<label for="password_2">Подтвердите новый пароль</label>
			<input placeholder="Проверьте новый пароль" type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" />
		</div>
		<div class="clear"></div>
		<?php do_action( 'woocommerce_edit_account_form' ); ?>
		<div class="col-md-12">
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
		</div>
		</div>
	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	</form>
	</div>
<br/>
<?php
// get the user meta
$userMeta = get_user_meta(get_current_user_id());
// get the form fields
$countries = new WC_Countries();
$billing_fields = $countries->get_address_fields( '', 'billing_' );
$load_address = 'billing';
$page_title   = __( 'Billing Address', 'woocommerce' );
?>
<input class="hide" id="hd-2" type="checkbox" >
<label for="hd-2">Изменить адрес платежа и доставки</label>
	<div class="data">
		<form action="/cabinet/edit-account/" class="edit-account" method="post">
		<div class="row">
 		    <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>
    		<?php foreach ( $billing_fields as $key => $field ) : ?>
	        <?php woocommerce_form_field( $key, $field, $userMeta[$key][0] ); ?>
		    <?php endforeach; ?>
			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
			<div class="col-md-12">
        		<input type="submit" class="button" name="save_address" value="Сохранить изменения" />
        		<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
        		<input type="hidden" name="action" value="edit_address" />
    		</div>
    	</div>
		</form>
	</div>
<br/>
<input class="hide" id="hd-3" type="checkbox" >
<label for="hd-3">Изменить новостную рассылку</label>
	<div class="col-md-12">
	<?php
		 global $wp_query;
		 echo do_shortcode("[newsletter_profile]");
	?>
	</div>
</div>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>