<?php
// =================================================================
// ====== DEVICE DETECTION
// =================================================================


// Device functions
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect();
$GLOBALS['device'] = ($detect->isMobile() ? ($detect->isTablet() ? 'desktop' : 'mobile') : 'desktop');
$GLOBALS['device'] = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');

//$GLOBALS['device'] = 'mobile';

if (isset($_GET['fdev'])) $GLOBALS['device'] = $_GET['fdev'];

function get_device() { return $GLOBALS['device'];  }
function the_device() { echo get_device(); }
function is_mobile() { return $GLOBALS['device']=='mobile';}
function is_tablet() { return $GLOBALS['device']=='tablet';}
function is_desktop() { return $GLOBALS['device']=='desktop';}


//
function get_device_image($url_or_id,$device_sizes,$class="") {
    if (is_string($device_sizes)) $device_sizes = deserialize_device_sizes($device_sizes);
    $device = get_device();
    if (!isset($device_sizes[$device])) return;
    return get_image($url_or_id,$device_sizes[$device][0],$device_sizes[$device][1],$device_sizes[$device][2],$class);
}


/**
 * the_device_image($id,array('desktop'=>array(120,130,1),'mobile'=>array(120,130,1),'mobile'=>array(120,130,1)))
 * the_device_image($id,'desktop:120x130c,mobile:120x130c,tablet:120x130')
 */
function the_device_image($url_or_id,$device_sizes,$class="") {
    if (is_string($device_sizes)) $device_sizes = deserialize_device_sizes($device_sizes);
    $device = get_device();
    if (!isset($device_sizes[$device])) return;
    the_image($url_or_id,$device_sizes[$device][0],$device_sizes[$device][1],$device_sizes[$device][2],$class);
}

function deserialize_device_sizes($serialized_sizes) {
    $serialized_sizes = explode(',',$serialized_sizes);
    $device_sizes = array();
    foreach ($serialized_sizes as $size_string) {
        preg_match('/(\w+):(\d+)x(\d+)(c)?/i', $size_string,$matches);
        $name = $matches[1];
        $crop = isset($matches[4]);
        $device_sizes[$name] = array($matches[2],$matches[3],$crop);
    }
    return $device_sizes;
}


// Now add the_device(); to the html class to return desktop | tablet | mobile
// <html class="desktop">
?>
