<?php

// Functions kept in includes to allow quick commenting out and organised
// --------------------------------------------------------------------
//require(get_template_directory() . '/_/inc/wp-bootstrap-navwalker.php');

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


// date and time generate 

// Function to convert Gregorian date to Hijri date
function gregorianToHijri($year, $month, $day)
{
    $jd = gregoriantojd($month, $day, $year);
    $hijri = jdToHijri($jd);
    return $hijri;
}

// Helper function to convert Julian Day to Hijri date
function jdToHijri($jd)
{
    $jd = $jd - 1948440 + 10632;
    $n = (int) (($jd - 1) / 10631);
    $jd = $jd - 10631 * $n + 354;
    $j = ((int) ((10985 - $jd) / 5316)) * ((int) (50 * $jd / 17719)) + ((int) ($jd / 5670)) * ((int) (43 * $jd / 15238));
    $jd = $jd - ((int) ((30 - $j) / 15)) * ((int) ((17719 * $j) / 50)) - ((int) ($j / 16)) * ((int) ((15238 * $j) / 43)) + 29;
    $month = (int) ((24 * $jd) / 709);
    $day = $jd - (int) ((709 * $month) / 24);
    $year = 30 * $n + $j - 30;
    return array($year, $month, $day);
}

// Function to display the date in the specified format
function display_custom_date()
{
    // Create a DateTime object for the current date
    $now = new DateTime('now', new DateTimeZone('Asia/Tokyo'));

    // Get the day name in English
    $english_day_name = $now->format('l');

    // Get the current Gregorian date
    $year = $now->format('Y');
    $month = $now->format('m');
    $day = $now->format('d');

    // Convert Gregorian date to Hijri date
    list($hijri_year, $hijri_month, $hijri_day) = gregorianToHijri($year, $month, $day);

    // Define Hijri months in English
    $hijri_months = array(
        1 => 'Muharram',
        2 => 'Safar',
        3 => 'Rabi\' al-awwal',
        4 => 'Rabi\' al-thani',
        5 => 'Jumada al-awwal',
        6 => 'Jumada al-thani',
        7 => 'Rajab',
        8 => 'Sha\'ban',
        9 => 'Ramadan',
        10 => 'Shawwal',
        11 => 'Dhu al-Qi\'dah',
        12 => 'Dhu al-Hijjah'
    );

    // Format the Hijri date
    $hijri_date = "$hijri_day " . $hijri_months[$hijri_month] . " $hijri_year";

    // Get the English date format
    $english_date = $now->format('F j, Y (D)');

    // Return the formatted date
    return "$english_day_name, $hijri_date $english_date";
}



// write a cron to load salat time for saitama city from api and save to acf field
function fetch_and_save_salat_times()
{
    $api_url = 'https://api.aladhan.com/v1/timingsByCity?city=saitama&country=Japan&method=3';
    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        return; // Exit if there's an error
    }
    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (isset($data['data']['timings']['Maghrib'])) {
        $salat_times = $data['data']['timings']['Maghrib'];
        // add 5 minutes to this salat time before saving
        $time = DateTime::createFromFormat('H:i', $salat_times);
        $time->modify('+5 minutes');
        $salat_times = $time->format('H:i');

        // convert to 12 hour format
        $salat_times = date("g:i A", strtotime($salat_times));

        // Load the ACF options array and update only the Maghrib/Magrib entry's prayer_time
        $time_sheets = get_field('time_sheets', 'option');
        if (is_array($time_sheets)) {
            foreach ($time_sheets as $idx => $item) {
                if (isset($item['prayer_name'])) {
                    $name = strtolower(trim($item['prayer_name']));
                    if ($name === 'magrib' || $name === 'maghrib' || stripos($name, 'magr') !== false) {
                        $time_sheets[$idx]['prayer_time'] = $salat_times;
                        break;
                    }
                }
            }
            // Save updated array back to ACF options
            update_field('time_sheets', $time_sheets, 'option');
        }
        // Also save the single salat_times option value
        update_field('salat_times', $salat_times, 'option');
    }
}
if (!wp_next_scheduled('update_salat_times_event')) {
    //wp_schedule_event(time(), 'hourly', 'update_salat_times_event');
    // schedule the event to run once in daily interval
    wp_schedule_event(time(), 'daily', 'update_salat_times_event');
}
add_action('update_salat_times_event', 'fetch_and_save_salat_times');
