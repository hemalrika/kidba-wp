<?php
/**
 * Check if CF7 Installed
 */
function tp_core_is_cf7_activated()
{
    return class_exists('WPCF7');
}

function tp_core_get_current_user_display_name()
{
    $user = wp_get_current_user();
    $name = 'user';
    if ($user->exists() && $user->display_name) {
        $name = $user->display_name;
    }
    return $name;
}
function tp_core_get_cf7_forms()
{
    $forms = [];
    if (tp_core_is_cf7_activated()) {
        $_forms = get_posts([
            'post_type' => 'wpcf7_contact_form',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
        ]);

        if (!empty($_forms)) {
            $forms = wp_list_pluck($_forms, 'post_title', 'ID');
        }
    }
    return $forms;
}

/**
 * Get Shortcode
 */
function tp_core_do_shortcode($tag, array $atts = array(), $content = null)
{
    global $shortcode_tags;
    if (!isset($shortcode_tags[$tag])) {
        return false;
    }
    return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
}
/**
 * Sanitize html class string
 *
 * @param $class
 * @return string
 */
function tp_core_sanitize_html_class_param($class)
{
    $classes = !empty($class) ? explode(' ', $class) : [];
    $sanitized = [];
    if (!empty($classes)) {
        $sanitized = array_map(function ($cls) {
            return sanitize_html_class($cls);
        }, $classes);
    }
    return implode(' ', $sanitized);
}
/**
 * allowed html
 */
function tp_element_kses_basic($string = '')
{
    return wp_kses($string, tp_element_get_allowed_html_tags('basic'));
}
function tp_element_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'img' => [
            'src' => [],
            'class' => []
        ],
        'b' => [],
        'i' => [],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
        'p' => [
            'class' => [],
            'data-wow-delay' => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'tpef' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
    }

    return $allowed_html;
}
