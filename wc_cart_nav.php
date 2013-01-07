<?php
/*
Plugin Name: WooCommerce Menu Cart
Plugin URI: www.wpovernight.com/plugins
Description: Woocommerce plugin that places a cart icon with number of items and total cost in the menu bar. Activate the plugin, set your menu's primary name to 'cart' and you're ready to go! Will automatically conform to your theme styles. Be sure that a menu is set to 'cart', otherwise the plugin will not work.
Version: 1.1.1
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
add_action('admin_init', 'wc_menucart_init' );
add_action('admin_menu', 'wc_menucart_add_page');

// Init plugin options to white list our options
function wc_menucart_init(){
	register_setting( 'wc_menucart_options', 'menucart_display', 'wc_menucart_options_validate' );
	register_setting( 'wc_menucart_options', 'menucart_name', 'wc_menucart_options_validate' );
	register_setting( 'wc_menucart_options', 'menucart_icon', 'wc_menucart_options_validate' );
	register_setting( 'wc_menucart_options', 'menucart_items', 'wc_menucart_options_validate' );
}

// Add menu page
function wc_menucart_add_page() {

			add_submenu_page( 'woocommerce' , 'Menu Cart' , 'Menu Cart Setup' , 'manage_options', 'wc_menucart_options_page', 'wc_menucart_options_do_page');
}

// Draw the menu page itself
function wc_menucart_options_do_page() {

?>
	<div class="wrap">
	<div style="background: #F3F3F3;-moz-border-radius: 3px;border-radius: 3px;margin:5%;padding: 10px;-moz-box-shadow: 0 0 5px #888;-webkit-box-shadow: 0 0 5px#888;box-shadow: 0 0 5px #888;width: 40%;float: left"> 
	<h1 style='margin-bottom: 30px;text-align: center'><?php _e('Menu Cart Setup','woothemes') ?></h1>
	<h3><?php _e("Let's keep this simple! Just check the boxes next to the features you want.","woothemes") ?></h3>
	<form method="post" action="options.php">
		<?php settings_fields('wc_menucart_options'); ?>
		<ul>
			<li>
				<?php $options = get_option('menucart_name'); ?>
				<input type="text" name="menucart_name[menu_name]" value="<?php echo $options['menu_name']; ?>" />
				<?php _e('Set the name of the menu you want to display','woothemes') ?>
			</li>
			<li>
				<?php $options = get_option('menucart_display'); ?>
				<input type="checkbox" name="menucart_display[always_display]" value="1" <?php checked($options['always_display'], 1); ?> />
				<?php _e("Display cart always, even if it's empty.","woothemes") ?>
			</li>
			<li>
				<?php $options = get_option('menucart_icon'); ?>
				<input type="checkbox" name="menucart_icon[icon_display]" value="1" <?php checked($options['icon_display'], 1); ?> />
				<?php _e("Don't display shopping cart icon (displayed by default).","woothemes") ?>
			</li>
			<li>
				<?php $options = get_option('menucart_items'); ?>
				<input type="radio" name="menucart_items[items_display]" value="1" <?php checked('1', $options['items_display']); ?> />
				<?php _e('Display Items Only.','woothemes') ?>
			</li>
			<li>
				<input type="radio" name="menucart_items[items_display]" value="2" <?php checked('2', $options['items_display']); ?> />
				<?php _e('Display Price Only.','woothemes') ?>
			</li>
			<li>
				<input type="radio" name="menucart_items[items_display]" value="3" <?php checked('3', $options['items_display']); ?> />
				<?php _e('Display both price and items.','woothemes') ?>
			</li>
		</ul>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes' , 'woothemes') ?>" />
		</p>
	</form>	
	</div>
	<div style="background: #F3F3F3;-moz-border-radius: 3px;border-radius: 3px;margin:5%;margin-left: 0%;padding: 10px;-moz-box-shadow: 0 0 5px #888;-webkit-box-shadow: 0 0 5px#888;box-shadow: 0 0 5px #888;width: 40%;float: left">
		<h1 style='margin-bottom: 30px;text-align: center'><?php _e('Contribute' , 'woothemes') ?></h1>
		<h3><?php _e('This plugin is only possible because of your contributions. Please consider helping by:' , 'woothemes') ?></h3>
		<p style="margin-top: 40px;margin-bottom: 92px;line-height: 20px"><strong>
		<?php _e('Giving a small donation:' , 'woothemes') ?> <a class="button-primary" href="https://www.wpovernight.com/donate" target="_blank" style="float: right;margin-right: 152px"><?php _e('Donate' , 'woothemes') ?></a>
	<br><br>
		<?php _e('Rating/Reviewing this on WordPress:' , 'woothemes') ?> <a class="button-primary" href="http://wordpress.org/support/view/plugin-reviews/woocommerce-menu-bar-cart" target="_blank" style="float: right;margin-right: 140px"><?php _e('Review It' , 'woothemes') ?></a>
	<Br><br>
		<?php _e('Offering ideas/expertise:' , 'woothemes') ?> <a class="button-primary" href="https://wpovernight.com/contact/" target="_blank" style="float: right;margin-right: 93px"><?php _e('Make Suggestion' , 'woothemes') ?></a>
	</strong></p> 
	</div>
	</div>
<?php
}
// Sanitize and validate input. Accepts an array, return a sanitized array.
function wc_menucart_options_validate($input) {
	// Our first value is either 0 or 1
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	
	// Say our second option must be safe text with no HTML tags
	$input['sometext'] =  wp_filter_nohtml_kses($input['sometext']);
	
	return $input;
}
//load fontawesome
$icon_display = get_option('menucart_icon');
$wccart_icon_display = $icon_display['icon_display'];
if ($wccart_icon_display != 1) {
	function mypage_head() {
    	echo '<link rel="stylesheet" type="text/css" href="https://www.agapebands.com/fontawesome/css/font-awesome.css">'."\n";
	}
	add_action('wp_head', 'mypage_head');
}
//grab cart name
$menu_name = get_option('menucart_name');
$wccart_menu_name_all = $menu_name['menu_name'];
$wccart_menu_name = strtolower($wccart_menu_name_all);
add_filter('wp_nav_menu_' . $wccart_menu_name . '_items','add_search_box_to_menu' , 10, 2);

function add_search_box_to_menu( $items ) {
	$always_display = get_option('menucart_display');
	$wccart_always_display = $always_display['always_display'];
	$items_display = get_option('menucart_items');
	$wccart_items_display = $items_display['items_display'];
	global $woocommerce;
	$viewing_cart = __('View your shopping cart', 'woothemes');
	$cart_url = $woocommerce->cart->get_cart_url();
	$cart_contents = sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);
	$cart_total = $woocommerce->cart->get_cart_total();
	if ( $wccart_always_display != 1 && $wccart_items_display == 1 ){
		if ($cart_contents > 0) {
		$items .= '<li style="float: right"><a class="cart-contents" href="'. $cart_url .'" 
title="'. $viewing_cart .'"><i class="icon-shopping-cart"></i> '. $cart_contents .' </a></li>';

    		return $items;
    	}
		else {
			return $items;
		}
	}
	if ($wccart_always_display != 1 && $wccart_items_display == 2){
		if ($cart_contents > 0) {
		$items .= '<li style="float: right"><a class="cart-contents" href="'. $cart_url .'" 
title="'. $viewing_cart .'"><i class="icon-shopping-cart"></i> '. $cart_total .'</a></li>';

    		return $items;
    	}
		else {
			return $items;
		}
	}
	if ($wccart_always_display != 1 && $wccart_items_display == 3){
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
	if ($wccart_always_display == 1 && $wccart_items_display == 1){
		$items .= '<li style="float: right"><a class="cart-contents" href="'. $cart_url .'" 
title="'. $viewing_cart .'"><i class="icon-shopping-cart"></i> '. $cart_contents .' </a></li>';

    	return $items;
	}
	if ($wccart_always_display == 1 && $wccart_items_display == 2){
		$items .= '<li style="float: right"><a class="cart-contents" href="'. $cart_url .'" 
title="'. $viewing_cart .'"><i class="icon-shopping-cart"></i>'. $cart_total .'</a></li>';

    	return $items;
	}
	if ($wccart_always_display == 1 && $wccart_items_display == 3){
		$items .= '<li style="float: right"><a class="cart-contents" href="'. $cart_url .'" 
title="'. $viewing_cart .'"><i class="icon-shopping-cart"></i> '. $cart_contents .'
 - '. $cart_total .'</a></li>';

    	return $items;
	}
}
?>