<?php
namespace TPCore\Traits\Classes;
trait TP_Core_Class_Func {
    public function tp_core_cpt_taxonomies($posttype,$value='id')
    {
        $options = array();
        $terms = get_terms( $posttype );
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                if ('name' == $value) {
                    $options[$term->name] = $term->name;
                } else {
                    $options[$term->term_id] = $term->name;
                }
            }
        }
        return $options;
    }
    public function tp_get_categories()
    {
        $terms = get_terms( 'category', array(
            'orderby'    => 'count',
            'hide_empty' => 0
        ) );
        $options = array();
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                $options[ $term->term_id ] = $term->name;
            }
        }
        return $options;
    }
    /*
     * List Posts
     */
    public function tp_get_posts() {
        $list = get_posts( array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        ) );
        $options = array();
        if ( ! empty( $list ) && ! is_wp_error( $list ) ) {
            foreach ( $list as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
        }
        return $options;
    }
    public function tp_core_get_slug_by_id($taxonomy, $id) {
        $term_slug = '';
        if(!empty($taxonomy && $id)) {
            $term = get_term( $id, $taxonomy );
            $term_slug = $term->slug;
        }
        return $term_slug;
    }
    public function tp_core_get_name_by_id($taxonomy, $id) {
        $term_slug = '';
        if(!empty($taxonomy && $id)) {
            $term = get_term( $id, $taxonomy );
            $term_slug = $term->name;
        }
        return $term_slug;
    }
    public function tp_core_post_category_list_by_id($post_id, $taxonomy, $parent_class="tp-couse-cat-list", $child_class="") {
        $cat_lists = '';
        global $post;
        if(!empty($post_id && $taxonomy)) {
            $cat_args = get_the_terms( $post->ID, 'course-category' );
            if($cat_args) {
                $cat_lists .= '<div class="'.esc_attr($parent_class).'">';
                foreach($cat_args as $args) {
                    $course_name = $args->name;
                    $cat_link = get_category_link($args->term_id);
                    $cat_lists .= '<a class="'.esc_attr($child_class).'" href="'.esc_url($cat_link).'">'.esc_html($course_name).'</a>';
                }
                $cat_lists .= "</div>";
            }
        } else {
            echo esc_html__("404 Error! Please Provide Post ID & Taxonomy First");
        }
        echo $cat_lists;
    }
    public function get_tp_core_post_category_list_by_slug($post_id, $taxonomy) {
        global $post;
        $cat_lists = array();
        if(!empty($post_id && $taxonomy)) {
            $cat_args = get_the_terms( $post->ID, 'course-category' );
            if($cat_args) {
                foreach($cat_args as $args) {
                    $slug = $args->slug;
                    array_push($cat_lists, $slug);
                }
            }
        }
        $cat_lists = implode (" ", $cat_lists); 
        return $cat_lists;
    }
    public function get_tp_core_course_price() {
        $course_price = apply_filters('tutor-loop-default-price', __('Free', 'tp-core'));
        $course_id = get_the_ID();
        if (tutor_utils()->is_course_purchasable()) {

            $product_id = tutor_utils()->get_course_product_id($course_id);
            $product = wc_get_product($product_id);

            if ($product) {
                $course_price = wp_strip_all_tags($product->get_price_html());
            }
        }
        return $course_price;
    }
}