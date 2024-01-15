<?php
// enqueue script and style
function axioned_style_and_script_enqueue() {
    $ver = time();

    wp_enqueue_style( 'primary-style', get_template_directory_uri() . '/build/css/style.min.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( 'primary-script', get_template_directory_uri() . '/build/js/script.min.js', array('jquery'), $ver, true );
    
    if( (is_home() || is_front_page()) ) {
        /* Homepage specific stylings */
    }
    wp_enqueue_style( 'my-style-slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );
    wp_enqueue_style( 'my-slider-script-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css');
    
    if( (is_home() || is_front_page()) ) {
        /* Homepage specific scripts */
    }
    wp_enqueue_script('my-slider-script', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js');

    wp_localize_script('primary-script', 'wp_ajax_data',
    array(
      'ajax_url' => admin_url('admin-ajax.php'),
      'template_url' => get_template_directory_uri(),
    )
  );
}
add_action('wp_enqueue_scripts','axioned_style_and_script_enqueue');
?>