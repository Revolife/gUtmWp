<?php
/**
 * @package gUtmWp
 * @author Grom <grom@revolife.com>
 * @version 1.0
 */

/*
Plugin Name: Google UTM WP
Plugin URI: https://github.com/Revolife/gUtmWp
Description: Determine the Google UTM (Urchin Tracking Module) tails.
Version: 1.0.1
Author: Grom
Author URI: https://revolife.com
License: GPL2
*/

defined('DS') or define('DS',DIRECTORY_SEPARATOR);
defined('gUtmpWp_PLUG_PATH') or define('gUtmpWp_PLUG_PATH',dirname(__FILE__));


require gUtmpWp_PLUG_PATH.DS.'plugin-update-checker'.DS.'plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'http://update.wp.alphaspace.pro/?action=get_metadata&section=plugin&slug='.basename(dirname(__FILE__)), //Metadata URL.
    __FILE__, //Full path to the main plugin file.
    basename(dirname(__FILE__)) //Plugin slug. Usually it's the same as the name of the directory.
);

require_once(gUtmpWp_PLUG_PATH.DS.'core'.DS.'gutm.php');
require_once(gUtmpWp_PLUG_PATH.DS.'core'.DS.'gutmwp.php');

gUtmWp::start();
?>
