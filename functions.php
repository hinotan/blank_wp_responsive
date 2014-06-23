<?php

/*
  HTML head
  -----------------------------------------------
 */

// Enqueue scripts and styles
function mysite_scripts() {
  wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/vendor/css/flexslider.css');
  wp_enqueue_style( 'onMediaQuery-css', get_template_directory_uri() . '/vendor/css/onMediaQuery.css');
  wp_enqueue_style( 'mysite-main', get_template_directory_uri() . '/css/style.less');
  wp_enqueue_style( 'mysite-print', get_template_directory_uri() . '/css/print.less', null, '20140210', 'print');

  wp_register_style( 'ie-fix', get_bloginfo( 'stylesheet_directory' ) . '/css/iefix.css');
  $GLOBALS['wp_styles']->add_data( 'ie-fix', 'conditional', 'lt IE 9' );
  wp_enqueue_style( 'ie-fix' );

  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'mysite-plugins', get_template_directory_uri() . '/vendor/js/plugins.js', array( 'jquery' ) );
  wp_enqueue_script( 'mysite-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'mysite_scripts' );


// Add IE conditional html5 shim to header
function add_ie_html5_shim () {
  echo '<!--[if lt IE 9]>';
  echo '<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>';
  echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

// Add Analytics
function add_analytics() {
  ?>
  <script>

  </script>
  <?php
}
add_action('wp_head', 'add_analytics');



/*
  Utilities
  -----------------------------------------------
 */

// Pagination
function paginate() {
  global $wp_query, $wp_rewrite;
  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

  $pagination = array(
    'base' => @add_query_arg('page','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'show_all' => true,
    'type' => 'list',
    'next_text' => 'Next &raquo;',
    'prev_text' => '&laquo; Previous'
    );

  if( $wp_rewrite->using_permalinks() )
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

  if( !empty($wp_query->query_vars['s']) )
    $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

  echo '<div class="pagination">';
  echo paginate_links( $pagination );
  echo '</div>';
}

// Chop long string
function chop_string($string, $limit) {
  if (strlen($string) <= $limit) {
    return $string;
  }
  $wstring = explode("\n", wordwrap($string, $limit, "\n"));
  return $wstring[0] . '&hellip;';
}



/*
  Theme settings
  -----------------------------------------------
 */

// Register navs
register_nav_menus( array(
  'main_menu' => 'Main Menu',
  'footer_menu' => 'Footer Menu'
));

// Allow featured image
add_theme_support( 'post-thumbnails' );


// Add custom image sizes
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'small-thumb', 100, 130, true );
  add_image_size( 'med-thumb', 220, 160, true );
}

// Thumbnail upscale
function thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
    if ( !$crop ) return null; // let the wordpress default function handle this

    if ( $orig_w < 300 || $orig_h < 200 ) return null; // prevent upscaling tiny image

    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);

    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );

    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter( 'image_resize_dimensions', 'thumbnail_upscale', 10, 6 );


// Disable image link in post
function wpb_imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );

  if ($image_set !== 'none') {
    update_option('image_default_link_type', 'none');
  }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

// Change [...] from excerpt
function new_excerpt_more( $more ) {
  return '&hellip;';
}
add_filter('excerpt_more', 'new_excerpt_more');


/*
  Admin settings
  -----------------------------------------------
 */

// Add admin editor styles
add_editor_style('css/admin-editor.css');

// Custom CSS styles on WYSIWYG Editor
function mysite_mce( $init ) {
   //theme_advanced_blockformats seems deprecated - instead the hook from Helgas post did the trick
   $init['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4";

   //$init['style_formats']  doesn't work - instead you have to use tinymce style selectors
   $style_formats = array(
    array(
        'title' => 'Link',
        'block' => 'a',
        'classes' => 'link-button',
        'wrapper' => true
    )
   );
   //$init['style_formats'] = json_encode( $style_formats );
   return $init;
}
add_filter('tiny_mce_before_init', 'mysite_mce');


// Give editors access to Gravity forms
function add_grav_forms(){
  $role = get_role('editor');
  $role->add_cap('gform_full_access');
}
add_action('admin_init','add_grav_forms');


// Dashboard footer
if (! function_exists('dashboard_footer') ){
  function dashboard_footer () {
    echo 'Website crafted by <a href="http://uprise.co.nz" target="_blank">Uprise</a>';
  }
}
add_filter('admin_footer_text', 'dashboard_footer');


// Show PDF in media library view
function modify_post_mime_types( $post_mime_types ) {
  $post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );
  return $post_mime_types;
}
add_filter( 'post_mime_types', 'modify_post_mime_types' );



// ACF post object select filter
/*
function my_post_object_query( $args, $field, $post ) {
  // modify the order
  $args['orderby'] = 'post_date';
  $args['order'] = 'DESC';
  $args['posts_per_page'] = 5;
  return $args;
}
add_filter('acf/fields/post_object/query/key=field_537aa3efc8006', 'my_post_object_query', 10, 3); // Related exhibitions - Exhibition
*/


// Change category from checkbox to radio buttons
add_filter('wp_terms_checklist_args', 'wpse_64691_one_category_only', '', 2);
function wpse_64691_one_category_only( $args, $post_id){
    $args['walker'] = new WPSE_64691_Category_Radio;
    return $args;
}

class WPSE_64691_Category_Radio extends Walker {
    var $tree_type = 'category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id'); //TODO: decouple this

    function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent<ul class='children'>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
    }

    function start_el( &$output, $category, $depth, $args, $id = 0 ) {
            extract($args);
            if ( empty($taxonomy) )
                    $taxonomy = 'category';

            if ( $taxonomy == 'category' )
                    $name = 'post_category';
            else
                    $name = 'tax_input['.$taxonomy.']';

            $class = in_array( $category->term_id, $popular_cats ) ? ' class="popular-category"' : '';
            if ( $taxonomy == 'category' )
                $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" . '<label class="selectit"><input value="' . $category->term_id . '" type="radio" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' . checked( in_array( $category->term_id, $selected_cats ), true, false ) . disabled( empty( $args['disabled'] ), false, false ) . ' /> ' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
            else
                $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" . '<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' . checked( in_array( $category->term_id, $selected_cats ), true, false ) . disabled( empty( $args['disabled'] ), false, false ) . ' /> ' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
    }

    function end_el( &$output, $category, $depth = 0, $args = array() ) {
            $output .= "</li>\n";
    }
}



?>
