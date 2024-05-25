<?php
// =================================================================
// ====== Custom admin + menus
// =================================================================


/* Theme support for menus */
add_theme_support('menus');
add_post_type_support('page', 'excerpt');
add_theme_support('title-tag');

// Remove width and height attributes from images via WYSIWYG/admin
add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);

function remove_width_attribute($html)
{
  $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
  return $html;
}


// Image link default = none
update_option('image_default_link_type', 'none');


// logo link
function wpc_url_login()
{
  return "/";
}
add_filter('login_headerurl', 'wpc_url_login');




//change the menu items label Posts to Articles
// Function to change menu and submenu labels for Posts
function change_post_menu_label()
{
  global $menu;
  global $submenu;
  $menu[5][0] = 'Announcements';
  $submenu['edit.php'][5][0] = 'Announcements Posts';
  $submenu['edit.php'][10][0] = 'Add Announcements';
  $submenu['edit.php'][15][0] = 'Categories'; // Change name for categories
  //$submenu['edit.php'][16][0] = 'Labels'; // Change name for tags
}
add_action('admin_menu', 'change_post_menu_label');

// Function to change labels for Posts
function change_post_object_label()
{
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'Announcements';
  $labels->singular_name = 'Announcements';
  $labels->add_new = 'Add Announcements Post';
  $labels->add_new_item = 'New Announcements Post';
  $labels->edit_item = 'Edit Announcements Post';
  $labels->new_item = 'Announcements Post';
  $labels->view_item = 'View Announcements Post';
  $labels->search_items = 'Search Announcements';
  $labels->not_found = 'Nothing found';
  $labels->not_found_in_trash = 'Nothing found in Trash';
}
add_action('init', 'change_post_object_label');

// Function to register custom post type "Prayers Time"
// function register_prayers_time_post_type()
// {
//   $labels = array(
//     'name'               => 'Prayers Time',
//     'singular_name'      => 'Prayers Time',
//     'add_new'            => 'Add New Prayers Time',
//     'add_new_item'       => 'Add New Prayers Time',
//     'edit_item'          => 'Edit Prayers Time',
//     'new_item'           => 'New Prayers Time',
//     'view_item'          => 'View Prayers Time',
//     'search_items'       => 'Search Prayers Time',
//     'not_found'          => 'No Prayers Time found',
//     'not_found_in_trash' => 'No Prayers Time found in Trash',
//     'parent_item_colon'  => 'Parent Prayers Time:',
//     'menu_name'          => 'Prayers Time'
//   );

//   $args = array(
//     'labels'              => $labels,
//     'public'              => true,
//     'has_archive'         => true,
//     'publicly_queryable'  => true,
//     'query_var'           => true,
//     'rewrite'             => true,
//     'capability_type'     => 'post',
//     'hierarchical'        => false,
//     'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields'),
//     'menu_position'       => 5,
//     'menu_icon'           => 'dashicons-clock', // You can change the icon
//     'show_in_rest'        => true
//   );

//   register_post_type('prayers_time', $args);
// }
// add_action('init', 'register_prayers_time_post_type');




// ================================================
/**
 * Hide ACF menu item from the admin menu
 */

function remove_acf_menu()
{

  // provide a list of usernames who can edit custom field definitions here
  $admins = array(
    'sajjad',
    'sakib'
  );

  // get the current user
  $current_user = wp_get_current_user();

  // match and remove if needed
  if (!in_array($current_user->user_login, $admins)) {
    remove_menu_page('edit.php?post_type=acf-field-group');
  }
}

add_action('admin_menu', 'remove_acf_menu');


// ================================================

function remove_menus()
{

  // leave the itmes in that you want removed

  global $menu;
  $restricted = array(__('Appearance'), __('Links'), __('Comments'));
  end($menu);
  while (prev($menu)) {
    $value = explode(' ', $menu[key($menu)][0]);
    if (in_array($value[0] != NULL ? $value[0] : "", $restricted)) {
      unset($menu[key($menu)]);
    }
  }
}

add_action('admin_menu', 'remove_menus');


// ================================================

function new_nav_menu()
{
  global $menu;
  $menu[99] = array('', 'read', 'separator', '', 'menu-top menu-nav');
  add_menu_page(__('Navigation', 'nav-menus'), __('Navigation', 'nav-menus'), 'edit_themes', 'nav-menus.php', '', 'dashicons-menu', 60);
}
add_action('admin_menu', 'new_nav_menu');


// ================================================

function remove_footer_admin()
{


  echo '<p>' . bloginfo("name") . '</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');




/*
	Disable Default Dashboard Widgets
	@ https://digwp.com/2014/02/disable-default-dashboard-widgets/
*/


function disable_default_dashboard_widgets()
{
  global $wp_meta_boxes;
  // wp..
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
  // bbpress
  unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);
  // yoast seo
  unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
  // gravity forms
  unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);


// Welcome to Wordpress widget
remove_action('welcome_panel', 'wp_welcome_panel');



// Add a widget in WordPress Dashboard
function add_dashboard_widget_function()
{
  // Entering the text between the quotes

  //  echo "<p style='text-align:center'><img style='max-width:250px;height:auto;' src='". get_template_directory_uri() ."/_/img/logo.png' /></p>";

  echo "<p style='text-align:center;font-size: 18px;text-transform:uppercase;'>";
  echo get_bloginfo('name');
  echo "</p>";
}



function wpc_add_dashboard_widgets()
{
  wp_add_dashboard_widget('wp_dashboard_widget', '&nbsp;', 'add_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets');



function remove_admin_bar_links()
{
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
  $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
  $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
  $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
  $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
  $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
  //$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
  $wp_admin_bar->remove_menu('themes');
  $wp_admin_bar->remove_menu('dashboard');
  $wp_admin_bar->remove_menu('menus');
  $wp_admin_bar->remove_menu('search');
  $wp_admin_bar->remove_menu('customize');
  $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
  $wp_admin_bar->remove_menu('updates');          // Remove the updates link
  $wp_admin_bar->remove_menu('comments');         // Remove the comments link
  //$wp_admin_bar->remove_menu('new-content');      // Remove the content link
  //$wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
  //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');


// remove from menus

function remove_sub_menus()
{
  //remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}
add_action('admin_menu', 'remove_sub_menus');

// Remove meta boxes
function remove_post_metaboxes()
{
  //  remove_meta_box( 'categorydiv','post','normal' ); // Categories Metabox
  remove_meta_box('tagsdiv-post_tag', 'post', 'normal'); // Tags Metabox
}
add_action('admin_menu', 'remove_post_metaboxes');


// Remove tags and comments columns from posts list
function my_manage_columns($columns)
{
  unset($columns['comments']);
  unset($columns['tags']);
  return $columns;
}

function my_column_init()
{
  add_filter('manage_posts_columns', 'my_manage_columns');
}
add_action('admin_init', 'my_column_init');


// Prepopulate ACF field with post categories

function acf_load_post_categories($field)
{

  // reset choices
  $field['choices'] = array();


  $categories = get_categories(array(
    'orderby' => 'name',
    'order'   => 'ASC'
  ));

  foreach ($categories as $category) {
    // vars
    $value = $category->term_id;
    $label = $category->name;


    // append to choices
    $field['choices'][$value] = $label;
  } // end foreach


  // return the field
  return $field;
}

add_filter('acf/load_field/name=panels__category', 'acf_load_post_categories');


// allow vcard 

// function ct_thz_enable_vcard_upload($mime_types)
// {
//   $mime_types['vcf'] = 'text/vcard';
//   $mime_types['vcard'] = 'text/vcard';
//   return $mime_types;
// }
// add_filter('upload_mimes', 'ct_thz_enable_vcard_upload');



// function slug_save_post_callback($post_ID, $post, $update)
// {
//   // allow 'publish', 'draft', 'future'
//   if ($post->post_type != 'ib-transaction' || $post->post_status == 'auto-draft')
//     return;

//   // only change slug when the post is created (both dates are equal)
//   if ($post->post_date_gmt != $post->post_modified_gmt)
//     return;

//   $subtitle = sanitize_title(get_field('client_name', $post_ID), '');

//   if(get_field('target', $post_ID)){
//     $subtitle .= '-' . sanitize_title(get_field('target', $post_ID), ''); 
//   }
//   if (get_field('counter_party_name', $post_ID)) {
//     $subtitle .= '-' . sanitize_title(get_field('counter_party_name', $post_ID), '');
//   }
//   if (get_field('final_counter_part_name', $post_ID)) {
//     $subtitle .= '-' . sanitize_title(get_field('final_counter_part_name', $post_ID), '');
//   }


//   $new_slug = $subtitle;
//   if ($new_slug == $post->post_name)
//     return; // already set

//   // unhook this function to prevent infinite looping
//   remove_action('save_post', 'slug_save_post_callback', 10, 3);
//   // update the post slug (WP handles unique post slug)
//   wp_update_post(array(
//     'ID' => $post_ID,
//     'post_name' => $new_slug
//   ));
//   // re-hook this function
//   add_action('save_post', 'slug_save_post_callback', 10, 3);
// }
// add_action('save_post', 'slug_save_post_callback', 10, 3); 

// initial hook
//  add_action('save_post', 'wpse105926_save_post_callback', 10, 3);



// // sort transections by defauly by date 
// function wpse_819391_post_types_admin_order($wp_query)
// {
//   if (is_admin() && !isset($_GET['orderby'])) {
//     // Get the post type from the query
//     $post_type = $wp_query->query['post_type'];
//     if (in_array($post_type, array('deal'))) {
//       $wp_query->set('orderby', 'meta_value_num');
//       $wp_query->set('meta_key', 'deal_date');
//       $wp_query->set('order', 'DESC');
//     }
//   }
// }
// add_filter('pre_get_posts', 'wpse_819391_post_types_admin_order');



// edit feed
function f_the_author($display_name)
{
  if (is_feed()) {
    return '';
  }
  return $display_name;
}

add_filter('the_author', 'f_the_author', PHP_INT_MAX, 1);

// login error message 
function no_wordpress_errors()
{
  return 'Something is wrong!';
}
add_filter('login_errors', 'no_wordpress_errors');

/*Remove login autocomplete*/
add_action('login_init', 'ct_autocomplete_login_init');
function ct_autocomplete_login_init()
{
  ob_start();
}

add_action('login_form', 'ct_autocomplete_login_form');
function ct_autocomplete_login_form()
{
  $content = ob_get_contents();
  ob_end_clean();
  $content = str_replace('id="loginform"', 'id="loginform" autocomplete="off"', $content);
  /* $content = str_replace('id="user_login"', 'id="user_login" autocomplete="off"', $content);
  $content = str_replace('id="user_pass"', 'id="user_pass" autocomplete="off"', $content); */
  echo $content;
}
