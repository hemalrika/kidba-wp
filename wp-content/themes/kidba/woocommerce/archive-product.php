<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<?php
if ( woocommerce_product_loop() ) {
$column_class = is_active_sidebar('shop') ? 'col-xl-8 col-lg-8': 'col-12';    
?>
<div class="product-add-cart-success-alert"></div>
<div class="row">
    <?php if(is_active_sidebar('shop')) : ?>
    <div class="col-xl-4 col-lg-4">
        <?php
            /**
             * Hook: woocommerce_sidebar.
             *
             * @hooked woocommerce_get_sidebar - 10
             */
            do_action( 'woocommerce_sidebar' );
        ?>
    </div>
    <?php endif; ?>
    <div class="<?php echo esc_attr($column_class); ?>">
        <?php
            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            
            ?>
            <div class="course__tab-inner grey-bg-2 mb-50">
                <div class="row align-items-center">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="course__tab-wrapper d-flex align-items-center justify-content-center justify-content-md-start mb-10 mb-md-0">
                            <div class="course__view">
                                <?php woocommerce_result_count(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="course__sort d-flex align-items-center justify-content-center justify-content-md-end">
                        <div class="course__view mr-15"><h4><?php echo esc_html__('Sort By', 'kidba'); ?></h4></div>
                            <div class="course__sort-inner">
                                <?php woocommerce_catalog_ordering(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <?php woocommerce_product_loop_start();
                
                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();
                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action( 'woocommerce_shop_loop' );
                        $product_id = get_the_ID();
                        $product_in_tutor_check = get_post_meta(get_the_ID(), '_tutor_product', true);
                        if($product_in_tutor_check != 'yes') {
                            wc_get_template_part( 'content', 'product' );
                        }
                    }
                }
            
                woocommerce_product_loop_end();
            
                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            } else {
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action( 'woocommerce_no_products_found' );
            }
        ?>
    </div>
</div>
<?php


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );



get_footer( 'shop' );