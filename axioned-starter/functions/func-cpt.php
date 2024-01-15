<?php 
/*
* Create Custom Post type
*/
function create_custom_post_type($post_label, $cptSlug, $menu_pos=NULL, $menu_icon=NULL) {
    register_post_type($post_label['name'], array(
      'label' => $post_label['label'],
      'labels' => array(
        'name' => __($post_label['label']),
        'singular_name' => __($post_label['label']),
        'add_new' => __('Add New ' . $post_label['label']),
        'add_new_item' => __('Add New ' . $post_label['label']),
        'edit_item' => __('Edit ' . $post_label['label']),
        'new_item' => __('New ' . $post_label['label']),
        'view_item' => __('View ' . $post_label['label']),
        'view_items' =>(__('View ' . $post_label['label']) . 's'),
        'search_items' => __('Search ' . $post_label['label'] . 's'),
        'all_items' => (__('View ' . $post_label['label']) . 's'),
      ),
      'public' => true,
      'show_in_rest' => true,
      'has_archive' => ($post_label["label"] === "Gallery") ? false : true,
      'hierarchical' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_admin_bar' => false,
      'show_in_nav_menus' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'can_export' => true,
      'menu_icon' => $menu_icon,
      'supports' => array(
        'title',
        'thumbnail',
        'revisions',
        'excerpt',
      ),
      'menu_position' => $menu_pos,
      'rewrite' => array('slug' => $cptSlug)
    ));
}

function init_function_call() {
  $product_labels = array(
    'label' => 'Product',
    'name' => 'product',
  );

  $project_labels = array(
    'label' => 'Project',
    'name' => 'project',
  );

  /* creating custom post */
  create_custom_post_type($product_labels, 'product', 6, 'dashicons-media-default');
  create_custom_post_type($project_labels, 'project', 8, 'dashicons-products');
}
add_action( 'init', 'init_function_call');
?>