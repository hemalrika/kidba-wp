<?php

function kidba_woocommerce_template_loop_product_thumbnail() { ?>
<div class="shop-card-img">
    <?php woocommerce_template_loop_product_link_open(); ?>
        <?php woocommerce_template_loop_product_thumbnail(); ?>
    <?php woocommerce_template_loop_product_link_close(); ?>
    <div class="shop-card-overlay">
        <?php kidba_woocommerce_template_loop_cart_product_link_open('shop-card-buy-now-btn'); ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/shop-cart-icon.png" alt="Buy Now">
        </a>
    </div>
</div>
<?php }

function kidba_woocommerce_template_loop_product_link_open($class='') {
    global $product;
    $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
    echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link '.$class.'">';
}
function kidba_woocommerce_template_loop_cart_product_link_open($class='') {
    global $product;
    $product_slug = $product->get_slug();
    $cart_link = '?add-to-cart='.get_the_ID().'';
    echo '<a class="button product_type_simple add_to_cart_button ajax_add_to_cart '.$class.' ajax_add_to_cart" data-product_sku="woo-'.$product_slug.'" data-product_id="'.get_the_ID().'" href="'.$cart_link.'">';
}
if ( ! function_exists( 'kidba_woocommerce_template_loop_product_title' ) ) {
	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function kidba_woocommerce_template_loop_product_title() {
        $product_url = get_permalink(get_the_ID());
		echo '<h3 class="shop-card-title mt--2 mb-20 ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"> <a href="'.$product_url.'">' . get_the_title() . '</a></h3>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if(!function_exists('kidba_woocommerce_product_price_class')) {
    function kidba_woocommerce_product_price_class($args) {
        return " shop-details-price mb-0";
    }
}
if(!function_exists('kidba_woocommerce_short_description')) {
    function kidba_woocommerce_short_description($args) {
        $args = wp_strip_all_tags($args);
        $html = "<p class='border-bottom pb-35 mb-40'>".$args."</p>";
        return $html;
    }
}
if(!function_exists('kidba_woocommerce_cart_item_quantity')) {
    function kidba_woocommerce_cart_item_quantity($args) {
        $args = str_replace('input-text qty text','input-text qty text quantity-input', $args);
        return $args;
    }
}
