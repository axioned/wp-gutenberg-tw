<?php 

function create_html_tag($tag_name, $attributes = array(), $content = '') {
    // Sanitize tag name
    $tag_name = strtolower($tag_name);

    // Opening tag
    $html_tag = '<' . $tag_name;

    // Add attributes if provided
    if (!empty($attributes)) {
        foreach ($attributes as $attr_name => $attr_value) {
            $html_tag .= ' ' . esc_attr($attr_name) . '="' . esc_attr($attr_value) . '"';
        }
    }

    // Closing tag
    $html_tag .= '>' . esc_html($content) . '</' . $tag_name . '>';

    return $html_tag;
}

?>