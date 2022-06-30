<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
        <?php
            $html = '';
            $html .= '<div class="shop-details-img-wrapper mb-50">';
                if(!empty($attachment_ids)) {
                    $html .= '<div class="shop-details-lg-images mb-50">';
                    foreach($attachment_ids as $attachment_id) {
                        $product_image_url = wp_get_attachment_image_src($attachment_id, 'full');
                        $product_image_url = $product_image_url[0];
                        $html .= '<div class="shop-details-lg-img w_100">';
                        $html .= '<div class="p-rel">';
                        $html .= woocommerce_show_product_sale_flash();
                        $html .= '<img src="'.$product_image_url.'" alt="'.__('Product Image', 'kidba').'"/>';
                        $html .= '</div>';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                } else {
                    if(!empty($post_thumbnail_id)) {
                        $product_image_url = wp_get_attachment_image_src($post_thumbnail_id, 'full');
                        $html .= '<div class="shop-details-lg-images mb-50">';
                        $html .= '<div class="shop-details-lg-img w_100">';
                        $html .= '<div class="p-rel">';
                        $html .= woocommerce_show_product_sale_flash();
                        $html .= '<img src="'.$product_image_url[0].'" alt="'.__('Product Image', 'kidba').'"/>';
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '</div>';
                    }
                }
                $html .= '</div>';
            echo $html;
        ?>










		<?php
		do_action( 'woocommerce_product_thumbnails' );
		?>
</div>
