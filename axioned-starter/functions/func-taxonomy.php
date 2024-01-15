<?php 
  /*
  * Function to Create Custom Taxonomy
  */
  function create_custom_taxonomy($tax_name , $cpt_name, $tax_slug, $custom_label) {
    $args = array(
      'label' => __( $tax_name ),
      'rewrite' => array( 'slug' => $tax_slug, 'hierarchical' => true ),
      'hierarchical' => true,
      'show_admin_column' => true,
      'show_in_rest' => true,
    );
    if($custom_label){
     $args["custom_label"] = $custom_label;
   }
  
   register_taxonomy( $tax_slug , $cpt_name , $args );
  }

  function init_taxonomy_register() {
    /* creating custom taxonomy */
    create_custom_taxonomy( 'Product Category' , 'product' , 'product-category', Null);
  }
  add_action( 'init', 'init_taxonomy_register');
?>