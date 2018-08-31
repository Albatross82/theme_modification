<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates/Emails
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
   </head>
   <body bgcolor="#edeeef" style="width:600px; margin: 0 auto; position:relative; top:20px;">
      <table border="0" cellpadding="0" cellspacing="0" style=" font-family:arial; margin:0; padding:0" width="100%">
      <tr>
         <td>
            <center style="max-width: 600px; width: 100%;">
                                                            
                                                            
                                                            
                                                    
