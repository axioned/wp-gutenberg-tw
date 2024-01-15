<?php 
  // Option Page
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
      'page_title' => 'Options',
      'menu_title' => 'Options',
      'menu_slug' => 'options-settings',
      'capability' => 'edit_posts',
      'redirect' => 'true',
    ));
  
    acf_add_options_sub_page(array(
      'menu_title' => 'Header',
      'page_title' => 'Header Setting',
      'parent_slug' => 'options-settings'
    ));
  
    acf_add_options_sub_page(array(
      'menu_title' => 'Footer',
      'page_title' => 'Footer Setting',
      'parent_slug' => 'options-settings'
    ));
  }
?>