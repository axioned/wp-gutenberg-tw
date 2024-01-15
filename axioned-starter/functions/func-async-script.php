<?php
/* Add async to JS */
function axioned_add_async_scripts( $tag, $handle, $src ) {
    if( !is_admin() ) {
        $async = array(
            'jquery-migrate',
        );
        
        if ( in_array( $handle, $async ) ) {
            return '<script id="'.$handle.'-js" src="' . $src . '" type="text/javascript" async></script>' . "\n";
        }
    }
    
    return $tag;
} 
add_filter( 'script_loader_tag', 'axioned_add_async_scripts', 10, 3 );
?>