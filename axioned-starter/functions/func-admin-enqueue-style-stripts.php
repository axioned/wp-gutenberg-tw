<?php
// enqueue admin script and style
function admin_style() {
  wp_enqueue_style('admin-styles-new', get_template_directory_uri() . '/build/css/style.min.css', array(), $ver, 'all');
  wp_enqueue_script( 'primary-script', get_template_directory_uri() . '/build/js/script.min.js', array('jquery'), $ver, true );

  wp_enqueue_style( 'my-style-slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );
  wp_enqueue_style( 'my-slider-script-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css');
  wp_enqueue_script('my-slider-script', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js');

}
add_action('admin_enqueue_scripts', 'admin_style');
?>