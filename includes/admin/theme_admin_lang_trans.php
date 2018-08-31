<?php

if (!defined('ABSPATH')) {
	exit;
}
add_action('init', 'localizationsample_init');
function localizationsample_init() {
    $path = dirname(plugin_basename( __FILE__ )) . '/languages/';
    $loaded = load_plugin_textdomain( 'theme-modifications', false, $path);
} 

// Add Admin Menu 
add_action('admin_menu','localizationsample_menu');
function localizationsample_menu() { 
    add_options_page(
        'Theme Modifications',            // admin page title
        'Theme Modifications',            // menu item name
        'manage_options',               // access privilege
        basename(__FILE__),                         // page slug for the option page
        'localization_demo_adminpanel'  // call-back function name
    );
}
function localization_demo_adminpanel() {
    echo '<div class="wrap"><div id="icon-themes" class="icon32"></div>';
    echo '<h2>' . __('Привет!', 'localizationsample') . '</h2>'; 
    echo '<p>';
    _e('Усе пашет', 'localizationsample');
    echo '</p>';
    echo '</div>'; // end of wrap
	if (in_array('myphotopages.ru', explode('/', $_SERVER['HTTP_HOST']))) {
		echo '<p>MyPhotoPages</p>';
	}
	if (in_array('couturebook.ru', explode('/', $_SERVER['HTTP_HOST']))) {
		echo '<p>Couturebook</p>';
	}
	if (in_array('fineart-print.ru', explode('/', $_SERVER['HTTP_HOST']))) {
		echo '<p>FineArtPrint</p>';
	}
	if (in_array('fineartbox.ru', explode('/', $_SERVER['HTTP_HOST']))) {
		echo '<p>FineArtBox</p>';
	}
	else { echo '<p>Модификации для бренда загружены</p>'; }
}

if (in_array('myphotopages.ru', explode('/', $_SERVER['HTTP_HOST']))) {
		include_once ('brands/theme_shop_mpp.php');
		include_once 'theme_cabinet_menu.php';
}
if (in_array('couturebook.ru', explode('/', $_SERVER['HTTP_HOST']))) {
		include_once 'brands/theme_shop_cout.php';
		include_once 'theme_cabinet_menu.php';
}

if (in_array('fineart-print.ru', explode('/', $_SERVER['HTTP_HOST']))) {
		include_once 'brands/theme_shop_fap.php';
		include_once 'theme_cabinet_menu_non_tao.php';

}
if (in_array('fineartbox.ru', explode('/', $_SERVER['HTTP_HOST']))) {
		include_once 'brands/theme_shop_fab.php';
		include_once 'theme_cabinet_menu_non_tao.php';
}
//echo "<pre>";
//    $uri_parts = explode('/', $_SERVER['REQUEST_URI']);
//   print_r(explode('=', $uri_parts[3]));
//	print_r($_SERVER['HTTP_HOST']);
//echo "</pre>";

class load_language 
{
    public function __construct()
    {
    add_action('init', array($this, 'load_my_transl'));
    }
     public function load_my_transl()
    {
        load_plugin_textdomain('yith-woocommerce-account-funds', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
        load_plugin_textdomain('woocommerce-smart-coupons', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
        load_plugin_textdomain('woocommerce-account-funds', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
        load_plugin_textdomain('cherry-projects', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
    }
}
$zzzz = new load_language;
?>