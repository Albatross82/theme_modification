<?php
if (!defined('ABSPATH')) {
	exit;
}
function wps_remove_role() {
remove_role('manadger', __('Manadger'));
}
add_action( 'init', 'wps_remove_role' );

function wps_add_role() {
add_role('manadger', __('Manadger'), array( // массив возможностей, true - разрешено, false - запрещено
			'read'         => true,  // ну это понятно
			'edit_others_posts'         => true,
			'edit_posts'         => true,
			'edit_private_posts'                 => true,
			'edit_published_posts'         => true,	
			'edit_others_posts'         => true,	
			'read_private_posts'         => true,		
			'publish_posts'         => true,		
			'manage_categories'         => true,
			'moderate_comments'                 => true,	
		'create_users'                 => true,		
		'edit_users'                 => true,		
		'list_users'                 => true,		
		'add_users'                 => true,
		'manage_options'                 => true,
		'manage_links'                 => true,
			'read_private_products'         => true,
			'publish_products'         => true,
			'edit_published_products'         => true,
			'edit_product'         => true,
			'edit_products'         => true,
			'edit_others_products'         => true,
			'read_product'         => true,
			'read_private_products'         => true,
			'moderate_comments'=> true, // разрешим модерировать комментарии	
		'publish_shop_orders'=> true,
		'edit_shop_orders'=> true,
		'edit_published_shop_orders'=> true,
		'edit_others_shop_orders'=> true,
		'read_private_shop_orders'=> true,
		'edit_private_shop_orders'=> true,
		'edit_shop_order'=> true,
		'read_shop_order'=> true,
			'publish_shop_coupons'=> true,
			'edit_shop_coupons'=> true,
			'edit_published_shop_coupons'=> true,
			'edit_others_shop_coupons'=> true,
			'read_private_shop_coupons'=> true,
			'edit_private_shop_coupons'=> true,
			'edit_shop_coupon'=> true,
			'read_shop_coupon'=> true,
			'publish_shop_webhooks'=> true,
			'edit_shop_webhooks'=> true,
			'edit_published_shop_webhooks'=> true,
			'edit_others_shop_webhooks'=> true,
			'read_private_shop_webhooks'=> true,
			'edit_private_shop_webhooks'=> true,
			'edit_shop_webhook'=> true,
			'read_shop_webhook'=> true,
		'manage_woocommerce'         => true,
		'view_woocommerce_reports'         => true,
		'manage_product_terms'         => true,
		'edit_product_terms'         => true,
		'delete_product_terms'         => true,
		'assign_product_terms'         => true,
		'manage_shop_order_terms'         => true,
		'edit_shop_order_terms'         => true,
		'delete_shop_order_terms'         => true,
		'assign_shop_order_terms'         => true,
		'manage_shop_coupon_terms'         => true,
		'edit_shop_coupon_terms'         => true,
		'delete_shop_coupon_terms'         => true,
		'assign_shop_coupon_terms'         => true,
		'manage_shop_webhook_terms'         => true,
		'edit_shop_webhook_terms'         => true,
		'delete_shop_webhook_terms'         => true,
		'assign_shop_webhook_terms'         => true,
			'publish_gift_cards'         => true,
			'edit_others_gift_cards'         => true,
			'edit_gift_cards'         => true,
			'read_private_gift_cards'         => true,
			'edit_published_gift_cards'         => true,
			'edit_private_gift_cards'         => true,
		'manage_woocommerce_order_status_emails'         => true
		)
	);
	}
add_action( 'init', 'wps_add_role' );

add_action( 'admin_menu', 'my_remove_menu_pages', 999 );
function my_remove_menu_pages() {
	if ( ! current_user_can('edit_dashboard') ) {
        remove_menu_page( 'options-general.php' );
        remove_menu_page( 'edit.php' );
        remove_menu_page( 'edit.php?post_type=wpb_gallery' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'yit_plugin_panel' );
        remove_menu_page( 'aiowpsec' );
        remove_menu_page( 'dl-verification/options-page.php' );
        remove_menu_page( 'cherry-search' );
        remove_menu_page( 'wpseo_dashboard' );
        remove_menu_page( 'tablepress' );
        remove_menu_page( 'wpcf7' );
        remove_menu_page( 'tm_pg_media' );
        remove_menu_page( 'newsletter_main_index' );
        remove_menu_page( 'edit.php?post_type=tm_pb_layout' );
        remove_submenu_page( 'woocommerce', 'wc-settings' );
        remove_submenu_page( 'woocommerce', 'wc-addons' );
        remove_submenu_page( 'woocommerce', 'wc-status' );
        remove_submenu_page( 'woocommerce', 'yandex_money_menu' );
    }
};
?>