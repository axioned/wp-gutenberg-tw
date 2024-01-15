<?php 
/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
*/


function axioned_setup() {
    load_theme_textdomain( 'axioned' );
  
    /* Add menu support */
    add_theme_support('menus');
  
    /* Add excerpt for pages */
    add_post_type_support( 'page', 'excerpt' );
  
    /* Add default posts and comments RSS feed links to head. */
    add_theme_support( 'automatic-feed-links' );
  
    add_theme_support( 'title-tag' );
  
    /* Enable support for Post Thumbnails on posts and pages. */
    add_theme_support( 'post-thumbnails' );
  
    /* Add default posts and comments RSS feed links to head. */
    add_theme_support( 'automatic-feed-links' );
  
    add_theme_support('html5', array('search-form'));
  
    // this will disable the gutenberg
    // add_filter('use_block_editor_for_post', '__return_false', 10);
  
    /* Add theme support for Custom Logo. */
    add_theme_support( 'custom-logo', array(
      'width'       => 500,
      'height'      => 500,
      'flex-height' => true,
      'flex-width'  => true,
    ) );
  
    // register menus
    register_nav_menus( array(
      'primary' => esc_html__( 'Primary Navigation', 'axioned' ),
      'footer' => esc_html__( 'Footer Navigation', 'axioned' ),
    ) );
}
add_action( 'after_setup_theme', 'axioned_setup' );


/* Action for upload SVG file */
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    $filetype = wp_check_filetype( $filename, $mimes );
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
    
}, 10, 4 );

function axioned_cc_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'axioned_cc_mime_types' );

function axioned_fix_svg() {
    echo '<style type="text/css">
    .attachment-266x266, .thumbnail img {
        width: 100% !important;
        height: auto !important;
    }
    </style>';
}
add_action( 'admin_head', 'axioned_fix_svg' );

/* rest_authentication_errors */
add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    return $result;
});

/*
* Disable support for comments and trackbacks in post types 
*/
function axioned_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'axioned_disable_comments_post_types_support');

// Close comments on the front-end
function axioned_disable_comments_status() {
    return false;
}

add_filter('comments_open', 'axioned_disable_comments_status', 20, 2);
add_filter('pings_open', 'axioned_disable_comments_status', 20, 2);

// Hide existing comments
function axioned_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'axioned_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function axioned_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'axioned_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function axioned_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'axioned_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function axioned_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'axioned_disable_comments_dashboard');

// Remove comments links from admin bar
function axioned_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'axioned_disable_comments_admin_bar');

/* custom excerpt length */
function axioned_custom_excerpt_length($length) {
    return 15;
}
add_filter('excerpt_length', 'axioned_my_excerpt_length');

function new_excerpt_more($more) {
    global $post;
    return '<a class="readmore" href="'. get_permalink($post->ID) . '">...read more</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function wrong_login() {
    return 'Wrong username or password.';
}
add_filter('login_errors', 'wrong_login');

function axioned_disable_embeds_code_init() {
    
    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );
    
    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    
    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'axioned_disable_embeds_tiny_mce_plugin' );
    
    // Remove all embeds rewrite rules.
    add_filter( 'rewrite_rules_array', 'axioned_disable_embeds_rewrites' );
    
    // Remove filter of the oEmbed result before any HTTP requests are made.
    remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}
add_action( 'init', 'axioned_disable_embeds_code_init', 9999 );

function axioned_disable_embeds_tiny_mce_plugin($plugins) {
    return array_diff( $plugins, array('wpembed') );
}

function axioned_disable_embeds_rewrites ($rules) {
    foreach($rules as $rule => $rewrite) {
        if(false !== strpos($rewrite, 'embed=true')) {
            unset($rules[$rule]);
        }
    }
    return $rules;
}

/*
The wlwmanifest tag is another meta tag that shows up on every WordPress website. 
The tag is used by Windows Live Writer, which is an almost obsolete app used to publish directly to WordPress. 
Removing this line of code will marginally improve the load time, reduce the DOM size and enhance Googlebot crawl process (one link less to follow).
*/
remove_action('wp_head', 'wlwmanifest_link');

/*
RSD is a discovery service that helps discover Pingbacks and XML-RPC on WordPress blogs. 
As we’ve disabled XML-RPC and Pingbacks, then we can safely disable RSD as well. 
To disable it, use this code into the theme’s functions.php file:
*/
remove_action( 'wp_head', 'rsd_link' ) ;

/* Disable XML-RPC */
add_filter( 'xmlrpc_enabled', '__return_false' );

/* Remove the REST API Link */
add_action('after_setup_theme', function() {
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
});

/* Disable RSS Feeds */
function itsme_disable_feed() {
    wp_die( __( 'No feed available, please visit the <a rel="noopener" href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}

add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);

/* Disable Self Pingbacks */
function no_self_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
    if ( 0 === strpos( $link, $home ) )
    unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

//Removing Tags from Post
function wpsnipp_remove_default_taxonomies(){
    global $pagenow;
  
    register_taxonomy( 'post_tag', array() );
  
    $tax = array('post_tag');
  
    if($pagenow == 'edit-tags.php' && in_array($_GET['taxonomy'],$tax) ){
    wp_die('Invalid taxonomy');
    }
  }
  add_action('init', 'wpsnipp_remove_default_taxonomies');

  /*
    As wp_get_attachment_image() method is used to fetch image element with all its attribute it fixes the issue for CLS, 
    But this method doesn't give height and width attributes for SVG Images ( which cause issue in CLS ). 
    To fix this founded the below mention code
  */
  
add_filter( 'wp_get_attachment_image_src', 'fix_wp_get_attachment_image_svg', 10, 4 );  /* the hook */

function fix_wp_get_attachment_image_svg($image, $attachment_id, $size, $icon) {
  if (is_array($image) && preg_match('/\.svg$/i', $image[0]) && $image[1] <= 1) {
      if(is_array($size)) {
          $image[1] = $size[0];
          $image[2] = $size[1];
      } elseif(($xml = simplexml_load_file($image[0])) !== false) {
          $attr = $xml->attributes();
          $viewbox = explode(' ', $attr->viewBox);
          $image[1] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
          $image[2] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
      } else {
          $image[1] = $image[2] = null;
      }
  }
  return $image;
} 
?>