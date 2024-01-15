<?php
/* Add Pre-loader in your css file */
function axioned_add_rel_preload($html, $handle, $href, $media) {
    
    if (is_admin())
    return $html;
    
    if( !is_admin() ) {
        $preload = array(
            'primary-style',
            'my-style-slick',
        );
    }
    
    if ( in_array( $handle, $preload ) ) {
        $html = "<link rel='preload' id='$handle' href='$href' as='style' onload='this.rel=\"stylesheet\"'>";
    }
    
    return $html;
}
add_filter( 'style_loader_tag', 'axioned_add_rel_preload', 10, 4 );  
?>