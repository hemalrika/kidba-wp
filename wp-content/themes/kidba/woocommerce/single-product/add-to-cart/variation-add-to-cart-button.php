<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	$product_input_box = woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
        ), null, false
	);
    $product_input_box = str_replace('class="input-text qty text"','class="input-text qty text quantity-input" min="1" max="100" step="1" value="1"',$product_input_box);
	do_action( 'woocommerce_after_add_to_cart_quantity' );?>
    <div class="shop-details-cart-buttons d-flex mb-40">
        <div class="product-count">
            <div class="quantity m-auto me-4">
            <?php echo $product_input_box; ?>
                <div class="quantity-nav">
                    <div class="quantity-btn quantity-down">
                        <i class="icofont-minus"></i>
                    </div>
                    <div class="quantity-btn quantity-up">
                        <i class="icofont-plus"></i>
                    </div>
                </div>
            </div>
            <button type="submit" class="border-0 def-btn"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
        </div>
    </div>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
