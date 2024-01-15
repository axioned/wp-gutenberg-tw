<?php
function my_acf_init() {
  register_acf_blocks('banner', 'banner', 'A custom banner block', '/inc/blocks/content-banner.php', 'admin-comments');
  register_acf_blocks('image-grid', 'image-grid', 'A custom image grid block', '/inc/blocks/content-image-grid.php', 'admin-comments');
  register_acf_blocks('slider', 'slider', 'A custom slider block', '/inc/blocks/content-slider.php', 'admin-comments');
  register_acf_blocks('two-column-layout', 'Two Column Layout', 'A custom Two Column Layout block', '/inc/blocks/content-two-column-layout.php', 'admin-comments');
}

function register_acf_blocks($slug, $title, $description, $template_loc, $icon) {

  if( function_exists('acf_register_block') ) {
    acf_register_block(array(
      'name'              => $slug,
      'title'             => __($title),
      'description'       => __($description),
      'render_callback'   => 'my_acf_block_render_callback',
      'render_template' => get_theme_file_path() . $template_loc,
      'category'          => 'formatting',
      'icon'              => $icon,
      'keywords'          => array( $slug ),
    ));
  }
}

function my_acf_block_render_callback( $block ) {
  // convert name ("acf/testimonial") into path friendly slug ("testimonial")
  $slug = str_replace('acf/', '', $block['name']);
  
  // include a template part from within the "template-parts/block" folder
  if( file_exists( get_theme_file_path("/inc/blocks/content-{$slug}.php") ) ) {
      include( get_theme_file_path("/inc/blocks/content-{$slug}.php") );
  }
}

add_action('acf/init', 'my_acf_init');

add_filter( 'allowed_block_types_all', 'axioned_allowed_block_types', 25, 2 );
 
function axioned_allowed_block_types( $allowed_blocks, $editor_context ) {
 
	return array(
		'acf/two-column-layout',
		'acf/banner',
		'acf/slider',
		'acf/image-grid',
	);
 
}
?>