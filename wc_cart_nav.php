<?php
/*
Plugin Name: WooCommerce Menu Cart
Plugin URI: www.wpovernight.com/plugins
Description: Woocommerce plugin that places a cart icon with number of items and total cost in the menu bar. Activate the plugin, set your menu's primary name to 'cart' and you're ready to go! Will automatically conform to your theme styles. Be sure that a menu is set to 'cart', otherwise the plugin will not work.
Version: 1.0.2
Author: Jeremiah Prummer
Author URI: www.wpovernight.com/about
License: GPL2
*/
/*  Copyright 2012 Jeremiah Prummer (email : jeremiah.prummer@yahoo.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/
?>
<?php

$wccart_menu_name = 'cart';

add_filter('wp_nav_menu_' . $wccart_menu_name . '_items','add_search_box_to_menu' , 10, 2);

function add_search_box_to_menu( $items ) {
global $woocommerce;
$viewing_cart = __('View your shopping cart', 'woothemes');
$cart_url = $woocommerce->cart->get_cart_url();
$cart_contents = sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);
$cart_total = $woocommerce->cart->get_cart_total();
if ($cart_contents > 0) {
$items .= '<li style="float: right"><a class="cart-contents" href="'. $cart_url .'" 
title="'. $viewing_cart .'"><i class="icon-shopping-cart"></i> '. $cart_contents .'
 - '. $cart_total .'</a></li>';

    return $items;
    }
else {
return $items;
}
}
?>