<?php

// Add feature images
add_theme_support( 'post-thumbnails' );

// Register navs
register_nav_menus( array(
  'main_menu' => 'Main Menu',
  'footer_menu1' => 'Footer Menu 1',
  'footer_menu2' => 'Footer Menu 2',
  'footer_menu3' => 'Footer Menu 3'
));


// Custom logos
function custom_login_logo() {
  echo '<style type="text/css">
    h1 a { background-image:url('.get_bloginfo('template_directory').'/images/login-logo.png) !important; }
    </style>';
}
add_action('login_head', 'custom_login_logo');


// Custom CSS styles on WYSIWYG Editor
function myCustomTinyMCE($init) {
  $init['theme_advanced_buttons2_add_before'] = 'styleselect'; // Adds the buttons at the begining. (theme_advanced_buttons2_add adds them at the end)
  $init['theme_advanced_styles'] = 'Link button=button;Key link button=button key;Small grey text=small-grey-text';
  $init['theme_advanced_text_colors'] = '333333,737888,e45820,999999';
  return $init;
}
add_filter('tiny_mce_before_init', 'myCustomTinyMCE' );
add_editor_style('css/admin-editor.css');


// Giving Editors Access to Gravity Forms
function add_grav_forms(){
  $role = get_role('editor');
  $role->add_cap('gform_full_access');
}
add_action('admin_init','add_grav_forms');

function fotp_get_excerpt($post_id, $excerpt_length = 15, $trailing_character = '&nbsp;&hellip;') {
  $the_post = get_post( $post_id );
  $the_excerpt = strip_tags( strip_shortcodes( $the_post->post_excerpt ), '<em>' );

  if ( empty( $the_excerpt ) ) $the_excerpt = strip_tags( strip_shortcodes( $the_post->post_content ) );
  $words = explode( ' ', $the_excerpt, $excerpt_length + 1 );

  if( count( $words ) > $excerpt_length ) $words = array_slice( $words, 0, $excerpt_length );

  $the_excerpt = implode( ' ', $words ) . $trailing_character;
  return $the_excerpt;
}


// Dashboard footer
if (! function_exists('dashboard_footer') ){
    function dashboard_footer () {
        echo 'Website crafted by <a href="http://uprise.co.nz" target="_blank">Uprise</a>';
    }
}
add_filter('admin_footer_text', 'dashboard_footer');


// Disable image link in post
function wpb_imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );

  if ($image_set !== 'none') {
    update_option('image_default_link_type', 'none');
  }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);


?>
 