<?php

/***
 * WooCommerce Remove Actions
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item_image', 'kidba_woocommerce_template_loop_product_thumbnail', 10);
add_action('kidba_woocommerce_shop_loop_item_title', 'kidba_woocommerce_template_loop_product_title', 10);
/**
 * Remove all woocommerce_single_product_summary data from single-product
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);


/***
 * Woo Filter
 */

 add_filter('woocommerce_product_price_class', 'kidba_woocommerce_product_price_class');
 add_filter('woocommerce_short_description', 'kidba_woocommerce_short_description');
 add_filter('woocommerce_cart_item_quantity', 'kidba_woocommerce_cart_item_quantity');