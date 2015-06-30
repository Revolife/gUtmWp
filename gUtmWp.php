<?php
/**
 * @package gUtmWp
 * @author Grom <grom@revolife.com>
 * @version 1.0
 */

/*
Plugin Name: Google UTM WP
Plugin URI: https://github.com/Revolife/gUtmWp
Description: determine the Google UTM (Urchin Tracking Module) tails.
Version: 1.0
Author: Grom
Author URI: https://revolife.com
License: GPL2
*/

defined('DS') or define('DS',DIRECTORY_SEPARATOR);
defined('gUtmpWp_PLUG_PATH') or define('gUtmpWp_PLUG_PATH',dirname(__FILE__));

require_once(gUtmpWp_PLUG_PATH.DS.'core'.DS.'gutm.php');
require_once(gUtmpWp_PLUG_PATH.DS.'core'.DS.'gutmwp.php');

gUtmWp::start();
?>
