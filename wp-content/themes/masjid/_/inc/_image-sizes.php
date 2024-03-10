<?php
// =================================================================
// ====== Custom image sizes
// =================================================================

// Add new image sizes
function custom_image_sizes( $image_sizes ) {
  // get the custom image sizes
  global $_wp_additional_image_sizes;
  // if there are none, just return the built-in sizes
  if ( empty( $_wp_additional_image_sizes ) )
    return $image_sizes;

  // add all the custom sizes to the built-in sizes
  foreach ( $_wp_additional_image_sizes as $id => $data ) {
    // take the size ID (e.g., 'my-name'), replace hyphens with spaces,
    // and capitalise the first letter of each word
    if ( !isset($image_sizes[$id]) )
      $image_sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
    }

  return $image_sizes;
}

function custom_image_setup () {
add_theme_support( 'post-thumbnails' );
// add_image_size('1x1', 1, 1, TRUE); // useful for colour backgrounds
// add_image_size('200w', 200);
// add_image_size('500w', 500);
/* add_image_size('800w', 800);
add_image_size('1400w', 1400);
add_image_size('2000w', 2000); */

// Squares
//add_image_size('800x800', 800, 800, TRUE);
//add_image_size('495x450', 495, 450, TRUE);
// add_image_size('367x377', 367, 377, TRUE);


// To hide these sizes from the admin area, comment out line below
add_filter( 'image_size_names_choose', 'custom_image_sizes' );
}
add_action( 'after_setup_theme', 'custom_image_setup' );
?>