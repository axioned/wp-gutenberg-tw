<?php
/* Add defer to JS */
function axioned_add_defer_scripts( $tag, $handle, $src ) {
    if( !is_admin() ) {
        $defer = array(
            'primary-script',
            'my-slider-script',
        );
        
        if ( in_array( $handle, $defer ) ) {
            return '<script id="'.$handle.'-js" src="' . $src . '" type="text/javascript" defer></script>' . "\n";
        }
    }
    
    return $tag;
} 
add_filter( 'script_loader_tag', 'axioned_add_defer_scripts', 10, 3 );
?>