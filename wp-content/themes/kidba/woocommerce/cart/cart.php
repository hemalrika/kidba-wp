<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
$shop_page_id = wc_get_page_id( 'shop' );
$shop_page_url = $shop_page_id ? get_permalink( $shop_page_id ) : '';
?>

<form class="woocommerce-cart-form pb-70" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
    <div class="panel mb-50">
        <div class="table-responsive">
            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents table table-bordered cart-table mb-0" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col"><?php echo esc_html__('Product', 'kidba'); ?></th>
                        <th scope="col"><?php echo esc_html__('Description', 'kidba'); ?></th>
                        <th scope="col"><?php echo esc_html__('Model', 'kidba'); ?></th>
                        <th scope="col"><?php echo esc_html__('Quantite', 'kidba'); ?></th>
                        <th scope="col"><?php echo esc_html__('Price', 'kidba'); ?></th>
                        <th scope="col"><?php echo esc_html__('Total', 'kidba'); ?></th>
                        <th scope="col"><?php echo esc_html__('Action', 'kidba'); ?></th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        $product_slug = get_post_field('post_name', $product_id);
                        $product_slug = $product_slug ? $product_slug : '';
                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                                <td class="px-15">
                                    <?php
                                    echo "<div class='cart-img'>";
                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                    echo "</div>";
                                    if ( ! $product_permalink ) {
                                        echo $thumbnail; // PHPCS: XSS ok.
                                    } else {
                                        printf( '<div class="cart-img"><a href="%s">%s</a></div>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                    }
                                    ?>
                                </td>
                                <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'kidba' ); ?>">
                                    <div class="cart-txt">
                                        <?php
                                            if ( ! $product_permalink ) {
                                                echo "<h4 class='cart-product-title d-block mb-10'>";
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                                echo "</h4>";
                                            } else {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="cart-product-title d-block mb-10">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }

                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                            // Meta data.
                                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                            // Backorder notification.
                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'kidba' ) . '</p>', $product_id ) );
                                            }
                                            echo "<span class='d-block'>".wp_trim_words(get_the_excerpt($product_id), 10)."</span>";
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <?php echo esc_html($product_slug); ?>
                                </td>
                                <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'kidba' ); ?>">
                                    <div class="product-count">
                                        <div class="quantity m-auto">
                                            <?php
                                                if ( $_product->is_sold_individually() ) {
                                                    $product_quantity = sprintf( '<input type="hidden"  min="1" step="1" max="100" step="1" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                } else {
                                                    $product_quantity = woocommerce_quantity_input(
                                                        array(
                                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                                            'input_value'  => $cart_item['quantity'],
                                                            'max_value'    => $_product->get_max_purchase_quantity(),
                                                            'min_value'    => 0,
                                                            'step'         => 1,
                                                            'product_name' => $_product->get_name(),
                                                        ),
                                                        $_product,
                                                        false
                                                    );
                                                }

                                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                            ?>
                                        </div>
                                    </div>
                                </td>

                                <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'kidba' ); ?>">
                                    <?php
                                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                                </td>

                                <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'kidba' ); ?>">
                                    <?php
                                        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                                </td>
                                <td class="product-remove">
                                    <?php
                                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            'woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="remove cart-action-btn" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="icofont-bin"></i></a>',
                                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                esc_html__( 'Remove this item', 'kidba' ),
                                                esc_attr( $product_id ),
                                                esc_attr( $_product->get_sku() )
                                            ),
                                            $cart_item_key
                                        );
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php do_action( 'woocommerce_cart_contents' ); ?>
            <div class="cart-table-bottom p-30 px-30">
                <div class="btn-box flex-wrap justify-content-between">
                    <a href="<?php echo esc_url($shop_page_url); ?>" class="def-btn btn-3"><?php echo esc_html__('Continue Shopping', 'kidba'); ?></a>
                    <button type="submit" class="button def-btn" name="update_cart" value="<?php esc_attr_e( 'Update Shopping cart', 'kidba' ); ?>"><?php esc_html_e( 'Update Shopping cart', 'woocommerce' ); ?></button>
                    <?php do_action( 'woocommerce_cart_actions' ); ?>
                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                </div>
            </div>
            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
        </div>
    </div>
    <div class="row">
        <?php if ( wc_coupons_enabled() ) { ?>
        <div class="col-lg-6 col-md-6">
            <div class="panel mb-50">
                <div class="panel-heading">
                    <h3 class="panel-heading-txt">Discount Code</h3>
                </div>
                <div class="panel-body">
                    <form action="index.html">
                        <div class="form-group mt--6 mb-30">
                            <label for="coupon_code" class="cart-label mb-17"><?php esc_html_e( 'Enter your coupon code.', 'kidba' ); ?></label>
                            <input type="text" name="coupon_code" class="input-text checkout-form" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'kidba' ); ?>" /> 
                        </div>
                        <div class="btn-box">
                            <button type="submit" class="border-0 def-btn btn-3" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'kidba' ); ?>"><?php esc_attr_e( 'Apply coupon', 'kidba' ); ?>
                            <?php do_action( 'woocommerce_cart_coupon' ); ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="col-lg-6 col-md-6">
            <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

                <div class="cart-collaterals">
                    <?php
                        /**
                         * Cart collaterals hook.
                         *
                         * @hooked woocommerce_cross_sell_display
                         * @hooked woocommerce_cart_totals - 10
                         */
                        do_action( 'woocommerce_cart_collaterals' );
                    ?>
            <?php do_action( 'woocommerce_after_cart' ); ?>
        </div>
    </div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>


