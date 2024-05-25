<?php

// Functions kept in includes to allow quick commenting out and organised
// --------------------------------------------------------------------
require(get_template_directory() . '/_/inc/wp-bootstrap-navwalker.php');

// Gutenberg ACF custom blocks
// Main thing to note is custom blocks will not show unless added to underpants_allowed_block_types
require(get_template_directory() . '/_/inc/_gutenberg.php');


// Register navs
require(get_template_directory() . '/_/inc/_register-navs.php');
//require(get_template_directory() . '/_/inc/_breadcrumb.php');


// Allows code snippets to be placed in head and body tags
// Intended for Analyics etc.
require(get_template_directory() . '/_/inc/_custom-acf-code-snippets.php');
require(get_template_directory() . '/_/inc/_404-acf.php');

// Helpful functions for customising the admin area
require(get_template_directory() . '/_/inc/_custom-wpadmin.php');

// Custom image sizes
require(get_template_directory() . '/_/inc/_image-sizes.php');



/**
 * Custom admin login header link alt text
 */
function custom_login_title()
{
    return get_option('blogname');
}
add_filter('login_headertext', 'custom_login_title');

// style and js include

function site_styles_scripts()
{
    $theme_url  = get_template_directory_uri();

    wp_enqueue_style('theme-style', $theme_url . '/_/css/screen.min.css', array(), filemtime(get_template_directory() . '/_/css/screen.min.css'));

    // script
    //----------------       
    wp_enqueue_script('swiper-bundle-script', $theme_url . '/_/js/swiper-bundle.min.js', array('jquery'), null, true);      
    wp_enqueue_script('jarallax-script', $theme_url . '/_/js/jarallax.min.js', array(), null, true);
    wp_enqueue_script('gasp-script', $theme_url . '/_/js/gasp.min.js', array(), null, true);
    wp_enqueue_script('custom-script', $theme_url . '/_/js/functions.js', array(), filemtime(get_template_directory() . '/_/js/functions.js'), true);
}
add_action('wp_enqueue_scripts', 'site_styles_scripts');

/// favicon add 
function add_my_favicon()
{
    $favicon_path = esc_url(get_field('favicon_upload', 'options'));
    echo '<link rel="shortcut icon" href="' . esc_url($favicon_path) . '" type="image/x-icon" id="faviconTag" />';
}

add_action('wp_head', 'add_my_favicon'); //front end
add_action('admin_head', 'add_my_favicon'); //admin end




// Recursive function to build the menu array
function build_menu_array($menu_items, $parent_id = 0)
{
    $menu_array = array();

    foreach ($menu_items as $menu_item) {
        if ($menu_item->menu_item_parent == $parent_id) {
            $submenu = build_menu_array($menu_items, $menu_item->ID);

            if (is_page($menu_item->object_id)) {
                $active_class = 'active'; // Add the active class if the current page matches the menu item
            }

            $menu_array[] = array(
                'menu_id' => $menu_item->ID,
                'title' => $menu_item->title,
                'url' => $menu_item->url,
                'description' => $menu_item->description,
                'classes' => implode(" ",  $menu_item->classes),
                'submenu' => $submenu,
            );
        }
    }

    return $menu_array;
}

add_filter('wp_get_nav_menu_items', 'prefix_nav_menu_classes', 10, 3);

function prefix_nav_menu_classes($items, $menu, $args)
{
    _wp_menu_item_classes_by_context($items);
    return $items;
}


function custom_lang_select()
{

    $languages = apply_filters('wpml_active_languages', NULL, array('skip_missing' => 0));

    if (!empty($languages)) {
        foreach ($languages as $language) {
            echo $language['active'] ? '<span>' . strtoupper($language['language_code']) . '</span>'  : '';
        }
        echo '<div class="langs">';
        foreach ($languages as $language) {
            echo !$language['active'] ? '<a href="' . $language['url'] . '">' . strtoupper($language['language_code']) . '</a>' : '';
        }
        echo '</div>';
    }
}

