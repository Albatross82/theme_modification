<?php
if (!defined('ABSPATH')) {
	exit;
}

add_filter('the_generator', '__return_empty_string');
function rem_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'rem_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'rem_wp_ver_css_js', 9999 );

add_action( 'wp_print_styles', 'aa_deregister_styles', 100 );
function aa_deregister_styles() {
    if ( ! is_page( get_theme_mod('header_contacts') ) ) {
        wp_dequeue_style( 'contact-form-7' );
	}
}

function admin_style() {
  wp_enqueue_style('admin-styles', plugin_dir_url(__FILE__) . 'css/admin_styles.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

//blog css
add_action( 'wp_print_styles', 'ss_deregister_style', 99 );
function ss_deregister_style() {
	if (is_single()) {
		wp_enqueue_style('projects_styles', plugin_dir_url(__FILE__) . 'css/projects_styles.css');
	}
	else {
	}
}
// project css
add_action( 'wp_print_styles', 'pp_deregister_style', 99 );
function pp_deregister_style() {
	if (in_array('projects-archive', explode('/', $_SERVER['REQUEST_URI']))) {
		wp_enqueue_style('projects_styles', plugin_dir_url(__FILE__) . 'css/projects_styles.css');	}
	else {
	}
}

// woocomerce
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
function child_manage_woocommerce_styles() {
	//убираем generator meta tag
    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
    //для начала проверяем, активен ли WooCommerce, дабы избежать ошибок
    if ( function_exists( 'is_woocommerce' ) ) {
        //отменяем загрузку скриптов и стилей
        if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() && ! is_page ('project-list') && ! is_page ('online-basket') && ! is_page ('sso') && ! is_page ('sign-in/reg')) {
        wp_dequeue_style( 'woocommerce_frontend_styles' );
        wp_dequeue_style( 'woocommerce_fancybox_styles' );
        wp_dequeue_style( 'woocommerce_chosen_styles' );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	    wp_dequeue_script( 'chosen-drop-down' );
	    wp_dequeue_script( 'wc_price_slider' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-add-to-cart' );
        wp_dequeue_script( 'wc-cart-fragments' );
        wp_dequeue_script( 'wc-checkout' );
        wp_dequeue_script( 'wc-add-to-cart-variation' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-cart' );
        wp_dequeue_script( 'wc-chosen' );
        wp_dequeue_script( 'woocommerce' );
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
        wp_dequeue_script( 'jquery-blockui' );
        wp_dequeue_script( 'jquery-placeholder' );
        wp_dequeue_script( 'fancybox' );
        wp_dequeue_script( 'jqueryui' );
        wp_dequeue_script( 'account_funds' );
	    wp_dequeue_script( 'swatches-and-photos' );
	    wp_dequeue_script( 'tmpl-variation-template' );
		wp_dequeue_script( 'tmpl-unavailable-variation-template' );
		wp_dequeue_script( 'ywcca_accordion' );
		wp_dequeue_script( 'add-to-cart-variation' );
		wp_dequeue_script( 'yith-wccl' );
		wp_dequeue_script( 'single-product' );
		wp_dequeue_script( 'jquery.hoverIntent' );
	    wp_dequeue_style( 'woocommerce-general' );
	    wp_dequeue_style( 'woocommerce-smallscreen' );
	    wp_dequeue_style( 'woocommerce-layout' );
	    wp_dequeue_style( 'swatches-and-photos' );
	    wp_dequeue_style( 'tm-woocommerce-package' );
	    wp_dequeue_style( 'tm-wc-ajax-filters-widget' );
	    wp_dequeue_style( 'chosen-drop-down' );
	    wp_dequeue_style( 'woocommerce_prettyPhoto' );
	    wp_dequeue_style( 'smart-coupon' );
	    wp_dequeue_style( 'jquery-rd-material-tabs' );
	    wp_dequeue_style( 'ywf_style' );
	    wp_dequeue_style( 'ywcca_dynamics' );
	    wp_dequeue_style( 'tpxIgStyles' );
	    wp_dequeue_style( 'ywcca_accordion_style' );
	    wp_dequeue_style( 'yith_wccl_frontend' );
	    wp_dequeue_style( 'yith_wccl_frontend-inline' );
//	    wp_dequeue_style( 'jquery-swiper' );
	    wp_dequeue_style( 'wpstatistics-css' );
	    wp_dequeue_style( 'ywsl_frontend' );
	    wp_dequeue_style( 'yoast-seo-adminbar' );
        }
    }
}
add_action( 'wp_print_styles', 'bb_deregister_styles3', 100 );
function bb_deregister_styles3() {
	wp_deregister_style( 'tm-pg-font-awesome' );
	wp_deregister_style( 'tm-pg-fontello' );
	wp_deregister_style( 'cherry-google-fonts' );
	wp_enqueue_style('theme_styles', plugin_dir_url(__FILE__) . 'css/theme_styles.css');
}

function remove_add_to_cart_buttons() {
    if( is_product_category() || is_shop()) { 
       remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
     }
 }
add_theme_support( 'title-tag' );
?>